<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: cal_functions.php,v 1.28 2014/04/09 08:54:21 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

/**
* @ignore
*/
if (!defined('IN_PORTAL'))
{
	die("Hacking attempt");
}

@define('JEWISH_SDN_OFFSET', 347997);
@define('HALAKIM_PER_HOUR', 1080);
@define('HALAKIM_PER_DAY', 25920);
@define('HALAKIM_PER_LUNAR_CYCLE', ((29*HALAKIM_PER_DAY)+13753));
@define('HALAKIM_PER_METONIC_CYCLE', (HALAKIM_PER_LUNAR_CYCLE * (12*19+7)));
@define('NEW_MOON_OF_CREATION', 31524);
@define('SUNDAY', 0);
@define('MONDAY', 1);
@define('TUESDAY', 2);
@define('WEDNESDAY', 3);
@define('THURSDAY', 4);
@define('FRIDAY', 5);
@define('SATURDAY', 6);
@define('NOON', (18*HALAKIM_PER_HOUR));
@define('AM3_11_20', ((9*HALAKIM_PER_HOUR)+204));
@define('AM9_32_43', ((15*HALAKIM_PER_HOUR)+589));
@define('ALAFIM', " אלפים ");

if(!defined('CAL_JEWISH_ADD_ALAFIM'))
{
	define('CAL_JEWISH_ADD_ALAFIM', 4);
}

if(!defined('CAL_JEWISH_ADD_ALAFIM_GERESH')) 
{
	define('CAL_JEWISH_ADD_ALAFIM_GERESH', 2);
}

if(!defined('CAL_JEWISH_ADD_GERESHAYIM')) 
{
	define('CAL_JEWISH_ADD_GERESHAYIM', 8);
}

$alef_bet 		= array('0','א','ב','ג','ד','ה','ו','ז','ח','ט','י','כ','ל','מ','נ','ס','ע','פ','צ','ק','ר','ש','ת');
$monthsPerYear 		= array(12, 12, 13, 12, 12, 13, 12, 13, 12, 12, 13, 12, 12, 13, 12, 12, 13, 12, 13 );
$yearOffset 		= array(0, 12, 24, 37, 49, 61, 74, 86, 99, 111, 123, 136, 148, 160, 173, 185, 197, 210, 222 );
$jewishMonthHebName 	= array('', 'TISHREI', 'CHESHVAN', 'KISLEV', 'TEVET', 'SHVAT', 'ADAR', 'ADAR_B', 'NISAN', 'IYYAR', 'SIVAN', 'TAMUZ', 'AV', 'ELUL');


//class AdvanceCalendar
class AdvanceCalendar extends JewishCalendar
{
	var $timestamp_decoding_function = 'getdate';
	var $year;
	var $month;
	var $day;
	var $date;	
	
	/**
	* Constructor for the calendar object.
	 *
	 * Please instantiate this class via <code>NativeCalendar::factory('Jewish')</code>.
	*/
	function init() 
	{
		global $db, $userdata, $debug, $cal_config;
		// Initialize defaults:
		global $phpEx;
		global $mx_user;
		
		$this->month = date(n); //gregorianMonth of Pasca or Omer
		$this->day = date(j); //regorianDay of Pasca or Omer
		$this->year = date(Y); //gregorianYear of Pasca or Omer		
		$this->date = date("D d M Y", strtotime("$this->year-$this->month-$this->day -0 days"));		
	}
	
	function canonize($date) 
	{
		return $this->_canonizeInputDate($date);
	}
	
	function tweakHolidaysCache() 
	{
		$this->cache['getHolidays'][5773][1][22][] = 'sukkot';
		$this->cache['getHolidays'][5773][1][22][] = 'lagBaOmer';
	}	
	
	/**
	* Set one of more settings.
	*
	* Various calendars may have various settings. Instead of
	* defining a separate setXYZ() function for each setting, we elect for
	* a central settings() method.
	*
	* A setting which all calendars are required to support is the 'language' setting. 
	* If may either be CAL_LANG_NATIVE or CAL_LANG_FOREIGN and it determines
	* the language in which the calendar 'talks.'
	*
	* @param array $settings
	*
	function settings($settings) 
	{
		$this->settings = array_merge($this->settings, $settings);
		return $this; // Allow for "fluid syntax".
	}
	*/
	
	/**
	 * load module.
	 *
	 * @param unknown_type $module_name send module name to load it
	 */
	function module( $id )
	{
		$module_name = 'Calendar';
		$classname = $id .'Calendar';	
		if (!class_exists($id . $module_name))
		{
			global $module_root_path, $phpEx;
			$this->module_name = $module_name;
			require_once($module_root_path . 'includes/' . $id .$module_name . '.' . $phpEx);
			eval( '$this->modules[' . $module_name . '] = new ' . $id . $module_name . '();' );
			if ( method_exists( $this->modules[$module_name], 'init' ) )
			{
				$this->modules[$module_name]->init();
			}
		}
	}	
	
	/**
	 * Add debug message.
	 *
	 * @param unknown_type $debug_msg
	 * @param unknown_type $file
	 * @param unknown_type $line_break
	 */
	function debug($debug_msg, $file = '', $line_break = true)
	{
		if ($this->debug)
		{
			$module_name = !empty($this->module_name) ? $this->module_name . ' :: ' : '';
			$file = !empty($file) ? ' (' . $file . ')' : '';
			$line_break = $line_break ? '<br>' : '';
			$this->debug_msg[] = $line_break . $module_name . $debug_msg . $file ;
		}
	}

	/*
	 * @file
	 * Some utility functions used by the main demonstration script.
	 *
	 * I won't bother documenting these functions, they should be obvious.
	 */
	function get_param($name, $default) 
	{
		global $mx_request_vars;
		if ($mx_request_vars->is_request($name))
		{
			return $mx_request_vars->request($name, MX_TYPE_NO_TAGS);
		}
		else
		{
			return $default;
		}
	}	
	
	function mxurl( $args = '', $jump_to_standalone_mode = false, $cal_page_id = '' )
	{
		global $thisscript, $generate_headers, $module_root_path, $page_id, $phpEx;
		if ( $generate_headers || $jump_to_standalone_mode )
		{
			$mxurl = $module_root_path . 'calendar.' . $phpEx . ( $args == '' ? '' : '?' . $args );
		}
		else
		{
			$mxurl = 'index.' . $phpEx;
			if ( is_numeric( $cal_page_id ) )
			{
				$mxurl .= '?page=' . $cal_page_id . ( $args == '' ? '' : '&amp;' . $args );
			}
			else if ( is_numeric( $page_id ) )
			{
				$mxurl .= '?page=' . $page_id . ( $args == '' ? '' : '&amp;' . $args );
			}
			else
			{
				$mxurl .= ( $args == '' ? '' : '?' . $args );
			}
		}
		return $mxurl;
	}	

	/**
	   * You may use this function to instantiate calendar objects.
	   *
	   * Instead of <code>$cal = new AdvanceCalendar</code>, do
	   * <code>$cal = NativeCalendar::factory('Advance')</code>.
	   *
	   * @static
	   * @param string $id
	   * @return object
	*/
	function factory($id = 'Advance', $settings = NULL) 
	{
		$module_name = 'Calendar';
		$classname = $id .'Calendar';	
		if (!class_exists($id . $module_name))
		{
			global $module_root_path, $phpEx;
		    if (@file_exists($module_root_path . 'includes/' . $id . $module_name . '.' . $phpEx)) 
			{
		      require_once($module_root_path . 'includes/' . $id .$module_name . '.' . $phpEx);
		    }		
		    $classname = $id . $module_name;
		}
		$obj = new $classname;
		// We keep the ID around in case some 3rd party code may wish to use it:
		$obj->name = $id;
		if (isset($settings)) 
		{
			$obj->settings($settings);
		}
		return $obj;
	}	
	
	function validate()
	{
		//
		// Start of MOD function (validate untrusted events)
		//
		global $thisscript, $phpbb_root_path, $phpEx, $db, $action, $template,
		$id, $day, $month, $year, $userdata, $lang, $config_footer, $footer, $caluser,
		$block_size,
		$cal_dateformat,
		$endday, $endmonth, $endyear, $homeurl, $board_config, $cal_version, $phpbbheaders;

		if ( $caluser >= 5 )
		{
			switch ( $action )
			{
				case "validevent":
					//
					// Validate the selected events.
					//
					if ( !$id )
					{
						mx_message_die( GENERAL_MESSAGE, $lang['Cal_must_sel_event'], '', __LINE__, __FILE__, '' );
					}
					//
					// $id is an array where checkboxes
					//
					while ( list( $thisid, $value ) = each( $id ) )
					{
						$sql = '';
						if ( $value == 'yes' )
						{
							$sql = "UPDATE " . CALADV_EVENTS_TABLE . " SET valid = 'yes' WHERE event_id = '$thisid'";
						}elseif ( $value == 'del' )
						{
							$sql = "DELETE FROM " . CALADV_EVENTS_TABLE . " WHERE event_id = '$thisid'";
						}
						if ( $sql )
						{
							if ( !( $query = $db->sql_query( $sql ) ) )
							{
								mx_message_die( GENERAL_ERROR, 'Could not validate events', '', __LINE__, __FILE__, $sql );
							}
						}
					}
					$message = $lang['Cal_event_validated'];
					$url = mx_append_sid( $this->mxurl( "month=" . $month . "&amp;year=" . $year ) );
					$message .= "</br></br><a href='" . $url . "'>" . $lang['Cal_back2cal'] . "</a>";
					mx_message_die( GENERAL_MESSAGE, $message, '', __LINE__, __FILE__, '' );
					// end of case
					break;

				case "getlist":
					//
					// Get the list of events waiting to be validated and display them for selection
					//
					$sql = "SELECT * FROM " . CALADV_EVENTS_TABLE . " WHERE valid='no' ORDER BY stamp";
					if ( !( $query = $db->sql_query( $sql ) ) )
					{
						mx_message_die( GENERAL_ERROR, 'Could not get events list to validate', '', __LINE__, __FILE__, $sql );
					}

					$url = mx_append_sid( $this->mxurl( "month=" . $month . "&amp;year=" . $year ) );

					$template->set_filenames( array( 'body' => 'cal_validate_events_lite.tpl' ) );

					$template->assign_vars( array( 'VALIDATE' => $lang['Validate'],
							'SELECT' => $lang['Select'],
							'SUBJECT' => $lang['Subject'],
							'DATE' => $lang['Date'],
							'END_DATE' => $lang['End_day'],
							'AUTHOR' => $lang['Username'],
							'BUTTON_HOME' => button_main( $url, $lang['Cal_back2cal'], 'center' ) )
						);

					if ( $phpbbheaders != '' )
					{
						$template->assign_block_vars( 'switch_show_headers', array() );
					}

					$template->assign_vars( array( 'BLOCK_SIZE' => $block_size, // MX001
							'PHPBBHEADER' => $phpbbheaders,
							'S_POST_ACTION' => $this->mxurl(),
							'CAL_VERSION' => 'Ver: ' . $cal_version,
							'CALENDAR' => $lang['Calendar'],
							'L_CAL_NEW' => $lang['Cal_add_event'],
							'U_INDEX' => mx_append_sid( "index.$phpEx" ),
							'L_INDEX' => sprintf( $lang['Forum_Index'], $board_config['sitename'] ),
							'U_CAL_HOME' => $homeurl )
						);

					$i = 0;
					while ( $row = $db->sql_fetchrow( $query ) )
					{
						$options = "<select name=id[" . $row['event_id'] . "]>
						<option value='hold' SELECTED>Hold</option>
						<option value='yes'>Accept</option>
						<option value='del'>Deny</option>
						</select>";

						$zdesc = $this->my_decode_bbtext( $row['description'], $row['bbcode_uid'] );
						$zsujet = stripslashes( $row['subject'] );

						$template->assign_block_vars( 'event_row', array( 'SELECT' => $options,
								'SUBJECT' => $zsujet,
								'DATE' => $this->my_dateformat( $row['stamp'], $cal_dateformat ),
								'END_DATE' => $this->my_dateformat( $row['eventspan'], $cal_dateformat, 1 ),
								'AUTHOR' => stripslashes( $row['username'] ),
								'DESC' => $zdesc )
							);
						$i++;
					}
					$db->sql_freeresult($result);

					if ( $i == 0 )
					{
						$template->assign_block_vars( 'no_events', array( 'NO_EVENTS' => $lang['No records'] ) 	);
						$submit_button = '';
					}
					else
					{
						$submit_button = "<input type='submit' accesskey='s' tabindex='6' name='post' class='mainoption' value='" . $lang['Submit'] . "' />";
					}
					$template->assign_vars( array( 'SUBMIT' => $submit_button ) );
					$template->pparse( 'body' );
					break;
			}
		}
		else
		{
			mx_message_die( GENERAL_MESSAGE, $lang['Cal_delete_event'], '', __LINE__, __FILE__, '' );
		}
		return;
	}

	function delete_marked()
	{
		global $thisscript, $phpbb_root_path, $phpEx, $action,
		$id, $day, $month, $year, $userdata, $lang, $config_footer, $footer, $caluser,
		$endday, $endmonth, $endyear, $homeurl, $db;
		if ( $caluser >= 4 )
		{
			if ( !$id )
			{
				mx_message_die( GENERAL_ERROR, $lang['Cal_must_sel_event'], '', __LINE__, __FILE__, $sql );
			}
			$sql = "SELECT event_id, user_id FROM " . CALADV_EVENTS_TABLE . " WHERE event_id = '$id'";
			if ( $caluser < 5 )
			{
				$sql .= " AND user_id = '" . $userdata['user_id'] . "'";
			}
			if ( !( $query = $db->sql_query( $sql ) ) )
			{
				mx_message_die( GENERAL_ERROR, 'Could not select event to delete from Table', '', __LINE__, __FILE__, $sql );
			}
			$row = $db->sql_fetchrow( $query );
			$db->sql_freeresult($result);

			if ( $row['event_id'] != '' )
			{
				$sql = "DELETE FROM " . CALADV_EVENTS_TABLE . " WHERE event_id = '$id'";
				if ( !( $query = $db->sql_query( $sql ) ) )
				{
					mx_message_die( GENERAL_ERROR, 'Could Not delete event from Table', '', __LINE__, __FILE__, $sql );
				}
				else
				{
					$url = mx_append_sid( $this->mxurl() );
					$message = $lang['Cal_event_delete'] . "<br><br><a href='" . $url . "'>" . $lang['Cal_back2cal'] . "</a>";
					mx_message_die( GENERAL_MESSAGE, $message, '', __LINE__, __FILE__, $sql );
				}
			}
			else
			{
				// Failed
				mx_message_die( GENERAL_ERROR, $lang['Cal_delete_event'], '', __LINE__, __FILE__, $sql );
			}
		}
		else
		{
			// Failed
			mx_message_die( GENERAL_ERROR, $lang['Cal_delete_event'], '', __LINE__, __FILE__, $sql );
		}
		return;
	}

