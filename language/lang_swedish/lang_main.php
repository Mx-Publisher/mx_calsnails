<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: lang_main.php,v 1.5 2013/04/07 16:37:47 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
*
*/

$lang['Calendar'] = 'Kalender';

$lang['Cal_description'] = 'Beskrivning';
$lang['Cal_day'] = 'Startdatum';
$lang['Cal_hour'] = 'Tid';
$lang['End_day'] = 'Slutdatum';
$lang['End_time'] = 'Sluttid';
$lang['Cal_subject'] = 'Ämne';
$lang['Cal_add_event'] = 'Lägg till händelse';
$lang['Cal_submit_event'] = 'Bekräfta händelse';

$lang['Cal_event_not_add'] = 'Har inte lagt till händelse...';
$lang['Cal_event_delete'] = 'Händelse raderad';
$lang['Cal_Del_mod'] = 'Radera/Ändra';
$lang['Cal_mod_only'] = 'Ändra';
$lang['Cal_back2cal'] = 'Kalender Hem';
$lang['Cal_mod_marked'] = 'Ändra händelse';
$lang['Cal_del_marked'] = 'Radera händelse';
$lang['Cal_must_sel_event'] = 'Du mĺste välja en händelse.';
$lang['Cal_edit_own_event'] = 'Ledsen, du kan bara ändra dina egna händelser.';
$lang['Cal_delete_event'] = 'Ledsen, du har inte tillĺtelse att radera denna händelse.';
$lang['Cal_not_enough_access'] = 'Ledsen, ĺtkomst nekad';
$lang['Cal_must_member'] = 'Du mĺste vara aktoriserad för att ansluta och använda denna service';
$lang['Cal_alt_event'] = 'Aktuell:';
$lang['Validate'] = 'Godkänna händelse';
$lang['Cal_event_validated'] = 'Händelse(r) har blivit godkännd(a)/raderad(e)';
$lang['No events'] = 'För närvarande finns det inga händelser för detta datum';
$lang['No records'] = 'Inga händelser kräver godkännande';
$lang['No records modify'] = 'Inga händelser är tillgängliga att ändra';
$lang['No information'] = 'Otillräcklig information. Vänligen fyll i all relevant info';
$lang['Date before today'] = 'Ledsen, du kan inte bekräfta händelse för datum som redan varit';
$lang['Date before start'] = 'Ledsen, du kan inte bekräfta händelse som är slut innan de startat';
$lang['No date'] = 'Du mĺste välja ett start- och slutdatum';
$lang['No time'] = 'Du mĺste välja ett start- och slutdatum';

//
// New Version 2.0.0 Additions.
//
$lang['Cal_event_add'] = 'Händelse tilllagd/ändrad...';
$lang['Cal_add4valid'] = 'Händelse skickad för bekräftelse av en administratör';

$lang['allow_categories'] = 'Använd kategorier med händelser';
$lang['require_categories'] = 'Begär en kategori med händelser:';

$lang['No_cat_selected'] = 'Ingen kategori vald';
$lang['Edit_cat'] = 'Ändra kategori';
$lang['Cats_explain'] = 'Använd denna delen för att lägga till, redigera eller radera kategorier som du använder i din databas. <br><br><b>NB:</b> Vänligen notera om du raderar en kategori som har blivit vald för en händelse kommer inte datan raderas men kommer hindra användare frĺn att kunna filtrera eller visa raderade kategorier.';
$lang['Cats_title'] = 'Kategorikonfiguration';
$lang['Must_enter_cat'] = 'Du mĺste ange en kategori';
$lang['Cat_updated'] = 'Kategorin uppdaterad...';
$lang['Cat_added'] = 'Lagt till en kategori';
$lang['cat_removed'] = 'Kategorin borttagen...';
$lang['Add_new_cat'] = 'Lägg till en ny kategori';
$lang['Click_return_catadmin'] = 'Klicka %shär%s för att ĺtervända till kategoriadministrationen';
$lang['Must_enter_valid_cat'] = 'Du mĺste använda giltiga alpha-/sifferbokstäver';
$lang['Filter_cats_alt'] = 'Visa endast vald kategori';
$lang['Filter_cats'] = 'Visa endast...';
$lang['Month_jump'] = 'Hoppa till...';

