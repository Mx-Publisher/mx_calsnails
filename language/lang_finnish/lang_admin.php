<?php
/***************************************************************************
 *                          mx_calsnails Module
 *                          lang_admin.php [English]
 *                          ------------------------
 *   copyright            : (C) 2003 Mx System
 *   email                : support@mx-system.com
 *   translated by:       :
 *
 *   module version       : v 1.05 2003/07/05 by markus_petrux
 *
 *   $Id: lang_admin.php,v 1.5 2003/07/05 01:55:20 markus_petrux Exp $
 *
 ****************************************************************************/

//
// The format of this file is:
//
// ---> $lang["message"] = "text";
//
// Specify your language character encoding... [optional]
//
// setlocale(LC_ALL, "en");

//
// Calendar Parameters documentation
//

$lang['Calendar_Block_Title'] = "Block title";
$lang['Calendar_Block_Titleinfo'] = "This parameter allows you to override the default block title (you may use something meaningfull depending on the Range used).";
$lang['Calendar_Events_dateformat'] = "Date Format";
$lang['Calendar_Events_dateformatinfo'] = "Only use if you wish to use a different format from the Calendar Lite date format (see <a href='http://www.php.net/date' target='_other'>date()</a>)";

$lang['Calendar_Vertical_Size'] = "Vertical Size (pixels)";
$lang['Calendar_Vertical_Sizeinfo'] = "If you choose 0, the block height depends on the number of events, otherwise the size will be fixed and the block will be scrollable.";
$lang['Calendar_Text_Length'] = "Text Length";
$lang['Calendar_Text_Lengthinfo'] = "Specify the max. number of visible characters for the events text.";

$lang['Calendar_Events_Range'] = "Range for Events";
$lang['Calendar_Events_Rangeinfo'] = "Specify the range (or filter) to be applied to the displayed events.";
$lang['Calendar_Events_Prev'] = "Days before range";
$lang['Calendar_Events_Previnfo'] = "Use this parameter to apply a negative offset to the range specified.";
$lang['Calendar_Events_Next'] = "Days after range";
$lang['Calendar_Events_Nextinfo'] = "Use this parameter to apply a positive offset to the range specified.";

$lang['Calendar_Where'] = "SQL Where";
$lang['Calendar_Whereinfo'] = "Specify conditions to filter calendar events.<br />For instance: username = 'xxxx' AND eventspan >= 'yyyy-mm-dd hh:mm:ss'<br />Column Information: id (int), username (string), stamp (datetime in the form 'yyyy-mm-dd hh:mm:ss'), subject (string), description (string), user_id (int), eventspan (date)";
$lang['Calendar_Order'] = "SQL Order By";
$lang['Calendar_Orderinfo'] = "Specify the list of columns (comma separated) to use in ORDER BY clausule.<br />Note: Parameters WHERE and ORDER BY are used to dynamically build the SQL statement for this block. Please, verify the SQL syntax is correct.";

//
// That's all Folks!
// -------------------------------------------------

?>
