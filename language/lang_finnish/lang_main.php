<?php
/*********************************************
*	Calendar Language Pack
*
*	Language:      Finnish
*	Last Updated:  $Date: 2005/03/03 23:08:21 $
*	Revision No.:  $Revision: 1.0 $
*   Translated by: Taajuus (taajuus@hotmail.com)
*********************************************/


// Version 2.0.1 (needs translating for other language versions!)
// Calendar Addon MOD Language fields

$lang['Calendar'] = "Kalenteri";

$lang['Cal_description'] = "Kuvaus";
$lang['Cal_day'] = "Alkamispäivämäärä";
$lang['Cal_hour'] = "Aika";
$lang['End_day'] = "Loppumispäivämäärä";
$lang['End_time'] = "Loppumisaika";
$lang['Cal_subject'] = "Aihe";
$lang['Cal_add_event'] = "Lisää tapahtuma";
$lang['Cal_submit_event'] = "Lähetä tapahtuma";

$lang['Cal_event_not_add'] = "Tapahtumaa ei lisätty...";
$lang['Cal_event_delete'] = "Tapahtuma poistettu";
$lang['Cal_Del_mod'] = "Poista / Muokkaa";
$lang['Cal_mod_only'] = "Muokkaa";
$lang['Cal_back2cal'] = "Kalenteriin";
$lang['Cal_mod_marked'] = "Muokkaa tapahtumaa";
$lang['Cal_del_marked'] = "Poista tapahtuma";
$lang['Cal_must_sel_event'] = "Valitse ensin tapahtuma.";
$lang['Cal_edit_own_event'] = "Voit muokata vain omia tapahtumiasi.";
$lang['Cal_delete_event'] = "Sinulla ei ole oikeutta poistaa tätä tapahtumaa.";
$lang['Cal_not_enough_access'] = "404 - Access Denied";
$lang['Cal_must_member'] = "Sinun täytyy olla jäsen voidaksesi käyttää tätä osiota";
$lang['Cal_alt_event'] = "Nykyinen :";
$lang['Validate'] = "Hyväksy tapahtumia";
$lang['Cal_event_validated'] = "Tapahtuma(t) hyväksytty/poistettu";
$lang['No events'] = "Ei tapahtumia";
$lang['No records'] = "Ei tapahtumia odottamassa hyväksymistä";
$lang['No records modify'] = "Ei tapahtumia joita muokata";
$lang['No information'] = "Riittämättömät tiedot. Täytä tarvittavat tiedotInsufficient information.";
$lang['Date before today'] = "Et voi lisätä tapahtumia menneistä ajankohdista";
$lang['Date before start'] = "Et voi lisätä tapahtmia jotka päättyvät ennen alkamistaan";
$lang['No date'] = "Sinun on määriteltävä alkamis ja päättymisajankohta";
$lang['No time'] = "Sinun on määriteltävä alkamis ja päättymisajankohta";


// New Version 2.0.0 Additions.
$lang['Config_Calendar'] = "Kalenterin Hallinta";
$lang['Config_Calendar_explain'] = "Aseta tarvittavat muuttujat kalenteriisi";
$lang['Cal_event_add'] = "Tapahtuma Lisätty/Poistettu...";
$lang['Cal_add4valid'] = "Tapahtuma lisätty ja odottaa adminin hyväksyntää";

$lang['week_start'] = "Viikko alkaa";
$lang['subject_length'] = "Aiheen pituus";
$lang['subject_length_explain'] = "Aseta maksimi merkkien pituus tapahtuman aiheessa<br><i>NB: For double-byte languages always select an even number of characters</i>";
$lang['cal_script_path_explain'] = "NOT CURRENTLY IN USE";
$lang['allow_anon'] = "Salli nimettömänä katselu";
$lang['allow_old'] = "Salli vanhat tapahtumat";
$lang['allow_old_explain'] = "Salli vanhojen tapahtumien lisääminen";

$lang['show_headers'] = "Näytä phpBB2 header info";
$lang['cal_date_explain'] = "Only use if you wish to use a different format from the forum date format <a href='http://www.php.net/date' target='_other'>date()</a>";
$lang['category'] = "Kategoria";

$lang['Cal_config_updated'] = "Kalenterin asetukset tallennettu onnistuneesti";
$lang['Cal_return_config'] = 'Klikkaa %stästä%s palataksesi kalenterin asetuksiin';
$lang['allow_categories'] = "Käytä kategorioita tapahtumissa:";
$lang['require_categories'] = "Vaadi kategoriat tapahtumissa:";

