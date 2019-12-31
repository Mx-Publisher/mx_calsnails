<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: db_install.php,v 1.34 2013/04/08 03:24:18 orynider Exp $
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
$mx_module_copy = 'Original phpBB <i>Calendar LITE</i> MOD by <a href="http://www.snailsource.com/" target="_blank">Martin</a> :: Adapted for MX-Publisher by [Jon Ohlsson] <a href="http://www.mx-publisher.com" target="_blank">The MX-Publisher Development Team</a>';

define( 'DB_INSTALL', true );
$module_root_path = dirname( __FILE__ ) . '/';
include_once( $module_root_path . 'includes/mx_common.' . $phpEx );

if ( !defined( 'CALADV_EVENTS_TABLE' ) )
{
	mx_message_die( GENERAL_ERROR, "Couldn't load cal_settings.php", "", __LINE__, __FILE__ );
}

if ( $result = $db->sql_query( "SELECT COUNT(*) as num_rows FROM " . CALADV_CONFIG_TABLE ) )
{
	echo '<b><font color=#0000FF>[Already added]</font></b>: mx_calsnails DB has been found. db_install.php has nothing to do, bye.<br />';
	return;
}

$sql = array(
	// Table: Calendar Lite Events
	"CREATE TABLE " . CALADV_EVENTS_TABLE . " (
	event_id int(11) NOT NULL auto_increment,
	username varchar(255),
	stamp datetime,
	subject varchar(255),
	description mediumtext,
	user_id mediumint(1) DEFAULT '-1' NOT NULL,
	valid char(3) DEFAULT 'no' NOT NULL,
	eventspan date,
	bbcode_uid varchar(10),
	block_id mediumint(8) unsigned NOT NULL default '0',
	PRIMARY KEY (event_id)
) CHARACTER SET utf8 COLLATE utf8_bin",
	// Table: Calendar Lite Configuration
	"CREATE TABLE " . CALADV_CONFIG_TABLE . " (
	config_name varchar(255) NOT NULL default '',
	config_value varchar(255) NOT NULL default '',
	PRIMARY KEY  (config_name)
) CHARACTER SET utf8 COLLATE utf8_bin",
	// Inserts: Default Calendar Configuration
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('week_start', '0')",
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('subject_length', '14')",
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('allow_anon', '0')",
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('allow_old', '0')",
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('show_headers', '0')",
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('cal_dateformat', 'D, d F Y h:i a')",
	"INSERT INTO " . CALADV_CONFIG_TABLE . " VALUES ('allow_user_default', '1')",
	// Inserts: Test Event.
	"INSERT INTO " . CALADV_EVENTS_TABLE . " (username, stamp, subject, description, user_id, valid, eventspan) " . "VALUES ('Test Event', '" . gmdate( "Y-m-d", time() ) . "', 'Calendar Lite Installed', " . "'This is just a test event to prove it works.<br /><br />Delete as required :)', -1 , 'yes', '" . gmdate( "Y-m-d", time() ) . "')"
	);

	$sql[] = "UPDATE " . $mx_table_prefix . "module" . "
				    SET module_version  = '" . $mx_module_version . "',
				      module_copy  = '" . $mx_module_copy . "'
				    WHERE module_id = '" . $mx_module_id . "'";

$message .= mx_do_install_upgrade( $sql );

echo "<br /><br />";
echo "<table  width=\"90%\" align=\"center\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">";
echo "<tr><th class=\"thHead\" align=\"center\">Module Installation/Upgrading/Uninstalling Information - module specific db tables</th></tr>";
echo "<tr><td class=\"row1\"  align=\"left\"><span class=\"gen\">" . $message . "</span></td></tr>";
echo "</table><br />";
?>