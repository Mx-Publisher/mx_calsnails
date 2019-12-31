<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: lang_admin.php,v 1.4 2014/04/09 08:54:32 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

//
// The format of this file is:
//
// ---> $lang['message'] = 'text';
//
// Specify your language character encoding... [optional]
//
// setlocale(LC_ALL, 'en');

//
// adminCP index
//
$lang['Calsnails_title'] = 'Calsnails';
$lang['1_Settings'] = 'Setari Generale';

//
// Configuration
//
$lang['Config_Calendar'] = 'Calendar Configuration';
$lang['Config_Calendar_explain'] = 'Set all the necessary variables for your calendar below';

$lang['week_start'] = 'Week start';
$lang['subject_length'] = 'Subject length';
$lang['subject_length_explain'] = 'Set the length of characters in an event subject(title) for the main month view<br><i>NB: For double-byte languages always select an even number of characters</i>';
$lang['cal_script_path_explain'] = 'NOT CURRENTLY IN USE';
$lang['allow_anon'] = 'Allow anonymous viewing';
$lang['allow_old'] = 'Allow old events';
$lang['allow_old_explain'] = 'Allow events to be posted for dates in the past';

$lang['show_headers'] = 'Show the phpBB2 header info';
$lang['cal_date_explain'] = "Only use if you wish to use a different format from the forum date format <a href='http://www.php.net/date' target='_other'>gmdate()</a>";

$lang['Cal_config_updated'] = 'Calendar Configuration Updated Sucessfully';
$lang['Cal_return_config'] = 'Click %sHere%s to return to Calendar Configuration';

$lang['no_public'] = 'No public access';
$lang['view_only'] = 'View only';
$lang['view_suggest'] = 'View,Suggest Events';
$lang['view_add'] = 'View,Add Events';
$lang['view_edit_own'] = 'View,Add (Edit/Delete own)';
$lang['cal_admin'] = 'Calendar Admin';

$lang['allow_user_post_default'] = 'Default access level for ALL registered users';
$lang['allow_anon_post_default'] = 'Default access level for ALL anonymous users';

//
// Block
//
$lang['Calendar_Where'] = 'SQL Where';
$lang['Calendar_Where_explain'] = 'Specify conditions to filter calendar events.<br />For instance: username = "xxxx" AND eventspan >= "yyyy-mm-dd hh:mm:ss"<br />Column Information: id (int), username (string), stamp (datetime in the form "yyyy-mm-dd hh:mm:ss"), subject (string), description (string), user_id (int), eventspan (date)';
$lang['Calendar_Order'] = 'SQL Order By';
$lang['Calendar_Order_explain'] = 'Specify the list of columns (comma separated) to use in ORDER BY clausule.<br />Note: Parameters WHERE and ORDER BY are used to dynamically build the SQL statement for this block. Please, verify the SQL syntax is correct.';

// -----------------------------------
// Block Parameter Specific
// -----------------------------------
$lang['Calendar_Block_Title'] = 'Block title';
$lang['Calendar_Block_Title_explain'] = 'This parameter allows you to override the default block title (you may use something meaningfull depending on the Range used).';
$lang['Calendar_Events_dateformat'] = 'Date Format';
$lang['Calendar_Events_dateformat_explain'] = "Only use if you wish to use a different format from the Calendar Lite date format (see <a href='http://www.php.net/date' target='_other'>gmdate()</a>)";

$lang['Calendar_Vertical_Size'] = 'Vertical Size (pixels)';
$lang['Calendar_Vertical_Size_explain'] = 'If you choose 0, the block height depends on the number of events, otherwise the size will be fixed and the block will be scrollable.';
$lang['Calendar_Text_Length'] = 'Text Length';
$lang['Calendar_Text_Length_explain'] = 'Specify the max. number of visible characters for the events text.';

$lang['Calendar_Events_Range'] = 'Range for Events';
$lang['Calendar_Events_Range_explain'] = 'Specify the range (or filter) to be applied to the displayed events.';
$lang['Calendar_Events_Prev'] = 'Days before range';
$lang['Calendar_Events_Prev_explain'] = 'Use this parameter to apply a negative offset to the range specified.';
$lang['Calendar_Events_Next'] = 'Days after range';
$lang['Calendar_Events_Next_explain'] = 'Use this parameter to apply a positive offset to the range specified.';

$lang['Mod_group'] = 'Calsnails Moderator Group';
$lang['Mod_group_explain'] = '- with Calsnails Admin permissions!';

$lang['auth_all']					= 'Default access level for ALL anonymous users';
$lang['auth_reg']					= 'Default access level for ALL registered users';
$lang['auth_reg_explain']			= 'NOTE: Block EDIT permissions also affect the CalSnails Block. EDIT users become CalSnails moderators...';
$lang['cal_filter']					= 'Event Filter: Show events added for this Block only';
$lang['cal_filter_explain']			= 'NOTE: FALSE, means show ALL calendar events...';
$lang['cal_hebrew']					= 'Hebrew Dates: Show some events added from the Hebrew Calendar';
$lang['cal_mod_group']				= 'CalSnails Moderator Group';

//Lang keys for  mx_calmoadim.php added in contrib
$lang['moad_nbr_display']				= 'Number of Topics to Query';
$lang['moad_def_days']				= 'Default number of days to display';
$lang['moad_display']				= 'Moad Display';
$lang['moad_display_sticky']				= 'Moad Sticky Topic Display';
$lang['moad_display_normal']				= 'Moad Normal Topic Display';
$lang['moad_display_global']				= 'Moad Global Topic Display';
$lang['moad_img']				= 'Event Image';
$lang['moad_img_sticky']				= 'Event Image Sticky';
$lang['moad_img_normal']				= 'Event Image Normal';
$lang['moad_img_global']				= 'Event Image Global';
$lang['moad_img_news']				= 'Event Image News';
$lang['moadim_forum_id']				= 'Select one or more Forums for Events Messages';
$lang['pesach_topic_id']				= 'Selected Forum topic_id for Pesach';
$lang['yom_teruah_topic_id']			= 'Selected Forum topic_id for Yom Teruah';
$lang['hanukkah_topic_id']				= 'Selected Forum topic_id for Kanukkah';
$lang['chag_yeshua_topic_id']			= 'Selected Forum topic_id for Chag Yeshua';

//
// That's all Folks!
// -------------------------------------------------
?>