$lang['No_cat_selected'] = "Ei kategoriaa valittuna";
$lang['Edit_cat'] = "Muokkaa kategoriaa";
$lang['Cats_explain'] = "Use this section to add, edit or delete the categories you use on your database. <br><br><b>NB:</b> Please note that if you delete a category that has been selected for an event it will not delete those records but it will stop users from being able to filter and view a deleted category.";
$lang['Cats_title'] = "Category Admin";
$lang['Must_enter_cat'] = "Sinun on annettava kategoria";
$lang['Cat_updated'] = "Kategoria päivitetty";
$lang['Cat_added'] = "Kategoria lisätty";
$lang['cat_removed'] = "Kategoria poistettu";
$lang['Add_new_cat'] = "Lisää uusi kategoria";
$lang['Click_return_catadmin'] = 'Klikkaa %stästä%s palataksesi Kategorian Hallintaan';
$lang['Must_enter_valid_cat'] = "Sinun on käytettävä hyväksyttyjä merkkejä";
$lang['Filter_cats_alt'] = "Näytä vain valitut kategoriat";
$lang['Filter_cats'] = "Näytä vain...";
$lang['Month_jump'] = "Hyppää...";

$lang['Recur_apply_to'] = "Muutokset vaikuttavat:";
$lang['Recur_future'] = "Tulevat tapahtumat";
$lang['Recur_solo'] = "Vain tämä tapahtum";
$lang['Recur_all'] = "Kaikki";
$lang['Cal_repeats'] = "Toista joka:";
$lang['until'] = "kunnes";
$lang['Earliest recur before today'] = "Sorry, the earliest date in this set cannot be moved before today.\n<BR> Problem event on: ";
$lang['day'] = "päivä(iä)";
$lang['month'] = "kuukausi(a)";
$lang['year'] = "vuosi(a)";
$lang['Event_length'] = "Jokainen tapahtuma kestää:";
$lang['Recur_title'] = "Lisätietoja.";
$lang['Event_title'] = "Tapahtumatietoja.";
$lang['Event overlap'] = "Recurring events cannot repeat before the initial event has ended";
$lang['R_period too small'] = "The period available for recurring events is insufficient for any repeats";

$lang['Add notes'] = "Lisää ylimääräisiä kommentteja tähän merkintään";
$lang['Add noted title'] = "Lisää Merkintöjä";
$lang['Split solo'] = "Split into 'stand-alone' entry <i>(will no longer update with related events)</i>";
$lang['Split solo title'] = "Split to seperate event";
$lang['Split future'] = "Change all event entries from this point forward";
$lang['Split future title'] = "Change all future events";
$lang['Edit all'] = "Change all related event entries";
$land['Edit all title'] = "Change all related events";
$lang['early_iteration'] = "(Earliest repetition after todays date)";

$lang['global subject'] = "Global subject";
$lang['global desc'] = "Global event info";

$lang['Del future'] = "Delete all events from this point forward";
$lang['Del all'] = "Delete all related event entries <i>(not including split entries)</i>";
$lang['Del this'] = "Delete this single event";

$lang['Event_num'] = "Event number:";
$lang['of'] = "<i>of</i>";

$lang['Additional info'] = "Additional information:";
$lang['Event specific'] = "(specific to 'this' event):";

$lang['allow_user_post_default'] = "Default access level for ALL registered users";

$lang['no_public'] = 'No public access';
$lang['view_only'] = 'View only';
$lang['view_suggest'] = 'View,Suggest Events';
$lang['view_add'] = 'View,Add Events';
$lang['view_edit_own'] = 'View,Add (Edit/Delete own)';
$lang['cal_admin'] = 'Calendar Admin';

$lang['Invalid date'] = "One or both of the dates you have submitted is invalid";
$lang['Empty subject'] = "You must enter a subject for your event";
$lang['Empty description'] = "You must enter a description for your event";
$lang['max'] = "Maximum:";
$lang['Return'] = "Go back to: ";

$lang['View All'] = "Näytä Kaikki";
$lang['Calendar_Level'] = "Kalenteritaso";
$lang['Calendar_Categories'] = "Kalenterikategoriat";
$lang['Calendar Config'] = "Kalenterin Asetukset";

$lang['days'] = "päivä(ä)";
$lang['weeks'] = "viikko(a)";
$lang['months'] = "kuukausi(a)";
$lang['years'] = "vuosi(a)";

