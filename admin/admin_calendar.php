<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: admin_calendar.php,v 1.21 2013/10/08 19:43:41 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

if ( !empty( $setmodules ) )
{
	$filename = basename( __FILE__ );
	$module['Calsnails_title']['1_Settings'] = 'modules/mx_calsnails/admin/' . $filename;
	return;
}

$mx_root_path = './../../../';
$module_root_path = "./../";
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require( $mx_root_path . '/admin/pagestart.' . $phpEx );

include_once( $mx_root_path . 'admin/page_header_admin.' . $phpEx );
include_once( $module_root_path . 'includes/mx_common.' . $phpEx );

// **********************************************************************
// Read language definition
// **********************************************************************
$default_lang = ($mx_user->lang['default_lang']) ? $mx_user->decode_lang($mx_user->lang['default_lang']) : $board_config['default_lang'];
// -------------------------------------------------------------------------
// Read Module Main Language Definition
// -------------------------------------------------------------------------
if ((@include $module_root_path . "language/lang_" . $default_lang . "/lang_main.$phpEx") === false)
{
	if ((@include $module_root_path . "language/lang_english/lang_main.$phpEx") === false)
	{
		mx_message_die(CRITICAL_ERROR, 'Module main language file ' . $mx_root_path . $module_root_path . "language/lang_" . $default_lang . "/lang_main.$phpEx" . ' couldn\'t be opened.');
	}
}

$caltable = CALADV_CONFIG_TABLE;

$sql = "SELECT * FROM " . $caltable;
if ( !$result = $db->sql_query( $sql ) )
{
	mx_message_die( GENERAL_ERROR, "Couldn't query calendar config table", "", __LINE__, __FILE__, $sql );
}
else
{
	while ( $row = $db->sql_fetchrow( $result ) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = $config_value;

		$new[$config_name] = ( isset( $HTTP_POST_VARS[$config_name] ) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];
		if ( isset( $HTTP_POST_VARS['submit'] ) )
		{
			$sql = "UPDATE " . $caltable . " SET
				config_value = '" . str_replace( "\'", "''", $new[$config_name] ) . "'
				WHERE config_name = '$config_name'";
			if ( !$db->sql_query( $sql ) )
			{
				mx_message_die( GENERAL_ERROR, "Failed to update calendar configuration for $config_name", "", __LINE__, __FILE__, $sql );
			}
		}
	}

	$db->sql_freeresult($result);

	if ( isset( $HTTP_POST_VARS['submit'] ) )
	{
		$message = $lang['Cal_config_updated'] . "<br /><br />" . sprintf( $lang['Cal_return_config'], "<a href=\"" . mx_append_sid( "admin_calendar.$phpEx" ) . "\">", "</a>" ) . "<br /><br />" . sprintf( $lang['Click_return_admin_index'], "<a href=\"" . mx_append_sid( $mx_root_path . "admin/index.$phpEx?pane=right" ) . "\">", "</a>" );
		mx_message_die( GENERAL_MESSAGE, $message );
	}
}

//
// Build Week Start select box
//
$week_start_select = "<select name='week_start'>";
$week_start_select .= "<option value='0' ";
$week_start_select .= ( $new['week_start'] == '0' ) ? "selected='selected'" : "";
$week_start_select .= ">" . $lang['datetime']['Sunday'] . "</option>";
$week_start_select .= "<option value='1' ";
$week_start_select .= ( $new['week_start'] == '1' ) ? "selected='selected'" : "";
$week_start_select .= ">" . $lang['datetime']['Monday'] . "</option>";
$week_start_select .= "</select>";

$allow_anon_yes = ( $new['allow_anon'] ) ? "checked=\"checked\"" : "";
$allow_anon_no = ( !$new['allow_anon'] ) ? "checked=\"checked\"" : "";

