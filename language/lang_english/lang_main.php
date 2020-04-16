<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: lang_main.php,v 1.12 2013/04/07 16:37:47 orynider Exp $
* @copyright (c) 2002-2006 [Martin, Markus, Jon Ohlsson] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://www.MX-Publisher.com
*
*/

// 
// The format of this file is: 
// 
// ---> $lang["message"] = "text"; 
// 
// Specify your language character encoding... [optional]
// 
// setlocale(LC_ALL, "en");

@setlocale(LC_ALL, "ro");
$lang['Calendar'] = 'Calendar';

$lang['Cal_description'] = 'Description';
$lang['Cal_day'] = 'Start Date';
$lang['Cal_hour'] = 'Time';
$lang['End_day'] = 'End Date';
$lang['End_time'] = 'End Time';
$lang['Cal_subject'] = 'Subject';
$lang['Cal_add_event'] = 'Add event';
$lang['Cal_submit_event'] = 'Submit event';

$lang['Cal_event_not_add'] = 'Event not added...';
$lang['Cal_event_delete'] = 'Event Deleted';
$lang['Cal_Del_mod'] = 'Delete / Modify';
$lang['Cal_mod_only'] = 'Modify';
$lang['Cal_back2cal'] = 'Calendar Home';
$lang['Cal_mod_marked'] = 'Modify event';
$lang['Cal_del_marked'] = 'Delete event';
$lang['Cal_must_sel_event'] = 'You must select an event.';
$lang['Cal_edit_own_event'] = 'Sorry, you can only modify your own events.';
$lang['Cal_delete_event'] = 'Sorry, you don\'t have permission to delete this event.';
$lang['Cal_not_enough_access'] = 'Sorry, Access Denied';
$lang['Cal_must_member'] = 'You must be authorised to connect and use this service';
$lang['Cal_alt_event'] = 'Current :';
$lang['Validate'] = 'Validate Events';
$lang['Cal_event_validated'] = 'Event(s) have been Validated/Deleted as specified';
$lang['No events'] = 'Currently there are no events for this date';
$lang['No records'] = 'No events require validation';
$lang['No records modify'] = 'No events available to modify';
$lang['No information'] = 'Insufficient information. Please fill out all the relevant info';
$lang['Date before today'] = 'Sorry, you cannot submit events for dates that have already passed';
$lang['Date before start'] = 'Sorry, you cannot submit events that finish before they start';
$lang['No date'] = 'You must select a start and end date';
$lang['No time'] = 'You must select a start and end time';

//
// New Version 2.0.0 Additions.
//
$lang['Cal_event_add'] = 'Event Added/Modified...';
$lang['Cal_add4valid'] = 'Event submitted for validation by an Administrator';

$lang['category'] = 'Category';

$lang['allow_categories'] = 'Use categories with events';
$lang['require_categories'] = 'Require a category with events:';

$lang['No_cat_selected'] = 'No category selected';
$lang['Edit_cat'] = 'Edit Category';
$lang['Cats_explain'] = 'Use this section to add, edit or delete the categories you use on your database. <br><br><b>NB:</b> Please note that if you delete a category that has been selected for an event it will not delete those records but it will stop users from being able to filter and view a deleted category.';
$lang['Cats_title'] = 'Category Admin';
$lang['Must_enter_cat'] = 'You must enter a category';
$lang['Cat_updated'] = 'Category Updated';
$lang['Cat_added'] = 'Category Added';
$lang['cat_removed'] = 'Category Removed';
$lang['Add_new_cat'] = 'Add new category';
$lang['Click_return_catadmin'] = 'Click %sHere%s to return to Category Administration';
$lang['Must_enter_valid_cat'] = 'You must use valid alpha/numeric characters';
$lang['Filter_cats_alt'] = 'Show selected category only';
$lang['Filter_cats'] = 'View only...';
$lang['Month_jump'] = 'Jump to...';

$lang['Recur_apply_to'] = 'Changes apply to:';
$lang['Recur_future'] = 'Future events';
$lang['Recur_solo'] = 'This event only';
$lang['Recur_all'] = 'All recurrences';
$lang['Cal_repeats'] = 'Repeats every:';
$lang['until'] = 'until';
$lang['Earliest recur before today'] = 'Sorry, the earliest date in this set cannot be moved before today.\n<BR> Problem event on: ';
$lang['day'] = 'day(s)';
$lang['month'] = 'month(s)';
$lang['year'] = 'year(s)';
$lang['Event_length'] = 'Each event lasts:';
$lang['Recur_title'] = 'Optional Recurring Info.';
$lang['Event_title'] = 'Event Info.';
$lang['Event overlap'] = 'Recurring events cannot repeat before the initial event has ended';
$lang['R_period too small'] = 'The period available for recurring events is insufficient for any repeats';