$lang['view_year'] = "Vuosinäkymä";
$lang['view_month'] = "Kuukausinäkymä";
$lang['view_week'] = "Viikkonäkymä";
$lang['view_day'] = "Päivä/Tapahtumanäkymä";
$lang['view_list'] = "Listaa Näkymä";
$lang['view'] = "Näytä";

$lang['Submitted_by'] = 'Lisääjä';

$lang['No_modify_old'] = "Et voi muokata mennyttä tapahtumaa";
$lang['Cat_in_use'] = "Tämä kategoria on linkitetty olemassaoleviin tapahtumiin, eikä sitä voida poistaa";

// DEV lang 2.0.25

$lang['require_time'] = "Require start/end times to be entered with new events";
$lang['allow_private_event'] = "Allow registered users to add private events";
$lang['allow_group_event'] = "Allow registered users to limit events to their own groups";

$lang['event_access'] = "Event Access:";
$lang['private_event'] = "Private/Personal";
$lang['public_event'] = "Public";
$lang['ug_event'] = "Restricted to Usergroup(s)";
$lang['group_select'] = "Allowed Usergroups: <br /><i>(if applicable)</i>";

$lang['group_event_explain'] = "<span class='genmed'><i>(Hold CTRL key and select groups with mouse to select more than one group)</i></span>";
$lang['No_private_events'] = "You are not permitted to add private events";
$lang['time_format'] = "Time Format";

// DEV lang 2.0.31

$lang['c_first'] = '1st';
$lang['c_second'] = '2nd';
$lang['c_third'] = '3rd';
$lang['c_fourth'] = '4th';
$lang['OR_every'] = 'OR every:';

//
// Added for MX-System module mx_calsnails (basically because 'May' in phpBB is rewritten by 3 letter month)
//

//$lang['datetime']['May'] = 'May';

//
// Added for MX-System module mx_calsnails
//

$lang['Events'] = 'Tapahtumat';
$lang['allow_anon_post_default'] = "Default access level for ALL anonymous users";

$lang['Calendar_Events'] = "Tapahtumakalenteri";
$lang['More_Info'] = 'Näytä Lisää...';
$lang['To_End_Date'] = 'To:';




//
// For Cal Events top label
//
$lang['Ev_this_day'] = 'Today';
$lang['Ev_this_week'] = 'This Week, ';
$lang['Ev_next_week'] = 'Next week, ';
$lang['Ev_this_month'] = 'This month ';
$lang['Ev_next_month'] = 'Next month ';

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

// The English spelling for the holidays I took from "Jewish Calendar for Linux" by Refoyl Finkl.
// Nisan
$lang['Rosh Kodeshim'] 		=		'Rosh Kodeshim'; //'ראש חודשים';
$lang['Yom haSher'] 			=		'Yom haSher'; //'יום השׂר';
$lang['Taanit Bechorim'] =	'Taonit Bechorim (Fast FirstBorn)'; //תַעֲנִית בְּכֹ֣ורים
$lang['Erev Pesakh'] 				=		'Erev Pesakh'; //'ערב פסח';
$lang['Pesakh'] 					=		'Pesakh'; //'פסח';
$lang['Pesakh II (Diaspora)']		=	'Pesakh II (Diaspora)'; //'שני של פסח (גולה)';
$lang['Khol HaMoed Pesakh']	=	'Khol HaMoed Pesakh'; //'חול המועד פסח'; 
$lang['Pesakh VII']					=	'Pesakh VII'; //'שביעי של פסח';
$lang['Pesakh VIII (Diaspora)']	=	'Pesakh VIII (Diaspora)';	//'שמיני של פסח (גולה)';
$lang['Isru Khag Pesakh']			=	'Isru Khag Pesakh'; //'אסרו חג';
$lang['Yom HaBikurei']				=	'</br>Yom Omer rishon Chatzir (Day First Omer Ripped)'; //'בְּיֹוםבִּכּוּרִ';
$lang['Sefirat HaOmer']			=	'Sefirat HaOmer'; //'ספירת העומר';
$lang['Yom HaShoa'] 	=	 'Yom HaShoa'; //'יום השואה';
// Iyar
$lang['Yom HaZikaron'] 	=	 'Yom HaZikaron'; //'יום הזכרון';
$lang['Yom HaAtsmaut'] 	=	 'Yom HaAtsmaut'; //'יום העצמאות';
$lang['Lag BaOmer'] 	=	 'Lag BaOmer'; //'ל"ג לעומר';