$allow_old_yes = ( $new['allow_old'] ) ? "checked=\"checked\"" : "";
$allow_old_no = ( !$new['allow_old'] ) ? "checked=\"checked\"" : "";

$show_headers_yes = ( $new['show_headers'] ) ? "checked=\"checked\"" : "";
$show_headers_no = ( !$new['show_headers'] ) ? "checked=\"checked\"" : "";

function get_caladv_levels( $field )
{
	global $lang, $new;

	$cal_levels[0] = $lang['no_public'];
	$cal_levels[1] = $lang['view_only'];
	$cal_levels[2] = $lang['view_suggest'];
	$cal_levels[3] = $lang['view_add'];
	$cal_levels[4] = $lang['view_edit_own'];
	$select = "<select name='" . $field . "'>";
	for ( $i = 0; $i <= 4; $i++ )
	{
		$select .= "<option value='" . $i;
		if ( $i == $new[$field] )
		{
			$select .= "' selected='selected'>\n";
		}
		else
		{
			$select .= "'>\n";
		}
		$select .= $cal_levels[$i] . "</option>";
	}
	return $select .= "</select>";
}

$s_cal_anon = get_caladv_levels( 'allow_anon' );
$s_cal_type = get_caladv_levels( 'allow_user_default' );

$template->set_filenames( array( "body" => "admin/calendar_config_body.tpl" ) );

$template->assign_vars( array(
	"S_CONFIG_ACTION" => mx_append_sid( "admin_calendar.$phpEx" ),

	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],
	"L_CONFIGURATION_TITLE" => $lang['Config_Calendar'],
	"L_GENERAL_SETTINGS" => $lang['Config_Calendar'],
	"L_CONFIGURATION_EXPLAIN" => $lang['Config_Calendar_explain'],
	"L_WEEK_START" => $lang['week_start'],
	"L_SUBJECT_LENGTH" => $lang['subject_length'],
	"L_SUBJECT_LENGTH_EXPLAIN" => $lang['subject_length_explain'],
	"L_ALLOW_ANON" => $lang['allow_anon'],
	"L_ALLOW_USER_POST" => $lang['allow_user_post'],
	"L_ALLOW_ANON_DEFAULT" => $lang['allow_anon_post_default'],
	"L_ALLOW_USER_DEFAULT" => $lang['allow_user_post_default'],
	"L_ALLOW_OLD" => $lang['allow_old'],
	"L_ALLOW_OLD_EXPLAIN" => $lang['allow_old_explain'],
	"L_SHOW_HEADERS" => $lang['show_headers'],
	"L_DATE_FORMAT" => $lang['Date_format'],
	"L_DATE_FORMAT_EXPLAIN" => $lang['cal_date_explain'],

	"L_SUBMIT" => $lang['Submit'],
	"L_RESET" => $lang['Reset'],

	"WEEK_START_SELECT" => $week_start_select,
	"SUBJECT_LENGTH" => $new['subject_length'],
	"SCIPT_PATH" => $new['cal_script_path'],

	"S_ALLOW_ANON_YES" => $allow_anon_yes,
	"S_ALLOW_ANON_NO" => $allow_anon_no,
	"S_ALLOW_USER_POST_YES" => $allow_user_post_yes,
	"S_ALLOW_USER_POST_NO" => $allow_user_post_no,
	"S_ALLOW_ANON_DEFAULT" => $s_cal_anon, // MX005: added
	"S_ALLOW_USER_DEFAULT" => $s_cal_type,
	"S_ALLOW_OLD_YES" => $allow_old_yes,
	"S_ALLOW_OLD_NO" => $allow_old_no,
	"S_SHOW_HEADERS_YES" => $show_headers_yes,
	"S_SHOW_HEADERS_NO" => $show_headers_no,
	"CAL_DATEFORMAT" => $new['cal_dateformat']
));

$template->pparse( "body" );
include_once( $mx_root_path . 'admin/page_footer_admin.' . $phpEx );
?>