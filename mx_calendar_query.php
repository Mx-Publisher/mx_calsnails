<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: mx_calendar_query.php,v 1.17 2013/04/03 10:56:50 orynider Exp $
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
$query_where = $mx_block->get_parameters( 'Calendar_Where' );
$query_order = $mx_block->get_parameters( 'Calendar_Order' );
$block_datefmt = $mx_block->get_parameters( 'Calendar_Events_dateformat' );

if ( empty( $block_datefmt ) )
{
	$block_datefmt = $cal_dateformat;
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
	$template->set_filenames( array( 'body' => 'mx_calendar_query.tpl' ) );

	$sql = "SELECT * FROM " . CALADV_EVENTS_TABLE . " WHERE valid = 'yes'";
	if ( $query_where != '' )
	{
		$sql .= " AND " . $query_where;
	}
	if ( $query_order != '' )
	{
		$sql .= " ORDER BY " . $query_order;
	}
	if ( !( $result = $db->sql_query( $sql ) ) )
	{
		mx_message_die( GENERAL_ERROR, 'Could not select Event data', '', __LINE__, __FILE__, $sql );
	}

	$check = 0;
	while ( $row = $db->sql_fetchrow( $result ) )
	{
		if ( $check == 0 )
		{
			$template->assign_block_vars( 'event_row', array(
				'ROW_CLASS' => 'catHead',
				'EVENT_ID' => '<b>ID</b>',
				'SUBJECT' => '<b>SUBJECT</b>',
				'DATE' => '<b>STAMP</b>',
				'END_DATE' => '<b>EVENTSPAN</b>',
				'DESC' => '<b>DESCRIPTION</b>',
				'BBTEXT' => '',
				'AUTHOR' => '<b>USERNAME</b>' )
			);
		}

		$template->assign_block_vars( 'event_row', array(
			'ROW_CLASS' => ( $check % 2 == 0 ) ? 'row1' : 'row2',
			'EVENT_ID' => stripslashes( $row['event_id'] ),
			'SUBJECT' => stripslashes( $row['subject'] ),
			'DATE' => $this->my_dateformat( $row['stamp'], $block_datefmt ),
			'END_DATE' => $this->my_dateformat( $row['eventspan'], $block_datefmt, 1 ),
			'DESC' => stripslashes( $row['description'] ),
			'BBTEXT' => $this->my_decode_bbtext( $row['description'], $row['bbcode_uid'] ),
			'AUTHOR' => stripslashes( $row['username'] ) )
		);
		$check++;
	}
	$db->sql_freeresult($result);

	if ( $check == 0 )
	{
		$template->assign_block_vars( 'no_events', array( 'NO_EVENTS' => $lang["No events"] ) );
	}
	$template->assign_vars( array(
		'BLOCK_SIZE' => $block_size,
		'L_TITLE' => ( $block_title == '' ? $lang['Calendar_Events'] : $block_title ) )
	);

	$template->pparse( 'body' );
	// --------------------------------------------------------------------------------
} //
// --------------------------------------------------------------------------------
unset( $caluser );
?>