$lang['Recur_apply_to'] = 'Lagt till ändringar till:';
$lang['Recur_future'] = 'Framtida händelser';
$lang['Recur_solo'] = 'Endst denna händelse';
$lang['Recur_all'] = 'Alla upprepningar';
$lang['Cal_repeats'] = 'Upprepas varje:';
$lang['until'] = 'Fram till';
$lang['Earliest recur before today'] = 'Ledsen, det tidigaste datumet i denna kan inte flyttas före idag.\n<BR> Problemhändelse pĺ: ';
$lang['day'] = 'dag(ar)';
$lang['month'] = 'mĺnad(er)';
$lang['year'] = 'ĺr';
$lang['Event_length'] = 'Varje händelse varar till:';
$lang['Recur_title'] = 'Tillval ĺterkommande info.';
$lang['Event_title'] = 'Händelseinfo.';
$lang['Event overlap'] = 'Ĺterkommande evenemang kan inte upprepas före initial händelse har slutat';
$lang['R_period too small'] = 'Perioden som är tillgänglig för ĺterkommande händelser är otillräcklig för vilka upprepningar';

$lang['Add notes'] = 'Lägg till tilläggsnoteringar för detta inlägg';
$lang['Add noted title'] = 'Lägg till noteringar';
$lang['Split solo'] = 'Dela till \'eget\' inlägg <i>(kommer inte längre uppdateras med relaterade händelser)</i>';
$lang['Split solo title'] = 'Dela till separat händelse';
$lang['Split future'] = 'Ändra alla händelseinlägg frĺn detta och famĺt';
$lang['Split future title'] = 'Ändra alla framtida händelser';
$lang['Edit all'] = 'Ändra alla relaterade händelseinlägg';
$land['Edit all title'] = 'Ändra alla relaterade händelser';
$lang['early_iteration'] = '(Tidigast upprepning efter dagens datum)';

$lang['global subject'] = 'Globalt Ämne';
$lang['global desc'] = 'Global händelseinfo';

$lang['Del future'] = 'Radera alla händelseinlägg frĺn detta och famĺt';
$lang['Del all'] = 'Radera alla relaterade händelseinlägg <i>(inkluderar inte delade inlägg)</i>';
$lang['Del this'] = 'Radera denna händelse';

$lang['Event_num'] = 'Händelsenummer:';
$lang['of'] = '<i>av</i>';

$lang['Additional info'] = 'Tilläggsinformation:';
$lang['Event specific'] = '(specifik till \'denna\' händelse):';

$lang['allow_user_post_default'] = 'Standard nivĺĺtkomst för ALLA registrerade användare';

$lang['no_public'] = 'Ingen publik ĺtkomst';
$lang['view_only'] = 'Visa endast';
$lang['view_suggest'] = 'Visa,föreslagna händelser';
$lang['view_add'] = 'Visa,Adderade händelser';
$lang['view_edit_own'] = 'Visa,lägg till (Redigera/Radera egna)';
$lang['cal_admin'] = 'Kalender Admin';

$lang['Invalid date'] = 'En eller bĺda av de datum du har skickat är ogiltig';
$lang['Empty subject'] = 'Du mĺste skriva i en rubrik för händelsen';
$lang['Empty description'] = 'Du mĺste skriva i en beskrivning för din händelse';
$lang['max'] = 'Maximalt:';
$lang['Return'] = 'Gĺ tillbaka: ';

$lang['View All'] = 'Visa Alla';
$lang['Calendar_Level'] = 'Kalendernivĺ';
$lang['Calendar_Categories'] = 'Kalenderkategorier';
$lang['Calendar Config'] = 'Kalenderkonfiguration';

$lang['days'] = 'dag(ar)';
$lang['weeks'] = 'vecka(or)';
$lang['months'] = 'mĺnad(er)';
$lang['years'] = 'ĺr';

$lang['view_year'] = 'Ĺrsöversikt';
$lang['view_month'] = 'Mĺnadsöversikt';
$lang['view_week'] = 'Veckoöversikt';
$lang['view_day'] = 'Dag-/evenemangöversikt';
$lang['view_list'] = 'Listöversikt';
$lang['view'] = 'Översikt';

