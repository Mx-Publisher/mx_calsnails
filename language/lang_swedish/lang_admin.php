<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: lang_admin.php,v 1.5 2014/04/09 08:54:33 orynider Exp $
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
$lang['Calsnails_title'] = 'Kalender';
$lang['1_Settings'] = 'Inställningar';

//
// Configuration
//
$lang['Config_Calendar'] = 'Kalenderkonfiguration';
$lang['Config_Calendar_explain'] = 'Göt alla inställningar för din kalender nedan';

$lang['week_start'] = 'Veckostart';
$lang['subject_length'] = 'Ämneslängd';
$lang['subject_length_explain'] = 'Ställ in längden av bokstäver i ett händelseämne(titel) för huvudmĺnadsvisning<br><i>Notera: För dubbelbyte-sprĺk, välj alltid ett jämnt antal bokstäver</i>';
$lang['cal_script_path_explain'] = 'Ingen aktuell är använd';
$lang['allow_anon'] = 'Tillĺt anonym visning';
$lang['allow_old'] = 'Tillĺt gamla händelser';
$lang['allow_old_explain'] = 'Tillĺt att posta händelser för datum som varit';

$lang['show_headers'] = 'Visa phpBB2 huvudinfo';
$lang['cal_date_explain'] = "Använd endast om du önskar använda ett annat format frĺn forum datumformat <a href='http://www.php.net/date' target='_other'>date()</a>";
$lang['category'] = 'Kategori';

$lang['Cal_config_updated'] = 'Kalenderkonfiguration uppdaterades...';
$lang['Cal_return_config'] = 'Klicka %shär%s för att ĺtervända till kalenderkonfigurationen';

$lang['no_public'] = 'Ingen publik ĺtkomst';
$lang['view_only'] = 'Visa endast';
$lang['view_suggest'] = 'Visa,föreslagna händelser';
$lang['view_add'] = 'Visa,Adderade händelser';
$lang['view_edit_own'] = 'Visa,lägg till (Redigera/Radera egna)';
$lang['cal_admin'] = 'Kalender Admin';

$lang['allow_user_post_default'] = 'Standard nivĺĺtkomst för ALLA registrerade användare';
$lang['allow_anon_post_default'] = 'Standardĺtkomstnivĺ för ALLA anonyma användare';

//
// Blocks
//
$lang['Calendar_Where'] = 'SQL var';
$lang['Calendar_Where_explain'] = 'Specificera villkoren för att filtrera kalenderhändelser.<br />Till exempel: användarnamn = "xxxx" OCH händelseräckvidd >= "yyyy-mm-dd hh:mm:ss"<br />Kolumninformation: id (int), username (string), stamp (datetime in the form "yyyy-mm-dd hh:mm:ss"), subject (string), description (string), user_id (int), eventspan (date)';
$lang['Calendar_Order'] = 'SQL sortera efter';
$lang['Calendar_Order_explain'] = 'Specificera lista med kolumner (komma-separerade) för att användas sorterat efter klausul.<br />Notera: Parametrar VAR och SORTERAT EFTER är använda för att dynamiskt bygga SQL framställning för detta block. Vänligen, verifiera att SQL syntaxen är korrekt.';

// -----------------------------------
// Block Parameter Specific
// -----------------------------------

$lang['Calendar_Block_Title'] = 'Blocktitel';
$lang['Calendar_Block_Title_explain'] = 'Denna parameter tillĺter dig att ĺsidosätta standardblocktiteln (du kan använda nĺgot meningsfullt beroende pĺ vilket omrĺde som används).';
$lang['Calendar_Events_dateformat'] = 'Datumformat';
$lang['Calendar_Events_dateformat_explain'] = "Använd endast om du önskar använda ett annat format frĺn Calendar Lite datumformat (se <a href='http://www.php.net/date' target='_other'>date()</a>)";

$lang['Calendar_Vertical_Size'] = 'Vertikal storlek (pixels)';
$lang['Calendar_Vertical_Size_explain'] = 'Om du väljer 0, beror blockhöjden pĺ antalet händelser, annars kommer storleken vara fast och blocket blir scrollbart.';
$lang['Calendar_Text_Length'] = 'Textlängd';
$lang['Calendar_Text_Length_explain'] = 'Specificera max antal bokstäver för händelsetext.';

$lang['Calendar_Events_Range'] = 'Intervall för händelse';
$lang['Calendar_Events_Range_explain'] = 'Specificera intervall (eller filtrera) för visade händelser.';
$lang['Calendar_Events_Prev'] = 'Dagar före intervallet';
$lang['Calendar_Events_Prev_explain'] = 'Använd denna parameter för att tillämpa en negativ sidogren till intervallet.';
$lang['Calendar_Events_Next'] = 'Dagar efter intervallet';
$lang['Calendar_Events_Next_explain'] = 'Använd denna parameter för att tillämpa en positiv sidogren till intervallet.';

$lang['Mod_group'] = 'Calsnails Moderatorgrupp';
$lang['Mod_group_explain'] = '- med adminrättigheter!';

$lang['auth_all']          			= 'Standardrättigheter för alla gäster';
$lang['auth_reg']          			= 'Standardrättigheter för alla registrerade användare';
$lang['auth_reg_explain']			= 'NOTE: Block EDIT permissions also affect the CalSnails Block. EDIT users become CalSnails moderators...';
$lang['cal_filter']         		= 'Händelsefilter: visa bara händelser associerade med detta block';
$lang['cal_filter_explain']         = 'Notera: FALSE, betyder att alla händelser visas...';
$lang['cal_hebrew']					= 'Hebrew Dates: Show some events added from the Hebrew Calendar';
$lang['cal_mod_group']       		= 'Calsnails moderatorgrupp';

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
