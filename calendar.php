<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: calendar.php,v 1.34 2020/04/16 20:43:41 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

/**
 * Calendar Lite
 *    note: following info added by CVS
 *    original author: WebSnail < Martin Smallridge >
 *
 * 	$Author: orynider $
 * 	$Date: 2013/10/08 19:43:41 $
 * 	$Revision: 1.33 $
 */

/*###############################################################
## Mod Title: phpBB2 Calendar Lite
## Mod Version: 1.4.1c
## Author: WebSnail < Martin Smallridge >
## SUPPORT: http://www.snailsource.com/forum/
## Description: Add a Calendar to your phpBB2 installation!
##              All registerd and logged in users can post to the calendar
##              And Admins can modify, remove, add also.
##
## Installation Level: MEDIUM
## Installation Time: 10 minutes
## Files to Edit: 2
## Files to Execute: 1
##
##
## NOTE: Please read readme.txt
#################################################################*/
// --------------------------------------------------

if( !defined('IN_PORTAL') || !is_object($mx_block))
{
	die("Hacking attempt");
}

// Common Includes and Read Calendar Lite Settings
include_once($module_root_path . 'includes/mx_common.' . $phpEx);

// Read Block Settings
$title = $mx_block->block_info['block_title'];
$block_size = ( isset( $block_size ) && !empty( $block_size ) ? $block_size : '100%' );

// Permission variables
$cal_auth_all = $mx_block->get_parameters('auth_all');
$cal_auth_reg = $mx_block->get_parameters('auth_reg');
$cal_filter = $mx_block->get_parameters('cal_filter') == 'TRUE';
$cal_mod_group = $mx_block->get_parameters('cal_mod_group');
$cal_hebrew = $mx_block->get_parameters('cal_hebrew') == 'TRUE';

// Get Calsnails target block
$cal_block_id = $mx_block->get_parameters( 'target_block' );
$cal_page_id = get_page_id( $cal_block_id );

if ( !isset( $cal_mode_mini ) )
{
	$cal_mode_mini = false;
}

// Get the current MX page.
//$page_id = ( !empty( $HTTP_POST_VARS['page'] ) ) ? $HTTP_POST_VARS['page'] : $HTTP_GET_VARS['page'];

// Security Check
if ( isset( $HTTP_GET_VARS['caluser'] ) || isset( $HTTP_POST_VARS['caluser'] ) || isset( $caluser ) )
{
	// Failed the test... Someone tried to spoof as a user.
	die( "Hacking attempt" );
}

$params = array( 'sid' => 'sid',
	'id' => 'id',
	'day' => 'day',
	'month' => 'month',
	'year' => 'year',
	'mode' => 'mode',
	'action' => 'action',
	'hour' => 'hour',
	'minute' => 'minute',
	'time' => 'time',
	'endday' => 'endday',
	'endmonth' => 'endmonth',
	'endyear' => 'endyear',
	'subject' => 'subject',
	'event_desc' => 'message', // MX011
	'modify' => 'modify',
);

while ( list( $var, $param ) = @each( $params ) )
{
	if ( isset( $HTTP_POST_VARS[$param] ) || isset( $HTTP_GET_VARS[$param] ) )
	{
		$$var = ( isset( $HTTP_POST_VARS[$param] ) ) ? $HTTP_POST_VARS[$param] : $HTTP_GET_VARS[$param];
	}
	else
	{
		unset( $$var );
	}
}

$thisscript = $module_root_path . basename( __FILE__ );

// --------------------------------------------------
// Interim days id to help with transfer to $lang['datetime'] format.
// DO NOT CHANGE THESE!!!!!!!!!!!!!!!!
$langdays[0] = $lang['datetime']['Sunday'];
$langdays[1] = $lang['datetime']['Monday'];
$langdays[2] = $lang['datetime']['Tuesday'];
$langdays[3] = $lang['datetime']['Wednesday'];
$langdays[4] = $lang['datetime']['Thursday'];
$langdays[5] = $lang['datetime']['Friday'];
$langdays[6] = $lang['datetime']['Saturday'];
$langdays[7] = $lang['datetime']['Sunday']; // Repeated to cover a Monday start

if ( $cal_mode_mini )
{
	$langdays[0] = strtoupper( substr( $lang['datetime']['Sun'], 0, 2 ) );
	$langdays[1] = strtoupper( substr( $lang['datetime']['Mon'], 0, 2 ) );
	$langdays[2] = strtoupper( substr( $lang['datetime']['Tue'], 0, 2 ) );
	$langdays[3] = strtoupper( substr( $lang['datetime']['Wed'], 0, 2 ) );
	$langdays[4] = strtoupper( substr( $lang['datetime']['Thu'], 0, 2 ) );
	$langdays[5] = strtoupper( substr( $lang['datetime']['Fri'], 0, 2 ) );
	$langdays[6] = strtoupper( substr( $lang['datetime']['Sat'], 0, 2 ) );
	$langdays[7] = $langdays[0];
}

//
// Add EDIT block nav
// $is_auth_ary = array();
//
$is_cal_moderator = !$cal_mode_mini ? mx_is_group_member( $cal_mod_group ) : false;

