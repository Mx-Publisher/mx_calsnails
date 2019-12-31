<?php
/**
*
* @package MX-Publisher Module - mx_calsadv
* @version $Id: mx_calendar_events.php,v 1.27 2013/04/03 10:56:50 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

if( !defined('IN_PORTAL') || !is_object($mx_block))
{
	die("Hacking attempt");
}

//
// Common Includes and Read Calendar Lite Settings
//
include_once( $module_root_path . 'includes/mx_common.' . $phpEx );

//
// Read Block Settings
//
$title = $mx_block->block_info['block_title'];
$block_size = ( isset( $block_size ) && !empty( $block_size ) ? $block_size : '100%' );

$block_title = $mx_block->get_parameters( 'Calendar_Block_Title' );
$block_vsize = $mx_block->get_parameters( 'Calendar_Vertical_Size' );
$text_length = $mx_block->get_parameters( 'Calendar_Text_Length' );
$events_range = $mx_block->get_parameters( 'Calendar_Events_Range' );
$events_prev = $mx_block->get_parameters( 'Calendar_Events_Prev' );
$events_next = $mx_block->get_parameters( 'Calendar_Events_Next' );
$block_datefmt = $mx_block->get_parameters( 'Calendar_Events_dateformat' );

if ( empty( $block_datefmt ) )
{
	$block_datefmt = $cal_dateformat;
}

define( 'CALRANGE_TODAY' , 'today' );
define( 'CALRANGE_THIS_WEEK' , 'this week' );
define( 'CALRANGE_NEXT_WEEK' , 'next week' );
define( 'CALRANGE_THIS_AND_NEXT_WEEK' , 'thisnext week' );
define( 'CALRANGE_THIS_MONTH', 'this month' );
define( 'CALRANGE_NEXT_MONTH', 'next month' );

//
// Check parameters: assign default values if the module is not correctly installed.
//
if ( empty( $block_title ) )
{
	$block_title = $lang['Calendar_Events'];
}
if ( !is_numeric( $block_vsize ) || $block_vsize < 0 )
{
	$block_vsize = 0;
}
if ( !is_numeric( $text_length ) || $text_length < 0 )
{
	$text_length = 30;
}
if ( !is_numeric( $events_prev ) || $events_prev < 0 )
{
	$events_prev = 0;
}
if ( !is_numeric( $events_next ) || $events_next < 0 )
{
	$events_next = 0;
}

//
// Get Calsnails target block
//
$cal_block_id = $mx_block->get_parameters( 'target_block' );

//
// Toggles
//
if (intval($cal_block_id) > 0)
{
	$cal_page_id = get_page_id( $cal_block_id );
	$cal_block_config = read_block_config( $cal_block_id );
	$cal_page_filter = $cal_block_config[$cal_block_id]['cal_filter']['parameter_value'] == 'TRUE';
}
else
{
	$cal_page_id = $page_id;
	$cal_page_filter = false;
	$template->assign_block_vars( 'no_events', array( 'NO_EVENTS' => 'This block is not correctly configured. Use the blockCP and define its target calsadv block.' ) );
}

//
// Security Check
//
if ( isset( $HTTP_GET_VARS['caluser'] ) || isset( $HTTP_POST_VARS['caluser'] ) || isset( $caluser ) )
{
	die( "Hacking attempt !!!" );
}
if ( $userdata['user_level'] == ADMIN )
{
	$caluser = 5;
}
else
{
	$caluser = ( $userdata['user_id'] == ANONYMOUS ? $cal_config['allow_anon'] : $cal_config['allow_user_default'] );
}

// --------------------------------------------------------------------------------
// Check if the user can see. Otherwise, nothing to do.
// --------------------------------------------------------------------------------
if ( $caluser >= 1 )
{
	// --------------------------------------------------------------------------------
	$template->set_filenames( array( 'body' => 'mx_calendar_events.tpl' ) );

	// Compute date range depending on block parameters.
	switch ( $events_range )
	{
		case CALRANGE_TODAY:
			$ini_time = time();
			$end_time = time();
			break;
		case CALRANGE_THIS_WEEK:
		case CALRANGE_NEXT_WEEK:
			$tmp_time = time();
			$tmp_dir = ( $events_range == CALRANGE_NEXT_WEEK ) ? 1 : -1;
			while ( $cal_config['week_start'] != gmdate( 'w', $tmp_time ) )
			{
				$tmp_time += ( SECONDS_PER_DAY * $tmp_dir );
			}
			$ini_time = $tmp_time;
			$end_time = $ini_time + ( SECONDS_PER_DAY * 6 );
			break;
		case CALRANGE_THIS_AND_NEXT_WEEK:
			$tmp_time = time();
			$tmp_dir = ( false ) ? 1 : -1;
			while ( $cal_config['week_start'] != gmdate( 'w', $tmp_time ) )
			{
				$tmp_time += ( SECONDS_PER_DAY * $tmp_dir );
			}
			$ini_time = $tmp_time;
			$end_time = $ini_time + ( SECONDS_PER_DAY * 13 );
			break;
		case CALRANGE_NEXT_MONTH:
			list( $tmp_yy, $tmp_mm ) = explode( '-', phpBB2::create_date( 'Y-m', time(), $cal_timezone ) );
			$ini_time = gmmktime( 0, 0, 0, ( $tmp_mm + 1 ), 1, $tmp_yy );
			$end_time = gmmktime( 0, 0, 0, ( $tmp_mm + 1 ), ( gmdate( 't', $ini_time ) ), $tmp_yy );
			break;
		case CALRANGE_THIS_MONTH:
		default:
			list( $tmp_yy, $tmp_mm ) = explode( '-', phpBB2::create_date( 'Y-m', time(), $cal_timezone ) );
			$ini_time = gmmktime( 0, 0, 0, $tmp_mm, 1, $tmp_yy );
			$end_time = gmmktime( 0, 0, 0, $tmp_mm, ( gmdate( 't', $ini_time ) ), $tmp_yy );
			break;
	}

	if ( $events_prev > 0 )
	{
		$ini_time -= ( SECONDS_PER_DAY * $events_prev );
	}
	if ( $events_next > 0 )
	{
		$end_time += ( SECONDS_PER_DAY * $events_next );
	}
	list( $ini_yy, $ini_mm, $ini_dd ) = explode( '-', phpBB2::create_date( 'Y-m-j', $ini_time, $cal_timezone ) );
	list( $end_yy, $end_mm, $end_dd ) = explode( '-', phpBB2::create_date( 'Y-m-j', $end_time, $cal_timezone ) );

	//
	// Build the query (note use of fixed condition: valid = 'yes').
	//
	$sql = "SELECT * FROM " . CALADV_EVENTS_TABLE . " WHERE valid = 'yes' AND ";

	if ( $cal_page_filter )
	{
		$sql .= "block_id = '$cal_block_id' AND ";
	}

	$sql .= "eventspan >= \"$ini_yy-$ini_mm-$ini_dd 00:00:00\" " . "AND stamp <= \"$end_yy-$end_mm-$end_dd 23:59:59\" ";
	$sql .= "ORDER BY stamp, subject";

	if ( !( $result = $db->sql_query( $sql, 300 ) ) )
	{
		mx_message_die( GENERAL_ERROR, 'Could not select Event data', '', __LINE__, __FILE__, $sql );
	}

	//
	// Loop through Calendar Events...
	//
	$today = phpBB2::create_date( 'Y-m-d', time(), $cal_timezone );
	$check = 0;
	$lastdate = '';

	while ( $row = $db->sql_fetchrow( $result ) )
	{	
		$id = stripslashes( $row['event_id'] );	
		$ini_date = $caladv->my_dateformat( $row['stamp'], $block_datefmt, 1 );
		$end_date = $caladv->my_dateformat( $row['eventspan'], $block_datefmt, 1 );
		$ini_time = trim( $caladv->my_dateformat( $row['stamp'], $block_datefmt ) );

		$subject = $caladv->my_truncate_words( $row['subject'], 25 );
		$zdesc = $caladv->my_truncate_words( $row['description'], $text_length );
		$zdesc = $caladv->my_decode_bbtext( $zdesc, $row['bbcode_uid'] );

		$yy = substr( $row['stamp'], 0, 4 );
		$mm = substr( $row['stamp'], 5, 2 );
		$dd = substr( $row['stamp'], 8, 2 );
		$u_ini_date = mx_append_sid( $mx_root_path . 'index.' . $phpEx . "?page=" . $cal_page_id . "&day=" . $dd . "&amp;month=" . $mm . "&amp;year=" . $yy . "&amp;mode=display" );
		$yy = substr( $row['eventspan'], 0, 4 );
		$mm = substr( $row['eventspan'], 5, 2 );
		$dd = substr( $row['eventspan'], 8, 2 );
		$u_end_date = mx_append_sid( $mx_root_path . 'index.' . $phpEx . "?page=" . $cal_page_id . "&day=" . $dd . "&amp;month=" . $mm . "&amp;year=" . $yy . "&amp;mode=display" );

		$template->assign_block_vars( 'event_row', array(
			'SUBJECT' => $subject,
			'ROW_CLASS' => ( $today >= substr( $row['stamp'], 0, 10 ) && $today <= $row['eventspan'] ? 'row1' : 'row1' ),
			'U_INI_DATE' => $u_ini_date,
			'INI_DATE' => $ini_date,
			'INI_TIME' => $ini_time,
			'L_END_DATE' => $lang['To_End_Date'],
			'U_END_DATE' => $u_end_date,
			'END_DATE' => $end_date,
			'AUTHOR' => stripslashes( $row['username'] ),
			'DESC' => $zdesc,
			'U_MORE_INFO' => $u_ini_date . "&amp;id=" . $id )
		);

		if ( $ini_time != '' )
		{
			$template->assign_block_vars( 'event_row.event_row_switch_time', array() );
		}

		if ( $ini_date != $lastdate )
		{
			$template->assign_block_vars( 'event_row.event_row_switch_day', array() );
		}
		if ( $ini_date != $caladv->my_dateformat( $row['eventspan'], $block_datefmt, 1 ) )
		{
			$template->assign_block_vars( 'event_row.event_row_switch_day.event_row_switch_endday', array() );
		}
		$lastdate = $ini_date;
		$check++;
	}
	$db->sql_freeresult($result);

	//
	// Do we get any event? Do we need to enable scrollbars?
	//
	if ( $check == 0 )
	{
		$template->assign_block_vars( 'no_events', array( 'NO_EVENTS' => $lang["No events"] ) );
	}
	else
	{
		if ( $block_vsize > 0 )
		{
			$template->assign_block_vars( 'switch_use_vsize_on', array() );
		}
	}

	$cdd = phpBB2::create_date( "j", time(), $userdata['calsadv_timezone'] );
	$cmm = phpBB2::create_date( "m", time(), $userdata['calsadv_timezone'] );
	$cyy = phpBB2::create_date( "Y", time(), $userdata['calsadv_timezone'] );
	// Added Week
	$currentweek = $caladv->week_of_year( $cdd, $cmm, $cyy );
	$nextweek = ( $currentweek < 52 ) ? $currentweek + 1 : 1;

	$curmonthname = $lang['datetime'][gmdate( "F", gmmktime( 0, 0, 0, $cmm, 1, $cyy ) )];

	$mm_tmp = ( $cmm < 12 ) ? ( $cmm + 1 ) : 1;
	$yy_tmp = ( $cmm < 12 ) ? $cyy : ( $cyy + 1 );
	$nextmonthname = $lang['datetime'][gmdate( "F", gmmktime( 0, 0, 0, $mm_tmp, 1, $yy_tmp ) )];

	$curdayname = $lang['datetime'][gmdate( "D", gmmktime( 0, 0, 0, $cmm, $cdd, $cyy ) )];

	// Compute top label.
	switch ( $events_range )
	{
		case CALRANGE_TODAY:
			$events_label = $lang['Ev_this_day'] . ' (' . $curdayname . ')';
			break;
		case CALRANGE_THIS_WEEK:
			$events_label = $lang['Ev_this_week'] . '' . $currentweek;
			break;
		case CALRANGE_NEXT_WEEK:
			$events_label = $lang['Ev_next_week'] . '' . $nextweek;
			break;
		case CALRANGE_THIS_AND_NEXT_WEEK:
			$events_label = $lang['Ev_this_week'] . '' . $currentweek . ' - ' . $nextweek;
			break;
		case CALRANGE_NEXT_MONTH:
			$events_label = $lang['Ev_next_month'] . ' (' . $nextmonthname . ')';
			break;
		case CALRANGE_THIS_MONTH:
			$events_label = $lang['Ev_this_month'] . ' (' . $curmonthname . ')';
			break;
		default:
			break;
	}

	//
	// Setup common template vars and display the block.
	//
	$template->assign_vars(array('BLOCK_SIZE' => $block_size,
		'EVENTS_LABEL' => $events_label,
		'WEEK_LABEL' => $week_label,
		'BLOCK_VSIZE' => $block_vsize,
		'L_TITLE' => $block_title,
		'L_MORE_INFO' => $lang['More_Info'])
	);
	$template->pparse('body');
	// --------------------------------------------------------------------------------
} //
// --------------------------------------------------------------------------------
unset( $caluser );
?>