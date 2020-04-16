<?php
/**
*
* @package MX-Publisher Module - mx_calsnails
* @version $Id: lang_main.php,v 1.5 2013/04/07 16:37:47 orynider Exp $
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
$lang['Calendar'] = "Calendar"; 

$lang['Cal_description'] = "Descriere"; 
$lang['Cal_day'] = "Data de început "; 
$lang['Cal_hour'] = "Ora"; 
$lang['End_day'] = "Data de sfârşit "; 
$lang['End_time'] = "Sfarsit de timp "; 
$lang['Cal_subject'] = "Subiect"; 
$lang['Cal_add_event'] = "Adăugare eveniment"; 
$lang['Cal_submit_event'] = "Trimiteti un eveniment "; 

$lang['Cal_event_not_add'] = "Eveniment ne-adăugat ..."; 
$lang['Cal_event_delete'] = "Eveniment şters "; 
$lang['Cal_Del_mod'] = "Ştergere / Modificare "; 
$lang['Cal_mod_only'] = "Modifica"; 
$lang['Cal_back2cal'] = "Index Calendar"; 
$lang['Cal_mod_marked'] = "Modificare eveniment"; 
$lang['Cal_del_marked'] = "Ştergere eveniment"; 
$lang['Cal_must_sel_event'] = "Trebuie să selectaţi un eveniment. "; 
$lang['Cal_edit_own_event'] = "Ne pare rău, puteţi modifica numai propriile evenimente. "; 
$lang['Cal_delete_event'] = "Ne pare rău, nu \ n-au permisiunea de a şterge acest eveniment. "; 
$lang['Cal_not_enough_access'] = "Ne pare rău, Access Denied "; 
$lang['Cal_must_member'] = "Trebuie să fie autorizate pentru a conecta şi de a folosi acest serviciu "; 
$lang['Cal_alt_event'] = "curent:"; 
$lang['Validate'] = "Validare Evenimente "; 
$lang['Cal_event_validated'] = "Eveniment (e) au fost validate / şterse după cum se specifică "; 
$lang['No events'] = "Momentan nu există evenimente pentru această dată "; 
$lang['No records'] = "Nu necesita validare evenimente "; 
$lang['No records modify'] = "Nu evenimente disponibile pentru a modifica "; 
$lang['No information'] = "suficiente informaţii. Vă rugăm să completaţi toate relevante info "; 
$lang['Date before today'] = "Ne pare rău, nu aveţi posibilitatea să trimiteţi datele de evenimente pentru care au trecut deja "; 
$lang['Date before start'] = "Ne pare rău, nu puteţi să prezinte evenimente care se termina înainte de a începe "; 
$lang['No date'] = "Trebuie să selectaţi un început şi data de sfârşit "; 
$lang['No time'] = "Trebuie să selectaţi o dată de start şi de sfârşit "; 

// 
// New Version 2.0.0 Adiţii. 
// 
$lang['Cal_event_add'] = "Eveniment adăugat / modificate ..."; 
$lang['Cal_add4valid'] = "Eveniment prezentat pentru validare de către un administrator "; 

$lang['category'] = "Categorie"; 

$lang['allow_categories'] = "Folosiţi categorii cu evenimente "; 
$lang['require_categories'] = "necesită o categorie cu evenimente: "; 

$lang['No_cat_selected'] = "Nu categorie selectate "; 
$lang['Edit_cat'] = "Editare categorie "; 
$lang['Cats_explain'] = "Folosiţi această secţiune pentru a adăugaţi, editaţi sau ştergeţi categoriile de a utiliza pe baza dumneavoastră de date. <br> <br> <b> NB: </ b> Vă rugăm să reţineţi că, dacă vă şterge o categorie care a fost selectat pentru un eveniment nu va şterge aceste înregistrări, dar se va opri utilizatorii de la a fi capabil de a filtra şi a vizualiza o elimină categorie. "; 
$lang['Cats_title'] = "Categorie Admin"; 
$lang['Must_enter_cat'] = "Trebuie să introduceţi o categorie "; 
$lang['Cat_updated'] = "Categorie Actualizat "; 
$lang['Cat_added'] = "Categorie adăugată "; 
$lang['cat_removed'] = "Categorie eliminat "; 
$lang['Add_new_cat'] = "Adăugare nouă categorie "; 
$lang['Click_return_catadmin'] = "Faceţi click %s aici %s pentru a reveni la Categorie Administraţie "; 
$lang['Must_enter_valid_cat'] = "Trebuie să utilizaţi valabile alfa / numeric de caractere"; 
$lang['Filter_cats_alt'] = "Arată numai categoria selectata"; 
$lang['Filter_cats'] = "Vezi numai ..."; 
$lang['Month_jump'] = "Salt la ..."; 

$lang['Recur_apply_to'] = "Modificările se aplică la:"; 
$lang['Recur_future'] = "viitorul evenimente "; 
$lang['Recur_solo'] = "Acest eveniment numai "; 
$lang['Recur_all'] = "Toate recurrences "; 
$lang['Cal_repeats'] = "Se repetă la fiecare: "; 
$lang['until'] = "până la"; 
$lang['Earliest recur before today'] = "Ne pare rău, mai devreme la data la acest set nu poate fi mutat de azi înainte. \ n <br> <b> Problema eveniment la data de:"; 
$lang['day'] = "zi (le)"; 
$lang['month'] = "lună (e)"; 
$lang['year'] = "an(i) "; 
$lang['Event_length'] = "Fiecare eveniment durează: "; 
$lang['Recur_title'] = "Optional Info recurent. "; 
$lang['Event_title'] = "Eveniment Info. "; 
$lang['Event overlap'] = "recurent evenimente nu poate repeta iniţială înainte de eveniment a luat sfârşit "; 
$lang['R_period too small'] = "Perioada disponibile pentru evenimente recurente este insuficientă pentru orice se repeta de"; 

$lang['Add notes'] = "Adauga suplimentare, această intrare pentru a notele "; 
$lang['Add noted title'] = "Adauga Notes "; 
$lang['Split solo'] = "împărţită în \'de sine stătătoare\' <i> intrare (nu va mai actualizare cu evenimente legate) </ i>"; 
$lang['Split solo title'] = "Split de a separa eveniment"; 
$lang['Split future'] = "Modificare toate caz, inregistrarile de la acest punct înainte "; 
$lang['Split future title'] = "Modificare toate evenimentele viitoare "; 
$lang['Edit all'] = "Modificare toate intrările legate de eveniment "; 
$land['Edit all title'] = "Modificare toate legate de evenimente "; 
$lang['early_iteration'] = "(Primele repetare după data de astăzi) "; 

$lang['global subject'] = "Global subiect "; 
$lang['global desc'] = "Global eveniment info "; 

$lang['Del future'] = "Ştergere toate evenimentele de la acest punct înainte "; 
$lang['Del all'] = "Şterge toate intrările <i> legate de eveniment (nu este împărţită inclusiv intrările) </ i> "; 
$lang['Del this'] = "Şterge acest eveniment unic "; 

$lang['Event_num'] = "Eveniment numarul: "; 
$lang['of'] = "<i>de</ i> "; 

$lang['Additional info'] = "Alte informaţii: "; 
$lang['Event specific'] = "(specifice pentru a \'acest\' caz):"; 

$lang['allow_user_post_default'] = "Implicit nivel de acces pentru toţi utilizatorii înregistraţi "; 

$lang['no_public'] = "Nu accesul public "; 
$lang['view_only'] = "Numai vizualizare"; 
$lang['view_suggest'] = "Vezi, Propuneţi Evenimente "; 
$lang['view_add'] = "Vizualizaţi, adăugaţi Evenimente "; 
$lang['view_edit_own'] = "Vizualizaţi, adăugaţi (Editaţi / Ştergeţi proprii) "; 
$lang['cal_admin'] = "Admin Calendar"; 

$lang['Invalid date']= "Unul sau ambele de la datele pe care le-aţi prezentat este invalid "; 
$lang['Empty subject'] = "Trebuie să introduceţi un subiect pentru dumneavoastră eveniment"; 
$lang['Empty description'] = "Trebuie să introduceţi o descriere a evenimentului "; 
$lang['max'] = "Maximum: "; 
$lang['Return'] = "Du-te inapoi la:"; 

$lang['View All'] = "Vezi Toate"; 
$lang['Calendar_Level'] = "Nivel Calendar"; 
$lang['Calendar_Categories'] = "Categorii Calendar "; 
$lang['Calendar Config'] = "Calendar config"; 

$lang['days'] = "zi(le) "; 
$lang['weeks'] = "săptămâni"; 
$lang['months'] = "luna(i) "; 
$lang['years'] = "an(i) "; 

$lang['view_year'] = "Anul Vizualizare "; 
$lang['view_month'] = "Vezi Luna "; 
$lang['view_week'] = "Săptămâna Vizualizare "; 
$lang['view_day'] = "Ziua / Eveniment Vizualizare "; 
$lang['view_list'] = "Vizualizare Listă "; 
$lang['view'] = "Vizualizare"; 

$lang['Submitted_by'] = "Publicat de"; 

$lang['No_modify_old'] = "Ne pare rău, puteţi \' t vechi edita un eveniment "; 
$lang['Cat_in_use'] = "Aceasta categorie este deja existente legate de evenimente şi nu poate fi sters "; 

// 
// Dev lang 2.0.25 
// 
$lang['require_time'] = "Prevederea de start / final de ori pentru a fi intrat cu noi evenimente "; 
$lang['allow_private_event'] = "Se permite de utilizatorii înregistraţi pentru a adăuga private de evenimente "; 
$lang['allow_group_event'] = "Se permite de utilizatorii înregistraţi pentru a limita evenimente la propriile lor grupuri "; 

$lang['event_access'] = "Eveniment de acces: "; 
$lang['private_event'] = "private / personale "; 
$lang['public_event'] = "public"; 
$lang['ug_event'] = "Rezervat grup de utilizatori (e) "; 
$lang['group_select'] = "Permis de utilizatori: <br /> <i> (dacă este cazul) </ i> "; 

$lang['group_event_explain'] = "<span class=\"genmed\"> <i> (tasta Ctrl pentru Tine şi selectaţi grupurile cu mouse-ul pentru a selecta mai mult de un grup) </ i> </ span> "; 
$lang['No_private_events'] = "Ai nu sunt permise pentru a adăuga private de evenimente "; 
$lang['time_format'] = "Timpul Format"; 

// 
// Dev lang 2.0.31 
// 
$lang['c_first'] = "1-lea"; 
$lang['c_second'] = "2-lea"; 
$lang['c_third'] = "3-lea"; 
$lang['c_fourth'] = "4-lea"; 
$lang['OR_every'] = "fiecare sau: "; 

// $lang['datetime'] [ 'poate "] =" Mai "; 

// 
// Adaugat pentru MX-Publisher Portalul modul mx_calsnails 
// 
$lang['Events'] = "Evenimente"; 
$lang['allow_anon_post_default'] = "Implicit nivel de acces pentru toţi utilizatorii anonimi "; 

$lang['Calendar_Events'] = "Calendar de evenimente "; 
$lang['More_Info'] = "Mai multe informaţii ..."; 
$lang['To_End_Date'] = "Dată de Sfârşit:"; 

// 
// Pentru început eticheta Cal Evenimente 
// 
$lang['Ev_this_day'] = "Astăzi"; 
$lang['Ev_this_week'] = "Acestă Săptămână"; 
$lang['Ev_next_week'] = "Săptămâna viitoare, "; 
$lang['Ev_this_month'] = "Această lună "; 
$lang['Ev_next_month'] = "Luna următoare";

//
// For HebCal Months and Events
//
$lang['Yom'] = 'Iom'; //"Yom ":"יום "
$lang['Rishon'] = 'Rişon'; //"ראשון","Rishon"
$lang['Sheni'] = 'Şeni'; //"שני","Sheni"
$lang['Shlishi'] = 'Şlişi'; //"שלישי","Shlishi"
$lang['Revi\'i'] = 'Revi\'i'; //"רבעי","Revi'i"
$lang['Chamishi'] = 'Chamişi'; //"חמישי","Chamishi"
$lang['Shishi'] = 'Şişi'; //"ששי","Shishi"
$lang['Shabbat'] = 'Şavat'; //"שבת","Shabbat"

$lang['Tishrei'] = 'Tişri'; //"תשרי","Tishrei"
$lang['Heshvan'] = 'Heşvan'; //"חשון","Cheshvan"
$lang['Kislev'] = 'Kislev'; //"כסלו","Kislev"
$lang['Tevet'] = 'Tevet'; //"טבת","Tevet"
$lang['Shevat'] = 'Şevat'; //"שבט","Shevat"
$lang['Adar'] = 'Adar'; //"אדר","Adar"
$lang['Adar II'] = 'Adar II'; //"אדר ב","Adar Bet"
$lang['Nisan'] = 'Aviv'; //"ניסן","Nissan"
$lang['Iyar'] = 'Aiar'; //"אייר","Iyar"
$lang['Sivan'] = 'Sivan'; //"סיון","Sivan"
$lang['Tamuz'] = 'Tamuz'; //"תמוז","Tammuz"
$lang['Av'] = 'Av'; //"אב","Av"
$lang['Elul'] = 'Elul'; //"אלול","Elul"

// The English spelling for the holidays I took from "Jewish Calendar for Linux" by Refoyl Finkl.
// Nisan
$lang['Rosh Kodeshim'] 		=		'Roş Chodeşim'; //'ראש חודשים';
$lang['Yom haSher'] 			=		'Iom heŞor'; //'יום השׂר';
$lang['Taanit Bechorim'] =	'Teaonit Beciorim (Post PrimNăscuţi)'; //תַעֲנִית בְּכֹ֣ורים
$lang['Erev Pesakh'] 				=		'Arev Pesach (Ajun)'; //'ערב פסח';
$lang['Pesakh'] 					=		'Pesach'; //'פסח';
$lang['Pesakh II (Diaspora)']		=	'Pesach II (Diaspora)'; //'שני של פסח (גולה)';
$lang['Khol HaMoed Pesakh']	=	'Chol HaMoed Pesach'; //'חול המועד פסח'; 
$lang['Pesakh VII']					=	'Pesach VII'; //'שביעי של פסח';
$lang['Pesakh VIII (Diaspora)']	=	'Pesach VIII (Diaspora)';	//'שמיני של פסח (גולה)';
$lang['Isru Khag Pesakh']			=	'Esru Chag Pesach'; //'אסרו חג';
$lang['Yom HaBikurei']				=	'</br>Iom Rişon Omer Chaţir  (Zi Prim Omer Secerat)'; //'בְּיֹוםבִּכּוּרִ';
$lang['Sefirat HaOmer']			=	'Sefirat HeOmer (Numărat deOmer)'; //'ספירת העומר';
$lang['Yom HaShoa'] 	=	 'Iom HaŞoa'; //'יום השואה';
// Iyar
$lang['Yom HaZikaron'] 	=	 'Iom HaZikaron'; //'יום הזכרון';
$lang['Yom HaAtsmaut'] 	=	 'Iom HaAtsmaut'; //'יום העצמאות';
$lang['Lag BaOmer'] 	=	 'Lag BaOmer'; //'ל"ג לעומר';

$lang['Yom HaAliyah']	=	 'Iom HaAliyiah'; //'יום העלייה';
$lang['Yom Yerushalayim'] =	'Iom Ieruşalayim'; //'יום ירושלים';
// Sivan
$lang['Erev Shavuot Parashim'] 	=	'Arev Şavuot Paraşim'; //'ערב שבועות';
$lang['Shavuot Parashim'] 	=	'Şavuot Paraşim'; //'שבועות';
$lang['Shavuot II Parashim (Diaspora)'] 	= 'Şavuot II Paraşim (Diaspora)'; //'שבועות ב\' (גולה)';
$lang['Isru Khag Shavuot Parashim'] 	= 'Esru Chag Şavuot Paraşim'; //'אסרו חג';

$lang['Erev Shavuot'] 	=	'Arev Şavuot'; //'ערב שבועות';
$lang['Shavuot'] 	=	'Şavuot'; //'שבועות';
$lang['Shavuot II (Diaspora)'] 	= 'Şavuot II (Diaspora)'; //'שבועות ב\' (גולה)';
$lang['Isru Khag Shavuot'] 	= 'Esru Chag Şavuot'; //'אסרו חג';
// Tamuz
$lang['Tsom Tamuz']	=		'Ţom Tamuz'; //'צום תמוז';
// Av
$lang['Tisha BeAv'] =	 'Tişa BeAv'; //'תשעה באב';
// Tishrei
$lang['Erev Roş HeŞanah'] 		= 'Arev Roş HeŞanah (Iom TeRuah)'; //'ערב ראש השנה';
$lang['Roş HeŞanah I'] 			= 'Roş HeŞanah I'; //'א\' ראש השנה';
$lang['Roş HeŞanah II'] 			= 'Roş HeŞanah II'; //'ב\' ראש השנה';
$lang['Tsom Gedalya'] 				= 'Tsom Gedalya'; //'צום גדליה';
$lang['Erev Yom Kippur'] 			= 'Erev Yom Kippur'; //'ערב יום הכיפורים';
$lang['Yom Kippur'] 					= 'Yom Kippur'; //'יום הכיפורים';
$lang['Erev Sukkot'] 					= 'Erev Sukkot'; //'ערב סוכות';
$lang['Sukkot'] 						= 'Sucot'; //'סוכות';
$lang['Sukkot II (Diaspora)']		= 'Sucot II (Diaspora)'; //'סוכות ב\' (גולה)';
$lang['Khol HaMoed Sukkot']	= 'Chol HeMoed Sucot'; //'חול המועד סוכות';
$lang['Hoshana Rabba']			= 'Hoşanae Ravah'; //'הושענא רבה';
$lang['Shemini Atseret']			= 'Şemini Aţeret'; //'שמיני עצרת';
$lang['Simkhat Tora']				= 'Simchat Torah'; //'שמחת תורה';
$lang['Isru Khag Sukkot']			= 'Asru Chag Sucot'; //'אסרו חג';
// Kislev / Tevet
$lang['Khanukka I'] = 		'Chanucah I'; //'א\' חנוכה';
$lang['Khanukka II'] = 		'Chanucah II'; //'ב\' חנוכה';
$lang['Khanukka III'] = 	'Chanucah III'; //'ג\' חנוכה';
$lang['Khanukka IV'] = 	'Chanucah IV'; //'ד\' חנוכה';
$lang['Khanukka V'] = 		'Chanucah V'; //'ה\' חנוכה';
$lang['Khanukka VI'] = 	'Chanucah VI'; //'ו\' חנוכה';
$lang['Khanukka VII'] = 	'Chanucah VII'; //'ז\' חנוכה';
$lang['Khanukka VIII'] = 	'Chanucah VIII'; //'ח\' חנוכה';
// Tevet
$lang['Tsom Tevet'] =					'Ţom Tevet'; //'צום טבת';
// Shevat
$lang['Tu BiShevat'] =					'Tu biŞevat'; //'ט\'ו בשבט';
// Adar
$lang['Taanit Esther'] = 				'Taanit Eşter'; //'תענית אסתר';
$lang['Purim'] =							'Purim'; //'פורים';
$lang['Shushan Purim'] =				'Şuşan Purim'; //'שושן פורים';
$lang['Erev Rosh Kodeshim'] =		'Arev Roş Chodeşim'; //'ראש חודשים ערב';

// That's all Folks!
// -------------------------------------------------
?>
