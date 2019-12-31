<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: cal_settings.php,v 1.25 2014/04/09 08:54:22 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/
if ( !defined('IN_PORTAL') )
{
	die("Hacking attempt");
}
$cal_version = "1.4.1c";
global $mx_user;
$mx_user->set_module_default_style('_core'); // For compatibility with core 2.8.x

// -------------------------------------------------------------------------
// Footer Copyrights
// -------------------------------------------------------------------------
if (is_object($mx_page))
{
	// -------------------------------------------------------------------------
	// Extend User Style with module lang and images
	// Usage:  $mx_user->extend(LANG, IMAGES)
	// Switches:
	// - LANG: MX_LANG_MAIN (default), MX_LANG_ADMIN, MX_LANG_ALL, MX_LANG_NONE
	// - IMAGES: MX_IMAGES (default), MX_IMAGES_NONE
	// -------------------------------------------------------------------------
	//die("Hacking attempt");	
	$mx_user->extend(MX_LANG_ALL, MX_IMAGES);	
	$mx_page->add_copyright('MXP CalAdvance Module');	
	//$mx_page->add_css_file();	
}
// -------------------------------------------------------------------------
// Define table names.
// -------------------------------------------------------------------------
define( 'CALADV_CONFIG_TABLE', $mx_table_prefix . 'caladv_config' );
define( 'CALADV_EVENTS_TABLE', $mx_table_prefix . 'caladv_events' );

// Prepare some other common variables
define('SECONDS_PER_DAY', 86400); // 24h * 60m * 60s

// Forum/Topic states
!defined('FORUM_CAT') ? define('FORUM_CAT', 0) : false;
!defined('FORUM_POST') ? define('FORUM_POST', 1) : false;
!defined('FORUM_LINK') ? define('FORUM_LINK', 2) : false;
!defined('ITEM_UNLOCKED') ? define('ITEM_UNLOCKED', 0) : false;
!defined('ITEM_LOCKED') ? define('ITEM_LOCKED', 1) : false;
!defined('ITEM_MOVED') ? define('ITEM_MOVED', 2) : false;

// Topic types
!defined('POST_NORMAL') ? define('POST_NORMAL', 0) : false;
!defined('POST_STICKY') ? define('POST_STICKY', 1) : false;
!defined('POST_MOAD_ANNOUNCE') ? define('POST_MOAD_ANNOUNCE', 2) : false;
!defined('POST_GLOBAL') ? define('POST_GLOBAL', 3) : false;
!defined('POST_GLOBAL_ANNOUNCE') ? define('POST_GLOBAL_ANNOUNCE', 3) : false;
!defined('POST_NEWS') ? define('POST_NEWS', 4) : false;

?>