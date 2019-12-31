<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: db_upgrade.php,v 1.27 2013/04/08 03:24:18 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

define( 'IN_PORTAL', true );
if ( !defined( 'IN_ADMIN' ) )
{
	$mx_root_path = './../../';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include( $mx_root_path . 'common.' . $phpEx );
	// Start session management
	$mx_user->init($user_ip, PAGE_INDEX);

	if ( !$userdata['session_logged_in'] )
	{
		die( "Hacking attempt(1)" );
	}

	if ( $userdata['user_level'] != ADMIN )
	{
		die( "Hacking attempt(2)" );
	}
	// End session management
}

$mx_module_version = '2.9.2';
$mx_module_copy = 'Original phpBB <i>Calendar Advance</i> MOD by <a href="http://www.snailsource.com/" target="_blank">Martin</a> :: Adapted for MX-Publisher by [Jon Ohlsson] <a href="http://www.mx-publisher.com" target="_blank">The MX-Publisher Development Team</a>';

define( 'DB_INSTALL', true );
$module_root_path = dirname( __FILE__ ) . '/';
include_once( $module_root_path . 'includes/mx_common.' . $phpEx );
if ( !defined( 'CALADV_EVENTS_TABLE' ) )
{
	mx_message_die( GENERAL_ERROR, "Couldn't load cal_settings.php", "", __LINE__, __FILE__ );
}

$sql = array();
// Precheck
if ( $result = $db->sql_query( "SELECT config_name from " . CALADV_CONFIG_TABLE ) )
{
	// Upgrade checks
	$upgrade_101 = 0;
	$upgrade_102 = 0;
	$upgrade_103 = 0;
	$upgrade_104 = 0;
	$upgrade_105 = 0;
	$upgrade_106 = 0;
	$upgrade_107 = 0;
	$upgrade_108 = 0;
	// validate before 1.07
	if ( !$result = $db->sql_query( "SELECT block_id from " . CALADV_EVENTS_TABLE ) )
	{
		$upgrade_107 = 1;
	}
	// validate before 1.08
	if ( !$result = $db->sql_query( "SELECT event_id from " . CALADV_EVENTS_TABLE ) )
	{
		$upgrade_108 = 1;
	}
	$message = "<b>Upgrading!</b><br/><br/>";

	if ( $upgrade_107 == 1 )
	{
		$message .= "<b>Upgrading to v. 1.07...</b><br/><br/>";
		$sql[] = "ALTER TABLE " . CALADV_EVENTS_TABLE . " ADD block_id mediumint(8) unsigned NOT NULL default '0' ";

	}

	if ( $upgrade_108 == 1 )
	{
		$message .= "<b>Upgrading to v. 1.08...</b><br/><br/>";
		$sql[] = "ALTER TABLE " . CALADV_EVENTS_TABLE . " CHANGE id event_id int(11) DEFAULT '0' NOT NULL auto_increment ";

	}
	else
	{
		$message .= "<b>Nothing to upgrade...</b><br/><br/>";
	}


	$sql[] = "UPDATE " . $mx_table_prefix . "module" . "
				    SET module_version  = '" . $mx_module_version . "',
				      module_copy  = '" . $mx_module_copy . "'
				    WHERE module_id = '" . $mx_module_id . "'";

	$message .= mx_do_install_upgrade( $sql );
	$message .= "<b>...Now upgraded to v. $mx_module_version :-)</b><br/><br/>";
}
else
{
	// If not installed
	$message = "<b>Module is not installed...and thus cannot be upgraded ;)</b><br/><br/>";
}

echo "<br /><br />";
echo "<table  width=\"90%\" align=\"center\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">";
echo "<tr><th class=\"thHead\" align=\"center\">Module Installation/Upgrading/Uninstalling Information - module specific db tables</th></tr>";
echo "<tr><td class=\"row1\"  align=\"left\"><span class=\"gen\">" . $message . "</span></td></tr>";
echo "</table><br />";
?>