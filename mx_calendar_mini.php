<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: mx_calendar_mini.php,v 1.14 2013/04/03 10:56:50 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

if( !defined('IN_PORTAL') || !is_object($mx_block))
{
	die("Hacking attempt");
}

$cal_mode_mini = true;
include($module_root_path . 'calendar.' . $phpEx);
$cal_mode_mini = false;
?>