$lang['Yom HaAliyah']	=	 'Yom HaAliyah'; //'יום העלייה';
$lang['Yom Yerushalayim'] =	'Yom Yerushalayim'; //'יום ירושלים';

// Sivan
$lang['Erev Shavuot Parashim'] 	=	'Erev Shavuot Parashim'; //'ערב שבועות';
$lang['Shavuot Parashim'] 	=	'Shavuot Parashim'; //'שבועות';
$lang['Shavuot II Parashim (Diaspora)'] 	= 'Shavuot II Parashim (Diaspora)'; //'שבועות ב\' (גולה)';
$lang['Isru Khag Shavuot Parashim'] 	= 'Isru Khag Shavuot Parashim'; //'אסרו חג';


$lang['Erev Shavuot'] 	=	'Erev Shavuot'; //'ערב שבועות';
$lang['Shavuot'] 	=	'Shavuot'; //'שבועות';
$lang['Shavuot II (Diaspora)'] 	= 'Shavuot II (Diaspora)'; //'שבועות ב\' (גולה)';
$lang['Isru Khag Shavuot'] 	= 'Isru Khag Shavuot'; //'אסרו חג';
// Tamuz
$lang['Tsom Tamuz']	=		'Tsom Tamuz'; //'צום תמוז';
// Av
$lang['Tisha BeAv'] =	 'Tisha BeAv'; //'תשעה באב';
// Tishrei
$lang['Erev Rosh HaShana'] 		= 'Erev Rosh HaShana'; //'ערב ראש השנה';
$lang['Rosh HaShana I'] 			= 'Rosh HaShana I'; //'א\' ראש השנה';
$lang['Rosh HaShana II'] 			= 'Rosh HaShana II'; //'ב\' ראש השנה';
$lang['Tsom Gedalya'] 				= 'Tsom Gedalya'; //'צום גדליה';
$lang['Erev Yom Kippur'] 			= 'Erev Yom Kippur'; //'ערב יום הכיפורים';
$lang['Yom Kippur'] 					= 'Yom Kippur'; //'יום הכיפורים';
$lang['Erev Sukkot'] 					= 'Erev Sukkot'; //'ערב סוכות';
$lang['Sukkot'] 						= 'Sukkot'; //'סוכות';
$lang['Sukkot II (Diaspora)']		= 'Sukkot II (Diaspora)'; //'סוכות ב\' (גולה)';
$lang['Khol HaMoed Sukkot']	= 'Khol HaMoed Sukkot'; //'חול המועד סוכות';
$lang['Hoshana Rabba']			= 'Hoshana Rabba'; //'הושענא רבה';
$lang['Shemini Atseret']			= 'Shemini Atseret'; //'שמיני עצרת';
$lang['Simkhat Tora']				= 'Simkhat Tora'; //'שמחת תורה';
$lang['Isru Khag Sukkot']			= 'Isru Khag Sukkot'; //'אסרו חג';
// Kislev / Tevet
$lang['Khanukka I'] = 		'Khanukka I'; //'א\' חנוכה';
$lang['Khanukka II'] = 		'Khanukka II'; //'ב\' חנוכה';
$lang['Khanukka III'] = 	'Khanukka III'; //'ג\' חנוכה';
$lang['Khanukka IV'] = 	'Khanukka IV'; //'ד\' חנוכה';
$lang['Khanukka V'] = 		'Khanukka V'; //'ה\' חנוכה';
$lang['Khanukka VI'] = 	'Khanukka VI'; //'ו\' חנוכה';
$lang['Khanukka VII'] = 	'Khanukka VII'; //'ז\' חנוכה';
$lang['Khanukka VIII'] = 	'Khanukka VIII'; //'ח\' חנוכה';
// Tevet
$lang['Tsom Tevet'] =					'Tsom Tevet'; //'צום טבת';
// Shevat
$lang['Tu BiShevat'] =					'Tu BiShevat'; //'ט\'ו בשבט';
// Adar
$lang['Taanit Esther'] = 				'Taanit Esther'; //'תענית אסתר';
$lang['Purim'] =							'Purim'; //'פורים';
$lang['Shushan Purim'] =				'Shushan Purim'; //'שושן פורים';
$lang['Erev Rosh Kodeshim'] =		'Erev Rosh Kodeshim'; //'ראש חודשים ערב';

// That's all Folks!
// -------------------------------------------------
?>