	function modify_marked()
	{
		global $html_entities_match, $html_entities_replace;
		global $thisscript, $board_config, $phpbb_root_path, $phpEx, $action, $lastday, $phpbbheaders, $id, $day, $month, $year, $userdata, $lang, $config_footer, $footer, $caluser, $cal_version, $block_size, $endday, $endmonth, $endyear, $bbcode_uid, $homeurl, $db, $template, $mx_page, $mx_bbcode;

		if ( $caluser >= 4 )
		{
			if ( !$id )
			{
				mx_message_die( GENERAL_ERROR, $lang['Cal_must_sel_event'], '', __LINE__, __FILE__, '' );
			}
			$sql = "SELECT *, SUBSTRING(stamp FROM 12 FOR 5) AS thetime,
				SUBSTRING(stamp FROM 9 FOR 2) AS theday,
				SUBSTRING(eventspan FROM 9 FOR 2) AS theendday,
				SUBSTRING(stamp FROM 6 FOR 2) AS themonth,
				SUBSTRING(eventspan FROM 6 FOR 2) AS theendmonth,
				SUBSTRING(stamp FROM 1 FOR 4) AS theyear,
				SUBSTRING(eventspan FROM 1 FOR 4) AS theendyear
				FROM " . CALADV_EVENTS_TABLE . " WHERE event_id = '$id'";

			if ( !( $query = $db->sql_query( $sql ) ) )
			{
				// CHECK echo "<B>".mysql_error()."</B><BR><BR>"; exit;
				mx_message_die( GENERAL_ERROR, 'Could not select event to modify from Table', '', __LINE__, __FILE__, $sql );
			}

			$row = $db->sql_fetchrow( $query );
			$db->sql_freeresult($result);

			if ( $caluser == 5 || $userdata['user_id'] == $row['user_id'] )
			{
				$bbcode_uid = $row['bbcode_uid'];
				$zdesc = preg_replace( "/<br />/", "", $row['description'] );
				$zdesc = preg_replace( "/\:(([a-z0-9]:)?)" . $bbcode_uid . "/si", "", $zdesc );

				$hidden_form_fields = "<input type=hidden name=id value='" . $row['event_id'] . "'>
					<input type=hidden name=bbcode_uid value='" . $row['bbcode_uid'] . "'>
				   	<input type=hidden name=modify value='Modify'>";
				//$smilies_path = $board_config['smilies_path'];
				//$board_config['smilies_path'] = PHPBB_URL . $board_config['smilies_path'];
				$mx_bbcode->generate_smilies( 'inline', PAGE_POSTING );
				//$board_config['smilies_path'] = $smilies_path;
				$template->assign_vars( array( 'U_MORE_SMILIES' => mx_append_sid( PHPBB_URL . "posting.$phpEx?mode=smilies" ) ) );

				$template->set_filenames( array( 'body' => 'cal_posting_body_lite.tpl' ) );

				if ( $phpbbheaders != '' )
				{
					$template->assign_block_vars( 'switch_show_headers', array() );
				}

				$template->assign_vars( array(
					'BLOCK_SIZE' => $block_size, // MX001
					'PHPBBHEADER' => $phpbbheaders,
					'CAL_VERSION' => 'Ver: ' . $cal_version,
					'CALENDAR' => $lang['Calendar'],
					'L_CAL_NEW' => $lang['Cal_mod_marked'],
					'U_INDEX' => mx_append_sid( "index.$phpEx" ),
					'L_INDEX' => sprintf( $lang['Forum_Index'], $board_config['sitename'] ),
					'U_CAL_HOME' => $homeurl )
				);

				$template->assign_vars( array(
					'SUBJECT' => $row['subject'],
					'MESSAGE' => stripslashes( $zdesc ),

					'L_SUBJECT' => $lang['Subject'],
					'L_MESSAGE_BODY' => $lang['Cal_description'],
					'L_SUBMIT' => $lang['Cal_mod_only'],
					'L_CANCEL' => $lang['Cancel'],

					'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
					'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
					'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
					'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'],
					'L_BBCODE_C_HELP' => $lang['bbcode_c_help'],
					'L_BBCODE_L_HELP' => $lang['bbcode_l_help'],
					'L_BBCODE_O_HELP' => $lang['bbcode_o_help'],
					'L_BBCODE_P_HELP' => $lang['bbcode_p_help'],
					'L_BBCODE_W_HELP' => $lang['bbcode_w_help'],
					'L_BBCODE_A_HELP' => $lang['bbcode_a_help'],
					'L_BBCODE_S_HELP' => $lang['bbcode_s_help'],
					'L_BBCODE_F_HELP' => $lang['bbcode_f_help'],
					'L_EMPTY_MESSAGE' => $lang['Empty_message'],

					'L_FONT_COLOR' => $lang['Font_color'],
					'L_COLOR_DEFAULT' => $lang['color_default'],
					'L_COLOR_DARK_RED' => $lang['color_dark_red'],
					'L_COLOR_RED' => $lang['color_red'],
					'L_COLOR_ORANGE' => $lang['color_orange'],
					'L_COLOR_BROWN' => $lang['color_brown'],
					'L_COLOR_YELLOW' => $lang['color_yellow'],
					'L_COLOR_GREEN' => $lang['color_green'],
					'L_COLOR_OLIVE' => $lang['color_olive'],
					'L_COLOR_CYAN' => $lang['color_cyan'],
					'L_COLOR_BLUE' => $lang['color_blue'],
					'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
					'L_COLOR_INDIGO' => $lang['color_indigo'],
					'L_COLOR_VIOLET' => $lang['color_violet'],
					'L_COLOR_WHITE' => $lang['color_white'],
					'L_COLOR_BLACK' => $lang['color_black'],

					'L_FONT_SIZE' => $lang['Font_size'],
					'L_FONT_TINY' => $lang['font_tiny'],
					'L_FONT_SMALL' => $lang['font_small'],
					'L_FONT_NORMAL' => $lang['font_normal'],
					'L_FONT_LARGE' => $lang['font_large'],
					'L_FONT_HUGE' => $lang['font_huge'],

					'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'],
					'L_STYLES_TIP' => $lang['Styles_tip'],

					'S_POST_ACTION' => mx_append_sid( $this->mxurl( "action=Addsucker" ) ),
					'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields )
				);

				// Day field
				$this_day = $this->create_day_drop( $row['theday'], 31 );
				// Month field
				$this_month = $this->create_month_drop( $row['themonth'], $row['theyear'] );
				// Year field
				$this_year = $this->create_year_drop( $row['theyear'] );
				// End Day field
				$end_day = $this->create_day_drop( $row['theendday'], 31 );
				// End Month field
				$end_month = $this->create_month_drop( $row['theendmonth'], $row['theendyear'] );
				// End Year field
				$end_year = $this->create_year_drop( $row['theendyear'] );
				// TIMEZONE FIX
				$currentmonth = phpBB2::create_date( "m", time(), $userdata['calsadv_timezone'] );

				$the_time = ( $row['thetime'] != '00:00' ) ? $row['thetime'] : '';

				// Set the rest of the Calendar fields
				$template->assign_vars( array(
					'L_CAL_DATE' => $lang['Cal_day'],
					'L_CAL_TIME' => $lang['Cal_hour'],
					'L_CAL_END_DATE' => $lang['End_day'],
					'THIS_DAY' => $this_day,
					'THIS_MONTH' => $this_month,
					'THIS_YEAR' => $this_year,
					'TIME' => $the_time,
					'END_DAY' => $end_day,
					'END_MONTH' => $end_month,
					'END_YEAR' => $end_year,
					'L_CAL_HOME' => $lang['Cal_back2cal'] )
				);

				$template->pparse( 'body' );
				return;
			}
			else
			{
				mx_message_die( GENERAL_ERROR, $lang['Cal_edit_own_event'], '', __LINE__, __FILE__, $sql );
			}
		}
		else
		{
			mx_message_die( GENERAL_ERROR, $lang['Cal_not_enough_access'], '', __LINE__, __FILE__, $sql );
		}
		return;
	}

	function cal_add_event()
	{
		global $thisscript, $phpbb_root_path, $phpEx, $board_config, $action, $cal_version,
		$id, $day, $month, $year, $userdata, $lang, $caluser, $lastday, $phpbbheaders,
		$block_size,
		$endday, $endmonth, $endyear, $bbcode_uid, $db, $template, $homeurl, $HTTP_POST_VARS, $mx_page, $mx_bbcode;

		if ( $caluser >= 2 )
		{
			// TIMEZONE FIX
			$currentday = phpBB2::create_date( "j", time(), $userdata['calsadv_timezone'] );
			if ( $day )
			{
				$currentday = $day;
			}

			//$smilies_path = $board_config['smilies_path'];
			//$board_config['smilies_path'] = PHPBB_URL . $board_config['smilies_path'];
			$mx_bbcode->generate_smilies( 'inline', PAGE_POSTING );
			//$board_config['smilies_path'] = $smilies_path;
			$template->assign_vars( array( 'U_MORE_SMILIES' => mx_append_sid( PHPBB_URL . "posting.$phpEx?mode=smilies" ) ) );

			$template->set_filenames( array( 'body' => 'cal_posting_body_lite.tpl' ) );

			if ( $phpbbheaders != '' )
			{
				$template->assign_block_vars( 'switch_show_headers', array() );
			}

			$template->assign_vars( array(
				'BLOCK_SIZE' => $block_size,
				'PHPBBHEADER' => $phpbbheaders,
				'CAL_VERSION' => 'Ver: ' . $cal_version,
				'CALENDAR' => $lang['Calendar'],
				'L_CAL_NEW' => $lang['Cal_add_event'],
				'U_INDEX' => mx_append_sid( "index.$phpEx" ),
				'L_INDEX' => sprintf( $lang['Forum_Index'], $board_config['sitename'] ),
				'U_CAL_HOME' => $homeurl )
			);

			$template->assign_vars( array(
				'SUBJECT' => $subject,
				'MESSAGE' => $message,

				'L_SUBJECT' => $lang['Subject'],
				'L_MESSAGE_BODY' => $lang['Cal_description'],
				'L_SUBMIT' => $lang['Submit'],
				'L_CANCEL' => $lang['Cancel'],

				'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
				'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
				'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
				'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'],
				'L_BBCODE_C_HELP' => $lang['bbcode_c_help'],
				'L_BBCODE_L_HELP' => $lang['bbcode_l_help'],
				'L_BBCODE_O_HELP' => $lang['bbcode_o_help'],
				'L_BBCODE_P_HELP' => $lang['bbcode_p_help'],
				'L_BBCODE_W_HELP' => $lang['bbcode_w_help'],
				'L_BBCODE_A_HELP' => $lang['bbcode_a_help'],
				'L_BBCODE_S_HELP' => $lang['bbcode_s_help'],
				'L_BBCODE_F_HELP' => $lang['bbcode_f_help'],
				'L_EMPTY_MESSAGE' => $lang['Empty_message'],

				'L_FONT_COLOR' => $lang['Font_color'],
				'L_COLOR_DEFAULT' => $lang['color_default'],
				'L_COLOR_DARK_RED' => $lang['color_dark_red'],
				'L_COLOR_RED' => $lang['color_red'],
				'L_COLOR_ORANGE' => $lang['color_orange'],
				'L_COLOR_BROWN' => $lang['color_brown'],
				'L_COLOR_YELLOW' => $lang['color_yellow'],
				'L_COLOR_GREEN' => $lang['color_green'],
				'L_COLOR_OLIVE' => $lang['color_olive'],
				'L_COLOR_CYAN' => $lang['color_cyan'],
				'L_COLOR_BLUE' => $lang['color_blue'],
				'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
				'L_COLOR_INDIGO' => $lang['color_indigo'],
				'L_COLOR_VIOLET' => $lang['color_violet'],
				'L_COLOR_WHITE' => $lang['color_white'],
				'L_COLOR_BLACK' => $lang['color_black'],

				'L_FONT_SIZE' => $lang['Font_size'],
				'L_FONT_TINY' => $lang['font_tiny'],
				'L_FONT_SMALL' => $lang['font_small'],
				'L_FONT_NORMAL' => $lang['font_normal'],
				'L_FONT_LARGE' => $lang['font_large'],
				'L_FONT_HUGE' => $lang['font_huge'],

				'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'],
				'L_STYLES_TIP' => $lang['Styles_tip'],

				'S_POST_ACTION' => mx_append_sid( $this->mxurl( "action=Addsucker" ) ),
				'S_HIDDEN_FORM_FIELDS' => '' )
			);

			// Day field
			$this_day = $this->create_day_drop( $currentday, 31 );
			// Month field
			$this_month = $this->create_month_drop( $month, $year );
			// Year field
			$this_year = $this->create_year_drop( $year );
			// End Day field
			$end_day = $this->create_day_drop( $currentday, 31 );
			// End Month field
			$end_month = $this->create_month_drop( $month, $year );
			// End Year field
			$end_year = $this->create_year_drop( $year );
			// TIMEZONE FIX
			$currentmonth = phpBB2::create_date( "m", time(), $userdata['calsadv_timezone'] );

			// Set the rest of the Calendar fields
			$template->assign_vars( array(
				'L_CAL_DATE' => $lang['Cal_day'],
				'L_CAL_TIME' => $lang['Cal_hour'],
				'L_CAL_END_DATE' => $lang['End_day'],
				'THIS_DAY' => $this_day,
				'THIS_MONTH' => $this_month,
				'THIS_YEAR' => $this_year,
				'END_DAY' => $end_day,
				'END_MONTH' => $end_month,
				'END_YEAR' => $end_year,
				'L_CAL_HOME' => $lang['Cal_back2cal'] )
			);

			$template->pparse( 'body' );
			return;
		}
		else
		{
			mx_message_die( GENERAL_ERROR, $lang['Cal_not_enough_access'], '', __LINE__, __FILE__, '' );
		}
	}

	function addsucker( $modify = '' )
	{
		global $html_entities_match, $html_entities_replace;
		global $thisscript, $phpbb_root_path, $mx_root_path, $phpEx, $db, $template, $action, $phpbbheaders;
		global $board_config, $cal_config, $id, $day, $month, $year, $time, $userdata, $modify, $lang, $event_desc, $subject, $caluser;
		global $endday, $endmonth, $endyear, $bbcode_uid, $homeurl, $block_id, $mx_page,$mx_bbcode;

		if ( ( $subject == '' ) || ( $event_desc == '' ) )
		{
			// Nothing in the subject line: Reject it.
			mx_message_die( GENERAL_ERROR, $lang['No information'], '', __LINE__, __FILE__, '' );
		}
		$currentdate = time();
		// Valid Start Date?
		if ( !checkdate( $month, $day, $year ) )
		{
			mx_message_die( GENERAL_ERROR, $lang['Invalid date'] );
		}
		// Valid End Date?
		if ( !checkdate( $endmonth, $endday, $endyear ) )
		{
			mx_message_die( GENERAL_ERROR, $lang['Invalid date'] );
		}
		// Valid Time?
		$hour = substr( $time, 0, 2 );
		$symbol = substr( $time, 2, 1 );
		$minute = substr( $time, 3, 2 );
		if ( !empty( $time ) )
		{
			if ( !is_numeric( $hour ) || $hour < 0 || $hour > 23 )
			{
				$err_time = true;
			}elseif ( !is_numeric( $minute ) || $minute < 0 || $minute > 59 )
			{
				$err_time = true;
			}
			else
			{
				unset( $err_time );
			}
			if ( isset( $err_time ) )
			{
				mx_message_die( GENERAL_ERROR, ( "Invalid " . $lang['Cal_hour'] ) );
			}
		}
		// Check that date info has been set.
		if ( $month != '' && $day != '' && $year != '' && $endmonth != '' && $endday != '' && $endyear != '' )
		{
			$submitdate = gmmktime ( 23, 59, 59, $month, $day, $year );
			$submitenddate = gmmktime ( 23, 59, 59, $endmonth, $endday, $endyear );
		}
		else
		{
			mx_message_die( GENERAL_ERROR, $lang['No date'] );
		}

		if ( ( $currentdate > $submitdate ) && !$cal_config['allow_old'] && ($userdata['user_level'] != ADMIN) )
		{
			// Nothing in the subject line: Reject it.
			mx_message_die( GENERAL_ERROR, $lang['Date before today'], '', __LINE__, __FILE__, '' );
		}
		if ( $submitdate > $submitenddate )
		{
			mx_message_die( GENERAL_ERROR, $lang['Date before start'], '', __LINE__, __FILE__, '' );
		}

		if( !function_exists('prepare_message') )
		{
			mx_cache::load_file('functions_post', 'phpbb2');
		}

		if ( !$bbcode_uid )
		{
			$bbcode_uid = $mx_bbcode->make_bbcode_uid();
		}
		// PREPARE MESSAGE
		$event_desc = prepare_message( $event_desc,
			$board_config['allow_html'],
			$board_config['allow_bbcode'],
			$board_config['allow_smilies'],
			$bbcode_uid );

		$event_desc = nl2br( $event_desc );
		$event_desc = addslashes( $event_desc );
		// Get rid of any commas in your subject field (causes untold problems with the HTML form)
		$subject = preg_replace( "/[\"]/", "", $subject );
		$subject = addslashes( $subject );

		$valid = 'no';
		if ( $caluser >= 3 )
		{
			$valid = 'yes';
		}
		if ( $modify )
		{
			preg_replace( "/<br />/", "", $event_desc );
			$sql = "UPDATE " . CALADV_EVENTS_TABLE . " SET stamp='$year-$month-$day $time', subject='$subject', description='$event_desc', eventspan='$endyear-$endmonth-$endday', bbcode_uid='$bbcode_uid', block_id='$block_id' WHERE event_id = '$id'";
		}
		else
		{
			$sql = "INSERT INTO " . CALADV_EVENTS_TABLE . " (username, stamp, subject, description, user_id, valid, eventspan, bbcode_uid, block_id) VALUES ('" . addslashes( $userdata[username] ) . "', '$year-$month-$day $time', '$subject', '$event_desc', '" . $userdata['user_id'] . "', '$valid', '$endyear-$endmonth-$endday', '$bbcode_uid', '$block_id')";
		}
		if ( !( $query = $db->sql_query( $sql ) ) )
		{
			mx_message_die( GENERAL_ERROR, $lang['Cal_event_not_add'], '', __LINE__, __FILE__, $sql );
		}
		else
		{
			// Success the event is now pending or actually added.
			// Temp measure until the language files all get updated.
			$lang['Cal_add4valid'] = ( !empty( $lang['Cal_add4valid'] ) ) ? $lang['Cal_add4valid'] : 'Event submitted for validation by an Administrator';

			$l_add = ( $valid != 'no' ) ? $lang['Cal_event_add'] : $lang['Cal_add4valid'];

			$url = mx_append_sid( $this->mxurl() );
			$message = $l_add . "</br></br><a href='" . $url . "'>" . $lang['Cal_back2cal'] . "</a>";
			mx_message_die( GENERAL_MESSAGE, $message, '', __LINE__, __FILE__, $sql );
		}
	}	
	/**
	| HTML Output Section - Using Templates (All Output Related)
	* Returns a nice HTML table showing one month in the calendar.
	*
	* This function is used for debugging. But you may use it for your 'end
	   * product' if you're lazy.
	   *
	   * Note that the month shown is Gregorian (that is, January, February, ...),
	   * therefore the parameters this function receives are the Gregorian year
	   * and month.
	*
	* You should include the 'demo-core.css' style sheet in your page for a
	* pretty display.
	* 
	* @param int $year 
	* @param int $month
	* @param constant $mode 
	* were modes are CAL_LANG_FOREIGN and CAL_LANG_NATIVE
	*/
	function _html_printCal($year, $month, $mode = CAL_LANG_FOREIGN)
	{
		global $phpEx, $phpbb_root_path, $mx_root_path;
		global $mx_user;
		global $board_config;
		global $mx_block, $template;
		global $lang;
		//
		// Read Block Settings
		//
		
		$title = $mx_block->block_info['block_title'];
		$b_description = $mx_block->block_info['block_desc'];
		$block_size = $mx_block->block_info['block_size'];
		$block_size = (isset($block_size) && !empty($block_size) ? $block_size : '176');
		$current_time_display = (isset($b_time_display) && !empty($b_time_display) ? $b_time_display : '24hr'); //12hr
	
		// $now contains today's date, and will be highlighted on the calendar printed.
		// You may wish to add to it the user's timezone offset.
		$now = getdate(time());		
		$julDate = $this->caldean_date('Date');
		$JDate = $this->caldean_date('HebrewDate');
		$JMonth = $this->caldean_date('JMonth');
		$JYear = $this->caldean_date('JYear'); 
		$JDay = $this->caldean_date('JDay');
		$JMonthName = $this->caldean_date('CaldeanMonth');			
		//
		// Step 1:
		//
		// Load parameters from the URL.
		//
		// The year to show the callendar for. If it isn't provided in the URL, use current year.
		$year  = $this->get_param('year', $now['year']);
		// The month to show the calendar for. If it isn't provided in the URL, use current month.
		$month = $this->get_param('month', $now['mon']);
	
		// The language in which to show the calendar. Defaults to Hebrew if and only if the browser
		// tells us the user reads Hebrew.
		$language = $this->get_param('language', strstr(@$_SERVER['HTTP_ACCEPT_LANGUAGE'], 'he') ? 'he' : 'en');
		
		// The method used to calculate the holidays. Can be either 'israel' or 'diaspora'. Defaults
		// to 'israel' if the language used is Hebrew.
		$method = $this->get_param('method', $language == 'he' ? 'israel' : 'diaspora');
		
		// Show 'Erev Rosh HaShana', etc. Defaults to true.
		$eves = $this->get_param('eves', '1');
		
		// Show Sefirat HaOmer (from Passover to Shavuot). Defaults to false.
		$sefirat_omer = $this->get_param('sefirat_omer', '0');
		
		// Show 'Isru Khags'. Defaults to false because they have almost no halakhic meaning.
		$isru = $this->get_param('isru', '0');
		
		//
		// Step 2:
		//
		// Instantiate the calendar object.
		//

		//$jcal = NativeCalendar::factory('Jewish');
		$this->settings(array(
		  'language' => ($language == 'he' ? CAL_LANG_NATIVE : CAL_LANG_FOREIGN),
		  'method' => $method,
		  'sefirat_omer' => $sefirat_omer,
		  'eves' => $eves,
		  'isru' => $isru,
		));


		//if ($this->get_param('feed', 0)) 
		//{
		//  header('Content-Type: text/calendar; charset=utf-8');
		//  header('Content-Disposition: attachment; filename="calendar.ics";');
		//  print get_ical_feed($jcal, $year, $month, 2 /* two years */);
		//  exit();
		//} 
		//else 
		//{
		//  header('Content-type: text/html; charset=utf-8');
		//}

		// Read configuration definition
		$template_out = 'israel_calendar'; //$mx_block->get_parameters('template');	
		$title = !empty($title) ? $title : $lang['Israel_Calendar'];
		$direction = ($language == 'he' ? 'rtl' : 'ltr');		
		$template_out = ($template_out == 'israel_calendar') ? array('calendar_block' => 'israel_calendar.tpl') : array('calendar_block' => 'hebcal_calendar.tpl');		
		$template->set_filenames($template_out);
		
		$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	    $todays_jdc    = $this->get_todays_date_as_jdc();
	    $prev_dow      = 100; // anything above 7:
	
	    if (($this->settings['language'] == CAL_LANG_FOREIGN) || ($mode == CAL_LANG_FOREIGN))
		{
	      $days_of_week = array(t('Sun'), t('Mon'), t('Tue'), t('Wed'), t('Thu'), t('Fri'), t('Sat'));
	    } 
		else 
		{
	      $days_of_week = $this->getDaysOfWeek(); //CAL_LANG_NATIVE
	    }
		
	    $output  = "<table class='holidays-calendar'>";
	    $output .= "<tr>";
		foreach ($days_of_week as $day) 
		{
			$output .= "<th class='day-header'>$day</td>";
			$template->assign_block_vars('days_of_week', array(
				'S_ROW_DAY'	=> $day)
			);		  
	    }
		$output .= "</tr>";
	
		for ($day = 1; $day <= $days_in_month; $day++)
		{
			$jdc = gregoriantojd($month, $day, $year);
			$dow = jddayofweek($jdc, 0) + 1;
			$template->assign_block_vars('weekrow', array('S_ROW_DAY' => $day));
			if ($dow < $prev_dow)
			{
				$template->assign_block_vars('weekrow.weekrow_switch_day', array('S_ROW_DAY' => $day));			
				// Starting a new week, so start a new row in table.
				if ($day == 1)
				{
					$output .= "<tr>";
					$template->assign_block_vars('weekrow.weekrow_switch_day.weekrow_switch_firstday', array('S_ROW_DAY' => $day));
					for ($i = 1; $i < $dow; $i++)
					{
						// Assign dummies
						$template->assign_block_vars('weekrow.weekrow_switch_day.weekrow_switch_firstday.weekrow_switch_emptyday', array());
						$output .= "<td class='empty-day'></td>";
					}
				}
				else				
				{
					$output .= "</tr>";
					$output .= "<tr>";
					$template->assign_block_vars('weekrow.weekrow_switch_day.weekrow_switch_endday', array('S_ROW_DAY'	=> $day));				  
				}
			}
			
			$jdc = gregoriantojd($month, $day, $year);
			$dow = jddayofweek($jdc, 0) + 1;			
			$j_date = $this->convertToNative(array('jdc' => $jdc));
			
			$julDate = $this->caldean_date('Date', $month, $thisday, $year);			
			$JDate = $this->caldean_date('HebrewDate', $month, $thisday, $year);
			$JMonth = $j_date['mon'] = $this->caldean_date('JMonth', $month, $thisday, $year);
			$JYear = $j_date['year'] = $this->caldean_date('JYear', $month, $thisday, $year); 
			$JDay = $j_date['mday'] = $this->caldean_date('JDay', $month, $thisday, $year);
			$JMonthName = $this->caldean_date('CaldeanMonth', $month, $thisday, $year);
			$JMonthN = $this->getHebrewMonth(false, $JYear, $JMonth);

			$holidays = $this->getMoadim($JYear, $JMonth, $JDay, $mode = CAL_LANG_FOREIGN); //$holidays = $this->getHolidays($j_date);
			$holiday_names = '';
			$holiday_classes = array();			
			
			if ($holidays) 
			{
				foreach ($holidays as $hday) 
				{
					$holiday_classes[$hday['id']] = 1;
					$holiday_classes[$hday['class']] = 1;
					$holiday_names .= "<div class='holiday-name'>$hday[name]</div>\n";
					$template->assign_block_vars('weekrow', array(
						'HOLIDAY_NAME'	=> $hday['name'])
					);						
				}
			}
			if ($jdc == $todays_jdc) 
			{
				$holiday_classes['today'] = 1;
			}
			$holiday_classes = implode(' ', array_keys($holiday_classes));
			
			$output .= "<td class='day $holiday_classes'>\n";
			$output .= "<span class='gregorian-number'>$day</span>\n";
			$output .= "<span class='native-number'>".$this->getNumber($j_date['mday']);
				
			$template->assign_block_vars('weekrow', array(
				'HOLIDAY_CLASSES'	=> $holiday_classes,
				'S_ROW_JDAY_NUM'	=> $this->getNumber($j_date['mday']),
				'S_ROW_DAY'	=> $day,
				'S_ROW_JDAY'		=> $j_date['mday'])
			);				
			if ($j_date['mday'] == 1)
			{
				$template->assign_block_vars('weekrow.weekrow_switch_jday', array());			
				$output .= " <span class='month-name'>(".
				$this->getMonthName($j_date['year'], $j_date['mon']).")</span>";
				$output .= "</span>\n";
				$output .= $holiday_names;
				$output .= "</td>";			
				$template->assign_block_vars('weekrow.weekrow_switch_jday', array(				
					'MONTH_NAME'	=> $this->getMonthName($j_date['year'], $j_date['mon']),
					'HOLIDAY_NAMES'	=> $holiday_names)
				);					
				$prev_dow = $dow;				
			}
			for ($i = $dow + 1; $i <= 7; $i++) 
			{
				$output .= "<td class='empty'></td>";
				// Assign dummies
				$template->assign_block_vars('weekrow.weekrow_switch_empty', array());								
			}
			$output .= "</tr>";
			$output .= "</table>";			
		}
		$template->assign_vars(array(
			'L_TITLE'		=> $title,
			'U_PORTAL_ROOT_PATH' 	=> PORTAL_URL,
			'U_PHPBB_ROOT_PATH' 	=> PHPBB_URL,
			'TEMPLATE_ROOT_PATH'	=> TEMPLATE_ROOT_PATH,	
			'CURRENT_MOON'	=> $JMonthName,
			'CURRENT_DAY'	=> $JDay, 
			'CURRENT_YEAR'	=> $JYear,
			'CURRENT_TIME_DISPLAY'	=> $current_time_display,
			
			'HOLIDAY_CLASSES'	=> $holiday_classes,
			'S_ROW_JDAY_NUM'	=> $this->getNumber($j_date['mday']),				
			'S_ROW_GDAY_NUM'	=> $day,			
			
			'MONTH_NAME'	=> $this->getMonthName($j_date['year'], $j_date['mon']),
			'HOLIDAY_NAMES'	=> $holiday_names,				
			'PREV_DOW'	=> $dow,

			'BLOCK_WIDTH'	=> (!empty($b_width) ? $b_width : '190'),
			'BLOCK_HEIGHT'	=> (!empty($b_height) ? $b_height : '230'),
			'BLOCK_SIZE'	=> $block_size
		));			
		echo $output;			
		//$template->pparse('calendar_block');			
	}	
	/*\
	|	HTML Output Section - Using Templates (All Output Related)
	\*/		
	function display()
	{
		global $thisscript, $phpbb_root_path, $phpEx, $action, $homeurl, $images, $phpbbheaders;
		global $id, $day, $month, $year, $userdata, $lang, $config_footer, $footer, $caluser;
		global $block_size, $cal_config, $cal_dateformat, $mx_bbcode;
		global $endday, $endmonth, $endyear, $board_config, $bbcode_uid, $template, $db, $cal_version, $cal_filter, $cal_hebrew, $block_id;

		// TIMEZONE FIX
		$currentmonth = phpBB2::create_date( "m", time(), $userdata['calsadv_timezone'] );

		$template->set_filenames( array( 'body' => 'cal_day_events_lite.tpl' ) );
		
		$id = 'Native';
		$module_name = 'Calendar';
		//if (!class_exists($id . $module_name))
		//{
		//	$jcal = $this->factory($id, null);
		//}

		// The language in which to show the calendar. Defaults to Hebrew if and only if the browser
		// tells us the user reads Hebrew.
		$language = $this->get_param('language', strstr(@$_SERVER['HTTP_ACCEPT_LANGUAGE'], 'he') ? 'he' : 'en');		
		
		// The method used to calculate the holidays. Can be either 'israel' or 'diaspora'. Defaults
		// to 'israel' if the language used is Hebrew.
		$method = $this->get_param('method', $language == 'he' ? 'israel' : 'diaspora');

		// Show 'Erev Rosh HaShana', etc. Defaults to true.
		$eves = $this->get_param('eves', '1');

		// Show Sefirat HaOmer (from Passover to Shavuot). Defaults to false.
		$sefirat_omer = $this->get_param('sefirat_omer', '0');

		// Show 'Isru Khags'. Defaults to false because they have almost no halakhic meaning.
		$isru = $this->get_param('isru', '0');		
		
	    $days_in_month	= cal_days_in_month(CAL_GREGORIAN, $month, $year);
	    $todays_natjc	= $this->get_todays_date_as_jdc();	

		$lastseconds = gmmktime( 0, 0, 0, $month, $day, $year ) - ( 24 * 60 * 60 );
		$lastday = gmdate( 'j', $lastseconds );
		$lastmonth = gmdate( 'm', $lastseconds );
		$lastyear = gmdate( 'Y', $lastseconds );

		$nextseconds = gmmktime( 0, 0, 0, $month, $day, $year ) + ( 24 * 60 * 60 );
		$nextday = gmdate( 'j', $nextseconds );
		$nextmonth = gmdate( 'm', $nextseconds );
		$nextyear = gmdate( 'Y', $nextseconds );

		$sql = "SELECT * FROM " . CALADV_EVENTS_TABLE . " WHERE valid = 'yes' AND ";
		if ( $id )
		{
			$sql .= "event_id = '$id'";
		}
		else
		{
			if ( $cal_filter )
			{
				$sql .= "block_id = '$block_id' AND ";
			}

			$sql .= "eventspan >= \"$year-$month-$day 00:00:00\" AND stamp <= \"$year-$month-$day 23:59:59\" ORDER BY stamp";
		}

		if ( !( $result = $db->sql_query( $sql ) ) )
		{
			mx_message_die( GENERAL_ERROR, 'Could not select Event data', '', __LINE__, __FILE__, $sql );
		}

		$check = 0;
		while ( $row = $db->sql_fetchrow( $result ) )
		{
			$subject = stripslashes( $row['subject'] );
			$zdesc = $this->my_decode_bbtext( $row['description'], $row['bbcode_uid'] );

			// Delete icon
			$today = strtotime( gmdate( "Y-m-d" ) );

			if ( ( ( $caluser >= 4 ) && ( $userdata['user_id'] == $row['user_id'] ) ) || ( $caluser >= 5 ) )
			{
				if ( $cal_config['allow_old'] || strtotime( $row['stamp'] ) >= $today )
				{
					$edit_img = '<a href="' . $this->mxurl( 'action=Modify_marked&amp;id=' . $row['event_id'] ) . '"><img src="' . $images['calsadv_icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
				}
				$delpost_img = '<a href="' . $this->mxurl( 'action=Delete_marked&amp;id=' . $row['event_id'] ) . '"><img src="' . $images['calsadv_icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
			}
			else
			{
				$edit_img = '';
				$delpost_img = '';
			}

			$zdesc = $mx_bbcode->make_clickable($zdesc);
			$start_date = $this->my_dateformat( $row['stamp'], $cal_dateformat );
			$end_date = $this->my_dateformat( $row['eventspan'], $cal_dateformat, 1 );

			$template->assign_block_vars( 'event_row', array( 'SUBJECT' => $subject,
					'DATE' => $start_date,
					'END_DATE' => $end_date,
					'AUTHOR' => stripslashes( $row['username'] ),
					'DESC' => $zdesc,
					'BUTTON_DEL' => $delpost_img,
					'BUTTON_MOD' => $edit_img )
				);
			$check++;
		}
		$db->sql_freeresult($result);

		if ( $check == 0 )
		{
			$template->assign_block_vars( 'no_events', array( 'NO_EVENTS' => $lang["No events"] ) );
		}

		// Previous Month button
		$url = mx_append_sid( $this->mxurl( "day=" . $lastday . "&amp;month=" . $lastmonth . "&amp;language=" . $language . "&amp;year=" . $lastyear . "&amp;mode=display" ) );
		$button_prev = ($language == 'he' ? $this->button_prev($url) : $this->button_next($url));

		// Viewed month link
		$monthname = $lang['datetime'][gmdate( "F", gmmktime( 0, 0, 0, $month, 1, $year ) )];
		$select_month_url = mx_append_sid( $this->mxurl( "month=" . $month . "&amp;year=" . $year ) );

		// Home Button
		$curmonthname = $lang['datetime'][gmdate( "F", gmmktime( 0, 0, 0, $currentmonth, 1, $year ) )];
		$url = mx_append_sid( $this->mxurl( "month=" . $month . "&amp;year=" . $year ) );
		$button_home = $this->button_main( $url, $lang['Cal_back2cal'], 'center' );

		// Next Month button.
		$url = mx_append_sid( $this->mxurl( "day=" . $nextday . "&amp;month=" . $nextmonth . "&amp;language=" . $language . "&amp;year=" . $nextyear . "&amp;mode=display" ) );
		$button_next = ($language == 'he' ? $this->button_next($url) : $this->button_prev($url));

		if ( $caluser >= 2 )
		{
			// Add button
			$url = mx_append_sid( $this->mxurl( "day=" . $day . "&amp;month=" . $month . "&amp;language=" . $language . "&amp;year=" . $year . "&amp;action=Cal_add_event" ) );
			$button_add = $this->button_add( $url );
			// Validate button
			$url = mx_append_sid( $this->mxurl( "mode=validate&amp;action=getlist" ) );
			$button_val = $this->button_validate( $url );
		}

		if ( $phpbbheaders != '' )
		{
			$template->assign_block_vars( 'switch_show_headers', array() );
		}

		$template->assign_vars( array(
			'BLOCK_SIZE' => $block_size,
			'PHPBBHEADER' => $phpbbheaders,
			'CAL_VERSION' => 'Ver: ' . $cal_version,
			'CALENDAR' => $lang['Calendar'],
			'L_CAL_NEW' => $lang['Cal_add_event'],
			'U_INDEX' => mx_append_sid( "index.$phpEx" ),
			'L_INDEX' => sprintf( $lang['Forum_Index'], $board_config['sitename'] ),
			'U_CAL_HOME' => $homeurl )
		);

		$template->assign_vars( array(
			'CAL_MONTH' => $monthname,
			'CAL_YEAR' => $year,
			'CAL_DAY' => $day,
			'SUBJECT' => $lang['Subject'],
			'DATE' => $lang['Date'],
			'END_DATE' => $lang['End_day'],
			'AUTHOR' => $lang['Author'],
			'BUTTON_PREV' => $button_prev,
			'BUTTON_NEXT' => $button_next,
			'BUTTON_HOME' => $button_home,
			'BUTTON_ADD' => $button_add,
			'BUTTON_VAL' => $button_val )
		);

		$template->pparse('body');
		return;
	}
	// End Display

	// The default display (ie: The main calendar screen)
	function defaultview()
	{
		global $thisscript, $phpbb_root_path, $phpEx, $action, $phpbbheaders,
		$board_config, $cal_config, $id, $day, $month, $year, $userdata, $lang, $event_desc, $subject, $caluser,
		$block_size, $cal_filter, $cal_hebrew, $block_id,
		$cal_mode_mini, $cal_page_id, $cal_block_id,
		$module_root_path,
		$endday, $endmonth, $endyear, $langdays, $template, $cal_version, $db, $homeurl;

		/*
		if ($userdata && $userdata['user_id'] != '-1')
		{
			$currentday = phpBB2::create_date("j", time(), $userdata['user_timezone']);
			$currentmonth = phpBB2::create_date("m", time(), $userdata['user_timezone']);
			$currentyear = phpBB2::create_date("Y", time(), $userdata['user_timezone']);
		}
		else
		{
			$currentday = phpBB2::create_date("j", time(), $board_config['board_timezone']);
			$currentmonth = phpBB2::create_date("m", time(), $board_config['board_timezone']);
			$currentyear = phpBB2::create_date("Y", time(), $board_config['board_timezone']);
		}
		*/

		// Timezone fix
		$currentday = phpBB2::create_date( "j", time(), $userdata['calsadv_timezone'] );
		$currentmonth = phpBB2::create_date( "m", time(), $userdata['calsadv_timezone'] );
		$currentyear = phpBB2::create_date( "Y", time(), $userdata['calsadv_timezone'] );
		
		// The language in which to show the calendar. Defaults to Hebrew if and only if the browser
		// tells us the user reads Hebrew.
		$language = $this->get_param('language', strstr(@$_SERVER['HTTP_ACCEPT_LANGUAGE'], 'he') ? 'he' : 'en');		
		$lastday = 1;
		
		// The method used to calculate the holidays. Can be either 'israel' or 'diaspora'. Defaults
		// to 'israel' if the language used is Hebrew.
		$method = $this->get_param('method', $language == 'he' ? 'israel' : 'diaspora');

		$template->set_filenames( array('body' => ( $cal_mode_mini ? 'cal_view_month_mini.tpl' : 'cal_view_month_lite.tpl')) );

		$firstday = gmdate( 'w', ( gmmktime( 0, 0, 0, $month, 1, $year ) - $cal_config['week_start'] ) ) % 7;
		$first_day = ( $first_day < 0 ) ? ( $first_day + 7 ) : $first_day;
		$lastday = gmdate( 't', gmmktime( 0, 0, 0, $month, 1, $year ) );
		$end_day = 7 - ( ( $firstday + $lastday ) % 7 );
		$end_day = ( $end_day == 7 ) ? 0 : $end_day; // day 7 same as day 0

		$nextmonth = ( $month < 12 ) ? ( $month + 1 ) : 1;
		$nextyear = ( $month < 12 ) ? $year : ( $year + 1 );

		$lastmonth = ( $month > 1 ) ? ( $month - 1 ) : 12;
		$lastyear = ( $month > 1 ) ? $year: ( $year - 1 );

		if ( $phpbbheaders != '' )
		{
			$template->assign_block_vars( 'switch_show_headers', array() );
		}

		if ( $cal_mode_mini )
		{
			if (intval($cal_block_id) == 0)
			{
				$template->assign_block_vars( 'info', array() );
			}
			$template->assign_vars( array(
				'S_ACTION' => mx_append_sid( $this->mxurl( '', 0, $cal_page_id ) ),
				'U_CAL_MONTH' => mx_append_sid( $this->mxurl( "month=" . $month . "&amp;year=" . $year, 0, $cal_page_id ) ),
			));
		}

		$template->assign_vars( array(
			'BLOCK_SIZE' => $block_size,
			'PHPBBHEADER' => $phpbbheaders,
			'CAL_MONTH' => $lang['datetime'][gmdate( "F", gmmktime( 0, 0, 0, $month, 1, $year ) )],
			'CAL_YEAR' => $year,
			'DAY_HEAD_1' => $langdays[( 0 + $cal_config['week_start'] ) % 7],
			'DAY_HEAD_2' => $langdays[( 1 + $cal_config['week_start'] ) % 7],
			'DAY_HEAD_3' => $langdays[( 2 + $cal_config['week_start'] ) % 7],
			'DAY_HEAD_4' => $langdays[( 3 + $cal_config['week_start'] ) % 7],
			'DAY_HEAD_5' => $langdays[( 4 + $cal_config['week_start'] ) % 7],
			'DAY_HEAD_6' => $langdays[( 5 + $cal_config['week_start'] ) % 7],
			'DAY_HEAD_7' => $langdays[( 6 + $cal_config['week_start'] ) % 7] )
		);
		$rowrow = 1;

		$lastday = gmdate( 't', gmmktime( 0, 0, 0, $month, 1, $year ) );

		// New optimised SQL query
		$sql = "SELECT * FROM " . CALADV_EVENTS_TABLE . "
			WHERE valid = 'yes' AND eventspan >= '$year-$month-1' AND stamp <= '$year-$month-$lastday 23:59:59'";

		if ($cal_filter)
		{
			$sql .= " AND block_id = '$block_id'";
		}

		$sql .= " ORDER BY stamp";

		if ( !( $query = $db->sql_query( $sql ) ) )
		{
			//echo "<BR>$sql<BR>" . mysql_error();
			//exit;
			mx_message_die( GENERAL_ERROR, 'Could not get months data', '', __LINE__, __FILE__, $sql );
		}

		$dates = array();
		while ( $get_row = $db->sql_fetchrow( $query ) )
		{
			$dates[] = $get_row;
		}
		$db->sql_freeresult($result);

		// Changed the range to do ALL the days not require duplicate code later.
		for ( $i = 1; $i <= ( $firstday + $lastday + $end_day ); $i++ )
		{
			if ( $i <= $firstday )
			{
				$today_year = ( $month <= 1 ) ? $year - 1 : $year;
				$today_month = ( $month <= 1 ) ? 12 : $month - 1;
				$today_day = ( gmdate( 't', gmmktime( 0, 0, 0, $today_month, 1, $today_year ) ) - $firstday ) + $i;
			}
			else if ( $i > ( $firstday + $lastday ) )
			{
				$today_year = ( $month >= 12 ) ? $year + 1 : $year;
				$today_month = ( $month >= 12 ) ? 1 : $month + 1;
				$today_day = $i - ( $firstday + $lastday );
			}
			else
			{
				$today_year = $year;
				$today_month = $month;
				$today_day = $i - $firstday;
			}

			// calc todays date range
			$today_start = gmdate( "Y-m-d", gmmktime( 0, 0, 0, $month, $today_day, $year ) );
			$today_end = gmdate( "Y-m-d H:i:s", gmmktime( 23, 59, 59, $month, $today_day, $year ) );

			// CHECK echo "TS: $today_start , TE: $today_end <BR>";
			unset( $this_date );
			$this_date = array();
			for( $d_cnt = 0; $d_cnt < count( $dates ); $d_cnt++ )
			{
				// CHECK echo "TS: ".$dates[$d_cnt]['stamp']." , TE: ".$dates[$d_cnt]['eventspan']." <BR>";
				if ( ( $dates[$d_cnt]['eventspan'] >= $today_start ) && ( $dates[$d_cnt]['stamp'] <= $today_end ) )
				{
					// Compile an array of all the events for today
					$this_date[] = $dates[$d_cnt];
				}
			}
			$this_date = $this->array_qsort2 ( $this_date, 'stamp', SORT_ASC, 0, $last = -2 );

			$thisday = $i - $firstday;

			$event_list = '';
			$correction = 0;

			$query_num = count( $this_date );
			for ( $j = 0; $j < $query_num; $j++ )
			{
				$results = $this_date[$j];
				$subject = stripslashes( $results['subject'] );
				$full_subject = stripslashes( $results['subject'] );
				$subjectnum = '';

				// Specific UKRag.net function.
				if ( strlen( $subject ) > $cal_config['subject_length'] )
				{
					if ( ( substr( $subject, -3, 1 ) == '(' ) && ( substr( $subject, -1, 1 ) == ')' ) )
					{
						// store the number of permits and tack them on the end of the shortened subject
						$subjectnum = substr( $subject, -2, 1 );
						$subject = substr( $subject, 0, -3 );
					}
					$subject = substr( $subject, 0, $cal_config['subject_length'] );
					$subject .= '..';
				}
				if ( $subjectnum )
				{
					$subject .= ' (' . $subjectnum . ')';
				}

				// End UKRag.net function
				$url = mx_append_sid( $this->mxurl( 'id=' . $results['event_id'] . '&amp;mode=display&amp;day=' . $thisday . '&amp;month=' . $today_month . '&amp;year=' . $today_year ) );

				// Need to keep the size down
				$event_list .= "<span class=gensmall><acronym title='" . stripslashes( $results['username'] ) . ": $full_subject'>
					$pt <a href='$url' id='cal_id" . $results['event_id'] . "' onMouseOver=\"swc('cal_id" . $results['event_id'] . "',1)\" onMouseOut=\"swc('cal_id" . $results['event_id'] . "',0)\">
					$subject</a></acronym><br></span>\n";
			}

			if ( ( $query_num - $correction ) < 4 )
			{
				for ( $j = 0; $j < ( 4 - ( $query_num - $correction ) ); $j++ )
				{
					$event_list .= '<span class=gensmall>&nbsp;<br></span>';
				}
			}

			if ( $i % 7 == 0 )
			{
				// we're at the end of a row
				// got another week to run
				$week_end = "\n</tr>\n<tr>\n";
			}
			else
			{
				$week_end = '';
			}

			// Choose which format to use (ie: pre, during or after this month)
			if ( $i <= $firstday )
			{
				$thisday = '';
				$event_list = '';
				$cellback = 'class=row1';
				$cellhead = 'class=row1';
				$cellbody = 'class=row1';
			}
			else if ( $currentmonth == $today_month && $month == $currentmonth && $currentday == $thisday && $currentyear == $year )
			{
				// TODAY
				$cellback = 'class=row3';
				$cellhead = 'class=rowpic';
				$cellbody = 'class=row2';
			}
			else if ( $i > ( $firstday + $lastday ) )
			{
				// end of the month
				$thisday = '';
				$event_list = '';
				$cellback = 'class=row1';
				$cellhead = 'class=row1';
				$cellbody = 'class=row1';
			}
			else
			{
				$cellback = 'class=row3';
				$cellhead = 'class=' . ( $cal_mode_mini ? 'row2' : 'row3' );
				$cellbody = 'class=row1';
			}

			//caldean_date($mode, $month, $day, $year) 	
			$jdc = gregoriantojd($month, $day, $year);
			$dow = jddayofweek($jdc, 0) + 1;			
			$j_date = $this->convertToNative(array('jdc' => $jdc));			
			$julDate = $this->caldean_date('Date', $month, $thisday, $year);			
			$JDate = $this->caldean_date('HebrewDate', $month, $thisday, $year);
			$JMonth = $j_date['mon'] = $this->caldean_date('JMonth', $month, $thisday, $year);
			$JYear = $j_date['year'] = $this->caldean_date('JYear', $month, $thisday, $year); 
			$JDay = $j_date['mday'] = $this->caldean_date('JDay', $month, $thisday, $year);
			$JMonthName = $this->caldean_date('CaldeanMonth', $month, $thisday, $year);
			$JMonthN = $this->getHebrewMonth(false, $JYear, $JMonth);
			$num_jdays = $this->getNumber($j_date['mday']);
			
			$holidays = $this->getMoadim($JYear, $JMonth, $JDay, $mode = CAL_LANG_FOREIGN);
			$holiday_names = '';
			$holiday_classes = array();
			
			if (is_array($holidays)) 
			{
				foreach ($holidays as $hday) 
				{
					$holiday_classes[$hday['id']] = 1;
					$holiday_classes[$hday['class']] = 1;
					$holiday_names .= $hday['name'];
				}
			}
			
			$url_day = !empty( $thisday ) ? mx_append_sid( $this->mxurl( "day=" . $thisday . "&amp;month=" . $month . "&amp;year=" . $year . "&amp;mode=display", 0, $cal_page_id ) ) : '';
			
			if ( $cal_mode_mini && $thisday != '' )
			{
				if ( $query_num > 0 )
				{
					$thisday = '<b>' . $thisday . '</b>';
				}
				$thisday = '<a class="genmed" href="' . $url_day . '" title="&nbsp;' . $lang['Events'] . ':&nbsp;' . $query_num . '&nbsp;">' . $thisday . '</a>';
			}
			
			if ($cal_hebrew)
			{					
				if ($holiday_names) 
				{
					$thisday .= "&nbsp;<span class='month-name'>(".
					$JDay . $JMonthN . "&nbsp;)</span>";
					$thisday .= "</span>\n";
					
					$thisday .= "<br /><span class='month-name'>".
					"&nbsp;" . $holiday_names ."</span>";
					$thisday .= "</span>\n";
				}
				elseif (($JDay == 1) || ($JDay == 10) || ($JDay == 14) || ($JDay == 15) || ($JDay == 21) || ($JDay == 29) || ($JDay == 30))
				{			
					$thisday .= "&nbsp;<span class='month-name'>(".
					$JDay . $JMonthN . "&nbsp;)</span>";
					$thisday .= "</span>\n";
				}						
				//
				// Holidays of Nisan
				//
				if ($j_month == NISAN) 
				{	
					if (!$holiday_names && (($JDay == 29) || ($JDay == 30)))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}				
				}
			    //
			    // Holidays of Iyar
			    //
				if ($j_month == IYAR) 
				{
					if (!$holiday_names && (($JDay == 29) || ($JDay == 30)))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
				}
			    //
			    // Holidays of Sivan
			    //
				if ($j_month == SIVAN) 
				{
					if (!$holiday_names && (($JDay == 29) || ($JDay == 30)))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
				}			    
			    //
			    // Holidays of Tamuz
			    //
				if ($j_month == TAMUZ) 
				{
					if (!$holiday_names && ($JDay == 29))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
				}
			    //
			    // Holidays of Av
				//
				if ($j_month == AV) 
				{
					if (!$holiday_names && (($JDay == 29) || ($JDay == 30)))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
				}		    
			    //
			    // Holidays of Elul
			    //
				if ($j_month == ELUL) 
				{
					if (!$holiday_names && ($JDay == 29))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
				}					
				//
			    // Holidays of Tishrei
			    //
			    if ($j_month == TISHREI) 
				{
					if (!$holiday_names && ($JDay == 30))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
			    }
			    if ($j_month == HESHVAN) 
				{
					if (!$holiday_names && ($JDay == 30))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
			    }				
			    //
			    // Holidays of Kislev or Tevet
			    //
			    if ($j_month == KISLEV) 
				{
					if (!$holiday_names && ($JDay == 30))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
			    }
			    //
			    // Holidays of Tevet
			    //		    
			    if ($j_month == TEVET) 
				{
					if (!$holiday_names && ($JDay == 29))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
			    }
			    //
			    // Holidays of Shevat
			    //
				if ($j_month == SHEVAT)
				{
					if (!$holiday_names && ($JDay == 30))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}
				}
			    //
			    // Holidays of Adar
			    //
				if ($j_month == ADAR || $j_month == ADAR_A) 
				{
					if (!$holiday_names && ($JDay == 30))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}		
				}
				if ($j_month == ADAR_B) 
				{
					if (!$holiday_names && ($JDay == 30))
					{			
						$thisday .= "&nbsp;<span class='month-name'>(".
						$JDay . $JMonthN . "&nbsp;)</span>";
						$thisday .= "</span>\n";
					}		
				}				
			}				
			$template->assign_block_vars(
				'daycell', array( 'S_CELL' => $cellback,
				'U_DAY' => $url_day,
				'NUM_DAY' => $thisday,
				'DAY_EVENT_LIST' => $event_list,
				'S_HEAD' => $cellhead,
				'S_DETAILS' => $cellbody,
				'WEEK_ROW' => $week_end )
			);

			if ( $week_end )
			{
				++$rowrow;
				if ( $rowrow == '3' )
				{
					$rowrow = '1';
				}
			}
		}		

		$template->assign_vars( array(
			'CAL_VERSION' => 'Ver: ' . $cal_version,
			'CALENDAR' => $lang['Calendar'],
			'L_CAL_NEW' => $lang['Cal_add_event'],
			'U_INDEX' => mx_append_sid( "index.$phpEx" ),
			'L_INDEX' => sprintf( $lang['Forum_Index'], $board_config['sitename'] ),
			'U_CAL_HOME' => $homeurl )
		);

		if ( $caluser >= 2 )
		{
			// Previous Month button
			$url = mx_append_sid( $this->mxurl( "month=" . $lastmonth . "&amp;year=" . $lastyear ) );
			$button_prev = $this->button_prev( $url );
			// Add Event button
			$url = mx_append_sid( $this->mxurl( "month=" . $month . "&amp;year=" . $year . "&amp;action=Cal_add_event" ) );
			$button_add = $this->button_add( $url );
			// Admin Validate button
			$url = mx_append_sid( $this->mxurl( "mode=validate&amp;action=getlist" ) );
			$button_validate = $this->button_validate( $url );
			// Next Month button
			$url = mx_append_sid( $this->mxurl( "month=" . $nextmonth . "&amp;year=" . $nextyear ) );
			$button_next = $this->button_next( $url );
		}
		else
		{
			// Previous Month button
			$url = mx_append_sid( $this->mxurl( "month=" . $lastmonth . "&amp;year=" . $lastyear ) );
			$button_prev = $this->button_prev( $url );
			// Next Month button
			$url = mx_append_sid( $this->mxurl( "month=" . $nextmonth . "&amp;year=" . $nextyear ) );
			$button_next = $this->button_next( $url );
		}

		$template->assign_vars( array(
			'BUTTON_PREV' => $button_prev,
			'BUTTON_ADD' => $button_add,
			'BUTTON_VALIDATE' => $button_validate,
			'BUTTON_NEXT' => $button_next )
		);

		$template->pparse( 'body' );		
		return;
	}

	function calendarperm( $user_id )
	{
		global $db, $table_prefix, $cal_config;

		// Get the user permissions first.
		$sql = 'SELECT user_calendar_perm FROM ' . $table_prefix . 'users WHERE user_id = \'' . $user_id . '\'';
		if ( !( $result = $db->sql_query( $sql ) ) )
		{
			mx_message_die( GENERAL_ERROR, 'Could not select Calendar permission from user table', '', __LINE__, __FILE__, $sql );
		}
		$row = $db->sql_fetchrow( $result );
		$db->sql_freeresult($result);

		// Get the group permissions second.
		$sql2 = 'SELECT group_calendar_perm FROM ' . $table_prefix . 'user_group ug, ' . $table_prefix . "groups g
			WHERE ug.user_id = '$user_id' AND g.group_id = ug.group_id";
		if ( !( $result2 = $db->sql_query( $sql2 ) ) )
		{
			mx_message_die( GENERAL_ERROR, 'Could not select Calendar permission from user/usergroup table', '', __LINE__, __FILE__, $sql2 );
		}

		$topgroup = 0;
		while ( $rowg = $db->sql_fetchrow( $result2 ) )
		{
			if ( $topgroup < $rowg['group_calendar_perm'] )
			{
				$topgroup = $rowg['group_calendar_perm'];
			}
		}
		$db->sql_freeresult($result);

		// Use whichever value is highest.
		if ( $topgroup > $row['user_calendar_perm'] )
		{
			$cal_perm = $topgroup;
		}
		else
		{
			$cal_perm = $row['user_calendar_perm'];
		}
		if ( $cal_config['allow_user_default'] > $cal_perm && $user_id != ANONYMOUS )
		{
			$cal_perm = $cal_config['allow_user_default'];
		}
		return $cal_perm;
	}

	function mydateformat( $thisdate, $dateformat = 'd M Y G:i', $span = 0 )
	{
		global $cal_config;

		if ( $cal_config['cal_dateformat'] )
		{
			$dateformat = $cal_config['cal_dateformat'];
		}

		// date comes in as the following:
		$myr = substr( $thisdate, 0, 4 );
		$mym = substr( $thisdate, 5, 2 );
		$myd = substr( $thisdate, 8, 2 );
		$myh = substr( $thisdate, 11, 2 );
		$myn = substr( $thisdate, 14, 2 );
		$mys = substr( $thisdate, 17, 2 );

		if ( $span || ( $myh == '00' && $myn == '00' && $mys == '00' ) )
		{
			// Need to strip out any TIME references so...
			$timerefs = array ( '/a/', '/A/', '/B/', '/g/', '/G/', '/h/', '/H/', '/i/', '/I/', '/s/' );
			while ( list( , $val ) = each ( $timerefs ) )
			{
				$dateformat = preg_replace( $val, "", $dateformat );
			}
			// strip out any characters used for time
			$dateformat = preg_replace( '/[:\.]/', " ", $dateformat );
		}

		$returndate = gmdate( $dateformat, gmmktime( $myh, $myn, $mys, $mym, $myd, $myr ) );
		return $returndate;
	}

	function create_day_drop( $day, $lastday )
	{
		for ( $i = 1; $i <= $lastday; $i++ )
		{
			if ( $i == $day )
			{
				$day_drop .= "<option value=$i selected>$i</option>";
			}
			else
			{
				$day_drop .= "<option value=$i>$i</option>";
			}
		}
		return $day_drop;
	}

	function create_month_drop( $month, $year )
	{
		global $lang;

		for ( $i = 1; $i < 13; $i++ )
		{
			$nm = $lang['datetime'][gmdate( "F", gmmktime( 0, 0, 0, $i, 1, $year ) )];
			if ( $i == $month )
			{
				$mon_drop .= "<option value=$i selected>$nm</option>";
			}
			else
			{
				$mon_drop .= "<option value=$i>$nm</option>";
			}
		}
		return $mon_drop;
	}

	function create_year_drop( $year )
	{
		for ( $i = $year-2; $i < $year + 5; $i++ )
		{
			if ( $i == $year )
			{
				$yr_drop .= "<option value=$i selected>$i</option>";
			}
			else
			{
				$yr_drop .= "<option value=$i>$i</option>";
			}
		}
		return $yr_drop;
	}

	// buttons
	function button_main( $url, $month, $align = 'center' )
	{
		global $lang;

		$button_main = "<form method=post action='$url'><td align='$align'>\n";
		$button_main .= "<input type=submit value='$month' class=mainoption>\n";
		$button_main .= "</td></form>";
		return $button_main;
	}

	function button_validate( $url )
	{
		global $lang, $caluser;

		if ( $caluser >= 5 )
		{
			// Validate button
			// $url = mx_append_sid($this->mxurl("mode=validate&amp;action=getlist"));
			$button_validate = "<form method=post action='$url'><td>";
			$button_validate .= "<input type=submit value='" . $lang['Validate'] . "' class=mainoption>";
			$button_validate .= "</td></form>";
		}
		else
		{
			$button_validate = "";
		}
		return $button_validate;
	}

	function button_mod_del( $url )
	{
		global $lang, $caluser;

		if ( $caluser >= 4 )
		{
			// Delete/Modify Button
			// $url = mx_append_sid($this->mxurl("day=".$day."&amp;month=".$month."&amp;year=".$year."&amp;mode=modify"));
			$button_mod_del = "<form method=post action=$url><td>";
			$button_mod_del .= "<input type=submit value=\"";
			if ( $caluser >= 5 )
			{
				$button_mod_del .= $lang['Cal_Del_mod'];
			}
			else
			{
				$button_mod_del .= $lang['Cal_mod_only'];
			}
			$button_mod_del .= "\" class=mainoption></td></form>";
		}
		else
		{
			$button_mod_del = "";
		}
		return $button_mod_del;
	}

	function button_add( $url )
	{
		global $lang, $caluser, $block_id;

		// Next Month
		$button_add = "<form method=post action='$url'><td>";
		$button_add .= "<input type=submit name=zaction value=\"" . $lang['Cal_add_event'] . "\" class=mainoption>";
		$button_add .= '<input type="hidden" name="cal_block_id" value="' . $block_id . '" />';
		$button_add .= "</td></form>";
		return $button_add;
	}

	function button_prev( $url, $align = 'left' )
	{
		// Previous Month
		$button_prev = "<form method=post action=$url><td align='$align'>&nbsp;";
		$button_prev .= "<input type=submit value='<<' class=mainoption>&nbsp;</td></form>";
		return $button_prev;
	}

	function button_next( $url, $align = 'right' )
	{
		// Next Month
		$button_next = "<form method=post action=$url><td align='$align'>&nbsp;";
		$button_next .= "<input type=submit value='>>' class=mainoption>&nbsp;";
		$button_next .= "</td></form>";
		return $button_next;
	}

	function array_qsort2 ( &$array, $column = 0, $order = SORT_ASC, $first = 0, $last = -2 )
	{
		// $array  - the array to be sorted
		// $column - index (column) on which to sort
		// can be a string if using an associative array
		// $order  - SORT_ASC (default) for ascending or SORT_DESC for descending
		// $first  - start index (row) for partial array sort
		// $last   - stop index (row) for partial array sort
		if ( $last == -2 )
		{
			$last = count( $array ) - 1;
		}
		if ( $last > $first )
		{
			$alpha = $first;
			$omega = $last;
			$guess = $array[$alpha][$column];
			while ( $omega >= $alpha )
			{
				if ( $order == SORT_ASC )
				{
					while ( $array[$alpha][$column] < $guess )
					{
						$alpha++;
					}
					while ( $array[$omega][$column] > $guess )
					{
						$omega--;
					}
				}
				else
				{
					while ( $array[$alpha][$column] > $guess )
					{
						$alpha++;
					}
					while ( $array[$omega][$column] < $guess )
					{
						$omega--;
					}
				}
				if ( $alpha > $omega )
				{
					break;
				}
				$temporary = $array[$alpha];
				$array[$alpha++] = $array[$omega];
				$array[$omega--] = $temporary;
			}
			$this->array_qsort2 ( $array, $column, $order, $first, $omega );
			$this->array_qsort2 ( $array, $column, $order, $alpha, $last );
		}
		return $array;
	}
	
	// --------------------------------------------------------------------------------
	// [ FUNCTIONS ]
	// --------------------------------------------------------------------------------

	// my_dateformat comes from calendar.php, so it can be reused.
	// Also, we try to solve 2 bugs in one step:
	// a) Martin's mydateformat() does not translate weekdays.
	// b) Solve the phpBB collision with $lang['datetime']['May'].
	function my_dateformat( $thisdate, $dateformat = 'd M Y G:i', $span = 0 )
	{
		global $cal_dateformat, $cal_timezone, $userdata;

		// date comes in as the following:
		$myr = substr( $thisdate, 0, 4 );
		$mym = substr( $thisdate, 5, 2 );
		$myd = substr( $thisdate, 8, 2 );
		$myh = substr( $thisdate, 11, 2 );
		$myn = substr( $thisdate, 14, 2 );
		$mys = substr( $thisdate, 17, 2 );

		if ( $span || ( $myh == '00' && $myn == '00' && $mys == '00' ) )
		{
			// Need to strip out any TIME references so...
			$timerefs = array ( '/a/', '/A/', '/B/', '/g/', '/G/', '/h/', '/H/', '/i/', '/I/', '/s/' );
			while ( list( , $val ) = each ( $timerefs ) )
			{
				$dateformat = preg_replace( $val, "", $dateformat );
			}
			// strip out any characters used for time
			$dateformat = preg_replace( '[:\.]', " ", $dateformat );
		}

		// Ok, this is problem (a). No translation occurs :(

		// $returndate = gmdate($dateformat, gmmktime ($myh,$myn,$mys,$mym,$myd,$myr));
		// Fix for time off 1 day
		// $returndate = my_create_date($dateformat, gmmktime ($myh,$myn,$mys,$mym,$myd,$myr), $cal_timezone);
		$returndate = $this->my_create_date( $dateformat, gmmktime( $myh, $myn, $mys, $mym, $myd, $myr ), $userdata['calsadv_timezone'] );
		return $returndate;
	}

	/*
	 This is about problem (b). Using our own version of phpbb.functions_php.create_date()
	 we can use our own copy of $lang['datetime']['May'] (see lang_main.php files).
	*/
	function my_create_date( $format, $gmepoch, $tz )
	{
		global $board_config, $lang;
		static $translate;
		
		if ( empty( $translate ) && $board_config['default_lang'] != 'english' )
		{
			@reset( $lang['datetime'] );
			while ( list( $match, $replace ) = @each( $lang['datetime'] ) )
			{
				$translate[$match] = $replace;
			}
		}
		return ( !empty( $translate ) ) ? strtr( @gmdate( $format, $gmepoch + ( 3600 * $tz ) ), $translate ) : @gmdate( $format, $gmepoch + ( 3600 * $tz ) );
	}

	/*
	 The easiest way I found to decode BBText.
	*/
	function my_decode_bbtext( $bbtext, $bbcode_uid )
	{
		global $board_config, $mx_root_path, $mx_bbcode;
		
		$mytext = stripslashes( $bbtext );
		if ( $board_config['allow_bbcode'] )
		{
			$mytext = ( $board_config['allow_bbcode'] ) ? $mx_bbcode->decode( $mytext, $bbcode_uid, $board_config['allow_smilies'] ) : preg_replace( "/\:[0-9a-z\:]+\]/si", "]", $mytext );
		}
		
		return $mytext;
	}

	/*
	 Truncate words on a string to specified length and append '...' if necesary.
	*/
	function my_truncate_words( $text, $length )
	{
		$mytext = stripslashes( $text );
		if ( strlen( $mytext ) > $length )
		{
			$mytext = substr( $mytext, 0, $length );
			$mytext = substr( $mytext, 0, strrpos( $mytext, ' ' ) );
			$mytext .= '...';
		}
		return $mytext;
	}

	// Get week number of year
	function week_of_year($day, $month, $year)
	{
		global $cal_config;
		
		$timestamp = gmmktime( 0, 0, 0, $month, $day, $year );
		$date = getdate( $timestamp );
		$woy = gmdate( 'W', $timestamp );
		
		if ( $cal_config['week_start'] != 1 )
		{
			if ( $date['wday'] == 0 )
			{
				$woy++;
			}
		}
		return $woy;
	}
	
	/*
		Adds a specified number of days to the date provided.
	*/
	function addDays($day, $days)
	{
		$timestr = ($days > 0) ? "+" . $days . " days" : $days . " days";
		return strtotime($timestr, $day);		
	}	
	/* 
		Functions ported from mx_moonfases module
	*/ 
	/********************************************************************************\
	|	The Get_Details function does exactly what it says - it gets and populates
	|	assuming that $jewish_month is the Jewish month,
	|	and $hebrewYear is the Jewish year,
	|	you can use this script to replace 'Adar I' with 'Adar' when it is not a leap year.
	|	this is because a Jewish leap year occurs every 3rd, 6th, 8th, 11th, 14th, 17th, and 19th year.
	\********************************************************************************/	
	function adar_check($JMonthName, $JYear) 
	{
		if ($JMonthName == "AdarI" && $JYear%19 != 0 && $JYear%19 != 3 && $JYear%19 != 6 && $JYear%19 != 8 && $JYear%19 != 11 && $JYear%19 != 14 && $JYear%19 != 17) { $JMonthName = "Adar"; }
		return $JMonthName;
	}
	/* 
		G is the Golden Number-1 
		H is 23-Epact (modulo 30) 
		I is the number of days from 21 March to the Paschal full moon 
		J is the weekday for the Paschal full moon (0=Saturday, 1=Sunday, 2=Monday etc.) 
		P is the Paschal full moon eve weekkay 
		L is the number of days from 21 March to the Palm Sunday on or before 
	         the Paschal full moon (a number between -6 and 28) 
	*/ 
	function passover_day($mode, $g_year, $j_year = 0) 
	{
		$g_year = ($g_year) ? $g_year : date(Y); //Gregorian or Julian Year		
		$year = (intval($j_year) > 0) ? $this->JewishToGreg('GYear', false, false, $j_year) : $g_year; //Gregorian or Julian Year			
		$G = $year % 19;
		$C = (int)($year / 100);
		$H = (int)($C - (int)($C / 4) - (int)((8 * $C + 13) / 25) + 19 * $G + 15) % 30;
		$I = (int)$H - (int)($H / 28) * (1 - (int)($H / 28)*(int)(29 / ($H + 1)) * ((int)(21 - $G) / 11)); 
		//$S21 = date("$year-03-21");	
	    if($I <= 10)
		{
			$GregLunarDay = str_pad(21 + $I, 2, '0', STR_PAD_LEFT);
			$PascaLunarDay = str_pad(20 + $I, 2, '0', STR_PAD_LEFT);
			$GregLunarMonth = 03;			
		}
		else
		{
			$GregLunarDay = str_pad($I - 10, 2, '0', STR_PAD_LEFT);
			$PascalunarDay = str_pad($I - 11, 2, '0', STR_PAD_LEFT);
			$GregLunarMonth = 04;			
		}

		$J = ($year + (int)($year / 4) + $I + 2 - $C + (int)($C / 4)) % 7;
	 	$L = $I - $J;
		$m = 3 + (int)(($L + 40) / 44);
		$OmerDay = $L + 28 - 31 * ((int)($m / 4));
		$OmerMonth = 3 + (int)(($L + 40) / 44);

		$lagBaOmerDay = 18 + $OmerDay - $GregLunarDay; //18 = 30					
		$lagBaOmerMonth = 4 + (int)(($L + 40) / 44);
		$AscensionDay = 25 + $OmerDay - $GregLunarDay; //25 = 40
		
		//1st omer is from 16 to 22 Nisan in Hag Matzot Shavua after Shabbbath is down
		$JOmerDay01 = $this->caldean_date('JDay', $OmerMonth, $OmerDay, $year);
		//$JOmerYear = $this->caldean_date('JYear', $OmerMonth, $OmerDay, $year);
		
		if($JOmerDay01 <= 20)
		{
			$AliyahDay = $JOmerDay01 + 9; //offset 40 - 30 = 10 | 40 days = 10 days + one month of 30 days
			$AliyahMonth = 10; //Sivan
			$AscensionMonth = 05; //May
			$AscensionYear = $year; //$this->JewishToGreg('GYear', $AliyahMonth, $AliyahDay, $JOmerYear);			
		}
		else
		{
			$AliyahDay = $JOmerDay01 - 20; //offset:  30 - 20 = 10 | 40 days = 10 days + one month of 30 days
			$AliyahMonth = 11; //Tamuz
			$AscensionMonth = 06; //June
			$AscensionYear = $year; //$this->JewishToGreg('GYear', $AliyahMonth, $AliyahDay, $JOmerYear);			
		}		

		//$JOmerDay30 = $JOmerDay01;
		//$JOmerDay33 = $JOmerDay01 + 3; //18 = 30		
		//$AscensionMonth = 5 + (int)(($L + 40) / 44);
		
		//$GregPentecostMonth = $GregLunarMonth + 2;					

		//$PalmSunday = $this->addDays($OmerDay, -7); //Christian Lamb Day
		//$LaetareSunday = $this->addDays($OmerDay, -21);     
		//$GoodFriday = $this->addDays($OmerDay, -2);
		
		//$HolyThursday = $this->addDays($OmerDay, -3); ?
		//$ShroveTuesday = $this->addDays($OmerDay, -47); ?     
		//$AshWednesday = $this->addDays($OmerDay, -46);   ?  
		//$AscensionDay = $this->addDays($OmerDay, 39);		
		$ShavuotDay = 6 + $OmerDay - $GregLunarDay; //6  Sivan offset +- max 5-6 days = day 50 
		//$PentecostDay = $this->addDays($OmerDay, 49); //Gregorian
		
		switch ($mode)
		{
			case 'GregLunarMonth':
				return $GregLunarMonth; //Mars = 03 or April = 04, coresponding to Nisan or Aviv
			break;
			case 'GregLunarDay':
				return $GregLunarDay;
			break;
			case 'OmerMonth':
				return $OmerMonth;
			break;
			case 'OmerDay':
				return $OmerDay;
			break;
			case 'JOmerDay':	
				return $JOmerDay01; //$JOmerDay01
			break;			
			case 'BaOmerMonth':
				return $lagBaOmerMonth;
			break;
			case 'BaOmerDay':
				return $lagBaOmerDay; //hebcal offset
			break;			
			case 'BOmerDay':	
				return $this->caldean_date('JDay', $lagBaOmerMonth, $lagBaOmerDay, $year); //gregorian cal hebday
			break;
			case 'AscensionDay':
				return $AscensionDay;
			break;
			case 'AliyahDay':
				return $AliyahDay; // 40 days
			break;			
			case 'PentecostDay':
				return $PentecostDay;
			break;
			case 'ShavuotDay':
				return $ShavuotDay;
			break;			
			default:
			break;
		}
	}
	// Implements from NativeCalendar::getHolidays()
	function getMoadim($j_year, $j_month, $j_day, $mode = CAL_LANG_FOREIGN) 
	{
		if (!isset($this->cache[__FUNCTION__])) 
		{
			$this->cache[__FUNCTION__] = array();
		}
		$cache =& $this->cache[__FUNCTION__];
		$holiday_details = $this->_getMoadimDetails();
		if (!isset($cache[$j_year][$j_month]))
		{
			$cache[$j_year][$j_month] = $this->_buildMoadim($j_year, $j_month, $j_day);
		}
		if (isset($cache[$j_year][$j_month][$j_day]))
		{	
			$holidays = array();
			foreach ($cache[$j_year][$j_month][$j_day] as $id) 
			{
				$holidays[$id] = $holiday_details[$id];
				$holidays[$id]['id'] = $id;
				if ($mode == CAL_LANG_NATIVE) 
				{
					$holidays[$id]['name'] = $holidays[$id]['native'];
				} 
				else 
				{
					$holidays[$id]['name'] = $holidays[$id]['foreign'];
				}
			}
			return $holidays;
		} 
		else 
		{
			return array();
		}
	}
	
	function caldean_date($mode, $month, $day, $year) 
	{
		$month = ($month) ? $month : date(n); //gregorianMonth of Pasca or Omer
		$day = ($day) ? $day : date(j); //regorianDay of Pasca or Omer
		$year = ($year) ? $year : date(Y); //gregorianYear of Pasca or Omer
		//$date = date("$month-$day-$year");	
		//global $mx_user;		
		/*
		jdmonthname()
		0 Gregorian - abbreviated Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec 
		1 Gregorian January, February, March, April, May, June, July, August, September, October, November, December 
		2 Julian - abbreviated Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec 
		3 Julian January, February, March, April, May, June, July, August, September, October, November, December 
		4 Jewish Tishri, Heshvan, Kislev, Tevet, Shevat, AdarI, AdarII, Nisan, Iyyar, Sivan, Tammuz, Av, Elul 
		5 French Republican Vendemiaire, Brumaire, Frimaire, Nivose, Pluviose, Ventose, Germinal, Floreal, Prairial, Messidor, Thermidor, Fructidor, Extra 
		*/
		$LunarDate = gregoriantojd($month, $day, $year); //decimal fraction of the Julian date with the php gregoriantojd()
		list($JudaicMonth, $JudaicDay, $JudaicYear) = split('/', jdtojewish($LunarDate));
		switch ($mode)
		{
			case 'Date':
				return $Date = date("D d M Y", strtotime("$year-$month-$day -0 days")); 
			break;
			case 'LunarDate':
				return $LunarDate;
			break;
			case 'CaldeanMonth':
				return $CaldeanMonth = $this->adar_check(jdmonthname($LunarDate, 4), $JudaicYear);
			break;
			case 'CaldeanDate':
				return $CaldeanDate = jdtojewish($LunarDate);
			break;	
			case 'HebrewDate':
				return $HebrewDate = iconv('WINDOWS-1255', 'UTF-8', jdtojewish($LunarDate, true, CAL_JEWISH_ADD_GERESHAYIM + CAL_JEWISH_ADD_ALAFIM + CAL_JEWISH_ADD_ALAFIM_GERESH)); // for today // convert to utf-8;
			break;
			case 'JMonth':
				return $JudaicMonth; 
			break;
			case 'JDay':
				return $JudaicDay; 
			break;
			case 'JYear':
				return $JudaicYear; 
			break;		
			default:
			 	return $this->adar_check(jdmonthname($LunarDate, 4), $JudaicYear) . '-' . jdtojewish($LunarDate);
			break;
		}	
	}
	//this->JewishToGreg('GDate', 4, 30, 5767) === "1/20/2007"
	function JewishToGreg($mode, $month = 0, $day = 0, $year = 0) 
	{
		$month = (intval($month) > 0) ? $month : $this->caldean_date('JMonth'); //gregorianMonth of Pasca or Omer
		$day = (intval($day) > 0) ? $day : $this->caldean_date('JDay'); //regorianDay of Pasca or Omer
		$year = (intval($year) > 0) ? $year : $this->caldean_date('JYear'); //gregorianYear of Pasca or Omer
		/*
		jdmonthname()
		0 Gregorian - abbreviated Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec 
		1 Gregorian January, February, March, April, May, June, July, August, September, October, November, December 
		2 Julian - abbreviated Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec 
		3 Julian January, February, March, April, May, June, July, August, September, October, November, December 
		4 Jewish Tishri, Heshvan, Kislev, Tevet, Shevat, AdarI, AdarII, Nisan, Iyyar, Sivan, Tammuz, Av, Elul 
		5 French Republican Vendemiaire, Brumaire, Frimaire, Nivose, Pluviose, Ventose, Germinal, Floreal, Prairial, Messidor, Thermidor, Fructidor, Extra 
		*/
		$JDate = JewishToJD($month, $day, $year); //decimal fraction of the Julian date with the php gregoriantojd()
		list($JD_Month, $JD_Day, $JD_Year) = split('/', $JDate);
		$GDate = jdtogregorian($JDate);
		list($GD_Month, $GD_Day, $GD_Year) = split('/', $GDate);
		switch ($mode)
		{
			case 'JMonth':
				return $JD_Month; 
			break;
			case 'JDay':
				return $JD_Day; 
			break;
			case 'JYear':
				return $JD_Year;
			case 'JDate':
				return $JDate; 
			break;				
			case 'GMonth':
				return $GD_Month; 
			break;			
			case 'GYear':
				return $GD_Year; 
			break;
			case 'GDay':
				return $GD_Day; 
			break;			
			case 'GDate':
			default:			
				return $GDate; 
			break;			
		}	
	}
	
	// From NativeCalendar::getMonthName()
	function getHebrewMonth($mode = CAL_LANG_NATIVE, $year, $month)
	{
		global $mx_user, $module_root_path, $lang, $board_config, $phpEx;
		$default_lang = ($mx_user->lang['default_lang']) ? $mx_user->decode_lang($mx_user->lang['default_lang']) : $board_config['default_lang'];
		// -------------------------------------------------------------------------
		// Read Module Main Language Definition
		// -------------------------------------------------------------------------
		/*
		if ((@include $module_root_path . "language/lang_" . $default_lang . "/lang_main.$phpEx") === false)
		{
			//if ((@include $module_root_path . "language/lang_english/lang_main.$phpEx") === false)
			//{
				mx_message_die(CRITICAL_ERROR, 'Module main language file ' . $mx_root_path . $module_root_path . "language/lang_" . $default_lang . "/lang_main.$phpEx" . ' couldn\'t be opened.');
			//}
		}
		*/
		static $hebrew = array(
			TISHREI => 'תשרי',
			HESHVAN => 'חשוון',
			TEVET   => 'טבת',
			SHEVAT  => 'שבט',
			ADAR    => 'אדר',
			ADAR_B  => 'אדר-ב\'',
			NISAN   => 'ניסן',
			IYAR    => 'אייר',
			SIVAN   => 'סיוון',
			TAMUZ   => 'תמוז',
			AV      => 'אב',
			ELUL    => 'אלול'
		);
		static $foreign;
		
		if (!isset($foreign))
		{
			$foreign = array(
				TISHREI => t('Tishrei'),
				HESHVAN => t('Heshvan'),
				KISLEV  => t('Kislev'),
				TEVET   => t('Tevet'),
				SHEVAT  => t('Shevat'),
				ADAR    => t('Adar'),
				ADAR_B  => t('Adar II'),
				NISAN   => t('Nisan'),
				IYAR    => t('Iyar'),
				SIVAN   => t('Sivan'),
				TAMUZ   => t('Tamuz'),
				AV      => t('Av'),
				ELUL    => t('Elul')
			);
		}
		
	    if ($month == ADAR && $this->isLeapYear($year)) 
		{
	      return $mode == CAL_LANG_NATIVE ? 'אדר-א\'' : t('Adar I');
	    }
	    return $mode == CAL_LANG_NATIVE ? $hebrew[$month] : $foreign[$month];
	}
	
	function _getMoadimDetails() 
	{
		static $details;
		if (!isset($details)) 
		{
			$details = array(
			// The English spelling for the holidays I took from "Jewish Calendar for Linux" by Refoyl Finkl.
			// Nisan
				'roshKodeshimKhag' =>	array('native' => 'ראש חודשים',     		'foreign' => t('Rosh Kodeshim'),  'class' => 'khol'),
				'yomhaSher' =>          array('native' => 'יום השׂר',     			'foreign' => t('Yom haSher'),   			'class' => 'spec'),				
				'pesakhErevKhag' =>     array('native' => 'ערב פסח',    			'foreign' => t('Erev Pesakh'),  			'class' => 'khol'),
				'pesakh1' =>            array('native' => 'פסח',        			'foreign' => t('Pesakh'),       			'class' => 'shabat'),
				'pesakh2' =>            array('native' => 'שני של פסח (גולה)', 		'foreign' =>  t('Pesakh II (Diaspora)'), 'class' => 'shabat'),
				'pesakhKholHaMoed' =>   array('native' => 'חול המועד פסח',    		'foreign' => t('Khol HaMoed Pesakh'), 'class' => 'khol'), 
				'pesakh7' =>            array('native' => 'שביעי של פסח',     		'foreign' =>  t('Pesakh VII'),  			'class' => 'shabat'),
				'pesakh8' =>            array('native' => 'שמיני של פסח (גולה)', 	'foreign' => t('Pesakh VIII (Diaspora)'), 'class' => 'shabat'),
				'pesakhIsruKhag' =>     array('native' => 'אסרו חג',    			'foreign' => t('Isru Khag Pesakh'),   'class' => 'khol'),
				'yomHaBikurei' =>		array('native' => 'בְּיֹוםבִּכּוּרִ',    			'foreign' => t('Yom HaBikurei'),   'class' => 'omer'),				
				'omer' =>               array('native' => 'ספירת העומר',			'foreign' => t('Sefirat HaOmer'),     'class' => 'omer'),
				'yomHaShoa' =>          array('native' => 'יום השואה',  			'foreign' => t('Yom HaShoa'),   			'class' => 'taanit'),
			// Iyar
				'yomHaZikaron' =>       array('native' => 'יום הזכרון', 			'foreign' => t('Yom HaZikaron'),			'class' => 'taanit'),
				'yomHaAzmaut' =>        array('native' => 'יום העצמאות',			'foreign' => t('Yom HaAtsmaut'),			'class' => 'khol'),
				'lagBaOmer' =>          array('native' => 'ל"ג לעומר',  			'foreign' => t('Lag BaOmer'),   			'class' => 'omer khol'),
								
				'yomAscension' =>		array('native' => 'יום העלייה',				'foreign' => t('Yom HaAliyah'),				'class' => 'khol'),
				'yomYerishalayim' =>    array('native' => 'יום ירושלים',			'foreign' => t('Yom Yerushalayim'),			'class' => 'khol'),
			// Sivan
				'shavuotErevKhag' =>    array('native' => 'ערב שבועות', 			'foreign' => t('Erev Shavuot'), 			'class' => 'khol'),
				'shavuot'  =>           array('native' => 'שבועות',     			'foreign' => t('Shavuot'),      			'class' => 'shabat'),
				'shavuot2'  =>          array('native' => 'שבועות ב\' (גולה)', 		'foreign' => t('Shavuot II (Diaspora)'), 'class' => 'shabat'),
				'shavuotIsruKhag' =>    array('native' => 'אסרו חג',    			'foreign' => t('Isru Khag Shavuot'),  'class' => 'khol'),
			// Tamuz
				'tsomTamuz' =>          array('native' => 'צום תמוז',   			'foreign' => t('Tsom Tamuz'),   			'class' => 'taanit'),
			// Av
				'tishaBeAv' =>          array('native' => 'תשעה באב',   			'foreign' => t('Tisha BeAv'),   			'class' => 'taanit'),
			// Tishrei
				'roshHaShanaErevKhag' =>array('native' => 'ערב ראש השנה',     		'foreign' => t('Erev Rosh HaShana'),  'class' => 'khol'),
				'roshHaShana1' =>       array('native' => 'א\' ראש השנה',     		'foreign' => t('Rosh HaShana I'),     'class' => 'spec'),
				'roshHaShana2' =>       array('native' => 'ב\' ראש השנה',     		'foreign' => t('Rosh HaShana II'),    'class' => 'spec'),
				'tsomGedalya' =>        array('native' => 'צום גדליה',  			'foreign' => t('Tsom Gedalya'), 			'class' => 'taanit'),
				'yomKippurErevKhag' =>  array('native' => 'ערב יום הכיפורים', 		'foreign' => t('Erev Yom Kippur'),    'class' => 'khol'),
				'yomKippur' =>          array('native' => 'יום הכיפורים',     		'foreign' => t('Yom Kippur'),   			'class' => 'spec'),
				'sukkotErevKhag' =>     array('native' => 'ערב סוכות',  			'foreign' => t('Erev Sukkot'),  			'class' => 'khol'),
				'sukkot' =>             array('native' => 'סוכות',      			'foreign' => t('Sukkot'),       			'class' => 'shabat'),
				'sukkot2' =>            array('native' => 'סוכות ב\' (גולה)', 		'foreign' => t('Sukkot II (Diaspora)'), 'class' => 'shabat'),
				'sukkotKholHaMoed' =>   array('native' => 'חול המועד סוכות',  		'foreign' => t('Khol HaMoed Sukkot'),   'class' => 'khol'),
				'hoshanaRabba' =>       array('native' => 'הושענא רבה', 			'foreign' => t('Hoshana Rabba'),			'class' => 'khol'),
				'sheminiAtseret' =>     array('native' => 'שמיני עצרת', 			'foreign' => t('Shemini Atseret'),    'class' => 'shabat'),
				'simkhatTora' =>        array('native' => 'שמחת תורה',  			'foreign' => t('Simkhat Tora'), 			'class' => 'shabat'),
				'sukkotIsruKhag' =>     array('native' => 'אסרו חג',    			'foreign' => t('Isru Khag Sukkot'),   'class' => 'khol'),
			// Kislev / Tevet
				'khanukka1' =>          array('native' => 'א\' חנוכה',  			'foreign' => t('Khanukka I'),   			'class' => 'khol'),
				'khanukka2' =>          array('native' => 'ב\' חנוכה',  			'foreign' => t('Khanukka II'),  			'class' => 'khol'),
				'khanukka3' =>          array('native' => 'ג\' חנוכה',  			'foreign' => t('Khanukka III'), 			'class' => 'khol'),
				'khanukka4' =>          array('native' => 'ד\' חנוכה',  			'foreign' => t('Khanukka IV'),  			'class' => 'khol'),
				'khanukka5' =>          array('native' => 'ה\' חנוכה',  			'foreign' => t('Khanukka V'),   			'class' => 'khol'),
				'khanukka6' =>          array('native' => 'ו\' חנוכה',  			'foreign' => t('Khanukka VI'),  			'class' => 'khol'),
				'khanukka7' =>          array('native' => 'ז\' חנוכה',  			'foreign' => t('Khanukka VII'), 			'class' => 'khol'),
				'khanukka8' =>          array('native' => 'ח\' חנוכה',  			'foreign' => t('Khanukka VIII'),			'class' => 'khol'),
			// Tevet
				'tsomTevet' =>          array('native' => 'צום טבת',    			'foreign' => t('Tsom Tevet'),   			'class' => 'taanit'),
			// Shevat
				'tuBiShevat' =>         array('native' => 'ט\'ו בשבט',  			'foreign' => t('Tu BiShevat'),  			'class' => 'khol'),
			// Adar
				'taanitEsther' =>       array('native' => 'תענית אסתר', 			'foreign' => t('Taanit Esther'),			'class' => 'taanit'),
				'purim' =>              array('native' => 'פורים',      			'foreign' => t('Purim'),        			'class' => 'khol'),
				'shushanPurim' =>       array('native' => 'שושן פורים', 			'foreign' => t('Shushan Purim'),			'class' => 'khol'),
				'taanitRoshKodeshim' =>	array('native' => 'ראש חודשים ערב',     	'foreign' => t('Erev Rosh Kodeshim'),  		'class' => 'taanit'),				
			);
		}
		return $details;
	}

  // _buildHolidays() is the 'brain' of this object. It builds a table of holidays
  // for either a complete year or a month.
	function _buildMoadim($j_year, $j_month = 0, $j_day = 0)
	{
		$list = array();
		$d = new _JewishDateObj();
		
		// shorthands
		$sefirat_omer = $this->settings['sefirat_omer'];
		$diaspora     = $this->isDiaspora();
		$isru         = $this->settings['isru'];
		$eves         = $this->settings['eves'];
		// Greg Year:
		$g_year = $this->JewishToGreg('GYear', $j_month, $j_day, $j_year);	
		//
		// Holidays of Nisan
		//
		if ($j_month == NISAN || !$j_month) 
		{
		
			$list[NISAN][1][] = 'roshKodeshimKhag';
			$list[NISAN][10][] = 'yomhaSher';        		
			if ($eves) 
			{
				$list[NISAN][14][] = 'pesakhErevKhag';
			}
			$list[NISAN][15][] = 'pesakh1';
			if ($diaspora) 
			{
				$list[NISAN][16][] = 'pesakh2';
			} 
			else 
			{
				$list[NISAN][16][] = 'pesakhKholHaMoed';
			}
			
			$list[NISAN][17][] = 'pesakhKholHaMoed';
			$list[NISAN][18][] = 'pesakhKholHaMoed';
			$list[NISAN][19][] = 'pesakhKholHaMoed';
			$list[NISAN][20][] = 'pesakhKholHaMoed';
			$list[NISAN][21][] = 'pesakh7';
			
			if ($diaspora) 
			{
				$list[NISAN][22][] = 'pesakh8';
				if ($isru) 
				{
					$list[NISAN][23][] = 'pesakhIsruKhag';
				}
			} 
			else 
			{
				if ($isru) 
				{
					$list[NISAN][22][] = 'pesakhIsruKhag';
				}
			}
			// Yom HaBikurei:
			$o = $this->passover_day('JOmerDay', $g_year, $j_year);				
			$list[NISAN][$o][] = 'yomHaBikurei';				
			// Yom HaShoaa:
			$d->set($j_year, NISAN, 27);
			// Rule #1: fri,sat -> thu -> sun
			while ($d->dow() == 5 || $d->dow() == 6) 
			{
				$d->decrement();
			}
			// Rule #2: sun -> mon
			while ($d->dow() == 0) 
			{
				$d->increment();
				//continue;
			}
			$list[$d->month][$d->day][] = 'yomHaShoa';		
			if ($sefirat_omer) 
			{
				for ($i = $diaspora ? 23 : 22; $i <= 30; $i++) 
				{
					$list[NISAN][$i][] = 'omer';
				}
			}
		}
    //
    // Holidays of Aiir
    //
		if ($j_month == IYAR || !$j_month) 
		{
			$b = $this->passover_day('BaOmerDay', $g_year, $j_year); //18	
			$a = $this->passover_day('AliyahDay', $g_year, $j_year); //23
			//print_r("$a");
			$d->set($j_year, IYAR, 4);
			// Rule #1: thu,fri -> wed
			while ($d->dow() == 4 || $d->dow() == 5) 
			{
				$d->decrement();
			}
			// Rule #2: sun -> mon
			while ($d->dow() == 0) 
			{
				$d->increment();
			}
			$list[$d->month][$d->day][] = 'yomHaZikaron';
			$d->set($j_year, IYAR, 5);
			// Rule #1: fri,sat -> thu
			while ($d->dow() == 5 || $d->dow() == 6) 
			{
				$d->decrement();
			}
			// Reul #2: mon -> tue
			while ($d->dow() == 1) 
			{
				$d->increment();
			}
			$list[$d->month][$d->day][] = 'yomHaAzmaut';

			$list[IYAR][$b][] = 'lagBaOmer';
			$list[IYAR][25][] = 'yomAscension';				
			$list[IYAR][$a][] = 'yomAscension';			
			$list[IYAR][28][] = 'yomYerishalayim';
			if ($sefirat_omer) 
			{
				for ($i = 1; $i <= 29; $i++) 
				{
					$list[IYAR][$i][] = 'omer';
				}
			}
		}
    //
    // Holidays of Sivan
    //
		if ($j_month == SIVAN || !$j_month) 
		{
			$s = $this->passover_day('ShavuotDay', $g_year, $j_year); //6
			$s0 = $s - 1; //5
			$s2 = $s + 1; //7
			$s3 = $s + 2; //8			
			if ($eves)
			{
				$list[SIVAN][5][] = 'shavuotErevKhag';
				$list[SIVAN][$s0][] = 'shavuotErevKhag';				
			}
			$list[SIVAN][6][] = 'shavuot';
			$list[SIVAN][$s][] = 'shavuot';			
			if ($diaspora) 
			{
				$list[SIVAN][7][] = 'shavuot2';
				$list[SIVAN][$s2][] = 'shavuot2';				
				if ($isru) 
				{
					$list[SIVAN][8][] = 'shavuotIsruKhag';
					$list[SIVAN][$s3][] = 'shavuotIsruKhag';					
				}
			} 
			else 
			{
				if ($isru) 
				{
					$list[SIVAN][7][] = 'shavuotIsruKhag';
					$list[SIVAN][$s2][] = 'shavuotIsruKhag';					
				}
			}
			if ($sefirat_omer) 
			{
				for ($i = 1; $i < $s; $i++) 
				{
					$list[SIVAN][$i][] = 'omer';
				}
			}
		}
    
    //
    // Holidays of Tamuz
    //
		if ($j_month == TAMUZ || !$j_month) 
		{
			$d->set($j_year, IYAR, 17);
			if ($d->dow() == 6) 
			{
				$d->increment();
			}
			$list[TAMUZ][$d->day][] = 'tsomTamuz';
		}
    //
    // Holidays of Av
	//
		if ($j_month == AV || !$j_month) 
		{
			$d->set($j_year, AV, 9);
			if ($d->dow() == 6) 
			{
				$d->increment();
			}
			$list[AV][$d->day][] = 'tishaBeAv';
		}
    
    //
    // Holidays of Elul
    //
		if ($j_month == ELUL || !$j_month) 
		{
			if ($eves) 
			{
			$list[ELUL][29][] = 'roshHaShanaErevKhag';
			}
		}
		
	//
    // Holidays of Tishrei
    //

    if ($j_month == TISHREI || !$j_month) {

      $list[TISHREI][1][] = 'roshHaShana1';
      $list[TISHREI][2][] = 'roshHaShana2';

      $d->set($j_year, TISHREI, 3);
      if ($d->dow() == 6) {
        $d->increment();
      }
      $list[TISHREI][$d->day][] = 'tsomGedalya';

      if ($eves) {
        $list[TISHREI][9][] = 'yomKippurErevKhag';
      }
      $list[TISHREI][10][] = 'yomKippur';

      if ($eves) {
        $list[TISHREI][14][] = 'sukkotErevKhag';
      }
      $list[TISHREI][15][] = 'sukkot';
      if ($diaspora) {
        $list[TISHREI][16][] = 'sukkot2';
      } else {
        $list[TISHREI][16][] = 'sukkotKholHaMoed';
      }
      
      $list[TISHREI][17][] = 'sukkotKholHaMoed';
      $list[TISHREI][18][] = 'sukkotKholHaMoed';
      $list[TISHREI][19][] = 'sukkotKholHaMoed';
      $list[TISHREI][20][] = 'sukkotKholHaMoed';

      $list[TISHREI][21][] = 'hoshanaRabba';
      $list[TISHREI][22][] = 'sheminiAtseret';

      if ($diaspora) {
        $list[TISHREI][23][] = 'simkhatTora';
        if ($isru) {
          $list[TISHREI][24][] = 'sukkotIsruKhag';
        }
      } else {
        $list[TISHREI][22][] = 'simkhatTora';
        if ($isru) {
          $list[TISHREI][23][] = 'sukkotIsruKhag';
        }
      }

    }

    //
    // Holidays of Kislev or Tevet
    //

    if ($j_month == KISLEV || $j_month == TEVET || !$j_month) {

      $d->set($j_year, KISLEV, 25);
      for ($i = 1; $i <= 8; $i++) {
        $list[$d->month][$d->day][] = 'khanukka'.$i;
        $d->increment();
      }

    }

    //
    // Holidays of Tevet
    //
    
    if ($j_month == TEVET || !$j_month) {

      $d->set($j_year, TEVET, 10);
      if ($d->dow() == 6) {
        $d->increment();
      }
      $list[TEVET][$d->day][] = 'tsomTevet';

    }

    //
    // Holidays of Shevat
    //
	if ($j_month == SHEVAT || !$j_month)
	{
		$list[SHEVAT][15][] = 'tuBiShevat';
	}

    //
    // Holidays of Adar
    //
		if ($j_month == ADAR || $j_month == ADAR_A || $j_month == ADAR_B || !$j_month) 
		{
			if ($this->isLeapYear($j_year)) 
			{
				$adar = ADAR_B;
			} 
			else 
			{
				$adar = ADAR;
			}
			$list[$adar][14][] = 'purim';
			$list[$adar][15][] = 'shushanPurim';
			$d->set($j_year, $adar, 13);
			if ($d->dow() == 6) 
			{
				// if falls on saturday...
		        // ...then decrement twice, to thursday.
		        // TODO: what if it falls on friday in the first place? is it possible?
		        $d->decrement();
		        $d->decrement();
			}
			$list[$adar][$d->day][] = 'taanitEsther';
			if ($eves)
			{
				$list[$adar][29][] = 'taanitRoshKodeshim';
			}			
		}
		
		if ($j_month) 
		{
			if (isset($list[$j_month])) 
			{
				return $list[$j_month];
			} 
			else 
			{
				return array();
			}
		} 
		else 
		{
			return $list;
		}
	}	

	/**
	*
	* @package MXP Cal. Module
	* @version $Id: cal_functions.php,v 1.28 2014/04/09 08:54:21 orynider Exp $
	* Copyright 1993-1995, Scott E. Lee, all rights reserved.
	* Permission granted to use, copy, modify, distribute and sell so long as
	* the above copyright and this permission statement are retained in all
	* copies.  THERE IS NO WARRANTY - USE AT YOUR OWN RISK.
	*
	*/
	function MoladOfMetonicCycle($metonicCycle)
	{
		$r1  = NEW_MOON_OF_CREATION;
		$r1 += $metonicCycle * (HALAKIM_PER_METONIC_CYCLE & 0xffff );
		$r2  = $r1 >> 16;                  
		$r2 += $metonicCycle * ((HALAKIM_PER_METONIC_CYCLE >> 16)&0xffff);
		$d2  = intval($r2 / HALAKIM_PER_DAY);
		$r2 -= $d2 * HALAKIM_PER_DAY;
		$r1  = ($r2 << 16) | ($r1 &0xffff);
		$d1  = intval($r1 / HALAKIM_PER_DAY);
		$r1 -= $d1 * HALAKIM_PER_DAY;

		return array(($d2<<16)|$d1, $r1);
	}

	function Tishri1($metonicYear, $moladDay, $moladHalakim)
	{
		$tishri1 = $moladDay;
		$dow = $tishri1 % 7;
		$leapYear = $metonicYear == 2 || $metonicYear == 5 || $metonicYear == 7 || $metonicYear == 10 || $metonicYear == 13 || $metonicYear == 16 || $metonicYear == 18;
		$lastWasLeapYear = $metonicYear == 3 || $metonicYear == 6 || $metonicYear == 8 || $metonicYear == 11 || $metonicYear == 14 || $metonicYear == 17 || $metonicYear == 0;

		if (($moladHalakim >= NOON) || ((!$leapYear) && $dow == TUESDAY && $moladHalakim >= AM3_11_20) || ($lastWasLeapYear && $dow == MONDAY && $moladHalakim >= AM9_32_43)) 
		{
			$tishri1++;
			$dow++;

			if ($dow == 7) 
			{
				$dow = 0;
			}
		}

		if ($dow == WEDNESDAY || $dow == FRIDAY || $dow == SUNDAY) 
		{
			$tishri1++;
		}

		return $tishri1;
	}

	function FindTishriMolad($inputDay)
	{
		global $monthsPerYear;

		$metonicCycle = intval(($inputDay + 310)/6940);
		$mDay = $this->MoladOfMetonicCycle($metonicCycle);

		while ($mDay[0] < ($inputDay - 6940 + 310)) 
		{
			$metonicCycle += 1;
			$mDay[1] += HALAKIM_PER_METONIC_CYCLE;
			$mDay[0] += intval($mDay[1] / HALAKIM_PER_DAY);
			$mDay[1] %= HALAKIM_PER_DAY;
		}

		for ($metonicYear = 0; $metonicYear < 18; $metonicYear++)
		{
			if ( $mDay[0] > ($inputDay - 74) ) break;

			$mDay[1] += HALAKIM_PER_LUNAR_CYCLE * $monthsPerYear[$metonicYear];
			$mDay[0] += intval($mDay[1] / HALAKIM_PER_DAY);
			$mDay[1] %= HALAKIM_PER_DAY;
		}

		return array($metonicCycle, $metonicYear, $mDay[0], $mDay[1]);
	}

	function SdnToJewish($sdn)
	{
		global $monthsPerYear;

		$rYear = $rMonth = $rDay = 0;

		if ($sdn <= JEWISH_SDN_OFFSET) return array(0, 0, 0);

		$inputDay = $sdn - JEWISH_SDN_OFFSET;
		$mCycle = $this->FindTishriMolad($inputDay);

		$tishri1 = $this->Tishri1($mCycle[1], $mCycle[2], $mCycle[3]);

		if ($inputDay >= $tishri1)
		{ 
			$rYear = $mCycle[0] * 19 + $mCycle[1] + 1;

			if ($inputDay < $tishri1 + 59)
			{
				if ($inputDay < $tishri1 + 30) 
				{
					return array($rYear, 1, $inputDay - $tishri1 +  1); // Year , Month , Day
				}
				else
				{
					return array($rYear, 2, $inputDay - $tishri1 - 29); // Year , Month , Day
				}
			}

			$mCycle[3] += HALAKIM_PER_LUNAR_CYCLE * $monthsPerYear[$mCycle[1]];
			$mCycle[2] += intval($mCycle[3] / HALAKIM_PER_DAY);
			$mCycle[3] %= HALAKIM_PER_DAY;
			$tishri1After = Tishri1(($mCycle[1]+1)%19, $mCycle[2], $mCycle[3]);
		}
		else
		{
			$rYear = $mCycle[0] * 19 + $mCycle[1];

			if ($inputDay >= $tishri1 - 177)
			{
				if ($inputDay > $tishri1 - 30)
				{
					return array($rYear, 13, $inputDay - $tishri1 +  30);
				}
				else if ($inputDay > $tishri1 -  60) 
				{
					return array($rYear, 12, $inputDay - $tishri1 +  60);
				}
				else if ($inputDay > $tishri1 -  89)
				{
					return array($rYear, 11, $inputDay - $tishri1 +  89);
				}
				else if ($inputDay > $tishri1 - 119)
				{
					return array($rYear, 10, $inputDay - $tishri1 + 119);
				}
				else if ($inputDay > $tishri1 - 148)
				{
					return array($rYear,  9, $inputDay - $tishri1 + 148);
				}

				return array($rYear, 8, $inputDay - $tishri1 + 178);
			}
			else
			{
				$rDay = $inputDay - $tishri1 + 207;

				if ($monthsPerYear[($rYear-1)%19] == 13)
				{
					$rMonth  = 7;

					if ($rDay > 0) return array($rYear, $rMonth, $rDay);

					$rMonth -= 1;
					$rDay   += 30;

					if ($rDay > 0) return array($rYear, $rMonth, $rDay);

					$rMonth -= 1;
					$rDay   += 30;
				}
				else
				{ 
					$rMonth  = 6;

					if ($rDay > 0) return array($rYear, $rMonth, $rDay);

					$rMonth -= 1;
					$rDay   += 30;
				}

				if ($rDay > 0) return array($rYear, $rMonth, $rDay);

				$rMonth -= 1;
				$rDay   += 29;

				if ($rDay > 0) return array($rYear, $rMonth, $rDay);

				$tishri1After = $tishri1;
				$mCycle = $this->FindTishriMolad ( $mCycle[2] - 365 );
				$tishri1 = $this->Tishri1 ( $mCycle[1] , $mCycle[2] , $mCycle[3] );
			}
		}

		$yearLength = $tishri1After - $tishri1;
		$mCycle[2] = $inputDay - $tishri1 - 29;

		if ($yearLength == 355 || $yearLength == 385)
		{
			if ($mCycle[2] <= 30) return array($rYear, 2, $mCycle[2]);

			$mCycle[2] -= 30;
		}
		else
		{
			if ($mCycle[2] <= 29) return array ($rYear, 2, $mCycle[2]);

			$mCycle[2] -= 29;
		}

		return array($rYear, 3, $mCycle[2]);
	}

	function heb_number_to_chars($n, $fl)
	{
		global $alef_bet;
		
		$last_letter = '';
		$num_string = '';
		$let_count = 0;
		
		if ($n > 9999 || $n < 1) return false;

		if (intval($n / 1000))
		{
			$num_string .= $alef_bet[$n/1000];
			
			if (CAL_JEWISH_ADD_ALAFIM_GERESH & $fl) $num_string .= "'";
			if (CAL_JEWISH_ADD_ALAFIM & $fl) $num_string .= ALAFIM;
			
			$n = $n % 1000;
		}
		
		while ($n >= 400) 
		{
			$num_string .= ($last_letter=$alef_bet[22]);
			$let_count += 1;
			$n -= 400;
		}
		
		if ($n >= 100) 
		{
			$num_string .= ($last_letter=$alef_bet[18+$n/100]);
			$let_count += 1;
			$n %= 100;
		}
		
		if ($n == 15 || $n == 16)
		{
			$num_string .= $alef_bet[9];
			$num_string .= ($last_letter=$alef_bet[$n-9]);
			$let_count += 2;
		}
		else
		{
			if ($n >= 10)
			{
				$num_string .= ($last_letter=$alef_bet[9+$n/10]);
				$let_count += 1;
				$n %= 10;
			}
			
			if ($n > 0)
			{
				$num_string .= ($last_letter=$alef_bet[$n]);
				$let_count += 1;
			}
		}
		
		if (CAL_JEWISH_ADD_GERESHAYIM & $fl) 
		{
			switch ($let_count)
			{
				case 0: 
				break;

				case 1: 
					$num_string .= "'";
				break;

				default: 
					$num_string = substr($num_string, 0, -strlen($last_letter)) . '"' . $last_letter;
				break;
			}
		}

		return $num_string;
	}	
	
	/*
	* this function replace the php jdtojewish function
	**/
	function mx_jdtojewish($juliandaycount, $hebrew = false, $fl = 0)
	{
		global $jewishMonthHebName, $mx_user;
		$jwdate = $this->SdnToJewish($juliandaycount);
		if ($jwdate[0] <= 0 || $jwdate[0] > 9999)
		{
			return $mx_user->lang['YEAR_OUT_OF_RANGE'];
		}
		$day = $hebrew ? $this->heb_number_to_chars($jwdate[2], $fl) : $jwdate[2];
		$month = $mx_user->lang['jewish_months'][$jewishMonthHebName[$jwdate[1]]];
		$year = $hebrew ? $this->heb_number_to_chars($jwdate[0], $fl) : $jwdate[0];
		return sprintf("%s %s %s", $day, $month, $year);
	}

	/**
	*
	* @package MXP Cal. Module
	* @version $Id: cal_functions.php,v 1.28 2014/04/09 08:54:21 orynider Exp $
	* Copyright 1993-1995, Scott E. Lee, all rights reserved.
	* Permission granted to use, copy, modify, distribute and sell so long as
	* the above copyright and this permission statement are retained in all
	* copies.  THERE IS NO WARRANTY - USE AT YOUR OWN RISK.
	*
	*/
	function mx_getdate($timestemp = 0)
	{
		global $jewishMonthHebName, $mx_user;
		if($timestemp <= 0)
		{
			$timestemp = time();
		}
		$juliandaycount = unixtojd($timestemp);
		$data = array();
		$jwdate = $this->SdnToJewish($juliandaycount);
		if ($jwdate[0] <= 0 || $jwdate[0] > 9999)
		{
			return $data;
		}
		$user_hebrew = $mx_user->lang['USER_LANG'] == 'he' ? true : false;
		$data = array(
			'day' 		=> $jwdate[2],
			'day_heb' 	=> $this->heb_number_to_chars($jwdate[2], CAL_JEWISH_ADD_GERESHAYIM),
			'day_lang' 	=> $user_hebrew ? $this->heb_number_to_chars($jwdate[2], CAL_JEWISH_ADD_GERESHAYIM) : $jwdate[2],
			
			'month' 	=> $jwdate[1],
			'month_key' 	=> $jewishMonthHebName[$jwdate[1]],
			'month_lang' 	=> $mx_user->lang['jewish_months'][$jewishMonthHebName[$jwdate[1]]],
			'month_sort' 	=> $user_hebrew ? $mx_user->lang['jewish_months'][$jewishMonthHebName[$jwdate[1]]] : mb_substr($mx_user->lang['jewish_months'][$jewishMonthHebName[$jwdate[1]]], 0, 3),
			
			'year'		=> $jwdate[0],
			'year_heb'	=> $this->heb_number_to_chars($jwdate[0], CAL_JEWISH_ADD_GERESHAYIM),
			'year_lang'	=> $user_hebrew ? $this->heb_number_to_chars($jwdate[0], CAL_JEWISH_ADD_GERESHAYIM) : $jwdate[0],
		);
		
		return $data;
	}
	
	/*
	* Jewish Date Format Keys Explain:
	*
	* V => Day of the month, 2 digits with leading zeros => 01 to 30
	* v => Day of the month without leading zeros => 1 to 30
	* J => A full hebrew textual representation of the day of the month => ?' through ?'
	* R => A full hebrew textual or Numeric representation of the day of the month, if user lang is hebrew the day is textual else the day is Numeric => ?' through ?' or 01 to 30
	*
	* E => A full textual representation of a month, such as Tishrei or Kislev => Tishrei through Elul
	* K => A full textual representation of a month key, such as TISHREI or KISLEV => TISHREI through ELUL
	* k => Numeric representation of a month, with leading zeros => 01 through 13
	* Q => A short textual representation of a month, three letters => Tis through Elu
	* q => Numeric representation of a month, without leading zeros => 1 through 13
	*
	* X => A full numeric representation of a year, 4 digits => Examples: 5695 or 5700
	* x => A full hebrew textual or Numeric representation of the year, if user lang is hebrew the year is textual else the year is Numeric => Examples: (???"? or ????"?) or (5695 or 5700)
	* C => A full hebrew textual representation of a year => Examples: ???"? or ????"?
	*
	* More Free Keys: b, f, p
	**/
	function mx_gmdate($format = 'R E x, H:i', $timestemp = 0)
	{
		global $mx_user;
		
		if($timestemp <= 0)
		{
			$timestemp = time();
		}

		$data = mx_getdate($timestemp);

		if(!sizeof($data))
		{
			return @gmdate($format, $timestemp);
		}

		$replacements = array(
			'V'	=> strlen($data['day']) == 1 ? (int) ('0' . $data['day']) : $data['day'],
			'v'	=> substr($data['day'], 0, 1) == '0' ? substr($data['day'], 1) : $data['day'],
			'J'	=> $data['day_heb'],
			'R'	=> $data['day_lang'],

			'E' 	=> $data['month_lang'],
			'K' 	=> $data['month_key'],
			'k' 	=> strlen($data['month']) == 1 ? (int) ('0' . $data['month']) : $data['month'],
			'Q' 	=> $data['month_sort'],
			'q'	=> substr($data['month'], 0, 1) == '0' ? substr($data['month'], 1) : $data['month'],

			'X' 	=> $data['year'],
			'x' 	=> $data['year_lang'],
			'C' 	=> $data['year_heb'],
		);          

		$format = str_replace(array_keys($replacements), array_values($replacements), $format);
		$format_ary = explode(" ", $format);

		$date = array();

		if(sizeof($format_ary))
		{
			foreach($format_ary as $key)
			{
				if(trim($key) == '')
				{
					continue;
				}

				if(!in_array($key, array_values($replacements)))
				{
					$date[] = @gmdate($key, $timestemp);
				}
				else
				{
					$date[] = $key;
				}
			}
		}
		return sizeof($date) ? implode(" ", $date) : $format;
	}	


	/********************************************************************************\
	|	The one call to show the block
	\********************************************************************************/
	function show_block()
	{
		$this->_html_printCal();
	}		
}
/********************************************************************************\
|	Main Body Section (Main Stuff)
\********************************************************************************/

$caladv = new AdvanceCalendar();

/********************************************************************************\
|	End Of Function (Self Explainatory)
\********************************************************************************/
?>