$lang['Submitted_by'] = 'Skickad av';

$lang['No_modify_old'] = 'Ledsen, du kan inte redigera en gammalt händelse';
$lang['Cat_in_use'] = 'Denna kategori är länkad till existerande händelser och kan inte raderas';

//
// DEV lang 2.0.25
//
$lang['require_time'] = 'Kräver start/slut tider för att skrivas in i nya händelser';
$lang['allow_private_event'] = 'Tillĺt registrerade användare att lägga till privata händelser';
$lang['allow_group_event'] = 'Tillĺt registrerade användare begränsa händelser till deras egna grupper';

$lang['event_access'] = 'Händelseĺtkomst:';
$lang['private_event'] = 'Privat/Personlig';
$lang['public_event'] = 'Publik';
$lang['ug_event'] = 'Begränsad till användargrupp(er)';
$lang['group_select'] = 'Tillĺtna användargrupper: <br /><i>(om tillämpbart)</i>';

$lang['group_event_explain'] = '<span class="genmed"><i>(Hĺll CTRL tangenten intryckt samtidigt som du väljer grupper med musen för att välja mer än en grupp)</i></span>';
$lang['No_private_events'] = 'Du har inte tillĺtelse att lägga till privata händelser';
$lang['time_format'] = 'Tidformat';

//
// DEV lang 2.0.31
//
$lang['c_first'] = '1:a';
$lang['c_second'] = '2:a';
$lang['c_third'] = '3:e';
$lang['c_fourth'] = '4:e';
$lang['OR_every'] = 'ELLER varje:';

//$lang['datetime']['May'] = 'May';

//
// Added for MX-Publisher Portal module mx_calsnails
//
$lang['Events'] = 'Händelser';
$lang['allow_anon_post_default'] = 'Standardĺtkomstnivĺ för ALLA anonyma användare';

$lang['Calendar_Events'] = 'Kalenderhändelse';
$lang['More_Info'] = 'Läs vidare...';
$lang['To_End_Date'] = 'Till:';

//
// For Cal Events top label
//
$lang['Ev_this_day'] = 'Idag';
$lang['Ev_this_week'] = 'Vecka ';
$lang['Ev_next_week'] = 'Nästa vecka, ';
$lang['Ev_this_month'] = 'Mĺnad ';
$lang['Ev_next_month'] = 'Nästa mĺnad ';

//
// For HebCal Months and Events
//
$lang['Yom'] = 'Yom'; //"Yom ":"יום "
$lang['Rishon'] = 'Rishon'; //"ראשון","Rishon"
$lang['Sheni'] = 'Sheni'; //"שני","Sheni"
$lang['Shlishi'] = 'Shlishi'; //"שלישי","Shlishi"
$lang['Revi\'i'] = 'Revi\'i'; //"רבעי","Revi'i"
$lang['Chamishi'] = 'Chamishi'; //"חמישי","Chamishi"
$lang['Shishi'] = 'Shishi'; //"ששי","Shishi"
$lang['Shabbat'] = 'Shabbat'; //"שבת","Shabbat"

$lang['Tishrei'] = 'Tishrei'; //"תשרי","Tishrei"
$lang['Heshvan'] = 'Heshvan'; //"חשון","Cheshvan"
$lang['Kislev'] = 'Kislev'; //"כסלו","Kislev"
$lang['Tevet'] = 'Tevet'; //"טבת","Tevet"
$lang['Shevat'] = 'Shevat'; //"שבט","Shevat"
$lang['Adar'] = 'Adar'; //"אדר","Adar"
$lang['Adar II'] = 'Adar II'; //"אדר ב","Adar Bet"
$lang['Nisan'] = 'Nisan'; //"ניסן","Nissan"
$lang['Iyar'] = 'Iyar'; //"אייר","Iyar"
$lang['Sivan'] = 'Sivan'; //"סיון","Sivan"
$lang['Tamuz'] = 'Tamuz'; //"תמוז","Tammuz"
$lang['Av'] = 'Av'; //"אב","Av"
$lang['Elul'] = 'Elul'; //"אלול","Elul"
?>