//
// Set Users permissions.
//
if ( $userdata['user_level'] == ADMIN || $is_cal_moderator )
{
	$caluser = 5;
}
else
{
	$caluser = ( $userdata['user_id'] == '-1' ? $cal_auth_all : $cal_auth_reg );
}

if ( $userdata['session_logged_in'] )
{
	$lvd = sprintf( $lang['You_last_visit'], phpBB2::create_date( $board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone'] ) );
}
else
{
	$lvd = "Not Logged In";
}

if ( $generate_headers )
{
	include( $mx_root_path . 'includes/page_header.' . $phpEx );
}

//$caladv = AdvanceCalendar::factory('Advance');
//$caladv = new AdvanceCalendar;
//
// Set Calendar Home URL (used in all templates)
//

$homeurl = mx_append_sid($caladv->mxurl());

if ( $cal_config['show_headers'] == 1 )
{
	$ct = sprintf( $lang['Current_time'], phpBB2::create_date( $board_config['default_dateformat'], time(), $board_config['board_timezone'] ) );
	if ( $userdata['session_logged_in'] )
	{
		$lvd = sprintf( $lang['You_last_visit'], phpBB2::create_date( $board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone'] ) );
	}
	else
	{
		$lvd = "Not Logged In";
	}
	$phpbbheaders = '<span class=gensmall>' . $lvd . "<br>\n";
	$phpbbheaders .= $ct . '<br></span>';
}
else
{
	$phpbbheaders = '';
}
// --------------------------------------------------

// Public Access check
// if ($cal_config['allow_anon'] != '1' && ($userdata['user_id'] == '-1' || $caluser == 0 || !$userdata)) {
// $er_msg =  $lang['Cal_not_enough_access'];
// $er_msg .= $lang['Cal_must_member'];
// mx_message_die(GENERAL_MESSAGE, $er_msg);
// }

if ( !$cal_mode_mini )
{
	if ( $caluser == 0 || !$userdata )
	{
		$er_msg = '';
		$er_msg .= '<table width="' . $block_size . '" border="0" cellpadding="0" cellspacing="0" class="forumline">';
		$er_msg .= '<tr><th class="thHead">' . $lang['Calendar'] . '</th></tr>';
		$er_msg .= '<tr><td class="row1" align="center">';
		$er_msg .= '<div style="margin:10px; padding:10px; border:solid red 1px;">';
		$er_msg .= '<b>' . $lang['Cal_not_enough_access'] . '</b><br />&nbsp;<br />' . $lang['Cal_must_member'];
		$er_msg .= '</div>';
		$er_msg .= '</td></tr>';
		$er_msg .= '</table>';
		echo $er_msg;
	}
}

// --------------------------------------------------
// Default date
/*
if ($userdata && $userdata['user_id'] != '-1') {
	if (!$day) { $day = phpBB2::create_date("j", time(), $userdata['user_timezone']); }
	if (!$month) { $month = phpBB2::create_date("m", time(), $userdata['user_timezone']); }
	if (!$year) { $year = phpBB2::create_date("Y", time(), $userdata['user_timezone']); }
	}
else {
	if (!$day) { $day = phpBB2::create_date("j", time(), $userdata[board_timezone]); }
	if (!$month) { $month = phpBB2::create_date("m", time(), $userdata[board_timezone]); }
	if (!$year) { $year = phpBB2::create_date("Y", time(), $userdata[board_timezone]); }
	}
*/

// FIX: Time off 1 day
if ( !$day )
{
	$day = phpBB2::create_date( "j", time(), $userdata['calsadv_timezone'] );
}
if ( !$month )
{
	$month = phpBB2::create_date( "m", time(), $userdata['calsadv_timezone'] );
}
if ( !$year )
{
	$year = phpBB2::create_date( "Y", time(), $userdata['calsadv_timezone'] );
}

$lastday = 1;
while ( checkdate( $month, $lastday, $year ) )
{
	$lastday++;
}

if ( $cal_mode_mini )
{
	// if ( $caluser >= 1 )
	
	if ( $caluser >= 1 || true)
	{
		$caladv->defaultview( $todaycolor );
	}
}
else
{
	if ( $mode == 'validate' && $caluser >= 5 )
	{	
		$caladv->validate();
	}
	elseif ( $mode == 'display' && $caluser >= 1 )
	{	
		$caladv->display();
	}
	elseif ( $action == 'Delete_marked' && $caluser >= 4 )
	{	
		$caladv->delete_marked();
	}
	elseif ( $action == 'Modify_marked' && $caluser >= 4 )
	{	
		$caladv->modify_marked();
	}
	elseif ( $action == 'Cal_add_event' && $caluser >= 2 )
	{
		$caladv->cal_add_event();
	}
	elseif ( $action == 'Addsucker' )
	{
		$caladv->addsucker( $modify );
	}
	elseif ( $caluser >= 1 )
	{	
		$caladv->defaultview( $todaycolor );
	}	
}

unset( $caluser );

if ( $generate_headers )
{
	include_once( $mx_root_path . 'includes/page_tail.' . $phpEx );
	exit;
}

// ------------------------------------------------------------------------------------------
// [ FUNCTIONS ]
// ------------------------------------------------------------------------------------------
// --------------------------------------------------

if (method_exists($caladv, 'mxurl'))
{
	return;
}

// --------------------------------------------------
// --------------------------------------------------
?>
