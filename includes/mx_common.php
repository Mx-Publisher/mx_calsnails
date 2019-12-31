<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: mx_common.php,v 1.24 2013/10/08 19:43:42 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

if ( !defined('IN_PORTAL') )
{
	die("Hacking attempt");
}

// Include common scripts.
date_default_timezone_set('Asia/Jerusalem'); // We have to set something or else PHP will complain.
//$jcal = NativeCalendar::factory('Jewish');
require_once($module_root_path . 'includes/cal_settings.' . $phpEx);
require_once($module_root_path . 'includes/NativeCalendar.' . $phpEx); // Provides the calendar object. The 'engine.'
require_once($module_root_path . 'includes/JewishCalendar.' . $phpEx); //Define Babilonian Month Names
require_once($module_root_path . 'includes/cal_functions.' . $phpEx);

if (!defined('DB_INSTALL'))
{
	// Get Calendar Settings from Cal_config table
	$cal_config = array();
	$sql = "SELECT * FROM " . CALADV_CONFIG_TABLE;
	if (!( $result = $db->sql_query($sql, 100)))
	{
		mx_message_die( GENERAL_ERROR, "Couldn't query calendar config table", "", __LINE__, __FILE__, $sql );
	}
	else
	{
		while ( $row = $db->sql_fetchrow( $result ) )
		{
			$cal_config[$row['config_name']] = $row['config_value'];
		}
	}
	$db->sql_freeresult($result);
	$cal_dateformat = !empty( $cal_config['cal_dateformat'] ) ? $cal_config['cal_dateformat'] : $board_config['default_dateformat'];
	// Timezone off 1 day fix
	// $cal_timezone   = $board_config['board_timezone'];
	$userdata['calsadv_timezone'] = 0;
}

?>