$lang['Add notes'] = 'Add additional notes to this entry';
$lang['Add noted title'] = 'Add Notes';
$lang['Split solo'] = 'Split into \'stand-alone\' entry <i>(will no longer update with related events)</i>';
$lang['Split solo title'] = 'Split to seperate event';
$lang['Split future'] = 'Change all event entries from this point forward';
$lang['Split future title'] = 'Change all future events';
$lang['Edit all'] = 'Change all related event entries';
$land['Edit all title'] = 'Change all related events';
$lang['early_iteration'] = '(Earliest repetition after todays date)';

$lang['global subject'] = 'Global subject';
$lang['global desc'] = 'Global event info';

$lang['Del future'] = 'Delete all events from this point forward';
$lang['Del all'] = 'Delete all related event entries <i>(not including split entries)</i>';
$lang['Del this'] = 'Delete this single event';

$lang['Event_num'] = 'Event number:';
$lang['of'] = '<i>of</i>';

$lang['Additional info'] = 'Additional information:';
$lang['Event specific'] = '(specific to \'this\' event):';

$lang['allow_user_post_default'] = 'Default access level for ALL registered users';

$lang['no_public'] = 'No public access';
$lang['view_only'] = 'View only';
$lang['view_suggest'] = 'View,Suggest Events';
$lang['view_add'] = 'View,Add Events';
$lang['view_edit_own'] = 'View,Add (Edit/Delete own)';
$lang['cal_admin'] = 'Calendar Admin';

$lang['Invalid date'] = 'One or both of the dates you have submitted is invalid';
$lang['Empty subject'] = 'You must enter a subject for your event';
$lang['Empty description'] = 'You must enter a description for your event';
$lang['max'] = 'Maximum:';
$lang['Return'] = 'Go back to: ';

$lang['View All'] = 'View All';
$lang['Calendar_Level'] = 'Calendar Level';
$lang['Calendar_Categories'] = 'Calendar Categories';
$lang['Calendar Config'] = 'Calendar Config';

$lang['days'] = 'day(s)';
$lang['weeks'] = 'week(s)';
$lang['months'] = 'month(s)';
$lang['years'] = 'year(s)';

$lang['view_year'] = 'Year View';
$lang['view_month'] = 'Month View';
$lang['view_week'] = 'Week View';
$lang['view_day'] = 'Day/Event View';
$lang['view_list'] = 'List View';
$lang['view'] = 'View';

$lang['Submitted_by'] = 'Submitted by';

$lang['No_modify_old'] = 'Sorry, you can\'t edit an old event';
$lang['Cat_in_use'] = 'This category is linked to existing events and cannot be deleted';

//
// DEV lang 2.0.25
//
$lang['require_time'] = 'Require start/end times to be entered with new events';
$lang['allow_private_event'] = 'Allow registered users to add private events';
$lang['allow_group_event'] = 'Allow registered users to limit events to their own groups';

$lang['event_access'] = 'Event Access:';
$lang['private_event'] = 'Private/Personal';
$lang['public_event'] = 'Public';
$lang['ug_event'] = 'Restricted to Usergroup(s)';
$lang['group_select'] = 'Allowed Usergroups: <br /><i>(if applicable)</i>';

$lang['group_event_explain'] = '<span class="genmed"><i>(Hold CTRL key and select groups with mouse to select more than one group)</i></span>';
$lang['No_private_events'] = 'You are not permitted to add private events';
$lang['time_format'] = 'Time Format';

//
// DEV lang 2.0.31
//
$lang['c_first'] = '1st';
$lang['c_second'] = '2nd';
$lang['c_third'] = '3rd';
$lang['c_fourth'] = '4th';
$lang['OR_every'] = 'OR every:';

//$lang['datetime']['May'] = 'May';

//
// Added for MX-Publisher Portal module mx_calsnails
//
$lang['Events'] = 'Events';
$lang['allow_anon_post_default'] = 'Default access level for ALL anonymous users';

$lang['Calendar_Events'] = 'Calendar of Events';
$lang['More_Info'] = 'More Information ...';
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
