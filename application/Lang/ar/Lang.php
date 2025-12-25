<?php
	require_once('UI/Login.php');
	require_once('UI/Register.php');
	require_once('UI/Footer.php');
	require_once('UI/ToolBar.php');
	require_once('UI/Support.php');
	require_once('UI/Admin.php');
	require_once('UI/Errors.php');
	require_once('UI/Build.php');
	require_once('UI/News.php');
	require_once('UI/Plus.php');
	require_once('UI/Options.php');
	require_once('UI/Manual.php');

	define("BUILDING_BUILDING","Buildings:");
	define("BUILDING_COMPLETE","Complete construction immediately");
	define("BUILDING_LEVEL","Level");
	define("BUILDING_QUEUE","Queue");
	define("BUILDING_TIMER","hr. Finish in ");
	define("BUILDING_ARCHITECT","Building");
	define("SIDEINFO_HERO1","Your hero is dead");
	define("SIDEINFO_HERO2","Hero is healthy");
	define("SIDEINFO_HERO3","Hero is in his native village");
	define("SIDEINFO_HERO4","You hero is in your village");
	define("SIDEINFO_HERO5","On road");
	define("SIDEINFO_HERO5H","In village");
	define("SIDEINFO_HERO6","Heros native village is");
	define("SIDEINFO_HERO7","There is no hero.");
	define("SIDEINFO_HERO8","Overview");
	define("SIDEINFO_HERO9","Adventures");
	define("SIDEINFO_HERO10","Avilable Adventures");
	define("SIDEINFO_HERO11","Heal");
	define("SIDEINFO_HERO12","Experience");

	define("LANG_UR","en");
	define("DIRECTION","ltr");
	define("DIRECTION_2","left");
	define("LOCATION_NAME","Global - EN");

	define("INCLUDED","");
	define("INS0","Changes rights on folders (CHMOD)");
	define("INS1","After Installation");
	define("INS2","Delete install folder");
	define("INS3","Change CHMOD GameEngine back to 644");
	define("INS4","Along with the installation/usage of this game, you shall be fully responsible for any legal results that may raised initiated by the owners of any unlicensed content you permit your copy of this game to publish.");
	define("INS5","Neither the team that created this script nor the team that customized it to create this distribution/release shall be responsible for any damage done to your computer/server system.");
	define("INS6","All code was confirmed to be running correctly by the creation team without any visible security risk they were aware of at the time the released it. Similarly for the customization team who customized it to create this distribution/release.");
	define("INS7","Users are asked to review the code on their own accord and behalf.");
	define("INS8","You have no rights to edit copyright notices or/and claim this script as your own.");
	define("INS9","Last but not least, Enjoy.");
	define("INS10","Error creating constant.php check cmod.");
	define("INS11","Month");
	define("INS12","Day");
	define("INS13","year");
	define("INS14","Hour");
	define("INS15","Min");
	define("INS16","Sec");
	define("INS17","Server name:");
	define("INS18","Server speed:");
	define("INS19","Troops speed:");
	define("INS20","Marketplace capacity (1 = 1x...):");
	define("INS21","Map capacity:");
	define("INS21M","25x25");
	define("INS22","50x50");
	define("INS23","100x100");
	define("INS24","150x150");
	define("INS25","200x200");
	define("INS26","250x250");
	define("INS27","300x300");
	define("INS28","350x350");
	define("INS29","400x400");
	define("INS30","Homepage:");
	define("INS31","New player protection");
	define("INS31M","2 hours");
	define("INS32","3 hours");
	define("INS33","5 hours");
	define("INS34","8 hours");
	define("INS35","10 hours");
	define("INS36","12 hours");
	define("INS37","24 hours (1 day)");
	define("INS38","48 hours (2 days)");
	define("INS39","72 hours (3 days)");
	define("INS40","120 hours (5 days)");
	define("INS41","Warehouse capacity:");
	define("INS42","Arena action (after x squares):");
	define("INS43","Admin");
	define("INS44","Admins visibility on page:");
	define("INS45","True");
	define("INS46","False");
	define("INS47","SQL RELATED");
	define("INS48","Hostname:");
	define("INS49","Username:");
	define("INS50","Password:");
	define("INS51","DB name:");
	define("INS52","Travian plus options");
	define("INS53","Travian plus duration:");
	define("INS54","12 hours");
	define("INS55","1 day");
	define("INS56","2 days");
	define("INS57","3 days");
	define("INS58","4 days");
	define("INS59","5 days");
	define("INS60","6 days");
	define("INS61","7 days");
	define("INS62","+25% bonus:");
	define("INS63","12 hours");
	define("INS64","1 day");
	define("INS65","2 days");
	define("INS66","3 days");
	define("INS67","4 days");
	define("INS68","5 days");
	define("INS69","6 days");
	define("INS70","7 days");
	define("INS71","Can resources be sold?");
	define("INS72","True");
	define("INS73","False");
	define("INS74","Can culture points be sold?");
	define("INS75","True");
	define("INS76","False");
	define("INS77","How many resources will be sold?");
	define("INS78","Cost on resources");
	define("INS79","Culture points price");
	define("INS80","How much culture points?");
	define("INS81","Default number of golds");
	define("INS82","Referal villages number");
	define("INS83","Gold for invitation");
	define("INS84","Server options");
	define("INS85","Server will start:");
	define("INS86","Timestamp date (generation will be from UTC+0!)");
	define("INS87","Artefacts:");
	define("INS88","(Timestamp date)");
	define("INS89","Wonder villages:");
	define("INS90","Timestamp date ");
	define("INS91","Scrolls:");
	define("INS92","Timestamp date");
	define("INS92M","Culture points amount:");
	define("INS93","High");
	define("INS94","Low");
	define("INS95","Quests");
	define("INS96","True");
	define("INS97","False");
	define("INS98","Max number cache images for map");
	define("INS99","Max number cache images for hero");
	define("INS100","Quality of the map ");
	define("INS101","Momentally troop building");
	define("INS102","True");
	define("INS103","False");
	define("INS104","Auction time");
	define("INS105","Oasis rates");
	define("INS106","Begginer protection will be longest every 12 hours on ...(in seconds)");
	define("INS107","If your host doesn’t have big amount of space please consider! ");
	define("INS108","1000 pictures=~80MB");
	define("INS109","If your host doesnt have big about of memory RAM place consider");
	define("INS110","1000 Pictures=~2.60ГБ");
	define("INS111","Perfect quality - 100,medium - 75(Picture will be 3 times worse compared with maximum)");
	define("INS112","Populate Oasis");
	define("INS113","Warning");
	define("INS114",": This can take some time. Do not click, just wait till the next page has been loaded!");
	define("INS115","Create Multihunter account");
	define("INS116","Name:");
	define("INS117","Password:");
	define("INS118","Note: Remember this password! You need it for the ACP");
	define("INS119","Error creating wdata. Check configuration or file.");
	define("INS120","Create World Data");
	define("INS121","Warning");
	define("BUILDING_CANCEL", "Cancel");
	define("INS122",": This can take some time. Do not click, just wait till the next page has been loaded!");
	define("INS123","Thanks for installing script.");
	define("INS124","Please remove/rename the installation folder.");
	define("INS125","All the files are placed. The database is created, so you can now start playing on your own Travian.");
	define("INS126","Error importing database. Check configuration.");
	define("INS127","Create SQL Structure");
	define("INS128","Warning: This can take some time. Do not click, just wait till the next page has been loaded");
	define("INS129","How much adventures gives per day?");

	define("CLANG","Select a language:");
	define("MULTI_RULES","Prohibited:<br/>Register more than 1 account on 1 IP.<br/> 1 IP - 1 Account.<br/>
	Prohibited register accounts with help of friends/from fake IPs,<br/>accounts like this will be find and you will be punished:<br/> For example 50% from troops.<br />Be honest and have a conscience to play fair.");
	define("OK","Ok");
	define("CROPFINDER","Crop finder");
	define("MAP","Map");
	define("MINIMAP","Minimap");
	define("GO","Go");
	define("GO_TO","Go to");
	define("PLEASE_WAIT","Wait");

	define("CATEGORY","'Category");
	define("EDITPROFILE","Edit profile");
	define("COORDIANTES","Coord");
	define("POPULATION","Population");
	define("WOOD","wood");
	define("ABONDENDVALLY","Abandoned valley");
	define("UNOCCUPIEDOASES","Unoccupied Oasis");
	define("UNOCCUPIEDOASIS","Unoccupied Oasis");
	define("OCCUPIEDOASES","Occupied Oasis");
	define("OCCUPIEDOASIS","Occupied Oasis");
	define("ABANDONEDVALLEY","Abandoned valley");
	define("BUILDRALLYPOINTTORAID","(build rally point)");
	define("PLAYER","Player");
	define("TRIBE","Tribe");
	define("VILLAGE","Village");
	define("ALLIANCE","Alliance");
	define("SIDEINFO_ADVENTURES","Adventure");
	define("SIDEINFO_AUCTIONS","Auction");
	define("SIDEINFO_PROFILE","Profile");
	define("SIDEINFO_ALLIANCE","Alliance");
	define("SIDEINFO_ALLY_FORUM","Ally forum");
	define("SIDEINFO_CHANGE_TITLE","Click to change title");
	define("SIDEINFO_CHANGEVIL_TITLE","Rename village");
	define("SIDEINFO_CHANGEVIL_LABEL","New village name");
	define("SIDEINFO_CHANGEVIL_BTN","Accept");
	define("HEADER_MESSAGE_NEW","New");


	define("MAINMENU","Main Menu");


	define("POPUALTION","Population");
	//MAIN MENU
	define("TRIBE1","Romans");
	define("TRIBE2","Teutons");
	define("TRIBE3","Gauls");
	define("TRIBE4","Wild");
	define("TRIBE5","Natars");
	define("TRIBE6","Egyptians");
	define("TRIBE7","Huns");
	define("PRISONERS","Prisoners");
	define("PRISONERSIN"," Prisoners in");
	define("PRISONERSFROM"," Prisoners from");
	define("HOME","Homepage");
	define("PW_ER","Password is wrong");
	define("INSTRUCT","Instructions");
	define("ADMIN_PANEL","Admin Panel");
	define("MASS_MESSAGE","Mass Message");
	define("LOGOUT","Logout");
	define("PROFILE","Profile");
	define("SUPPORT","Support");
	define("RULES","Rules");

	define("P","P");
	define("L","l");
	define("U","u");
	define("S","s");
	define("UPDATE_T_10","Update Top 10");
	define("SYSTEM_MESSAGE","System message");
	define("TRAVIAN_PLUS","Travian <b><font color=\"#71D000\">P</font><font color=\"#FF6F0F\">l</font><font color=\"#71D000\">u</font><font color=\"#FF6F0F\">s</font></b>");
	define("CONTACT","Contact us!");
	define("HEADER_MESSAGES_NEW","New");

	define("HEADER_PLUS","Plus");
	define("HEADER_ADMIN","Admin");
	define("HEADER_PLUSMENU","Plus menu");

	define("HEADER_DORF1","Resources");
	define("HEADER_DORF2","Buildings");
	define("HEADER_STATS","Statistic");
	define("HEADER_MAP","Map");
	define("HEADER_NOTICES","Reports");
	define("HEADER_MESSAGES","Messages");

	define("HEADER_GOLD","Gold");
	define("HEADER_SILVER","Silver");
	define("HEADER_NIGHT","Night");
	define("HEADER_DAY","Day");
	define("HEADER_NOTICES_NEW","New Report");
	define("NO_PERMISSION","No permission");



	define("LOGOUT_TITLE","Logout complete!");
	define("LOGOUT_H4","Thank you for visiting");
	define("LOGOUT_DESC","If other people use this computer too, you should delete your cookies for your own safety:");
	define("LOGOUT_LINK","Clear cookies");
	define("PREREG1","Troop Speed");
	define("PREREG2","Administator");
	define("PREREG3","Medals in ");
	define("PREREG4","Server will start at: ");
	define("PREREG5","To start: ");

	define("LOGIN_PW_SENT","Your password restoration message has been sent.");

	define("REGISTER_USERINFO","Register");
	define("REGISTER_USERNAME","Name");
	define("REGISTER_EMAIL","Email");
	define("REGISTER_PASSWORD","Password");
	define("REGISTER_STARTER","");
	define("REGISTER_SELECT_TRIBE","Select Tribe");
	define("REGISTER_LOCATION","Location");
	define("REGISTER_NE","North-East");
	define("REGISTER_NW","North-West");
	define("REGISTER_SE","South-East");
	define("REGISTER_SW","South-West");
	define("REGISTER_RANDOM","Random");
	define("REGISTER_MOREINFO","T&C");
	define("REGISTER_CLOSED","The register is closed. You can't register to this server.");
	define("newmsg","New Message(s):");
	//MENU
	define("REG","Register");
	define("FORUM","Forum");
	define("CHAT","Chat");
	define("IMPRINT","Imprint");
	define("MORE_LINKS","More Links");
	define("TOUR","Game Tour");
	//PLUS
	define("PLUS0","Plus Functions");
	define("PLUS1","Overview");
	define("PLUS2","Duration");
	define("PLUS3","Gold");
	define("PLUS4","Action");
	define("PLUS5","You have ");
	define("PLUS6","Gold coins");
	define("PLUS7","Remaining:");
	define("PLUS8","Days");
	define("PLUS9","Hours");
	define("PLUS10","Minutes");
	define("PLUS11","Gold");
	define("PLUS12","Activate");
	define("PLUS13","Extend");
	define("PLUS14","Insufficient gold");
	define("PLUS15","Production: Wood");
	define("PLUS16","Production: Clay");
	define("PLUS17","Production: Iron");
	define("PLUS18","Production: Crop");
	define("PLUS19","NPC Market ");
	define("PLUS20","Now");
	define("PLUS21","To the Market!");
	define("PLUS22","Exchange Gold and Silver");
	define("PLUS23","Exchange");
	define("PLUS24","Complete all constructions and search");
	define("PLUS25","Complete");
	define("PLUS26","buy");
	define("PLUS27","Culture Points");
	define("PLUS28","buy");
	define("PLUS29","Every Kind of Resources");
	define("PLUS30","Day");
	define("PLUS31","Gold Club");
	define("PLUS32","Gold Club Functions:");
	define("PLUS33","1.Farmlist");
	define("PLUS34","2.Trade Routes");
	define("PLUS35","3.Auto troops evasion");
	define("PLUS36","4.Crop Finder");
	define("PLUS37","5.Master Builder");
	define("PLUS38","6.x3 Trading");
	define("PLUS39","All functions are free!");
	define("PLUS40","Whole Game");
	define("PLUS41","Activated");



	//active
	define("ACTIV1","Hello");
	define("ACTIV2","The registration was successful. In the next few minutes, you will receive an email with the access information.<br /><br />

	The email will be sent to following address:");

	define("ACTIV3","In order to activate your account enter the code or click on the link in your email.");
	define("ACTIV4","Activation code");
	define("ACTIV5","No email received?");
	define("ACTIV6","Sometimes the email is moved to the spam folder. For further help click ");
	define("ACTIV7","here");
	define("ACTIV8","You can undo the registration and re-register with a <u>different email address</u>.
	Then the activation code will be sent again");
	define("ACTIV9","Your account has been successfully activated.</p><p class=\"f9\">Follow this link to <a href=\"login.php\">log in</a>");
	define("ACTIV10","Either the password is wrong or the registration has already been deleted.");
	//ERRORS
	define("USRNM_EMPTY","(Username empty)");
	define("USRNM_TAKEN","(Name is already in use.)");
	define("USRNM_SHORT","(min. 3 figures)");
	define("USRNM_CHAR","(Invalid Characters only А-Я,A-Z,0-9)");
	define("PW_EMPTY","(Password empty)");
	define("PW_SHORT","(min. 4 figures)");
	define("PW_INSECURE","(Password insecure. Please choose a more secure one.)");
	define("EMAIL_EMPTY","(Email Empty)");
	define("EMAIL_INVALID","(Invalid email address)");
	define("EMAIL_TAKEN","(Email is already in use)");
	define("TRIBE_EMPTY","<li>Please choose a tribe.</li>");
	define("AGREE_ERROR","<li>You have to agree to the game rules and the general terms & conditions in order to register.</li>");
	define("LOGIN_USR_EMPTY","Enter name.");
	define("LOGIN_PASS_EMPTY","Enter password.");
	define("EMAIL_ERROR","Emails do not match");
	define("PASS_MISMATCH","Passwords do not match");
	define("ALLI_OWNER","Please appoint an alliance owner before deleting");
	define("SIT_ERROR","Sitter already set");
	define("USR_NT_FOUND","Name does not exist.");
	define("LOGIN_PW_ERROR","The password is wrong.");
	define("WEL_TOPIC","Useful tips & information ");
	define("ATAG_EMPTY","Tag empty");
	define("ANAME_EMPTY","Name empty");
	define("ATAG_EXIST","Tag taken");
	define("ANAME_EXIST","Name taken");


	define("CUR_PROD","Current production");
	define("NEXT_PROD","Production level");

	//BUILDINGS
	define("B1","Woodcutter");
	define("B1_DESC","The woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter, the more lumber is produced");
	define("B2","Clay Pit");
	define("B2_DESC","Clay is produced here. By increasing its level, you increase the clay production.");
	define("B3","Iron mine");
	define("B3_DESC","Here miners produce the precious resource of iron. By increasing the mine`s level, you increase the iron production.");
	define("B4","Cropfland");
	define("B4_DESC","Your population`s food is produced here. By increasing the farm`s level, you increase its crop production.");

	//DORF1
	define("LUMBER","Lumber");
	define("CLAY","Clay");
	define("IRON","Iron");
	define("CROP","Crop");
	define("LEVEL","Level");
	define("CROP_COM",CROP." consumption");
	define("PER_HR","Per hour");
	define("PROD_HEADER","Production");
	define("ANNOUNCEMENT","Announcement");
	define("GO2MY_VILLAGE","Go to my village");
	define("VILLAGE_CENTER","Village centre");
	define("FINISH_GOLD","Finish all construction and research orders in this village immediately for 2 Gold?");
	define("WAITING_LOOP","(waiting loop)");
	define("HRS","(hrs.)");
	define("DONE_AT","done at");
	define("CANCEL","Cancel");
	define("LOYALTY","Loyalty");
	define("CALCULATED_IN","Calculated in");
	define("SEVER_TIME","Server time:");


	//======================================================//
	//================ UNITS - DO NOT EDIT! ================//
	//======================================================//
	define("U0","Hero");

	//ROMAN UNITS
	define("U1","Legionnaire");
	define("U2","Praetorian");
	define("U3","Imperian");
	define("U4","Equites Legati");
	define("U5","Equites Imperatoris");
	define("U6","Equites Caesaris");
	define("U7","Battering Ram");
	define("U8","Fire Catapult");
	define("U9","Senator");
	define("U10","Settler");

	//TEUTON UNITS
	define("U11","Clubswinger");
	define("U12","Spearman");
	define("U13","Axeman");
	define("U14","Scout");
	define("U15","Paladin");
	define("U16","Teutonic Knight");
	define("U17","Ram");
	define("U18","Catapult");
	define("U19","Chief");
	define("U20","Settler");

	//GAUL UNITS
	define("U21","Phalanx");
	define("U22","Swordsman");
	define("U23","Pathfinder");
	define("U24","Theutates Thunder");
	define("U25","Druidrider");
	define("U26","Haeduan");
	define("U27","Ram");
	define("U28","Trebuchet");
	define("U29","Chieftain");
	define("U30","Settler");
	define("U99","Traps");

	//NATURE UNITS
	define("U31","Rat");
	define("U32","Spider");
	define("U33","Snake");
	define("U34","Bat");
	define("U35","Wild Boar");
	define("U36","Wolf");
	define("U37","Bear");
	define("U38","Crocodile");
	define("U39","Tiger");
	define("U40","Elephant");

	//NATARS UNITS
	define("U41","Pikeman");
	define("U42","Thorned Warrior");
	define("U43","Guardsman");
	define("U44","Birds Of Prey");
	define("U45","Axerider");
	define("U46","Natarian Knight");
	define("U47","War Elephant");
	define("U48","Ballista");
	define("U49","Natarian Emperor");
	define("U50","Natarian Settler");

	//Egyptian UNITS
	define("U51","Slave Militia");
	define("U52","Ash Warden");
	define("U53","Khopesh Warrior");
	define("U54","Sopdu Explorer");
	define("U55","Anhur Guard");
	define("U56","Resheph Chariot");
	define("U57","Ram");
	define("U58","Stone Catapult");
	define("U59","Nomarch");
	define("U60","Settler");

	//Huns UNITS
	define("U61","Mercenary");
	define("U62","Bowman");
	define("U63","Spotter");
	define("U64","Steppe Rider");
	define("U65","Marksman");
	define("U66","Marauder");
	define("U67","Ram");
	define("U68","Catapult");
	define("U69","Logades");
	define("U70","Settler");


	define("U99","Traps");
	//INDEX.php

	define("PLAYER_STATISTICS","Player statistics");


	define("P_ONLINE","Players online: ");
	define("P_TOTAL","Players in total: ");
	define("CHOOSE","Please choose a server.");
	//define("STARTED"," The server started ". round((time()-COMMENCE)/86400) ." days ago.");

	//ANMELDEN.php
	define("NICKNAME","Nickname");

	define("INVITED","Invited by(if exist)");
	define("EMAIL","Email");
	define("PASSWORD","Password");
	define("ROMANS","Romans");
	define("TEUTONS","Teutons");
	define("GAULS","Gauls");
	define("NW","North West");
	define("NE","North East");
	define("SW","South West");
	define("SE","South East");
	define("RANDOM","random");
	define("ACCEPT_RULES"," I accept the game rules and general <a href='rules.php' target='_blank'>terms</a> and conditions.");
	define("ONE_PER_SERVER","Each player may only own ONE account per server.");
	define("BEFORE_REGISTER","Before you register an account you should read the <a href='../anleitung.php' target='_blank'>rules</a>");
	define("MULTIBAN","One computer-1account.All multiaccounts will be banned!");
	define("HOURS","hours");
	define("SIGN1","Register");
	define("SIGN2","Select Tribe");
	define("SIGN3","Select Region");
	define("SIGN4","Homepage");
	define("SIGN5","Register");
	define("SIGN6","Login");
	define("SIGN7","Activate Account");
	define("SIGN8","Bank");

	//QUESTS
	define("QST0","Quest");
	define("QST1","Task");
	define("QST2","Woodcutter");
	define("QST3","Build woodcutter Level <b>5</b>");
	define("QST4","Cropland");
	define("QST5","Build cropland Level <b>3</b>");
	define("QST6","Iron and Clay");
	define("QST7","Build Clay Pit and Iron mine to <b>4</b> Level");
	define("QST8","Main Building");
	define("QST9","Build Main Building Level <b>8</b>");
	define("QST10","Economic");
	define("QST11","Build warehouse and granary Level <b>4</b>,Marketplace Level <b>1</b>");
	define("QST12","Militarisation");
	define("QST13","Build rally point Level <b>1</b>, Barracks Level <b>3</b>");
	define("QST14","Reliable Protection");
	define("QST15","Train 100 units and build Wall level <b>8</b>");
	define("QST16","First Blood");
	define("QST17","Take <b>1000</b> Attack points.");
	define("QST18","Viva la Socium!");
	define("QST19","Visit one of our groups");
	define("QST20","End of tasks!");
	define("QST21","At this moment no more quests.In future will be more quests,but now-good game!:)");
	define("QST22","Perfect!Yor reward:");
	define("QST23","To the next Task!");

	//ATTACKS ETC.
	define("TROOP_MOVEMENTS","Troop Movements:");
	define("ARRIVING_REINF_TROOPS","Arriving reinforcing troops");
	define("ARRIVING_REINF_TROOPS_SHORT","Reinf.");
	define("OWN_ATTACKING_TROOPS","Own attacking troops");
	define("ATTACK","Attack");
	define("OWN_REINFORCING_TROOPS","Own reinforcing troops");
	define("TROOPS_DORF","Troops:");


	//LOGIN.php
	define("COOKIES","You must have cookies enabled to be able to log in. If you share this computer with other people you should log out after each session for your own safety.");
	define("NAME","Name");
	define("PW_FORGOTTEN","Password forgotten?");
	define("PW_REQUEST","Then you can request a new one which will be sent to your email address.");
	define("PW_GENERATE","All fields required");
	define("EMAIL_NOT_VERIFIED","Email not verified!");
	define("EMAIL_FOLLOW","Follow this link to activate your account.");
	define("VERIFY_EMAIL","Verify Email.");
	define("LOGIN_SERVER_START","Server will start in:");
	define("LOGIN_FOR_GAME","Login");

	//404.php
	define("NOTHING_HERE","Nothing here!");
	define("WE_LOOKED","We looked 404 times already but can't find anything");

	//TIME RELATED
	define("CALCULATED","Calculated in");
	define("SERVER_TIME","Server time:");

	//MASSMESSAGE.php
	define("MASS","Message Content");
	define("MASS_SUBJECT","Subject:");
	define("MASS_COLOR","Message color:");
	define("MASS_REQUIRED","All fields required");
	define("MASS_UNITS","Images (units):");
	define("MASS_SHOWHIDE","Show/Hide");
	define("MASS_READ","Read this: after adding smilie, you have to add left or right after number otherwise image will won't work");
	define("MASS_CONFIRM","Confirmation");
	define("MASS_REALLY","Do you really want to send MassIGM?");
	define("MASS_ABORT","Aborting right now");
	define("MASS_SENT","Mass IGM was sent");

	// Menu items

	define("GAME_TOUR","Game Tour");

	define("FORUM_LINK","http://forum.travian.com");
	define("MORE_GAMES","More games");
	define("REGISTER","Register");
	define("LOGIN","Login");
	define("MANUAL","Manual");
	define("TUTORIAL","Tutorial");

	define("FAQ","FAQ");
	define("SPIELREGELN","Game Rules");
	define("AGB","Terms");

	define("LINKS","Links");

	define("INSTRUCTIONS","Instructions");
	define("MULTIHUNTER_PANEL","Multihunter Panel");
	define("UPDATE_TOP_TEN","Update Top 10");

	define("HELP","Help");

// Index


//profile
define("PROFHEAD","");
define("ACC1","Change Password");
define("ACC2","Old password");
define("ACC3","New password");
define("ACC4","Change email");
define("ACC5","Please enter your old and your new e-mail addresses. You will then receive a code snippet at both e-mail addresses which you have to enter here.");
define("ACC6","Old email");
define("ACC7","New email");
define("ACC8","Account sitters");
define("ACC9","A sitter can log into your account by using your name and his/her password. You can have up to two sitters.");
define("ACC10","Name of the sitter");
define("ACC11","You have no sitters.");
define("ACC12","<td class=\"note\" colspan=\"2\">For delete sitter click <img class=\"del\" src=\"img/x.gif\" title=\"del\" alt=\"del\"></td>");
define("ACC13","Delete account");
define("ACC14","You can delete your account here. After starting the cancellation, it will take 24 hours to complete the cancellation of your account. You can cancel this process within the first 12 hours. Administration can’t cancel deleting.");
define("ACC15","Delete Account?");
define("ACC16","Enter your passwoed:");
define("ACC17","Yes");
define("ACC18","No");
define("ACC19","Delete after:");
define("ACC20","These are the accounts you are sitting for");
define("ACC21","Sitter");
define("SAVE","Save");
 //menu prof
define("PROFM1","Overview");
define("PROFM2","Profile");
define("PROFM3","Links");
define("PROFM4","Account");
define("PROFM5", "Sessions");
define("PROFM6", "Status");
define("PROFM7", "Who");
define("PROFM8", "Recent Activity");
define("PROFM9", "Owner");
define("PROFM10", "Deputy");
define("PROFM11", "Dual");
define("PROFM12", "You");
//OVERVIEW
define("OVERVIEW1","Player");
define("OVERVIEW2","Details");
define("OVERVIEW3","Description");
define("OVERVIEW4","Rank");
define("OVERVIEW5","Tribe");
define("OVERVIEW6","Alliance");
define("OVERVIEW7","Villages");
define("OVERVIEW8","Population");
define("OVERVIEW9","Age");
define("OVERVIEW10","Male");
define("OVERVIEW11","Female");
define("OVERVIEW12","Gender");
define("OVERVIEW13","Location");
define("OVERVIEW14","Profile");
define("OVERVIEW15","Write message");
define("OVERVIEW16","Village");
define("OVERVIEW17","Name");
define("OVERVIEW18","Population");
define("OVERVIEW19","Coordinates");
define("OVERVIEW20","Capital");
define("OVERVIEW21","Banned");
define("OVERVIEW22","Birthday");
define("OVERVIEW23","January");
define("OVERVIEW24","Febrary");
define("OVERVIEW25","March");
define("OVERVIEW26","April");
define("OVERVIEW27","May");
define("OVERVIEW28","June");
define("OVERVIEW29","July");
define("OVERVIEW30","August");
define("OVERVIEW31","September");
define("OVERVIEW32","November");
define("OVERVIEW33","December");
define("OVERVIEW35","Medals");
define("OVERVIEW36","Category");
define("OVERVIEW37","Week");
define("OVERVIEW38","Code");
define("OVERVIEW39","Male");
define("OVERVIEW40","Female");
//medals
define("MEDAL1","Attacker of ");
define("MEDAL2","Defender of ");
define("MEDAL3","Pop Climber of ");
define("MEDAL4","Robber of ");
define("MEDAL5","Top 10 of both attackers and defenders");
define("MEDAL6","Top 3 of Attackers of ");
define("MEDAL7","Top 3 of Defenders of ");
define("MEDAL8","Top 3 of Pop climbers of ");
define("MEDAL9","Top 3 of Robbers of ");
define("MEDAL10","Rank Climber of ");
define("MEDAL11","Top 3 of Rank climbers of ");
define("MEDAL12","Top 10 of Rank Attackers of ");
define("MEDAL20","Day");
define("DNYA","the Day");
define("TIMES","times");
define("MEDAL15","");
define("MEDAL16","");
define("MEDAL17","Hero of ");
define("MEDAL18","Trader of ");
define("MEDAL19","in a row");
define("BONUS","Bonus");
//statistic..zzzest'
define("STATISTIC1","Players statistic");
define("STATISTIC2","Player not found");
define("STATISTIC3","Not found");
define("STATISTIC4","Largest Alliance");
define("STATISTIC5","Alliance not found");
define("STATISTIC6","Points");
define("STATISTIC7","Alliance Statistic(Off)");
define("STATISTIC8","Alliance Statistic(Def)");
define("STATISTIC9","Top");
define("STATISTIC10","Hero Statistic");
define("STATISTIC11","Experience");
define("STATISTIC12","Hero not found");
define("STATISTIC13","Players Statistic(Off)");
define("STATISTIC14","Players Statistic(Def)");
define("STATISTIC15","Players Statistic(Romans)");
define("STATISTIC16","Players Statistic(Germans)");
define("STATISTIC17","Players Statistic(Gauls)");
define("STATISTIC18","Resources");
define("STATISTIC19","Players");
define("STATISTIC20","Total registered");
define("STATISTIC21","Active players");
define("STATISTIC22","Online players");
define("STATISTIC23","Tribes");
define("STATISTIC24","Tribe");
define("STATISTIC25","Registered");
define("STATISTIC26","Percent");
define("STATISTIC27","World Wonder");
define("STATISTIC28","Players");
define("STATISTIC29","Alliances");
define("STATISTIC30","Heroes");
define("STATISTIC31","General");
define("STATISTIC32","Statistic");
define("STATISTIC33","or");
define("STATISTIC34","Back");
define("STATISTIC35","Forward");
define("STATISTIC36","Players Statistic(Monsters)");
define("STATISTIC37","Defend");
//alliance
define("ALLIANCE1","Options");
define("ALLIANCE2","Assign to position");
define("ALLIANCE3","Change name");
define("ALLIANCE4","Kick player");
define("ALLIANCE5","Change Description");
define("ALLIANCE6","Diplomacy");
define("ALLIANCE7","Invite Player");
define("ALLIANCE8","Kick from alliance");
define("ALLIANCE9","Alliance Events");
define("ALLIANCE10","Event");
define("ALLIANCE11","Date");
define("ALLIANCE12","In order to quit the alliance you have to enter your password again for safety reasons.");
define("ALLIANCE13","Alliance diplomacy");
define("ALLIANCE14"," offer a confederation");
define("ALLIANCE15"," offer non-aggression pact");
define("ALLIANCE16"," declare war");
define("ALLIANCE17","Manual");
define("ALLIANCE18","If you want to see connections in the alliance description automatically, type <span class=\"e\">[diplomatie]</span> into the description, <span class=\"e\">[ally]</span>, <span class=\"e\">[nap]</span> and <span class=\"e\">[war]</span> are also possible.");
define("ALLIANCE19","Own offers");
define("ALLIANCE20","Foreign offers");
define("ALLIANCE21","Existing relationships");
define("ALLIANCE22","Conf.");
define("ALLIANCE23","Nap");
define("ALLIANCE24","War");
define("ALLIANCE25","position");
define("ALLIANCE26","Adding permission");
define("ALLIANCE27","Mass.message");
define("ALLIANCE28","Here you can grant the players from your alliance rights & positions.");
define("ALLIANCE29","Attacks");
define("ALLIANCE30","Here you can kick the players from your alliance.");
define("ALLIANCE31","Invited");
define("ALLIANCE32","confederations");
define("ALLIANCE33"," invited by ");
define("ALLIANCE34"," has rejected the invitation");
define("ALLIANCE35"," has deleted the invitation for");
define("ALLIANCE36"," has joined the alliance");
define("ALLIANCE37","Too many peoples in alliance");
define("ALLIANCE38","Alliance founder");
define("ALLIANCE39","The alliance has been founded by");
define("ALLIANCE40"," has changed the alliance name");
define("ALLIANCE41"," joined to alliance");
define("ALLIANCE42"," has changed the alliance description");
define("ALLIANCE43"," has changed permissions");
define("ALLIANCE44"," has quit the alliance");
define("ALLIANCE45"," offer a confederation to");
define("ALLIANCE46"," offer non-aggression pact to");
define("ALLIANCE47"," declare war on");
define("ALLIANCE48","Invite sended");
define("ALLIANCE49","You have already sended them a invite");
define("ALLIANCE50","hacker?yep?");
define("ALLIANCE51","Alliance does not exist");
//crop finder or nice place for ddos,lol
define("FINDER1","Here you can search villages with 9 and 15 crop fields with crop oases.");
define("FINDER2","Search");
define("FINDER3","Starting Position");
define("FINDER4","Type");
define("FINDER5","Oasis");
define("FINDER6","Unoccupied");
define("FINDER7","Unoccupied");
define("FINDER8","Distance");
define("FINDER9","Position");
define("FINDER10","Occupied By");
define("FINDER11","Searching villages with 9 and 15 crop fields");
define("FINDER12","Oases");
define("FINDER13","");
define("FINDER14","");
define("FINDER15","");
define("FINDER16","");
define("FINDER17","");
//otpravka figni
define("OTPRAV1","Send Units");
define("OTPRAV2","Reinforcement");
define("OTPRAV3","Attack");
define("OTPRAV4","Raid");
define("OTPRAV5","Scout");
define("OTPRAV6","Reinforcement for");
define("OTPRAV7","Attack to");
define("OTPRAV8","Raid to");
define("OTPRAV9","Scout");
define("OTPRAV10","Scout resourse and troops<br>");
define("OTPRAV11","Scout troops and defence things");
define("OTPRAV12","Target");
define("OTPRAV13","Random");
define("OTPRAV14","Units are effected by the brewery. Only random targets.");
define("OTPRAV15","(will be attacked by catapult(s))");
define("OTPRAV16","Artefact");
define("OTPRAV17","Arrived");
define("OTPRAV18","User presently has beginners protection");
define("OTPRAV19","Any attack of another player will remove your beginner protection");
define("OTPRAV20","");

//Artefacti
define("ART1","The architects slight secret");
define("ART2","The architects great secret");
define("ART3","The architects unique secret");
define("ART4","The slight titan boots");
define("ART5","The great titan boots");
define("ART6","The unique titan boots");
define("ART7","The eagle’s slight eyes");
define("ART8","The eagle’s great eyes");
define("ART9","The eagle’s unique eyes");
define("ART10","The trainer’s slight talent");
define("ART11","The trainer’s great talent");
define("ART12","The trainer’s unique talent");
define("ART13","Storage masterplan");
define("ART14","WW Buildingplan");
define("ART15","Access to the building.");
define("ART16","This artifact is protecting your village from the catapults and battering rams. Thanks to him, all the buildings and the wall becomes stronger.");
define("ART17","This artifact accelerates the movement of your troops.");
define("ART18","This artifact makes your scouts stronger. All scouts, as well as being in the village, and sent her out to explore in another village, get this bonus. In addition, in an attack on you, you can see the collection point type of enemy troops.");
define("ART19","Artifact reduces the training of troops in the barracks, stables and workshop.");
define("ART20","This artifact gives you the opportunity to build a large warehouse and a large granary. Artifact is also necessary to improve both buildings.");
define("ART21","Artifact needed for the construction of Wonder.");
//karta vrode
define("BAN","Banned");
define("KAR1","Abandoned valley");
define("KAR2","Unoccupied oasis");
define("KAR3","Occupied oasis");
define("KAR4","There is no<br>information available.");
define("KAR5","Found new Village");
define("KAR6","Culture Points");
define("KAR7","Settlers");
define("KAR8","Build a rally point");
define("KAR9","Send Units");
define("KAR10","Beginners protection");
define("KAR11","Send merchant(s)");
define("KAR12"," Add to farmlist ");
define("KAR13","Add to farmlist (already)");
define("KAR14","Add to farmlist (max limit)");
define("KAR15","Land distribution:");
define("KAR16","Map Center");
define("KAR17","Build market place");
define("KAR18","Map");
define("KAR19","Search");
define("KAR20","List of favorites targets");
define("KAR21","Position");
define("KAR22","Last Attack");
define("KAR23","Dead");
define("KAR24","Bounty");

//ss6Ilo4ki EBAN6IE:D
define("LINK1","Link");
define("LINK2","Adress");
define("LINK3","");
define("LINK4","");
//pravila anti-gad6I
define ("RULES1", "Rules of the game");
define ("RULES2", "These rules of the game are rules developed by the administration of xtravian.net. in case of account blocking, as well as in order to better understand prohibited actions, please refer to the Multihunter, to §3. <br>
Bypassing the rules of the game is a violation. The rules are uniform and are binding on all players, including those who are going to delete or are already deleting their accounts. ");
define ("RULES3", "§ 1 Account");
define ("RULES4", "§1.1. Each player has the right to own only one account on the same players server.");
define ("RULES5", "§1.2. in the owner of the game account is the player whose email address is specified in the account settings. You can change the email address in the account profile (Profile» Account). ");
define ("RULES6", "§1.3. Transferring the password from an account to persons playing on the same server is prohibited. It is also prohibited to log in to other players' accounts using the owners password. Any such actions are classified as in the possession of any account or more. one player server. ");
define ("RULES7", "Several players can play on the same account, provided that none of the players owns and / or plays other accounts on the same players server.");
define ("RULES8", "It is also forbidden to use the same passwords on accounts when using a shared computer and / or replacement.");
define ("RULES9", "§1.4. in the account owner bears full responsibility for everything that happens to his account.");
define ("RULES10", "§ 2 Gaming Ethics");
define ("RULES11", "§2.1. The sale and purchase of an account, units of troops, resources or player actions are prohibited. This also applies to those installed in an account in time.");
define ("RULES12", "§2.2. Insults, humiliation or other questionable comments about other players in any form and in any place in the game are prohibited. The use of profanity (including inappropriate language) and any threats related to real life are also prohibited. ");
define ("RULES13", "§2.3. It is forbidden to imitate the official structures of xtravian.net, as well as the use of names, titles that are offensive and incorrect from the point of view of political and political norms.");
define ("RULES14", "§2.4. Composing game and alliance profiles is allowed only in Russian and English.");
define ("RULES15", "§2.5. Advertising of any kind, spam or chain letters are prohibited.");
define ("RULES16", "§2.6. Posting game messages, player emails, multi-hunter or community managers is prohibited.");
define ("RULES17", "§2.7. It is forbidden to urge a player to violate the rules of the game, delete, transfer a password, co-play on the same account, demand to transfer an account or indicate a substitute.");
define ("RULES18", "§2.8. The use of errors in the game to recover any profit is prohibited. The use of any programs that automate and / or imitate the players activities, as well as alter in any way the external in-view of the game, is prohibited. The use of graphics packages is in progress. ");
define ("RULES19", "§ 3 Administrative Provisions");
define ("RULES20", "§3.1. The method of punishment in case of violation of the rules is determined by multihunters and / or the administration. The punishment in any case will exceed the benefit gained from the violation. Without any exceptions, all accounts that were related to the violation will be penalized Lost raw materials, buildings, trees or troops lost during the blocking time will not be refunded.");
define ("RULES21", "§3.2. The multi-hunter is the only point of contact regarding rule violations. Players can submit arguments in the quality of proof of the blue right by sending messages to the multi-hunter. in case of disagreement with the multi-hunters decision, the player can contact the administration.");
define ("RULES22", "in all questions about violations and penalties, the xtravian.net team resolves only with the account owner.");
define ("RULES23", "§3.3. The xtravian.net team reserves the right to change the game rules at any time.");
define("PERC","Percent");

$lang['header'] = array (
							0 => 'Resources',
							1 => 'Village center',
							2 => 'Map',
							3 => 'Statistics',
							4 => 'Reports',
							5 => 'Messages',
							6 => 'Plus Menu');

		$lang['buildings'] = array (
							1 => "Woodcutter",
							2 => "Clay pit",
							3 => "Iron Mine",
							4 => "Cropland",
							5 => "Sawmill",
							6 => "Brickworks",
							7 => "Iron Foundry",
							8 => "Grain Mill",
							9 => "Bakery",
							10 => "Warehouse",
							11 => "Granary",
							12 => "Smithy",
							14 => "Tournament Square",
							15 => "Main Building",
							16 => "Rally Point",
							17 => "Marketplace",
							18 => "Embassy",
							19 => "Barracks",
							20 => "Stable",
							21 => "Workshop",
							22 => "Academy",
							23 => "Cranny",
							24 => "Town Hall",
							25 => "Residence",
							26 => "Palace",
							27 => "Treasury",
							28 => "Trade Office",
							29 => "Great Barracks",
							30 => "Great Stable",
							31 => "City Wall",
							32 => "Earth Wall",
							33 => "Palisade",
							34 => "Stonemason",
							35 => "Brewery",
							36 => "Trapper",
							37 => "Hero’s Mansion",
							38 => "Great Warehouse",
							39 => "Great Granary",
							40 => "World Wonder",
							41 => "Horse Drinking Pool",
							42 => "Stone Wall",
							43 => "Makeshift Wall",
							44 => "Command Center",
							45 => "Waterworks");

$lang ['desc'] [1] = array (0 => 'The lumberjack cuts down trees to produce timber. The further you increase the level, the more timber you produce.');
$lang ['desc'] [2] = array (0 => 'Clay is produced here. Increasing its level increases its clay production.');
$lang ['desc'] [3] = array (0 => 'Here the miners produce the precious iron base. Increasing the level of the mine increases its iron production.');
$lang ['desc'] [4] = array (0 => 'The food of the population is produced here. It increases the crop production by increasing the level of the farm.');
$lang ['desc'] [ 5 ] = array (0 => 'Lumber cut by your woodcutters is processed here. Based on its level, your sawmill can increase your lumber production by up to 25 percent.');
$lang ['desc'][ 6 ] = array ( 0 => 'The brickyard converts clay into bricks. Based on its level, your brickyard can increase your clay production by up to 25 percent.');
$lang ['desc'][ 7 ] = array ( 0 => 'The iron foundry melts iron. Based on its level, your iron foundry can increase your iron production by up to 25 percent.');
$lang ['desc'][ 8 ] = array ( 0 => 'The grain mill grinds grain into flour. Based on its level, your grain mill can increase your crop production by up to 25 percent.');
$lang ['desc'][ 9 ] = array ( 0 => 'The bakery flour to bake bread . Grain production is associated with the level of development and bakeries can be increased , together with the mill , by 50 percent.');
$lang ['desc'][ 10 ] = array ( 0 => 'The resources lumber, clay and iron are stored in the warehouse. By increasing its level, you increase your warehouses capacity.');
$lang ['desc'][ 11 ] = array ( 0 => 'The crop produced on your farms is stored in the granary. By increasing its level, you increase the granary’s capacity');
$lang ['desc'][ 12 ] = array ( 0 => 'The weapons and armor of your warriors are enhanced in the smithys melting furnaces. By increasing its level, you can order the fabrication of even better weapons and armor.');
$lang ['desc'][ 13 ] = array ( 0 => ' The weapons and armor of your warriors are enhanced in the smithys melting furnaces. By increasing its level, you can order the fabrication of even better weapons and armor.');
$lang ['desc'][ 14 ] = array ( 0 => 'Your troops can increase their stamina at the Tournament Square. The further the building is upgraded, the faster your troops are beyond a minimum distance of 20 squares.');
$lang ['desc'][ 15 ] = array ( 0 => ' The main building is the home of the villages master builders. The higher its level, the faster your master builders complete the construction of new buildings.');
$lang ['desc'][ 16 ] = array ( 0 => ' Your villages troops gather here. From here, you can send them out to conquer, raid or reinforce other villages.
The rally point can only be built on the green grassland below and to the right of your main building.
If there are less attacking units than the level of the rally point, you can see the type of unit attacking.');
$lang ['desc'][ 17 ] = array ( 0 => 'You can trade resources with other players via the marketplace. The higher the level, the more merchants are available.');
$lang ['desc'][ 18 ] = array ( 0 => 'The embassy is the place for diplomatic relations. At level 1 you can join an alliance, while with a level 3 embassy you may even found one yourself.') ;
$lang ['desc'][ 19 ] = array ( 0 => 'In the barracks, infantry can be trained. The higher its level, the faster the troops are trained. ');
$lang ['desc'][ 20 ] = array ( 0 => ' Cavalry can be trained in the stable. The higher its level, the faster the troops are trained');
$lang ['desc'][ 21 ] = array ( 0 => ' Siege engines, like catapults and rams, can be built in the workshop. The higher its level, the faster these units are produced. ');
$lang ['desc'][ 22 ] = array ( 0 => ' New unit types can be researched in the academy. By increasing its level, you can order the research of better units. ');
$lang ['desc'][ 23 ] = array ( 0 => ' The cranny hides some of your resources in case the village gets attacked. These resources cannot get stolen.
At level 1 the cranny can hold 200 of each resource. The capacity of Gallic crannies is 1.5 times larger.
If a Teutonic hero attacks a village, crannies can hide only 80% of their normal capacity. ');
$lang ['desc'][ 24 ] = array ( 0 => ' In the town hall, you can hold pompous celebrations. Such a celebration increases your culture points (= CP).

Culture points are necessary to found or conquer new villages. Each building produces culture points and the higher its level, the more CP it produces. With celebrations, you can increase this production for a short while. ');
$lang ['desc'][ 25 ] = array ( 0 => 'The Residence protects the village against enemy conquests. You can build one residence per village. Units that can found a new village or conquer existing villages can be trained here.

Additionally, the residence provides an expansion slot at levels 10 and 20 each.');
$lang ['desc'][ 26 ] = array ( 0 => ' The palace building is unique. You can only build one in your whole realm and you can proclaim that village as your capital. It also protects the village against enemy conquests. Units that can found a new village or conquer existing villages can be trained here.

Additionally, the palace provides an expansion slot at levels 10, 15 and 20 each. ');
$lang ['desc'][ 27 ] = array ( 0 => ' The riches of your empire are kept in the treasury. A treasury can only store one artefact at a time.

You need a treasury at level 10 for a small artefact, or level 20 for a great one. ');
$lang ['desc'][ 28 ] = array ( 0 => 'In the trade office, the merchants carts get improved and equipped with powerful horses. The higher its level, the more your merchants are able to carry.');
$lang ['desc'][ 29 ] = array ( 0 => 'Great Barracks allows you to train soldiers . However, the cost of training a soldier is three times more. Using a great barracks and barracks you can train twice as many soldiers for the same time. Great Barracks cannot be built in the capital. ');
$lang ['desc'][ 30 ] = array ( 0 => 'Great Stable allows you to train cavalry . However , the cost of training is three times more. Great stable cannot be built in the capital. ');
$lang ['desc'][ 31 ] = array ( 0 => 'By building a wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces defense.');
$lang ['desc'][ 32 ] = array ( 0 => 'By building a wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces defense.');
$lang ['desc'][ 33 ] = array ( 0 => 'By building a wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces defense.');
$lang ['desc'][ 34 ] = array ( 0 => 'The stonemason lodge is an expert at cutting stone. The further the building is extended, the higher the stability of the villages buildings.');
$lang ['desc'][ 35 ] = array ( 0 => 'Tasty mead is brewed in the brewery and later quaffed by the soldiers during the celebrations.

These drinks make your soldiers braver and stronger when attacking others (1% per level). Unfortunately, the chiefs’ power of persuasion is decreased and catapults can only do random hits.

It can only be built by Teutons and only in their capital. It affects the whole empire.');
$lang ['desc'][36]=array(0=>"The trapper protects your village with well-hidden traps. Enemies can be imprisoned and won't be able to harm your village any more. Troops imprisoned in traps eat crop from the village they originally belong to. ");

$lang ['desc'][ 37 ] = array ( 0 => 'In the heros mansion you can get an overview of the surrounding oasis. Starting with building level 10, you can occupy oases with your hero and increase the resource production of your village. ') ;
$lang ['desc'][ 38 ] = array ( 0 => 'Large warehouse accommodates 3 times more resources than a regular warehouse. ');
$lang ['desc'][ 39 ] = array ( 0 => 'Large granary accommodates 3 times more resources than a conventional granary . ');
$lang ['desc'][ 40 ] = array ( 0 => 'Wonder of the World is the crown of civilization. Only the most powerful and wealthy empire can build a work of art and successfully defend it from attacks by enemies. ');
$lang ['desc'][ 41 ] = array ( 0 => 'The horse drinking trough cares for the well-being of your horses and therefore increases the speed of their training.

The horse drinking trough reduces the crop usage for one for the following soldiers: Equites Legati from level 10, Equites Imperatoris from level 15 and Equites Caesaris from level 20.

The horse drinking trough can only be built by Romans..');
$lang ['desc'][ 42 ] = array ( 0 => 'By building a stone wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces\' defence.<br>The stone wall can only be built by Egyptians, its defence bonus is like the Gaulish Palisade and its durability is like the Teutonic earth wall.');
$lang ['desc'][ 43 ] = array ( 0 => 'By building a makeshift wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces defence.<br>The makeshift wall can only be built by Huns, its defence bonus is like the Teutonic earth wall and its durability is like the Roman city wall.');
$lang ['desc'][ 44 ] = array ( 0 => 'The Command Center protects the village against enemy conquests. You can build one Command Center per village. Settlers and Senators/Chiefs/Chieftains/Nomarchs/Logades can be trained there.');
$lang ['desc'][ 45 ] = array ( 0 => 'With the Waterworks you regulate the water flow to your oases. This not only helps growing trees and crops, but is also useful for quarries and mines supplying workers with water and transporting resources.<br>This building increases the bonus of all annexed oases. Its maximum effect on level 20 doubles the effect of oases.<br>The Waterworks can only be built by Egyptians.');

$lang['descs'][5]=array(0=>array(1,10),array(15,5));
$lang['descs'][6]=array(0=>array(2,10),array(15,5));
$lang['descs'][7]=array(0=>array(3,10),array(15,5));
$lang['descs'][8]=array(0=>array(4,5));
$lang['descs'][9]=array(0=>array(4,10),array(15,5));
$lang['descs'][12]=array(0=>array(22,1),array(15,3));
$lang['descs'][13]=array(0=>array(22,1),array(15,3));
$lang['descs'][14]=array(0=>array(16,15));
$lang['descs'][17]=array(0=>array(15,3),array(10,1),array(11,1));
$lang['descs'][19]=array(0=>array(16,1),array(15,3));
$lang['descs'][20]=array(0=>array(22,5),array(12,3));
$lang['descs'][21]=array(0=>array(22,10),array(15,5));
$lang['descs'][22]=array(0=>array(19,3),array(15,3));
$lang['descs'][24]=array(0=>array(15,10),array(22,10));
$lang['descs'][25]=array(0=>array(15,5));
$lang['descs'][26]=array(0=>array(18,1),array(15,5));
$lang['descs'][27]=array(0=>array(15,10));
$lang['descs'][28]=array(0=>array(17,20),array(20,10));
$lang['descs'][29]=array(0=>array(19,20));
$lang['descs'][30]=array(0=>array(20,20));
$lang['descs'][34]=array(0=>array(26,3),array(15,5));
$lang['descs'][35]=array(0=>array(11,20),array(16,10));
$lang['descs'][36]=array(array(16,1));
$lang['descs'][37]=array(0=>array(16,1),array(15,3));
$lang['descs'][38]=array(0=>array(15,10));
$lang['descs'][39]=array(0=>array(15,10));
$lang['descs'][41]=array(0=>array(20,20),array(16,10));
		$lang['fields'] = array (
							0 => '&nbsp;level',
							1 => 'Sawmill level',
							2 => 'Clay pit level',
							3 => 'Iron mine level',
							4 => 'Cropland level',
							5 => 'Outdoor construction site',
							6 => 'Construction site',
							7 => 'Construction site of the rally point');

		$lang['npc'] = array (
							0 => 'NPC merchant');

		$lang['upgrade'] = array (
                    		0 => 'The building is already at its maximum level',
							1 => 'The maximum level of the building is being built',		
							2 =>  'The building will be demolished',
							3 => '<b>The cost</b> of construction to level',
							4 => 'Workers are busy.',
							5 => 'Not enough food. Upgrade the cropland. ',
							6 => 'Build a warehouse.',
							7 => 'Build a granary.',
							8 => 'Enough resources will be',
							9 => '&nbsp;in&nbsp;&nbsp;',
							10 => 'Upgrade to level ',
							11 => 'Today',
							12 => 'Tomorrow');

		$lang['movement'] = array (
							0 => 'in&nbsp;');

		$lang['troops'] = array (
							0 => 'no',
							1 => 'Hero');

// Player statics


	define("PLAYERS_ACTIVE","Active players");
	define("PLAYERS_ONLINE","Players online");
	define("PLAYERS","Players");
	define("ACTIVE","Active");
	define("ONLINE","Online");


//NOTICES
define("REPORT_SUBJECT","Subject:");
define("REPORT_ATTACKER","Attacker");
define("REPORT_DEFENDER","Defender");
define("REPORT_RESOURCES","Resources");
define("REPORT_FROM_VIL","from village");
define("REPORT_FROM_ALLY","from ally");
define("REPORT_SENT","Sent on:");
define("REPORT_SENDER","Sender");
define("REPORT_RECEIVER","Receiver");
define("REPORT_AT","At");
define("REPORT_TO","To");
define("REPORT_SEND_RES","Send resources");
define("REPORT_DEL_BTN","Delete report");
define("REPORT_DEL_QST","Are you sure that you want to delete the report?");
define("REPORT_WARSIM","Combat simulator");
define("REPORT_ATK_AGAIN","Return on the attack");
define("REPORT_TROOPS","Troops");
define("REPORT_REINF","Reinforcement");
define("REPORT_CASUALTIES","Casualties");
define("REPORT_INFORMATION","Information");
define("REPORT_BOUNTY","Bounty");
define("REPORT_CLOCK","Time");
define("REPORT_UPKEEP","Upkeep");
define("REPORT_PER_HOURS","per hours");
define("REPORT_SEND_REINF_TO","Send reinforcement to village");
define("REPORT_NO","There are no reports available.");
define("REPORT1"," scouts ");
define("REPORT2"," attacks ");


define ("NGZ2", "Current construction time");
define ("NGZ3", "Construction time at level");


//CTENA
define ("C1", " City Wall Level");
define ("C2", " By building a City Wall you can protect your village against the barbarian hordes of your enemies. The higher the walls level, the higher the bonus given to your forces' defense.");
define ("C3", "Defense Bonus no");
define ("C4", "Defense Bonus at level");
define ("C5", " ");
define ("C6", " ");
define ("C7", "Earth Wall Level");
define ("C8", "Palisade Level");
define ("C9", "City Wall Level");

//CKLAD
define ("CK0", "Warehouse Level ");
define ("CK", " The resources wood, clay, and iron are stored in the warehouse. The higher the level, the larger the resource storage capacity. ");


//AMBAR
define ("AM", " Granary Level ");
define ("AM1", " The wheat from your wheat fields is stored in the granary. The higher the level, the larger the storage capacity.");

define ("AM4", "Capacity at level");

define("CAPACITY","Capacity");
define("CAPACITYA","Capacity at level");



//upgrade.php
define("UPG0","The building is on the highest level.");
define("UPG1","We construct the maximum level.");
define("UPG2","The building is on the demolition.");
define("UPG3","Cost");
define("UPG4"," Improvement to level ");
define("UPG5","All Workers are busy.");
define("UPG6","All Workers are busy. (Queue)");
define("UPG7","Do not miss a meal. Develop farm.");
define("UPG8","Develop Warehouse.");
define("UPG9","Develop Granary. ");
define("UPG10","Enough resources - Never");
define("UPG11","Upgrade to level ");
define("UPG12","Build with master builder ");


//отпраinка inойск
define("nap0","Reinforcement");
define("nap1","Normal attack");
define("nap2","Raid");



define ("PY1", "Movements to village ");
define ("PY2", "Overview");
define ("PY3", "Send troops");
define ("PY5", "Troops in village ");
define ("PY6", " Village");
define ("PY7", "Own Troops");
define ("PY8", "Troops ");
define ("PY9", "Upkeep ");
define ("PY10", "per hour ");
define ("PY11", "Send Back ");
define ("PY12", "Troops in another villages ");
define ("PY13", "Reinforcement For ");
define ("PY14", "Take back ");
define ("PY15", "Your troops movements ");
define ("PY16", "Evasion");
define ("PY17", "Farm List");
define ("PY18", "Oasis");
define ("PY19", "Troops in oases ");
define ("GOLDC","Gold Club");
//KAZARMA
define ("KA", " Barracks Level ");
define ("KA1", " All foot soldiers are trained in the barracks. The higher the level of the barracks, the faster the troops are trained.");
define ("KA2", "Barracks");
define ("KA3", "Training can commence when barracks are completed.");

//RYNOK
define ("RY", " Marketplace Level ");
define ("RY1", " At the marketplace, you can trade resources with other players. The higher its level, the more resources can be transported at the same time.");




//DVOREZ
define ("DV", " Palace Level ");
define ("DV1", " The king of the nation lives in the palace. The palace may only be built in the capital city. The higher the level, the more difficult it is for enemies to conquer the village.");
define("dvrc0","password is wrong");
define("dvrc1","In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.");
define("dvrc2","This is your capital");
define("dvrc3","Are you sure, that you want to change your capital?");
define("dvrc4","You can't undone this!");
define("dvrc5","For security you must enter your password to confirm:");
define("dvrc6","Change");
define("dvrc7","Palace under construction");
define("dvrc8","Password:");
define("dvrc9","Name");
define("dvrc10","Quantity");
define("dvrc11","Max");

//POSOLbSTVO
define("posl0","Alliance");
define("posl1","Tag");
define("posl2","Name");
define("posl3","To the alliance");
define("posl4","Invites");
define("posl5","Accept");
define("posl6","There are no invitations available");
define("posl7","Found alliance");
define("posl8","Create");

//masterskaya
define("mastr0","Units need to be researched");
define("mastr1","Train");
define("mastr2","Training");
define("mastr3","Duration");
define("mastr4","Finished");
define("mastr5","Total");

//REZA
define ("RE", " Residence Level ");
define ("RE1", " The residence is a small palace that the king lives in while he visits. The residence protects the village from being conquered by enemy forces. ");
define ("RE2", "This is your capital");
define ("RE3", "Residence");
define ("RE4", "Train");
define ("RE5", "Culture points");
define ("RE6", "Loyalty");
define ("RE7", "Expansion");
define("RE8","In order to expand your nation you need culture points. These accumulate over time from your buildings, and faster at higher levels.");
define("RE9","Production of this village:");
define("RE10","Culture points per day");
define("RE11","Production of all villages:");
define("RE12","Your villages have produced");
define("RE13","points in total. To found or conquer a new village you need");
define("RE14","points");
define("RE15","By attacking with senators, chiefs or chieftains a villages loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at");
define("RE16","Villages founded or conquered by this village");
define("RE17","Village");
define("RE18","Player");
define("RE19","Inhabitants");
define("RE20","Coordinatess");
define("RE21","Date");
define("RE22","No other village has been founded or conquered by this village yet.");
define("RE23","Training");
define("RE24","Duration");
define("RE25","Soon");
define("RE26","Train");
define("RE27","In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village, you need a level 10 or 20 residence and a senator, chief or chieftain.");

//AKADEM
define ("AK", " Academy Level ");
define ("AK1", " In the academy new unit types can be researched. By increasing its level, you can order the research of better units. ");
define ("AK2", "Academy");
define ("AK3", "There are no researches available");
define ("AK4", "Action");
define ("AK5", "Prerequisites");
define ("AK6", "show more");
define ("AK7", "hide more");
define ("AK8", "Research");

//MELNIZA
define ("ME", " Flour Mill Level ");
define ("ME1", " Wheat is milled into flour in the mill. Depending on the level, the mill can increase wheat production by up to 25 percent ");
define ("ME2", "");
define ("ME3", "");




//KON
define ("KO", " Stable Level ");
define ("KO1", " All mounted troops are trained in the stable. The higher the level, the faster the troops are trained. ");
define("KO2","No units available. Research at academy");
define("KO3", "Training can commence when great stables are completed.");
define("KZ333", "Training can commence when great barracks are completed.");


//GLAVNOE ZDANIE
define("gz0","Demolition of the building:");
define("gz1","If you no longer need a building, you can order the demolition of the building.");
define("gz2","Demolition of");
define("gz3","Finish all construction and research orders in this village immediately for 2 Gold?");
define("gz4","Destroy the building");

//COKRA
define ("CO", " Treasure Chamber Level ");
define ("CO1", " The riches of your empire are kept in the treasure chamber. Your treasure chamber has room for only one treasure. After you have captured an artefact, it takes 24 hours on a normal server and 12 hours on a 3x speed server for the artefact to become effective.");
define ("CO2", "");
define ("CO3", "");
define ("CO4", "");

//GHYGYN
define ("GH", " Iron Foundry Level ");
define ("GH1", " Iron is melted in the foundry. Depending on level, the foundry can increase iron production by up to 25 percent.");
define ("GH2", "Current iron bonus");
define ("GH3", "Iron bonus at level");
define ("GH4", "");

//KIRPIGH
define ("KI", " Brickworks Level ");
define ("KI1", " Clay is baked into bricks in the brickworks. Depending on level, the brickworks can increase clay production by up to 25 percent.");
define ("KI2", "Current clay bonus");
define ("KI3", "Clay bonus at level");
define ("KI4", "");
define ("KI5", "");
define ("KI6", "");

define ("CURB", "Current bonus");
define ("CURBL", "Bonus at level");
define("NOTDONEU","Build is not completed yet.");
define("SPEEDB","Current speed bonus");
define("SPEEDBL","Speed bonus at level");

//ратуша
define("ratusha0","Celebrations can commence when the town hall is completed.");
define("ratusha1","Celebrations");
define("ratusha2","Action");
define("ratusha3","Celebration");
define("ratusha4","in progress");
define("ratusha5","Crop production is negative so you will never reach the required resources");
define("ratusha6","Too few");
define("ratusha7","resources");
define("ratusha8","hold");
define("ratusha9","Great celebration (2000 culture points)");
define("ratusha10","Enough resources");
define("ratusha11","culture points");
define("ratusha12","Duration");
define("ratusha13","Finish");
define("ratusha14","Small Celebration");
define("ratusha15","");
define("ratusha16","");
define("ratusha17","");
define("ratusha18","");
define("ratusha19","");
define("ratusha20","");


//ARENA
define ("AR", " Tournament Square Level ");
define ("AR1", " At the tournament square, your troops can improve their stamina. The higher the level, the faster your troops will move once they are more than 30 fields away.");
define ("AR2", "");
define ("AR3", "");
define ("AR4", "");

//MASTERSKAI
define ("MA", " Siege Workshop Level ");
define ("MA1", "Siege weapons such as catapults and rams are produced in the siege workshop. The higher the level, the faster the units are produced. ");
define ("MA2", "");
define ("MA3", "");
define ("MA4", "");

//PEKARNIA
define ("PE", " Bakery Level ");
define ("PE1", " In the bakery, the flour from the mill is baked into bread. In conjunction with the mill, the bakery can raise wheat production by up to 50 percent. ");
define ("PE2", "");
define ("PE3", "");
define ("PE4", "");

//RATYSHA
define ("RAT", " City Hall Level ");
define ("RAT1", " You can host extravagant parties for your citizens at the city hall. These parties increase your number of culture points.");
define ("RAT2", "");
define ("RAT3", "");
define ("RAT4", "");

//PALATA
define ("PAL", " Trade Office Level ");
define ("PAL1", " The trade carts of your marketplace can be improved in the trade office. The higher the level, the more each merchant can carry. ");
define ("PAL2", "");
define ("PAL3", "");
define ("PAL4", "");

//VODOPOI
define ("VO", " Horse Drinking Trough Level ");
define ("VO1", " The horse drinking trough cares for the well-being of your horses, lowers their crop consumption and makes their training faster. Per level, the training time in your stable is reduced. ");
define ("VO2", "");
define ("VO3", "");
define ("VO4", "");


//BA
define ("BA", " Great Granary Level ");
define ("BA1", " In the granary the wheat produced by your farms is stored. The great granary offers you even more space to keep your wheat dry and safe and free from maggots. ");
define ("BA2", "");
define ("BA3", "");
define ("BA4", "");

//BK
define ("BK", " Great Warehouse Level ");
define ("BK1", " In your warehouse wood, clay and iron resources are stored. The great warehouse give you even more space to keep your resources dry and safe. ");
define ("BK2", "");
define ("BK3", "");
define ("BK4", "");
define ("BK5", "");

//PIVO
define ("PI", " Brewery Level ");
define ("PI1", " Tasty mead is brewed in the brewery and later quaffed by the soldiers during the celebrations. ");
define ("PI2", "");
define ("PI3", "");
define ("PI4", "");

//CHYDO
define ("CHY", " Wonder Of The World Level ");
define ("CHY1", " The wonder of the world represents the pride of creation. Only the mightiest and richest are able to build such a masterwork and defend it against envious enemies. ");
define ("CHY2", "");
define ("CHY3", "");
define ("CHY4", "");
define ("CHY5", "");

//KAZARMA BIG
define ("BIG", "Great Barracks Level ");
define ("BIG1", "The great barracks allows you to build more units at the same time but they cost thrice the original amount. ");
define ("BIG2", "");
define ("BIG3", "");
define ("BIG4", "");

//KONI BIG
define ("KONI ", "Great Stable Level ");
define ("KONI1", "The great stable allows you to build more units at the same time but they cost thrice the original amount. ");
define ("KONI2", "");
define ("KONI3", "");
define ("KONI4", "");

//KAPKAN
define ("KAP", "Trapper Level ");
define ("KAP1", "The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village anymore. ");
define ("KAP2", "");
define ("KAP3", "");
define ("KAP4", "");

//KYZNIA
define ("KY", " Armoury Level ");
define ("KY1", " In the armourys melting furnaces your warriors' armour is enhanced. By increasing its level you can order the fabrication of even better armour.");
define ("KY2", "");
define ("KY3", "");
define ("KY4", "");


//KYZNIZA
define ("KZ", " Blacksmith Level ");
define ("KZ1", " In the blacksmiths melting furnaces your warriors' weapons are enhanced. By increasing its level you can order the fabrication of even better weapons.");
define ("KZ2", "Upgrade");
define ("KZ3", "Blacksmith");
define ("KZ4", "Action");
define ("KZ5", "Upgrading");
define ("KZ6", "Duration");
define ("KZ7", "Complete");
define ("KZ8", "Upgrading<br>Blacksmith");
define ("KZ9", "Upgrading<br> in progress");

define ("oasis", "Oases");
define ("Namet", "Name");
define ("Quantityе", "Quantity");
define ("Maxе", "Max");
define ("Avaliablet", "Avaliable");
define ("TRA1", "Training");
define ("TRA2", "Duration");
define ("TRA3", "Finished");
define ("Workshop", "Workshop");
define ("RallyPoint", "Rally Point");
define ("Blacksmith", "Blacksmith");
define ("Armoury", "Armoury");
define ("Stable", "Stable");
define ("SendResouces", "Send Resouces");
define ("Buyma", "Buy");
define ("Offerma", "Offer");
define ("ONPCtrading", "NPC trading");
define ("ilior", "or");
define ("markgo", "go");
define ("Constructnewbuilding", "Construct new building");
define ("SOCR", "The riches of your empire are kept in the treasury. A treasury can only store one artefact. <br><br> You need a treasury level 10 for a small artefact, or level 20 for a great one.");
define ("mesotkogo", "Sender:");
define ("mestena", "Topic:");
define ("meskomy", "Recipient:");
//Самая жопа avaliable
define ("avaAcademy", "Academy");
define ("avaAcademy1", "In the academy new unit types can be researched. By increasing its level you can order the research of better units.");
define ("avaArmoury", "Armoury");
define ("avaArmoury1", "In the armoury melting furnaces your warriors; armour is enhanced. By increasing its level you can order the fabrication of even better armour.");
define ("avaCityWall", "City Wall");
define ("avaCityWall1", "By building a City Wall you can protect your village against the barbarian hordes of your enemies. The higher the walls level, the higher the bonus given to your forces' defense.");


define("ITEM0","Helmet of Awareness");
define("IEFF0","+15% more experience.");
define("ITEM1","Helmet of Enlightenment");
define("IEFF1","+20% more experience.");
define("ITEM2","Helmet of Wisdom");
define("IEFF2","+25% more experience.");
define("ITEM3","Helmet of Regeneration");
define("IEFF3","+10 health points/day");
define("ITEM4","Helmet of Healthiness");
define("IEFF4","+15 health points/day");
define("ITEM5","Helmet of Healing");
define("IEFF5","+20 health points/day");
define("ITEM6","Helmet of the Gladiator");
define("IEFF6","+100 Culture Points/day");
define("ITEM7","Helmet of the Tribune");
define("IEFF7","+400 Culture Points/day");
define("ITEM8","Helmet of the Consul");
define("IEFF8","+800 Culture Points/day");
define("ITEM9","Helmet of the Horseman");
define("IEFF9","Training time in stable reduced by 10%");
define("ITEM10","Helmet of the Cavalry");
define("IEFF10","Training time in stable reduced by 15%");
define("ITEM11","Helmet of the Heavy Cavalry");
define("IEFF11","Training time in stable reduced by 20%");
define("ITEM12","Helmet of the Mercenary");
define("IEFF12","Training time in barracks reduced by 10%");
define("ITEM13","Helmet of the Warrior");
define("IEFF13","Training time in barracks reduced by 15%");
define("ITEM14","Helmet of the Archon");
define("IEFF14","Training time in barracks reduced by 20%");
define("ITEM15","Armour of Regeneration");
define("IEFF15","+20 health points regeneration per day");
define("ITEM16","Armour of Health");
define("IEFF16","+30 health points regeneration per day");
define("ITEM17","Armour of Healing");
define("IEFF17","+40 health points regeneration per day");
define("ITEM18","Light scale Armour");
define("IEFF18","Damage reduced by 4 health points + 10 HP regeneration");
define("ITEM19","Scale Armour");
define("IEFF19","Damage reduced by 6 health points + 15 HP regeneration");
define("ITEM20","Heavy scale Armour");
define("IEFF20","Damage reduced by 8 health points + 20 HP regeneration");
define("ITEM21","Light Breast-plate");
define("IEFF21","+500 fighting strength for Hero");
define("ITEM22","Breast-plate");
define("IEFF22","+1000 fighting strength for Hero");
define("ITEM23","Heavy Breast-plate");
define("IEFF23","+1500 fighting strength for Hero");
define("ITEM24","Light Segmented-armour");
define("IEFF24","Damage reduced by 3;+250 fighting strength for Hero");
define("ITEM25","Segmented-armour");
define("IEFF25","  Damage reduced by 4;+500 fighting strength for Hero");
define("ITEM26","Heavy Segmented-armour");
define("IEFF26"," Damage reduced by 5;+750 fighting strength for Hero");
define("ITEM27","Small Map");
define("IEFF27","30% faster return");
define("ITEM28","Map");
define("IEFF28","40% faster return");
define("ITEM29","Large Map");
define("IEFF29","50% faster return");
define("ITEM30","Small Pennant");
define("IEFF30","30% faster troops between own villages");
define("ITEM31","Pennant");
define("IEFF31","40% faster troops between own villages");
define("ITEM32","Great Pennant");
define("IEFF32","50% faster troops between own village");
define("ITEM33","Small Standard");
define("IEFF33","15% faster troops between alliance members");
define("ITEM34","Standard");
define("IEFF34","20% faster troops between alliance members");
define("ITEM35","Great Standard");
define("IEFF35","25% faster troops between alliance members");
define("ITEM36","Pouch of the thief");
define("IEFF36","+10% plunder bonus");
define("ITEM37","Bag of the thief");
define("IEFF37","+15% plunder bonus");
define("ITEM38","Sack of the thief");
define("IEFF38","+20% plunder bonus");
define("ITEM39","Small shield");
define("IEFF39","+500 hero strength");
define("ITEM40","Shield");
define("IEFF40","+1000 hero strength");
define("ITEM41","Large shield");
define("IEFF41","+1500 hero strength");
define("ITEM42","Small horn of the Natarian");
define("IEFF42","+20% fighting strength against Natars");
define("ITEM43","Horn of the Natarian");
define("IEFF43","+25% fighting strength against Natars");
define("ITEM44","Large horn of the Natarian");
define("IEFF44","+30% fighting strength against Natars");
define("ITEM45","Short sword of the Legionnaire");
define("IEFF45","+500 to hero strength For every Legionnaire: +3 attack and +3 defence");
define("ITEM46","Sword of the Legionnaire");
define("IEFF46","+1000 to hero strength For every Legionnaire: +4 attack and +4 defence");
define("ITEM47","Long sword of the Legionnaire");
define("IEFF47","+1500 to hero strength For every Legionnaire: +5 attack and +5 defence");
define("ITEM48","Short sword of the Praetorian");
define("IEFF48","+500 to hero strength For every Praetorian: +3 attack and +3 defence");
define("ITEM49","Sword of the Praetorian");
define("IEFF49","+1000 to hero strength For every Praetorian: +4 attack and +4 defence");
define("ITEM50","Long sword of the Praetorian");
define("IEFF50","+1500 to hero strength For every Praetorian: +5 attack and +5 defence");
define("ITEM51","Short sword of the Imperian");
define("IEFF51","+500 to hero strength For every Imperian: +3 attack and +3 defence");
define("ITEM52","Sword of the Imperian");
define("IEFF52","+1000 to hero strength For every Imperian: +4 attack and +4 defence");
define("ITEM53","Long sword of the Imperian");
define("IEFF53","+1500 to hero strength For every Imperian: +5 attack and +5 defence");
define("ITEM54","Short sword of the Imperatoris");
define("IEFF54","+500 to hero strength For every Equites Imperatoris: +9 attack and +9 defence");
define("ITEM55","Sword of the Imperatoris");
define("IEFF55","+1000 to hero strength For every Equites Imperatoris: +12 attack and +12 defence");
define("ITEM56","Long sword of the Imperatoris");
define("IEFF56","+1500 to hero strength For every Equites Imperatoris: +15 attack and +15 defence");
define("ITEM57","Light lance of the Caesaris");
define("IEFF57","+500 to hero strength For every Equites Caesaris: +12 attack and +12 defence");
define("ITEM58","Lance of the Caesaris");
define("IEFF58","+1000 to hero strength For every Equites Caesaris: +16 attack and +16 defence");
define("ITEM59","Heavy lance of the Caesaris");
define("IEFF59","+1500 to hero strength For every Equites Caesaris: +20 attack and +20 defence");
define("ITEM60","Spear of the Phalanx");
define("IEFF60","+500 to hero strength For every Phalanx: +3 attack and +3 defence");
define("ITEM61","Pike of the Phalanx");
define("IEFF61","+1000 to hero strength For every Phalanx: +4 attack and +4 defence");
define("ITEM62","Lance of the Phalanx");
define("IEFF62","+1500 to hero strength For every Phalanx: +5 attack and +5 defence");
define("ITEM63","Short sword of the Swordsman");
define("IEFF63","+500 to hero strength For every Swordsman: +3 attack and +3 defence");
define("ITEM64","Sword of the Swordsman");
define("IEFF64","+1000 to hero strength For every Swordsman: +4 attack and +4 defence");
define("ITEM65","Long sword of the Swordsman");
define("IEFF65","+1500 to hero strength For every Swordsman: +5 attack and +5 defence");
define("ITEM66","Short-bow of the Theutates");
define("IEFF66","+500 to hero strength For every Theutates Thunder: +6 attack and +6 defence");
define("ITEM67","Bow of the Theutates");
define("IEFF67","+1000 to hero strength For every Theutates Thunder: +8 attack and +8 defence");
define("ITEM68","Long-bow of the Theutates");
define("IEFF68","+1500 to hero strength For every Theutates Thunder: +10 attack and +10 defence");
define("ITEM69","Staff of the Druidrider");
define("IEFF69","+500 to hero strength For every Druidrider: +6 attack and +6 defence");
define("ITEM70","Great staff of the Druidrider");
define("IEFF70","+1000 to hero strength For every Druidrider: +8 attack and +8 defence");
define("ITEM71","Fighting-staff of the Druidrider");
define("IEFF71","+1500 to hero strength For every Druidrider: +10 attack and +10 defence");
define("ITEM72","Light lance of the Haeduan");
define("IEFF72","+500 to hero strength For every Haeduan: +9 attack and +9 defence");
define("ITEM73","Lance of the Haeduan");
define("IEFF73","+1000 to hero strength For every Haeduan: +12 attack and +12 defence");
define("ITEM74","Heavy lance of the Haeduan");
define("IEFF74","+1500 to hero strength For every Haeduan: +15 attack and +15 defence");
define("ITEM75","Club of the Clubswinger");
define("IEFF75","+500 to hero strength For every Maceman: +3 attack and +3 defence");
define("ITEM76","Mace of the Clubswinger");
define("IEFF76","+1000 to hero strength For every Maceman: +4 attack and +4 defence");
define("ITEM77","Morning star of the Clubswinger");
define("IEFF77","+1500 to hero strength For every Maceman: +5 attack and +5 defence");
define("ITEM78","Spear of the Spearman");
define("IEFF78","+500 to hero strength For every Spearman: +3 attack and +3 defence");
define("ITEM79","Spike of the Spearman");
define("IEFF79","+1000 to hero strength For every Spearman: +4 attack and +4 defence");
define("ITEM80","Lance of the Spearman");
define("IEFF80","+1500 to hero strength For every Spearman: +5 attack and +5 defence");
define("ITEM81","Hatchet of the Axeman");
define("IEFF81","+500 to hero strength For every Axeman: +3 attack and +3 defence");
define("ITEM82","Axe of the Axeman");
define("IEFF82","+1000 to hero strength For every Axeman: +4 attack and +4 defence");
define("ITEM83","Battle axe of the Axeman");
define("IEFF83","+1500 to hero strength For every Axeman: +5 attack and +5 defence");
define("ITEM84","Light hammer of the Paladin");
define("IEFF84","+500 to hero strength For every Paladin: +6 attack and +6 defence");
define("ITEM85","Hammer of the Paladin");
define("IEFF85","+1000 to hero strength For every Paladin: +8 attack and +8 defence");
define("ITEM86","Heavy hammer of the Paladin");
define("IEFF86","+1500 to hero strength For every Paladin: +10 attack and +10 defence");
define("ITEM87","Short sword of the Teutonic Knight");
define("IEFF87","+500 to hero strength For every Teutonic Knight: +9 attack and +9 defence");
define("ITEM88","Sword of the Teutonic Knight");
define("IEFF88","+1000 to hero strength For every Teutonic Knight: +12 attack and +12 defence");
define("ITEM89","Long sword of the Teutonic Knight");
define("IEFF89","+1500 to hero strength For every Teutonic Knight: +15 attack and +15 defence");
define("ITEM90","Boots of Regeneration");
define("IEFF90","+10 health points/day");
define("ITEM91","Boots of Healthiness");
define("IEFF91","+15 health points/day");
define("ITEM92","Boots of Healing");
define("IEFF92","+20 health points/day");
define("ITEM93","Boots of the Mercenary");
define("IEFF93","+25% armys speed");
define("ITEM94","Boots of the Warrior");
define("IEFF94","+50% armys speed");
define("ITEM95","Boots of the Archon");
define("IEFF95","+75% armys speed");
define("ITEM96","Small spurs");
define("IEFF96","hero speed +3");
define("ITEM97","Spurs");
define("IEFF97","hero speed +4");
define("ITEM98","Nasty spurs");
define("IEFF98","hero speed +5");
define("ITEM99","Gelding");
define("IEFF99","Hero speed is 14");
define("ITEM100","Thoroughbred");
define("IEFF100","Hero speed is 17");
define("ITEM101","Warhorse");
define("IEFF101","Hero speed is 20");
define("ITEM102","Small bandage");
define("IEFF102","Can be healed , max 25%  Stackable");
define("ITEM103","Bandage");
define("IEFF103","Can be healed , max 33% Stackable");
define("ITEM104","Cage");
define("IEFF104","Animal can be caught in oasis Stackable");
define("ITEM105","Scroll");
define("IEFF105","Gives hero 10 experience Stackable");
define("ITEM106","Ointment");
define("IEFF106","Instantly heals hero by 1% Stackable");
define("ITEM107","Bucket");
define("IEFF107","Instantly ressurect your hero");
define("ITEM108","Book of Wisdom");
define("IEFF108","Redistributes hero skills");
define("ITEM109","Tablet of Law");
define("IEFF109","+1% loyalty in village, max 125% Stackable");
define("ITEM110","Artwork");
define("IEFF110","Instantly gives amount of CP, equal to daily production, but not more than 5000 Stackable");
define("ITEM111","");
define("IEFF111","");
define("ITEM112","");
define("IEFF112","");
define("ITEM113","");
define("IEFF113","");
define("ITEM114","");

// iRedux - New tribes items
define("ITEM115","Laminate Slave Militia");
define("IEFF115","+500 to hero strength For every Mulch Thinner: +3 attack and +3 defence");
define("ITEM116","Scepter stick marsha fluffy");
define("IEFF116","+1000 to hero strength For every Mulch Thinner: +4 attack and +4 defence");
define("ITEM117","Fluff mulcha star");
define("IEFF117","+1500 to hero strength For every Mulch Thinner: +5 attack and +5 defence");
define("ITEM118","Ash guard axe");
define("IEFF118","+500 to hero strength For every Ash Guard: +3 attack and +3 defence");
define("ITEM119","Ash guard better axe");
define("IEFF119","+1000 to hero strength For every Ash Guard: +4 attack and +4 defence");
define("ITEM120","Ashes guard war axe");
define("IEFF120","+1500 to hero strength For every Ash Guard: +5 attack and +5 defence");
define("ITEM121","Short Khopesh of the Warrior");
define("IEFF121","+500 to hero strength For every Khopesh Warrior: +3 attack and +3 defence");
define("ITEM122","Khopesh of the Warrior");
define("IEFF122","+1000 to hero strength For every Khopesh Warrior: +4 attack and +4 defence");
define("ITEM123","Long Khopesh of the Warrior");
define("IEFF123","+1500 to hero strength For every Khopesh Warrior: +5 attack and +5 defence");
define("ITEM124","Spear of the Anhor Guard");
define("IEFF124","+500 to hero strength For every Anhur Guard: +6 attack and +6 defence");
define("ITEM125","Spear of the Anhor Guard");
define("IEFF125","+1000 to hero strength For every Anhur Guard: +8 attack and +8 defence");
define("ITEM126","Lance of the Anhor Guard");
define("IEFF126","+1500 to hero strength For every Anhur Guard: +10 attack and +10 defence");
define("ITEM127","Short Bow of the Resheph Chariot");
define("IEFF127","+500 to hero strength For every Resheph Chariot: +9 attack and +9 defence");
define("ITEM128","Bow of the Resheph Chariot");
define("IEFF128","+1000 to hero strength For every Resheph Chariot: +12 attack and +12 defence");
define("ITEM129","Long Bow of the Resheph Chariot");
define("IEFF129","+1500 to hero strength For every Resheph Chariot: +15 attack and +15 defence");

define("ITEM130","Hatchet of the Mercenary");
define("IEFF130","+500 to hero strength For every Mercenary: +3 attack and +3 defence");
define("ITEM131","Axe of the Mercenary");
define("IEFF131","+1000 to hero strength For every Mercenary: +4 attack and +4 defence");
define("ITEM132","Battle Axe of the Mercenary");
define("IEFF132","+1500 to hero strength For every Mercenary: +5 attack and +5 defence");
define("ITEM133","Composite Short Bow of the Bowman");
define("IEFF133","+500 to hero strength For every Bowman: +3 attack and +3 defence");
define("ITEM134","Composite Bow of the Bowman");
define("IEFF134","+1000 to hero strength For every Bowman: +4 attack and +4 defence");
define("ITEM135","Composite Long Bow of the Bowman");
define("IEFF135","+1500 to hero strength For every Bowman: +5 attack and +5 defence");
define("ITEM136","Short Spatha Sword of the Steppe Rider");
define("IEFF136","+500 to hero strength For every Steppe Rider: +6 attack and +6 defence");
define("ITEM137","Spatha Sword of the Steppe Rider");
define("IEFF137","+1000 to hero strength For every Steppe Rider: +8 attack and +8 defence");
define("ITEM138","Long Spatha Sword of the Steppe Rider");
define("IEFF138","+1500 to hero strength For every Steppe Rider: +10 attack and +10 defence");
define("ITEM139","Composite Short Bow of the Marksman");
define("IEFF139","+500 to hero strength For every Marksman: +6 attack and +6 defence");
define("ITEM140","Composite Bow of the Marksman");
define("IEFF140","+1000 to hero strength For every Marksman: +8 attack and +8 defence");
define("ITEM141","Composite Long Bow of the Marksman");
define("IEFF141","+1500 to hero strength For every Marksman: +10 attack and +10 defence");
define("ITEM142","Short Spatha Sword of the Marauder");
define("IEFF142","+500 to hero strength For every Marauder: +9 attack and +9 defence");
define("ITEM143","Spatha Sword of the Marauder");
define("IEFF143","+500 to hero strength For every Marauder: +12 attack and +12 defence");
define("ITEM144","Long Spatha Sword of the Marauder");
define("IEFF144","+500 to hero strength For every Marauder: +15 attack and +15 defence");
define("HEROI0","Attributes");
define("HEROI1","Point");
define("HEROI2","attribute power tooltip");
define("HEROI3","Fighting Strength Combines with your heros defence and offense. The higher the Fighting strength the better in battle.");
define("HEROI4","Fighting Strength:");
define("HEROI5","from hero");
define("HEROI6","attribute power tooltip");
define("HEROI7","Fighting Strength Combines with your heros defence and offense. The higher the Fighting strength the better in battle.");
define("HEROI8","Fighting Strength:");
define("HEROI9","from hero +");
define("HEROI10","Attributes");
define("HEROI11","Fighting Strength");
define("HEROI12","Max");
define("HEROI13","Offence bonus gives a bonus when attacking.");
define("HEROI14","Offence Bonus");
define("HEROI15","Defence Bonus gives an extra bonus when attacked.");
define("HEROI16","Defence Bonus");
define("HEROI17","The Hero also gathers resources, the higher the level the more resources.");
define("HEROI18","Resources bonus :");
define("HEROI19","Resources");
define("HEROI20","Distribute");
define("HEROI21","Change the resources production of your Hero");
define("HEROI22","All resources");
define("HEROI23","Your hero regeneration:");
define("HEROI24","per day");
define("HEROI25","Health:");
define("HEROI26","The hero will revive in this village");
define("HEROI27","Not enough resources for hero revive");
define("HEROI28","Revive");
define("HEROI29","Hero will be ready in");
define("HEROI30","Duration");
define("HEROI31","Your hero need more");
define("HEROI32","Experience to reach level");
define("HEROI33","Experience:");
define("HEROI34","The Higher the Hero level , the more points you get.");
define("HEROI35","Hero level");
define("HEROI36","Your Heros speed determines how many fields he travels an hour");
define("HEROI37","Speed:");
define("HEROI38","Cases by hour");
define("HEROI39","Your hero will always stay with the troops.");
define("HEROI40","Hero will hide during an attack on their home village. ");
define("HEROI41","Hide hero:");
define("HEROI43","Hero production:");
define("HEROI44","Current regeneration of your hero: 20% per day");
define("HEROI45","Speed");
define("HEROI46","Speed of your hero");
define("HEROI47","Current production of your hero:");
define("HEROI48","Attributes:");
define("HEROI49","Please save your changes.");
define("HEROI50","Free points:");
define("HEROI51","Save changes");
define("HEROI53","The resources needed to restore the hero:");
define("HEROA0","Local");
define("HEROA1","Duration");
define("HEROA2","Difficulty");
define("HEROA3","Time remaining");
define("HEROA4","Link");
define("HEROA5","No adventure found.");
define("HEROA6","To the adventure.");
define("HEROA7","Forest");
define("HEROA8","Lake");
define("HEROA9","Mountain");
define("HEROA10","Ocean");
define("HEROF0","head");
define("HEROF1","colour of hair");
define("HEROF2","hair style");
define("HEROF3","ears");
define("HEROF4","eyebrows");
define("HEROF5","eyes");
define("HEROF6","nose");
define("HEROF7","mouth");
define("HEROF8","beard");
define("HEROAC0","Filter for Helmets");
define("HEROAC1","Filter for Body Items");
define("HEROAC2","Filter for Left-Hand Items");
define("HEROAC3","Filter for Right-Hand Items");
define("HEROAC4","Filter for Shoes");
define("HEROAC5","Filter for Horses");
define("HEROAC6","Filter for small Bandages");
define("HEROAC7","Filter for Bandages");
define("HEROAC8","Filter for Cages");
define("HEROAC9","Filter for Scrolls");
define("HEROAC10","Filter for Ointments");
define("HEROAC11","Filter for Buckets");
define("HEROAC12","Filter for Book of Wisdom");
define("HEROAC13","Filter for Tablets of Law");
define("HEROAC14","Filter for Artworks");
define("HEROAC15","Items not found.");
define("HEROAC16","Opened");
define("HEROAC17","Closed");
define("HEROAC18","Silver Shortage");
define("HEROAC19","Current bid:");
define("HEROAC20","The highest bidder:");
define("HEROAC21","New bid:");
define("HEROAC22","Bid");
define("HEROAC23","Auctions");
define("HEROAC24","No Bids Found.");
define("HEROAC25","Time");
define("HEROAC26","Won");
define("HEROAC27","Finished auctions");
define("HEROAC28","Select all");
define("HEROAC29","No Items Available.");
define("HEROAC30","Buy");
define("HEROAC31","Sell");
define("HEROAC32","Bids");
define("HEROAC33","No Items");
define("HEROAC34","For each unit");
define("HEROAC35","You currently have");
define("HEROAC36","items for sale in the auction (Maximum allowed at the same time is 5)");
define("HEROAC37","Finished auctions.");
define("HEROAC38","No sales found.");
define("HEROAC39","Really sell this item?");
define("HEROAC40","Sell &lt");
define("HEROAC41","Amount");
define("HEROAC42","Change Bid");
define("HEROAC43","Add bid");
define("HEROAC44","Per unit");

define("PRODUCTION_OVERVIEW","Production overview");
define("PRODUCTION_BONUS","Production bonus");
define("PRODUCTION_TOTAL_BONUS","Total bonus");
define("PRODUCTION_FIELD","Source");
define("PRODUCTION","Producão");
define("PRODUCTION_BONUS2","Bonus");
define("PRODUCTION_HP","Hero production");
define("PRODUCTION_BALANCE","Interim balance");
define("PRODUCTION_P25","+25% Production");
define("PRODUCTION_INACTIVE","Inactive");
define("PRODUCTION_TOTAL","Total");
define("PRODUCTION_PROD_TOTAL","Total production per hour:");
define("PRODUCTION_PROD_S1","Clay Pit Level");
define("PRODUCTION_PROD_S2","Woodcutter Level");
define("PRODUCTION_PROD_S3","Iron Mine Level");
define("PRODUCTION_PROD_S4","Cropland Level");
define("PRODUCTION_PROD_S5","Hourly production including production bonus: ");
define("PRODUCTION_PROD_S6","The production bonus increases the production of the resource in <span class=\"underlined\">all</span> your villages.");
define("PRODUCTION_PROD_T1","Sawmill Level");
define("PRODUCTION_PROD_T2","Oasis");
define("PRODUCTION_PROD_T3","Brickyard Level");
define("PRODUCTION_PROD_T4","Iron Foundry Level");
define("PRODUCTION_PROD_T5","Grain Mill Level");
define("PRODUCTION_PROD_T6","Bakery Level");

define("ESCAPE_GORIZ","Escape");
define("CAPTCHA_1","Click on the image for a new one");
define("PLUS_TIME_ENABLE","<p>Your plus account is active for <b><span id=\"timer100\">%s</span></b> day(s).</p>");
define("RENEW","Renew");
define("USERS_ACTIVE","Active users");
define("USERS_ONLINE","Online users");
define("USERS_TOTAL","Total users");
define("dorf1_links","Link list");
define("dorf1_activateplus","Activate plus account");
define("dorf1_villageNameBox_1","No marketplace");
define("dorf1_villageNameBox_2","Build marketplace");
define("dorf1_villageNameBox_3","No barracks");
define("dorf1_villageNameBox_4","Build barracks");
define("dorf1_villageNameBox_5","No stable");
define("dorf1_villageNameBox_6","Build stable");
define("dorf1_villageNameBox_7","There is no workshop in this village");
define("dorf1_villageNameBox_8","No workshop");
define("dorf1_villageNameBox_9","Go to marketplace");
define("dorf1_villageNameBox_10","Go to barracks");
define("dorf1_villageNameBox_11","Training in progress");
define("dorf1_villageNameBox_11n","No training in progress");
define("dorf1_villageNameBox_12","Go to stable");
define("dorf1_villageNameBox_13","Training in progress");
define("dorf1_villageNameBox_14","Go to workshop");
define("dorf1_villageNameBox_15","Training in progress");
define("dorf1_villageNameBox_16","Change the villages name");
define("dorf1_villageNameBox2_1"," Village statistics ");
define("dorf1_villageNameBox2_2"," Show coordinates ");
define("dorf1_villageNameBox2_4"," Hide coordinates ");
define("dorf1_villageNameBox2_3","Villages");
define("dorf1_villageNameBox2_5","Culture points generated to take control of another village:");
define("Link_desc_text_1" , "Travian Plus allows you to make a link list.");
define("infobox_desc_text_1" , "Info box");
define("Questbox_desc_text_1" , "Welcome");
define("Questbox_desc_text_2" , "Start quest");
define("LVL",'level');
define("SIDE_I_1","Aretefacs will be released in");
define("SIDE_I_2","");
define("SIDE_I_3","Aretefacts are released");
define("SIDE_I_4","<font style='font-size:11px;'>Building plans will be released in</font>");
define("SIDE_I_5","Building plans are released");
define("SIDE_I_6","Medals will be given in");
define("SIDE_I_7","");
define("CS"," Building area ");
define("UPGRADECOST","Costs for upgrading to level %s ");
define("SERVER_INFO","Server info");
define("MORE_ADVS_1","You should go on adventure");
define("MORE_ADVS_2","more times to be able to buy things");
define("WORLDWONDER","World wonder");
define("WAREHOUSE","Warehouse");
define("NO_FARM","Theres no farm till now!");
define("FARMLIST_FOOTER","<small>
Farm resources are calculated every ~30 seconds.<br>
Warehouse storage and Crop are equal in farms.<br>
The list is sorted by the time of creation of every item.<br>
</small>");
define("PROTECTION_TIME","You will be under beginner protection for <b><span class=\"timer\" counting=\"down\" value=\"%s\">%s</span></b>.");
define("ACCOUNT_DELETION","Your account will be deleted in <b><span id=\"timer100\">%s</span></b>");
define("Ally_dorf1","Alliance");
define("DIRECT_LINK","Direct link");
define("NO_PLUS_ESI","This option needs an active plus account");
define("NO_PLUS_ESI2","Go to shop");
define("NO_PLUS_ESI3","Go to market");

define("plus_goldcount","Gold");
define("buygold_DESC_1","Location");
define("buygold_DESC_2","Choose your location:");
define("buygold_DESC_3","Change");
define("buygold_DESC_4","Gold packages:");
define("buygold_DESC_5","Choose a package");
define("buygold_DESC_7","Payment gateways");
define("buygold_DESC_8","Should be chosen");
define("buygold_DESC_9","Prices are marked final");
define("buygold_DESC_10","Payments will be done immediately");
define("buygold_DESC_11","Buy gold");
define("buygold_DESC2_1","Choose another package");
define("buygold_DESC_6","Step 2 - Choose a package");
define("first_desc1" , "Choose a tribe");
define("first_desc2" , "Thanks for activating your account");
define("first_desc3" , "Choose a tribe to play on this server");
define("first_desc4" , "We recommend gauls if its your first travian experience");
define("first_Gauls_desc1" , "Gauls");
define("first_Gauls_desc2" , "Specifications:");
define("first_Gauls_desc3" , "Little time is required.");
define("first_Gauls_desc4" , "From the very beginning of the game are better defended against looting.");
define("first_Gauls_desc5" , "Roadway systems are excellent and fastest troops in the game.");
define("first_Gauls_desc6" , "The new players are the best choice.");
define("first_Roman_desc1" , "Romans");
define("first_Roman_desc2" , "Especially:");
define("first_Roman_desc3" , "Time management is necessary.");
define("first_Roman_desc4" , "They can expand faster than the rest of his village.");
define("first_Roman_desc5" , "The powerful army, but they are precious; implemented systems are very powerful.");
define("first_Roman_desc6" , "The race was very hard early game and this breed is not recommended for new players.");
define("first_Teutons_desc1" , "Teutons");
define("first_Teutons_desc2" , "Especially:");
define("first_Teutons_desc3" , "There is enough time for aggressive players.");
define("first_Teutons_desc4" , "Troops cheap it can be trained quickly and are good for loot.");
define("first_Teutons_desc5" , "For aggressive and experienced players.");
define("first_page_second_step_desc1" , "The village is the location of your choice.");
define("first_page_tribe1","The Romans");
define("first_page_tribe2","The Teutons");
define("first_page_tribe3","The Gauls");
define("first_page_tribe1_lead","Kvyntvs");
define("first_page_tribe2_lead","Henrik");
define("first_page_tribe3_lead","Ambyvryks");
define("first_Gauls_chosen_desc1" , "You chose %s. Since this your guide will be %s .");
define("first_Romans_chosen_desc1" , "You chose %s. Since this your guide will be %s .");
define("first_Teutons_chosen_desc1" , "You chose %s. Since this your guide will be %s .");
define("first_page_second_step_desc2" , "Change tribe");
define("first_page_second_step_desc3" , "We build your village or place can change your selection by clicking on the map.");
define("first_page_second_step_desc4" , "You will start in north-west");
define("first_page_second_step_desc5" , "You will start in north-east");
define("first_page_second_step_desc6" , "You will start in south-west");
define("first_page_second_step_desc7" , "You will start in south-east");
define("first_page_second_step_desc8" , "Create village");
define("BUILDINGS","Village center");
define("CHANGING_YOUR_VILLAGE_NAME","change Village Name");
define("NEW_NAME","new Village Name");
define("IS_ON_ADVENTURE","On an adventure");
define("MOVING_FROM","Moving from");
define("LN_TO","to");
define("SOME_CHANGES_DONE","Your changes will be undone. Sure to leave?");
define("MORE_INFO_25_BUTTON","More info about 25% extra resource production");
define("HEROFULLLVL","Your hero reached his/her max level.");
define("LN_QUEST","Quest");
define("SHOW_HINTS_PANEL","Show hints panel");
define("JR_CONSTRUCTION_PLANS_TITLE","WW Construction Plan");
define("JR_CONSTRUCTION_PLANS_VNAME","Construction Plan Village");
define("JR_CONSTRUCTION_PLANS_DESC","With this ancient construction plan you will able to build World Wonder to level 50. to build further, your alliance must hold at least two plans.");
define("JR_CONSTRUCTION_PLANS_RELEASE_TITLE","Construction Plans");
define("JR_CONSTRUCTION_PLANS_RELEASE_DESC","Many decades ago the tribes of travian were surprised by the unexpected return of jackass. This tribe of ancient wisdom, incomparable greatness and glory was about to disrupt free people again. Thus were made ??all efforts to prepare a final war against Natars and drive out forever. Many have thought about so-called \"Wonders of the World\", a legendary construction, as one solution. It was said that the end will make builders leaders and conquerors travian ");
define("JR_CONSTRUCTION_PLANS_RELEASE_TREASURY_DESC","However, you said that you will need a plan to build such a building. For this reason architects have designed clever ways to store them safely. After a while they could glimpse buildings like temples in many towns and cities - treasuries.");
define("JR_CONSTRUCTION_PLANS_RELEASE_MYTHS_DESC","Unfortunately, no one - not even the wise and experienced - have no idea where these plans could be found. The more people trying to find, the more seemed to be only myths.");
define("JR_CONSTRUCTION_PLANS_RELEASE_DISCOVERED_DESC","Today, however, this last secret will be discovered. Losses and past aspirations were vain as today scouts of several tribes have found the locations of these construction plans. Well guarded by the Natars, lie hidden in many oases scattered throughout the land travian. Only the bravest heroes will be able to capture such a plan and bring it home safely so that construction can begin.");
define("JR_CONSTRUCTION_PLANS_RELEASE_LINK_DESC","All information on the operation of the construction plans can be found on the servers.");
define("JR_HERE","Here");
define("JR_travian_TEAM","travian Team");
define("JR_CONTINUE","continue");
define("JR_ATTACK_COMBAT_MODEL","Combat Model");
define("JR_ATTACK_NORMAL","Normal attack");
define("JR_ATTACK_RAID","Raid");
define("JR_WARSIM_ATTACKER","Attacker");
define("JR_WARSIM_DEFENDERS","Defenders");
define("JR_WARSIM_ATTACKCONFIG","Attack configuration");
define("JR_WARSIM_SIMULATE","Simulate");
define("JR_POWERED_BY","Powered by Travian Pro Games");
define("JR_RIGHTS","All rights reserved");
define("JR_ZRAVIANX","TravianProX");
define("JR_COPYYEAR","&copy; 2011 - 2020");
define("JR_FOOTER_SPECIAL_S","<b>Developing by: <a href=\"404/\" target=\"_blank\" style=\"color:purple\">Travian Pro Games</a> (Developer & translator & designer)</b> <br/><br/> So many thanks to <a style=\"color:green\">Travian Pro Games</a>");
define("JR_NOT_ADMIN","Access Denied: You are not Admin!");
define("JR_ART_BPTTL","Ancient Construction Plan");
define("JR_ART_BPVN","WW Buildingplan");
define("JR_ART_BPDES",'With this ancient construction plan you will able to build World Wonder to level 50. to build further, your alliance must hold at least two plans.');
define('WILLACTIN','Will activate in');
define("JR_CATEGORY","Category");
define("JR_SELECT","Select");
define("JR_GENERALQUESTIONS","General Questions");
define("JR_ICANNOTLOGIN","I can not log in");
define("JR_ICANNOTREGISTER","I can not register");
define("JR_SEND","Send");
define("JR_REGISTERFIRST","Please, register account first.");
define("JR_HEROATTRIBUTES","Attributes");
define("JR_HEROAPPEARANCE","Appearance");
define("JR_HEROADVENTURE","Adventure");
define("JR_HEROAUCTION","Auction");
define("JR_HEROHEAD","head");
define("JR_HEROHAIRCOLOR","colour of hair");
define("JR_HEROHAIRSTYLE","hair style");
define("JR_HEROEARS","ears");
define("JR_HEROEYEBROWS","eyebrows");
define("JR_HEROEYES","eyes");
define("JR_HERONOSE","nose");
define("JR_HEROMOUTH","mouth");
define("JR_HEROBEARD","beard");
define("JR_HEROLOCATION","Local");
define("JR_HEROTIME","Duration");
define("JR_HERODIFFICULTY","Dificuldade");
define("JR_HEROTIMELEFT","Tempo Restante");
define("JR_HEROLINK","Link");
define("JR_HEROBIDERROR1","You dont have enough silver coin to buy this item. You should at least have");
define("JR_HEROBIDERROR2","coin(s)");
define("JR_HEROBIDERROR3","Not enopugh silver coins for bid.");
define("JR_HEROBIDERROR4","There is a larger bid.");
define("JR_HEROBIDERROR5","The auction is finished.");
define("JR_HEROBIDERROR6","The auction does not exist.");
define("JR_HEROEVASION","When checked hero will hide when village attacked.");
define("JR_HERODEADORNOTHERE","Your hero is dead, or (s)he is not in this village, so you can not use this item.");
define("HEROISDEAD","Hero is dead");
define("JR_HEROBUYITEMS","Buy Items");
define("JR_HEROSELLITEMS","Sell Items");
define("JR_HEROEXP","experience");
define("JR_HEROEXPGROW","experience gain");
define("JR_HEROEXPWILLBE","after use, experience will be");
define("JR_HEROCURRENTCP","Current cultural point");
define("JR_HEROCPVALUE","Cultural point");
define("JR_HEROCPAFTERUSE","Cultural point after use");
define("JR_HEROWANNAWEAR","Do you really want to wear this item?");
define("JR_HEROTIU","Total item used");


define("JR_SAVE","Save");

define("JR_FOREST","forest");
define("JR_FIELD","field");
define("JR_MOUNTAIN","mountain");
define("JR_SEA","sea");
define("JR_OK","Ok");

define("JR_CANCEL","Cancel");
define("JR_YES","Yes");
define("JR_NO","No");
define("NUM","No.");
define("JR_NOTFINISHED","Not Finished");
define("JR_CONSUMPTION","Consumption");

define("JR_MOW","Medals of the week");
define("JR_MEDALSCONFIRM","Confirm to give medals");
define("JR_MEDALSCONFIRMNOTE","Note: this will take time");
define("JR_CONFIRM","Confirm");
define("GENDER","Gender");
define("GENDER0","Not Specified");
define("GENDER1","Homem");
define("GENDER2","Mulher");

//logint4.4
define("logint40","Larger map||For this feature you need Travian Plus activated.");
define("logint41","Occupied");
define("logint42","Unoccupied");
define("logint43","Wilderness");
define("logint410"," Map center ");
define("logint411","Found new village");
define("logint412","Reports");
define("logint413","Player");
define("logint414","Tribe");
define("logint415","Alliance");
define("logint416","Owner");
define("logint417","Population");
define("logint418"," Bonuses ");
define("logint419"," Send troops ");

//pluspalladiys
define("pluss0","Shopping for gold in other ways (qiwi, webmoney, paypal) contact");
define("pluss1","administrator");
define("pluss2","After buying gold you must go to");
define("pluss3","Bank");
define("pluss4","There you will be able to transfer gold to any account on the server available partially or completely.");
define("pluss5","Buying Gold");
define("pluss6","Plus function");
define("pluss7","Description");
define("pluss8","Duration");
define("pluss9","Gold");
define("pluss10","Action");
define("pluss11","Account");
define("pluss12","Remaining");
define("pluss13","days");
define("pluss14","Exchange Office");
define("pluss15","Enter the amount of Gold or Silver you want to exchange.");
define("pluss16","Exchange rates");
define("pluss17","1 Gold : 100 Silver");
define("pluss18","2000 Silver : 1 Gold");
define("pluss19","exchange");
define("pluss20","ERRRRROOOOOOORRRRRRRRRRRRR");
define("pluss21","Buy Gold");
define("pluss22","Function");
define("pluss23","Make Gold");
define("pluss24","Exchange Gold and Silver");
define("pluss25","Acitvate");
define("pluss26","Extend");
define("pluss27","Needs Gold");
define("pluss28","Remaining");
define("pluss29","days");
define("pluss30","hours");
define("pluss31","minutes");
define("pluss32","You have");
define("pluss33","golds");
define("pluss34","Production: Lumber");
define("pluss35","Production: Clay");
define("pluss36","Production: Iron");
define("pluss37","Production: Crop");
define("pluss38","1:1 NPC");
define("pluss39","");
define("pluss40","");
define("pluss41","");
define("pluss42","");
define("pluss43","");
define("pluss44","");
define("pluss45","");

//herohome
define("herohero0","Attributes");
define("herohero1","Appearance");
define("herohero2","Adventure");
define("herohero3","Auctions");
define("herohero4","Buy item.");
define("herohero5","Sell item.");
define("herohero6","Random");

//ban_msg.tpl
define("yubnd","You have been banned. Please message Multihunter");

define("SOKI_1", "Adventure");
define("SOKI_2", "Units");
define("SOKI_3", "Arrival");
define("SOKI_4", "Start Adventure");
define("SOKI_5", "Warning");
define("SOKI_6", "Appeared scrolls");

define("attack1", "Resources");
define("attack2", "Infrastructure");
define("attack3", "Troops");
define("attack4", "Resources");
define("attack5", "Infrastructure");
define("attack6", "Troops");
define("attack7", "Diamond Chisel");
define("attack8", "Giant Marble Hammer)");
define("attack9", "Hemons Scrolls");
define("attack10", "Opal Horsesho");
define("attack11", "Golden Chariot");
define("attack12", "Pheidippides' Sandals");
define("attack13", "Tale of a Rat");
define("attack14", "Generals Letter");
define("attack15", "Diary of Sun Tzu");
define("attack16", "Scribed Soldiers Oath");
define("attack17", "Declaration of War");
define("attack18", "Memoirs of Alexander the Great");
define("attack19", "Great warehouse or great granary plan!");
define("attack20", "Wonder of the World builders!");
define("attack21", "confirm");

define("newdorf1", "Found new village");
define("newdorf2", "new");
define("newdorf3", "Found new village");
define("newdorf4", "troops");
define("newdorf5", "Duration");
define("newdorf6", "Resources");
define("newdorf7", "confirm");
define("newdorf8", "culture points");

define("search1", "Reinforcement");
define("search2", "Normal attack");
define("search3", "Raid");
define("search4", "Coordinations");
define("search5", "X"); // not sure if really needed lol
define("search6", "Y");
define("search7", "Confirm");

define("sendback1", "Send Home");
define("sendback2", "Send these troops back");
define("sendback3", "Units");
define("sendback4", "Time");
define("sendback5", "in");
define("sendback6", "to");
define("sendback7", "confirm");

define("startraid1", "You don't have enough troops!");


define("activated1", "register for the game");
define("activated2", "registration");

define("delete", "register for the game");
define("delete2", "delete");

define("allimenu1", "active");
define("allimenu2", "normal");
define("allimenu3", "News");
define("allimenu4", "Attacks");
define("allimenu5", "Options");

define("allidesc1", "Store");

define("assignpos1", "Assign");

define("attacker1", "There are no reports available");

define("defender1", "There are no reports available");

define("attacks1", "Military events");
define("attacks2", "Defender");
define("attacks3", "Attacker");

define("changepos0", "Name");
define("changepos1", "Assign");
define("changepos2", "Kick");
define("changepos3", "Change Description");
define("changepos4", "Alliance Diplomacy");
define("changepos5", "IGMs to the whole alliance");
define("changepos6", "Invite");
define("changepos7", "Position Name");

define("changediplo1", "None");

define("invite1", "No Invites");
define("invite2", "Refused");
define("invite3", "Invited");

define("kick1", "Go");

define("option1", "Go");

define("overvieww1", "Details");
define("overvieww2", "Position");
define("overvieww", "Members");


define("quitally1", "Quit");

define("bids1", "For each unit");
define("bids2", "Bids");
define("bids3", "Silver");
define("bids4", "Time");
define("bids5", "Del");

define("buy1", "silver");
define("buy2", "per unit");
define("buy3", "New bid");
define("buy4", "Offer");

define("build1", "Upgrade Warehouse");
define("build2", "Upgrade Granary");
define("build3", "Enough Resources");
define("build4", "Wheat production is negative, there will never be enough resources");
define("build5", "few resources");
define("build6", "Fully Developed");
define("build7", "Improve the blacksmith");
define("build8", "Research in progress");
define("build9", "development");
define("build10", "Unit");
define("build11", "Remaining time");
define("build12", "Finished");
define("build13", "Demolition of the building");
define("build14", "If you no longer need a building, you can order the demolition of the building");
define("build15", "Demolition of");
define("build16", "Finish all construction and research orders in this village immediately for 2 Gold?");
define("build17", "Destroy the building");
define("build18", "Kill");
define("build19", "The farm list is free, but only when the gold club available.");
define("build20", "Evasion settings");
define("build21", "Activate troop evasion for your capital.");
define("build22", "Attack on ");
define("build23", "Raid on ");
define("build24", "Reinforcement for ");
define("build25", "Troops");
define("build26", "Arrival");
define("build27", "in");
define("build28", "Return from ");
define("build29", "Reinforcement for ");
define("build30", "Return from ");
define("build31", "Return from ");
define("build32", "Return from cover ");
define("build33", "Oasis");
define("build34", "Cover");
define("build35", "Return from ");
define("build36", "Troops");
define("build37", "Stolen");
define("build38", "Arrival");
define("build39", "Attack on your");
define("build40", "Oasis");
define("build41", "Troops");
define("build42", "Arrival");
define("build43", "in");
define("build44", "Troops");
define("build45", "Consumption");
define("build46", "por hora");
define("build47", "Reinforcement for");
define("build48", "Scout");
define("build49", "Attack on");
define("build50", "Raid on");
define("build51", "Foundation of the Settlement");
define("build52", "Adventure");
define("build53", "Oasis");
define("build54", "Troops");
define("build55", "Merchants");
define("build56", "Fa");
define("build57", "Vas");
define("build58", "Wheat");
define("build59", "Coordinates");
define("build60", "Player");
define("build61", "duration");
define("build62", "Merchants");
define("build63", "Send Merchants");
define("build64", "Wheat");
define("build65", "Coordinates");
define("build66", "Each merchant can carry");
define("build67", "Send Resources");
define("build68", "No Coordinates selected");
define("build69", "You cannot send resources to the same village");
define("build70", "Player is Banned. You cannot send resources to him.");
define("build71", "Resources not selected.");
define("build72", "Enter coordinates or village name.");
define("build73", "Too few merchants.");
define("build74", "Merchants coming");
define("build75", "Transport from");
define("build76", "Arrival in");
define("build77", "Own merchants on the way");
define("build78", "Transport to");
define("build79", "Arrival in");
define("build80", "Resource");
define("build81", "Merchants returning");
define("build82", "Return from");
define("build83", "Arrival in");
define("build84", "Resource");
define("build85", "I'm searching");
define("build86", "I'm offering");
define("build87", "Offers at the marketplace");
define("build88", "Offered");
define("build89", "to me");
define("build90", "Wanted");
define("build91", "from me");
define("build92", "Player");
define("build93", "Duration");
define("build94", "Action");
define("build95", "Not Enough Resource");
define("build96", "Not Enough Merchant");
define("build97", "Accept offer");
define("build98", "There are no available offers on the market");
define("build99", "Offering");
define("build100", "Wood");
define("build101", "Clay");
define("build102", "Iron");
define("build103", "Crop");
define("build104", "max. time of transport");
define("build105", "hours");
define("build106", "Searching");
define("build107", "own alliance only");
define("build108", "Merchants");
define("build109", "Sell");
define("build110", "Offer");
define("build111", "Alliance");
define("build112", "Duration");
define("build113", " hrs.");
define("build114", "All");
define("build115", "NPC completed");
define("build116", "Cost 3");
define("build117", "Back to building");
define("build118", "NPC Trade");
define("build119", "Trade resources at (step 2 of 2)");
define("build120", "Costs");
define("build121", "You can't use NPC trade in WW village.");
define("build122", "Start");
define("build123", "Merchants");
define("build124", "Action");
define("build125", "No active trade routes");
define("build126", "edit");
define("build127", "Create new trade route");
define("build128", "Create trade route");
define("build129", "Target village");
define("build130", "Resources");
define("build131", "Start time");
define("build132", "Deliveries");
define("build133", "Edit trade route");
define("build134", "Resources");
define("build135", "Start time");
define("build136", "Deliveries");
define("build137", "Alliance");
define("build138", "Tag");
define("build139", "Name");
define("build140", "Invites");
define("build141", "Accept");
define("build142", "There are no invitations available");
define("build143", "found alliance");
define("build144", "Tag");
define("build145", "Name");
define("build146", "create");
define("build147", "Train");
define("build148", "Training");
define("build149", "No units available. Research at academy");
define("build150", "Available");
define("build151", "all");
define("build152", "Units need to be researched");
define("build153", "Train");
define("build154", "Units need to be researched");
define("build155", "Training");
define("build156", "Duration");
define("build157", "Finished");
define("build158", "Research can commence when academy is completed");
define("build159", "Expand warehouse");
define("build160", "Expand<br>warehouse");
define("build161", "Expand granary");
define("build162", "Expand<br>granary");
define("build163", "Enough resources");
define("build164", "Crop production is negative so you will never reach the required resources");
define("build165", "Too few");
define("build166", "resources");
define("build167", "Research in progress");
define("build168", "Researching");
define("build169", "Duration");
define("build170", "Complete");
define("build171", "hrs");
define("build172", "Currently hidden units per resource");
define("build173", "Hidden units per resource at level");
define("build174", "Celebrations can commence when the town hall is completed.");
define("build175", "Celebrations");
define("build176", "Action");
define("build177", "in progress");
define("build178", "at");
define("build179", "hold");
define("build180", "Great celebration (2000 culture points)");
define("build181", "Finish");
define("build182", "Party");
define("build183", "In order to expand your nation you need culture points. These accumulate over time from your buildings, and faster at higher levels..");
define("build184", "Production of this village");
define("build185", "Culture points per day");
define("build186", "Production of all villages");
define("build187", "Culture points per day");
define("build188", "Your villages have produced");
define("build189", "points in total. To found or conquer a new village you need");
define("build190", "points.");
define("build191", "By attacking with senators, chiefs or chieftains a villages loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at");
define("build192", "percent");
define("build193", "Villages founded or conquered by this village");
define("build194", "Village");
define("build195", "Player");
define("build196", "Inhabitants");
define("build197", "Coordinates");
define("build198", "Date");
define("build199", "No other village has been founded or conquered by this village yet.");
define("build200", "training");
define("build201", "period");
define("build202", "ready");
define("build203", "on");
define("build204", "Train");
define("build205", "In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village you need a level 10 or 20 residence and a senator, chief or chieftain.");
define("build206", "password is wrong");
define("build207", "This is your capital");
define("build208", "change capital");
define("build209", "Are you sure, that you want to change your capital?<br/><b>You can't undone this!</b>.<br/>For security you must enter your password to confirm");
define("build210", "Change");
define("build211", "Palace under construction");
define("build212", "In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.");
define("build213", "Your Artefacts");
define("build214", "Title");
define("build215", "Village");
define("build216", "Captured");
define("build217", "You have no Artefacts");
define("build218", "Diamond Chisel");
define("build219", "The buildings are more durable against attacks by catapults and rams. Does not count for the Wonder of the World, but the account wide and unique type count for all other buildings in the Wonder of the World village.");
define("build220", "Giant Marble Hammer");
define("build221", "The buildings are more durable against attacks by catapults and rams. Does not count for the Wonder of the World, but the account wide and unique type count for all other buildings in the Wonder of the World village.");
define("build222", "Hemons Scrolls");
define("build223", "The buildings are more durable against attacks by catapults and rams. Does not count for the Wonder of the World, but the account wide and unique type count for all other buildings in the Wonder of the World village.");
define("build224", "Opal Horseshoe");
define("build225", "The troops travel faster.");
define("build226", "Golden Chariot");
define("build227", "The troops travel faster.");
define("build228", "Pheidippides' Sandals");
define("build229", "The troops travel faster.");
define("build230", "Tale of a Rat");
define("build231", "The Scouts, Equites Legati and Pathfinders are better at spying, and defending against spy attacks. All scouts in the village/account as well as all scouts sent for spying from this village/account are affected. However, scouts deployed as reinforcements to villages not covered by the Artefact are not affected. Additionally, you can see the type of troops attacking you at your rally point, but not the amount of troops.");
define("build232", "Generals Letter");
define("build233", "The Scouts, Equites Legati and Pathfinders are better at spying, and defending against spy attacks. All scouts in the village/account as well as all scouts sent for spying from this village/account are affected. However, scouts deployed as reinforcements to villages not covered by the Artefact are not affected. Additionally, you can see the type of troops attacking you at your rally point, but not the amount of troops.");
define("build234", "Diary of Sun Tzu");
define("build235", "The Scouts, Equites Legati and Pathfinders are better at spying, and defending against spy attacks. All scouts in the village/account as well as all scouts sent for spying from this village/account are affected. However, scouts deployed as reinforcements to villages not covered by the Artefact are not affected. Additionally, you can see the type of troops attacking you at your rally point, but not the amount of troops.");
define("build236", "Silver Platter");
define("build237", "The troops consume less crop.");
define("build238", "Sacred Hunting Bow");
define("build239", "The troops consume less crop.");
define("build240", "King Arthurs Chalice");
define("build241", "The troops consume less crop.");
define("build242", "Scribed Soldiers Oath");
define("build243", "The troops are trained faster.");
define("build244", "Declaration of War");
define("build245", "The troops are trained faster.");
define("build246", "Memoirs of Alexander the Great");
define("build247", "The troops are trained faster.");
define("build248", "Great warehouse or great granary plan");
define("build249", "Grants ability to build great warehouse or great granary..");
define("build250", "Access to Buildings");
define("build251", "Map of the Hidden Caverns");
define("build252", "Artefact raises cranny capacity and additionally causes enemy catapult attacks to fire randomly. World Wonder can always be targeted and hit.");
define("build253", "Bottomless Satchel");
define("build254", "Artefact raises cranny capacity and additionally causes enemy catapult attacks to fire randomly. World Wonder can always be targeted and hit.");
define("build255", "Trojan Horse");
define("build256", "Artefact raises cranny capacity and additionally causes enemy catapult attacks to fire randomly. World Wonder can always be targeted and hit.");
define("build257", "Pendant of Mischief");
define("build258", "This artifact changes its effect every 24 hours, and can get any of the effects of other artifacts except building plans for World Wonders, Great Granaries, and Great Warehouses. Also the effect scope is randomly decided between account and village wide every 24 hours.");
define("build259", "Accidentally");
define("build260", "Forbidden Manuscrip");
define("build261", "This artifact changes its effect every 24 hours, and can get any of the effects of other artifacts except building plans for World Wonders, Great Granaries, and Great Warehouses. Also the effect scope is randomly decided between account and village wide every 24 hours.");
define("build262", "Aaccidentally");
define("build263", "Building scroll Wonder of the World");
define("build264", "Artifact needed to build Wonder");
define("build265", "Access to Buildings");
define("build266", "Village");
define("build267", "Account");
define("build268", "Treasury");
define("build269", "Influence");
define("build270", "Nearest artifacts");
define("build271", "Title");
define("build272", "Player");
define("build273", "Distance");
define("build274", "Nearest artifacts missing.");
define("build275", "Diamond Chisel");
define("build276", "Giant Marble Hammer");
define("build277", "Hemons Scrolls");
define("build278", "Opal Horseshoe");
define("build279", "Golden Chariot");
define("build280", "Pheidippides' Sandals");
define("build281", "Tale of a Rat");
define("build282", "Generals Letter");
define("build283", "Diary of Sun Tzu");
define("build284", "Scribed Soldiers Oath");
define("build285", "Declaration of War");
define("build286", "Memoirs of Alexander the Great");
define("build287", "Great warehouse or great granary plan");
define("build288", "Access to Buildings");
define("build289", "Building scroll Wonder of the World");
define("build290", "Access to Buildings");
define("build291", "Village");
define("build292", "Account");
define("build293", "Distance");
define("build294", "Effect");
define("build295", "Small artifacts");
define("build296", "Title");
define("build297", "Player");
define("build298", "Alliance");
define("build299", "There are no artifacts.");
define("build300", "Diamond Chisel");
define("build301", "Opal Horseshoe");
define("build302", "Tale of a Rat");
define("build303", "Scribed Soldiers Oath");
define("build304", "Great warehouse or great granary plan");
define("build305", "Access to Buildings");
define("build306", "Building scroll Wonder of the World");
define("build307", "Access to Buildings");
define("build308", "Treasury");
define("build309", "Effect");
define("build310", "Village");
define("build311", "Large artifacts");
define("build312", "Title");
define("build313", "Player");
define("build314", "Alliance");
define("build315", "Giant Marble Hammer");
define("build316", "Hemons Scrolls");
define("build317", "Golden Chariot");
define("build318", "Pheidippides' Sandals");
define("build319", "Generals Letter");
define("build320", "Diary of Sun Tzu");
define("build321", "Declaration of War");
define("build322", "Memoirs of Alexander the Great");
define("build323", "Great warehouse or great granary plan");
define("build324", "Access to Buildings");
define("build325", "Account");
define("build326", "There are no artifacts.");
define("build327", "Treasury");
define("build328", "Effect");
define("build329", "Small Artefacts");
define("build330", "Large Artefacts");
define("build331", "Village");
define("build332", "Account");
define("build333", "Not Active");
define("build334", "Active");
define("build335", "Diamond Chisel");
define("build336", "The buildings are more durable against attacks by catapults and rams. Does not count for the Wonder of the World, but the account wide and unique type count for all other buildings in the Wonder of the World village.");
define("build337", "Giant Marble Hammer");
define("build338", "The buildings are more durable against attacks by catapults and rams. Does not count for the Wonder of the World, but the account wide and unique type count for all other buildings in the Wonder of the World village.");
define("build339", "Hemons Scrolls");
define("build340", "The buildings are more durable against attacks by catapults and rams. Does not count for the Wonder of the World, but the account wide and unique type count for all other buildings in the Wonder of the World village.");
define("build341", "Opal Horseshoe");
define("build342", "The troops travel faster.");
define("build343", "Golden Chariot");
define("build344", "The troops travel faster.");
define("build345", "Pheidippides' Sandals");
define("build346", "The troops travel faster.");
define("build347", "Tale of a Rat");
define("build348", "The Scouts, Equites Legati and Pathfinders are better at spying, and defending against spy attacks. All scouts in the village/account as well as all scouts sent for spying from this village/account are affected. However, scouts deployed as reinforcements to villages not covered by the Artefact are not affected. Additionally, you can see the type of troops attacking you at your rally point, but not the amount of troops.");
define("build349", "Generals Letter");
define("build350", "The Scouts, Equites Legati and Pathfinders are better at spying, and defending against spy attacks. All scouts in the village/account as well as all scouts sent for spying from this village/account are affected. However, scouts deployed as reinforcements to villages not covered by the Artefact are not affected. Additionally, you can see the type of troops attacking you at your rally point, but not the amount of troops.");
define("build351", "Diary of Sun Tzu");
define("build352", "The Scouts, Equites Legati and Pathfinders are better at spying, and defending against spy attacks. All scouts in the village/account as well as all scouts sent for spying from this village/account are affected. However, scouts deployed as reinforcements to villages not covered by the Artefact are not affected. Additionally, you can see the type of troops attacking you at your rally point, but not the amount of troops.");
define("build353", "Scribed Soldiers Oath");
define("build354", "The troops are trained faster.");
define("build355", "Declaration of War");
define("build356", "Memoirs of Alexander the Great");
define("build357", "Great warehouse or great granary plan");
define("build358", "Grants ability to build great warehouse or great granary..");
define("build359", "Access to Buildings");
define("build360", "Building scroll Wonder of the World");
define("build361", "Artifact needed to build Wonder");
define("build362", "Access to Buildings");
define("build363", "Owner");
define("build364", "Village");
define("build365", "Alliance");
define("build366", "Effect");
define("build367", "Bonus");
define("build368", "Activity");
define("build369", "Stored in");
define("build370", "Treasury");
define("build371", "Level");
define("build372", "Captured");
define("build373", "Current merchant load");
define("build374", "Merchant load at level");
define("build375", "Merchant load at level 20");
define("build376", "Train");
define("build377", "Training can commence when great barracks are completed.");
define("build378", "Available");
define("build379", "Training can commence when great stables are completed.");
define("build380", "Training");
define("build381", "Duration");
define("build382", "Finished");
define("build383", "First train cavalry units in the Academy.");
define("build384", "Current stability bonus");
define("build385", "Actual bonus");
define("build386", "Bonus to level");
define("build387", "Festivity");
define("build388", "Action");
define("build389", "Holiday");
define("build390", "during");
define("build391", "Resources will be sufficient");
define("build392", "Not enough grain.");
define("build393", "Not enough");
define("build394", "resources");
define("build395", "celebrate");
define("build396", "The holiday lasts");
define("build397", "Will be completed");
define("build398", "Currect maximum traps to train");
define("build399", "Traps");
define("build400", "Maximum traps to train at level");
define("build401", "Maximum traps to train at level 20");
define("build402", "Your currently have");
define("build403", "Available");
define("build404", "Make");
define("build405", "Training can commence when trapper are completed.");
define("build406", "Oasis occupied by");
define("build407", "village");
define("build408", "Type");
define("build409", "Hűség");
define("build410", "Conquered");
define("build411", "Coordinates");
define("build412", "Resources");
define("build413", "1. Next Oasis from Hero´s Mansion Level 10");
define("build414", "2. Next Oasis from Hero´s Mansion Level 15");
define("build415", "3. Next Oasis from Hero´s Mansion Level 20");
define("build416", "2. Next Oasis from Hero´s Mansion Level 15");
define("build417", "3. Next Oasis from Hero´s Mansion Level 20");
define("build418", "3. Next Oasis from Hero´s Mansion Level 20");
define("build419", "Other oases");
define("build420", "Owner");
define("build421", "Village");
define("build422", "Coordinates");
define("build423", "Resource");
define("build424", "Current capacity");
define("build425", "units");
define("build426", "Capacity at level");
define("build427", "Cost");
define("build428", "Workers are working");
define("build429", "Food shortages: first upgrade Cropland!");
define("build430", "Upgrade warehouse.");
define("build431", "Upgrade Granary.");
define("build432", "Enough resources at");
define("build433", "Construct building");
define("build434", "Queue");
define("build435", "Construct building");
define("build436", "Architect");
define("build437", "Construction of new building");
define("build438", "View constructions available soon");
define("build439", "Required");
define("build440", "Level");
define("build441", "The building is at the maximum level.");
define("build442", "Constructed maximum level.");
define("build443", "The building is on the demolition.");
define("build444", "Costs");
define("build445", "to build up to the level");
define("build446", "All Workers are busy");
define("build447", "All Workers are busy. (Queue)");
define("build448", "A shortage of food.Build more farms.");
define("build449", "Build Warehouse.");
define("build450", "Build Granary.");
define("build451", "Never will be enough resources");
define("build452", "enough resources");
define("build453", "Increase the level of");
define("build454", "turn");
define("build455", "Architect");
define("build456", "Wonder of the World");
define("build457", "Level");
define("build459", "You need to have World Wonder level 1 to be able to change its name.");
define("build460", "World Wonder name");
define("build461", "You can not change the name of the World Wonder after level 10.");
define("build462", "Name changed.");
define("build463", "The building is at the maximum level.");
define("build464", "Constructed maximum level.");
define("build465", "The building is on the demolition.");
define("build466", "Costs");
define("build467", "to build up to the level");
define("build468", "All Workers are busy.");
define("build469", "All Workers are busy. (Queue)");
define("build470", "A shortage of food.Build more farms.");
define("build471", "Build Warehouse.");
define("build472", "Build Granary.");
define("build473", "enough resources");
define("build474", "in");
define("build475", "Increase the level of");
define("build476", "Architect");
define("build477", "Need WW construction plan.");
define("build478", "Need more WW construction plan.");

define("dorf31", "Village");
define("dorf32", "Village");
define("dorf33", "Building");
define("dorf34", "Troops");
define("dorf35", "Merchants");
define("dorf36", "Resources");
define("dorf37", "Sum");
define("dorf38", "Warehouse");
define("dorf39", "Culture points");
define("dorf310", "CP/day");
define("dorf311", "Celebrations");
define("dorf312", "Troops");
define("dorf313", "Slots");
define("dorf314", "Own troops");
define("dorf315", "CP");
define("dorf316", "Attacks");

define("gclub0", "Village");
define("gclub1", "on");
define("gclub2", "Distance");
define("gclub3", "Troops");
define("gclub4", "LastRaid");
define("gclub5", "There is no any raid list.");
define("gclub6", "Oasis");
define("gclub7", "edit");
define("gclub8", "Select All");
define("gclub9", "Add Raid");
define("gclub10", "Start Raid");
define("gclub11", "Are you sure that you want to delete this list?"); //farmlist.php line 225, not sure if it will work
define("gclub12", "Details");
define("gclub13", "Create a new list");
define("gclub14", "Name");
define("gclub15", "Village");
define("gclub16", "Create");
define("gclub17", "There is no village on those coordinates.");
define("gclub18", "You can not add to the list of village in which you are.");
define("gclub19", "No troops has been selected.");
define("gclub20", "Enter the correct coordinates.");
define("gclub21", "Add Slot");
define("gclub22", "Farm Name");
define("gclub23", "Select target");
define("gclub24", "This is not your list!");
define("gclub25", "There is no village on those coordinates.");
define("gclub26", "You can not add to the list of village in which you are.");
define("gclub27", "Enter the correct coordinates.");
define("gclub28", "No troops has been selected.");
define("gclub29", "Enter the correct coordinates.");
define("gclub30", "Delete");

define("map1", "Centre map");
define("map2", "Found new village");
define("map3", "Szabad oázis kifosztása");
define("map4", "Distribution:");
define("map5", "Troops");
define("map6", "Player");
define("map7", "Tribe");
define("map8", "Alliance");
define("map9", "Owner");
define("map10", "Population");
define("map11", "Reports");

define("msg0", "Topic");
define("msg1", "Player");
define("msg2", "Sent");
define("msg3", "There are no messages available.");
define("msg4", "Check All");
define("msg5", "Delete");
define("msg6", "Inbox");
define("msg7", "Write");
define("msg8", "Sent");
define("msg9", "There is no message.");
define("msg10", "Recipient");
define("msg11", "Suject");
define("msg12", "Send");

define("notice0", "from the village");
define("notice1", "Troops");
define("notice2", "lost");
define("notice3", "prisoners");
define("notice4", "Information");
define("notice5", "defense");
define("notice6", "reinforcement");
define("notice7", "attack");
define("notice8", "from the village");
define("notice9", "Posted");
define("notice10", "in");
define("notice11", "sender");
define("notice12", "from the village");
define("notice13", "Troops");
define("notice14", "Troops");
define("notice15", "Information");
define("notice16", "Resources obtained from");
define("notice17", "Posted");
define("notice18", "from the village");
define("notice19", "Resources");
define("notice20", "in village");
define("notice21", "scouts");
define("notice22", "There are no reports");
define("notice23", "Check all");
define("notice24", "Delete");

define("plus0", "buy GOLD");
define("plus1", "Price");
define("plus2", "number");
define("plus3", "Buy");
define("plus4", "Tarif");
define("plus5", "Buy");
define("plus6", "SPECIAL");
define("plus7", "Gold Price");
define("plus8", "Price");
define("plus9", "Amount");
define("plus10", "Buy(PayPal)");
define("plus11", "Tarif");
define("plus12", "Buy");
define ("plus13", "Purchase of gold for another amount (UnitPay) (Rus)");
define ("plus14", "Payment Amount");
define ("plus15", "Total");
define ("plus16", "* When buying gold worth more than 300 rubles, gold is more profitable than the tariffs!");
define ("plus17", "in case of an inquire, please contact");
define ("plus18", "Administrator");
define ("plus19", "After purchasing gold, you must go in");
define ("plus20", "Bank");
define ("plus21", "There you will be able to Transfer Gold to any account (s) on an available server in part or in full.");
define ("plus22", "rubles");
define ("plus23", "Bank (mini version)");
define ("plus24", "This is where the purchased / moved gold from previous rounds is stored. (If the balance exceeds 100 coins) <br /> inyou can transfer it to <s> any other account </s> <b> in your account </ b> (mini-version) within xTravian.net ");
define ("plus25", "inindete your Gold transfer code.");
define ("plus26", "(It was sent to your E-mail.)");
define ("plus27", "E-mail not found!");
define ("plus28", "Code accepted!");
define ("plus29", "Available for the translation");
define ("plus30", "gold");
define ("plus31", "Gold to the translation");
define ("plus32", "Playful Nick");
define ("plus33", "Code is Inefficient!");
define ("plus34", "Something went wrong. <br /> Please try again.");
define ("plus35", "Player");
define ("plus36", "Found");
define ("plus37", "Player ID");
define ("plus38", "Will be redirected");
define ("plus39", "gold");
define ("plus40", "Player not found");
define ("plus41", "Back");
define ("plus42", "Something went wrong. <br /> Please try again.");
define ("plus43", "Gold Moved Successfully!");
define ("plus44", "Something went wrong. <br /> Please try again.");
define ("plus45", "E-mail");
define ("plus46", "Full inversion");
define ("plus47", "Invite friends and win gold!");
define ("plus48", "Send in your friend and your personal Ref-link");
define ("plus49", "Favorable conditions for receiving the award");
define ("plus50", "1.As soon as the population of the empire of the player invited in by us is in higher");
define ("plus51", "in you can take it");
define ("plus52", "I'll click on the icon for gold");
define ("plus53", "2.in you cannot be a substitute for the invited player.");
define ("plus54", "Referred Players");
define ("plus55", "Player");
define ("plus56", "Registration Date");
define ("plus57", "Population");
define ("plus58", "Dereinny");
define ("plus59", "Pick up");
define ("plus60", "You have not brought in any new players yet.");
define ("plus61", "Top Referrerin");
define ("plus62", "Location");
define ("plus63", "Player");
define ("plus64", "Exchange Office");
define ("plus65", "Enter the amount of Gold or Silver you want to exchange");
define ("plus66", "Exchange rates");
define ("plus67", "1 Gold: 100 Silver <br> 2000 Silver: 1 Gold");
define ("plus68", "exchange");
define ("plus69", "Trainian");
define ("plus74", "Buy Gold");
define ("plus75", "Functions");
define ("plus76", "Earn gold");
define ("plus77", "Bank");

define ("other0", "you are blocked. Write a letter to the administrator");
define ("other1", "Travianprox.com");
define ("other2", "Finish");
define ("other3", "Completed in");
define("other4", "Level");
define("other5", "Outer building site");
define("other6", "WorldWonder");
define("other7", "Building Site");
define("other8", "Rally Point building site");
define("other9", "Construction Site");
define("other10", "in контакте");
define("other11", "Facebook");
define("other12", "Adventure");
define("other13", "hours of protection.");
define("other14", "The account will be deleted in");
define ("other15", "Artifacts");
define ("other16", "Wonder of the Country");
define ("other17", "Links through");
define ("other18", "Change Language to Russian");
define ("other19", "Change language into English");
define ("other20", "Production");
define ("other21", "None");
define ("other22", "Click for");
define ("other23", "construction by clicking on the field");

// пункт сбора
define ("punktxuev0", "Resources");
define ("punktxuev1", "Infrastructure");
define ("punktxuev2", "Military");
define ("punktxuev3", "Confirm");
define ("punktxuev4", "Start adventure");
define ("punktxuev5", "Troops");
define ("punktxuev6", "Arrival");
define ("punktxuev7", "Your hero is not in this village yet.");
define ("punktxuev8", "Your hero is dead.");
define ("punktxuev9", "You need to build rally point.");
define ("punktxuev10", "Send Home");
define ("punktxuev11", "Send these troops back");
define ("punktxuev12", "Units");
define ("punktxuev13", "time");
define ("punktxuev14", "Not enough troops!");

//актиinация
define("activate0","To play you need to activate your account.");
define("activate1","Activation code:	");
define("activate2","Activate and start the game");
define("activate3","Mistype E-mail or username?");
define("activate4","Here, you can unregister and re-register.");
define("activate5","Your E-Mail:");
define("activate6","Your Login:");
define("activate7","Your Password:");
define("activate8","Check the accuracy of the entered data.");
define("activate9","Make sure that the account has not been activated.");
define("activate10","Send");
define("activate11","Or");

//альянс
define("ally0","Invites");
define("ally1","No Invites");
define("ally2","Invite for");
define("ally3","Go");
define("ally4","Details");
define("ally5","Position");
define("ally6","Members");
define("ally7","Quit");
define("ally8","News");
define("ally9","Attacks");
define("ally10","Options");
define("ally11","Assign");
define("ally12","None");
define("ally13","");
define("ally14","");

//фармлист
define("farmlist0","Village");
define("farmlist1","Details");
define("farmlist2","");
define("farmlist3","Distance");
define("farmlist4","Troops");
define("farmlist5","Last Raid");
define("farmlist6","Add Raid");
define("farmlist7","Start Raid");
define("farmlist8","are you sure that you want to delete this list?");
define("farmlist9","Create a new list");
define("farmlist10","There is no any raid list.");
define("farmlist11","Name:");
define("farmlist12","Create");
define("farmlist13","This is not your list, sir!");
define("farmlist14","There is no village on those coordinates.");
define("farmlist15","No troops has been selected.");
define("farmlist16","Enter the correct coordinates.");
define("farmlist17","Add slot");
define("farmlist18","Farm Name:");
define("farmlist19","Select target:");
define("farmlist20","Delete");
define("farmlist21","Wilderness");

//dorf3
define("dorf0","Overview");
define("dorf1","Resources");
define("dorf2","Warehouse");
define("dorf3","Culture points");
define("dorf4","Troops");
define("dorf5","Village");
define("dorf6","Attacks");
define("dorf7","Building");
define("dorf8","Troops");
define("dorf9","Merchants");
define("dorf10","Sum");
define("dorf11","CP/day");
define("dorf12","Celebrations");
define("dorf13","Slots");
define("dorf14","Own troops");
define("dorf15","");
define("dorf16","");
define("dorf17","");
define("dorf18","");
define("dorf19","");
define("dorf20","");
define("dorf21","");
define("dorf22","");
define("dorf23","");
define("dorf24","");
define("dorf25","");
define("dorf26","");
define("dorf27","");
define("dorf28","");
define("dorf29","");
define("dorf30","");


//makegold in плюсе
define("mkg0","Invite your friends and get the gold!");
define("mkg1","How to do it?");
define("mkg2","Send to your friend");
define("mkg3","Your personal referral link");
define("mkg4","Favorable conditions for the award:");
define("mkg5","1.How to only the population of the empire player you invite will be higher");
define("mkg6",",you can pick up");
define("mkg7","gold by clicking on the icon");
define("mkg8","2.You can not be substituted invited player.");
define("mkg9","invited players:");
define("mkg10","Player");
define("mkg11","Date of registration");
define("mkg12","Population");
define("mkg13","Village");
define("mkg14","pick up");
define("mkg15","You do not even have invited new players.");

//сообщения
define("MSG0","Subject");
define("MSG1","Player");
define("MSG2","Date post");
define("MSG3","There are no messages available");
define("MSG4","Check All");
define("MSG5","Delete");
define("MSG6","Inbox");
define("MSG7","Write");
define("MSG8","Sent");
define("MSG9","Date Sent");
define("MSG10","Replay");
define("MSG11","Return");
define("MSG12","Recipient:");
define("MSG13","Send");


//TAINIK
define ("TA", " Cranny Level  ");
define ("TA1", " The cranny is used to hide some of your resources when the village is attacked. These resources cannot be stolen. ");
define ("TA2", " Cranny ");
define ("TA3", " units");
define ("TA4", " Cranny on level ");
define ("TA6", " Construction costs to a level ");
define ("TA7"," Improve to the level of ");
define("newrpt","New Report(s):");

//SOKR
define("sokr0","Owner");
define("sokr1","Village");
define("sokr2","Alliance");
define("sokr3","Effect");
define("sokr4","Bonus");
define("sokr5","Activity");
define("sokr6","Stored in:");
define("sokr7","Treasury");
define("sokr8","lvl");
define("sokr9","Captured");
define("sokr10","Your artifact ");
define("sokr11","Name");
define("sokr12","You do not have the artifact.");
define("sokr13","Nearest artifacts");
define("sokr14","Player");
define("sokr15","Distance");
define("sokr16","Nearest artifacts missing.");
define("sokr17","Treasury");
define("sokr18","Small artifact");
define("sokr19","There are no artifacts.");
define("sokr20","Large artifacts ");
define("sokr21","No active.");
define("sokr22","Active");

// tavern
define ("TVRN0", "Oasis occupied by");
define ("TVRN1", "");
define ("TVRN2", "Type");
define ("TVRN3", "Loyalty");
define ("TVRN4", "Conquered");
define ("TVRN5", "Coordinates");
define ("TVRN6", "Resources");
define ("TVRN7", "Next Oasis from Heroes Mansion Level 10");
define ("TVRN8", "Next Oasis from Heroes Mansion Level 15");
define ("TVRN9", "Next Oasis from Heroes Mansion Level 20");
define ("TVRN10", "Other oases");
define ("TVRN11", "Owner");
define ("TVRN12", "Wood");
define ("TVRN13", "Clay");
define ("TVRN14", "Iron");
define ("TVRN15", "Crop");

//отчеты
define("rpts0","Troops");
define("rpts1","Casualties");
define("rpts2","Captured");
define("rpts3","Infromation");
define("rpts4","from the village");
define("rpts5","Reinforcements");
define("rpts6","Subject");
define("rpts7","Resources received from");
define("rpts8","Posted by");
define("rpts9","Defence");
define("rpts10","in the village");
define("rpts11","Attack");
define("rpts12","scouts");
define("rpts13","(new)");
define("rpts14","There are no reports.");
define("rpts15","sender");
define("ot4m0","All");
define("ot4m1","Attack");
define("ot4m2","Reinforcement");
define("ot4m3","Miscellaneous");
define("ot4m4","Trade");
define("XUYXUYXUY","Reports");
define("REPORT_TODAY","Today");
define("REPROT_YESTERDAY","Yesterday");
define("len0","Warehouse");
define("len1","Village");

//рынок
define("MERCHANTS","Merchants");
define("IMSEARCHING","I'm searching");
define("IMOFFERING","I'm offering");
define("OFFEREDONTHEMARKET","I'm offering");
define("market0","Trade Routes");
define("market1","Offers at the marketplace");
define("market2","Offered");
define("market3","to me");
define("market4","Wanted");
define("market5","from me");
define("market6","Player");
define("market7","Duration");
define("market8","Action");
define("market9","Not Enough Resource");
define("market10","Not Enough Merchant");
define("market11","Accept");
define("market12","There are no avaliable offers on the market");
define("market13","Send Merchants");
define("market14","Each merchant can carry");
define("market15","units of resource");
define("market16","No Coordinates selected");
define("market17","You cannot send resources to the same village");
define("market18","Player is Banned. You cannot send resources to him.");
define("market19","Resources not selected.");
define("market20","Enter coordinates or village name.");
define("market21","Too few merchants.");
define("market22","Merchants coming");
define("market23","Arrival in");
define("market24","Resource");
define("market25","Own merchants on the way:");
define("market26","Merchants returning");
define("market27","Offering");
define("market28","Searching");
define("market29","max. time of transport:");
define("market30","hours");
define("market31","own alliance only");
define("market32","Sell");
define("market33","Own offers");
define("market34","Offer");
define("market35","Search");
define("market36","Alliance");
define("market37","hrs.");
define("market38","All");
define("market39","NPC completed.");
define("market40","Cost");
define("market41","Back to building");
define("market42","Distribute resources at (step 1 of 2)");
define("market43","Trade resources at (step 2 of 2)");
define("market44","You can't use NPC trade in WW village.");
define("market45","Start");
define("market46","No active trade routes.");
define("market47","Trade route to");
define("market48","edit");
define("market49","Create new trade route");
define("market50","Resources");
define("market51","Start time");
define("market52","Deliveries");
define("market53","Edit trade route");
define("market54","Target village");

define("anlm0","Please enter your login");
define("anlm1","Please enter your e-mail");
define("anlm2","Please enter your password");

define("upgra0","Cost:");
define("upgra1","Workers are working.");
define("upgra2","Food shortages: first upgrade Cropland!");
define("upgra3","Upgrade warehouse.");
define("upgra4","Upgrade Granary.");
define("upgra5","Enough resources at");
define("upgra6","Construct building");
define("upgra7","(Queue)");
define("upgra8","Architect");
define("upgra9","(costs:");

//world wonder
define("ww0","The World Wonder (otherwise known as a Wonder of the World) is as wonderful as it sounds. This building is built in order to win the server. Each level of the World Wonder costs hundreds of thousands (even millions) of resources to build.");
define("ww1","You need to have World Wonder level 1 to be able to change its name.");
define("ww2","World Wonder name:");
define("ww3","You can not change the name of the World Wonder after level 10.");
define("ww4","Name changed.");
define("ww5","Need WW construction plan.");
define("ww6","Need more WW construction plan.");
define("ww7","For build to level ");
define("ww8","For building WW 50+ level you need have 2 buildingplan (one must have you and second dude from your Alliance!!!)");
define("ww9","For building WW you need have first building plan in you account or/and(50+ level) second building plan must have dude from your Alliance!");

//kuznicaupgrade
define("kuzupg0","Fully Developed ");
define("kuzupg1","Improve the blacksmith");
define("kuzupg2","Research in progress");
define("destroyvil","Village already destroyed.");

//sitter
//заместители
define("accsit0","Send raid");
define("accsit1","Send reinforcements to other players");
define("accsit2","Send resources to other players");
define("accsit3","Spending gold");
define("accsit4","Read and write messages");
define("accsit5","Delete messages and reports");



//онлайн in альянсе(online in alliance)
define("oweronline0","Now online");
define("oweronline1","Offline");
define("oweronline2","Last 3 days");
define("oweronline3","Last 7 days");

//doperevod
define("heroh0","consumption");
define("heroh1","Do you really want to wear this item?");
define("heroh2","Current number of culture");
define("heroh3","Add culture points:");
define("heroh4","After use, will be: ");
define("sendmsg","Send message");

//EVERYDAY QUEST
define("questday0","Quest is complete for today");
define("questday1","Quest is still open");
define("questday2","Daily Quests");
define("questday3","Points");
define("questday4","By collecting 25 points you will receive of one of the following rewards:");
define("questday5","5 Adventure");
define("questday6","+5000 culture points");
if(!defined("HOWRES")){define("HOWRES",100000);} //делаем опасный трюк.
define("questday7",HOWRES." resources of one random type");
define("questday8","By collecting 50 points you will receive of one of the following rewards:");
define("questday9","+1 day PLUS Account");
define("questday10","+1 day +25% lumber production");
define("questday11","+1 day +25% clay production");
define("questday12","+1 day +25% iron production");
define("questday13","+1 day +25% crop production");
define("questday14","By collecting 75 points you will receive of one of the following rewards:");
define("questday15","+20 adventures");
define("questday16","+2 bucket");
define("questday17","+1000 silver");
define("questday18","By collecting 100 points you will receive of one of the following rewards:");
define("questday19","+50 gold");
define("questday20","+4000 silver");
define("questday21","+50 adventures");
define ("questday22", "Get these free rewards every day!");
define ("questday23", "(The next reset will be at 12:00. Make sure you have collected your reward before!)");
define ("questday24", "Complete an adventure");
define("questday25","Get a Medal");
define("questday26","Invite a player");
define("questday27","Build or capture new village");
define("questday28","Gain or spend gold");
define("questday29","Capture 1 oasis");
define("questday30","Visitar nosso grupo no Facebook (Clique aqui)");
define("questday31","Upgrade any unit to max level in Smithy");
define("questday32","Congratulations! You collect the required number of points for an award!");
define("questday33","typeset");
define("questday34","point");
define("questday35"," You can collect a fee for the collection");
define("questday36","points today.");
define("questday37","The award is chosen randomly from this list:");
define("questday38","You have gathered today");
define("questday39","points and for that you get the following remuneration:");
define("questday40","Your reward today:");

define("REP_С1"," Released <b>all</b> troops.");
define("REP_С2","Resudence/Palace");
define("REP_С3"," Cranny Capacity");
define("REP_С4","Wall");
define("REP_С5","Your hero got o XP");
define("REP_С6","You hero got");
define("REP_С7","Your hero degrade loylaty from ");
define("REP_С8","to");
define("REP_С9","and got");
define("REP_С10","Your hero occupied oasis and got");
define("REP_С11","");
define("REP_С12","Village can't be occupied");
define("REP_С13","Not enough culture points");
define("REP_С14","Inhabitants of");
define("REP_С15","village decided to join your empire");
define("REP_С16","");
define("REP_С17","Residence or Palace not destroyed");
define("REP_С18","Village already destroyed");
define("REP_С19","Destroyed from level");
define("REP_С20","");
define("REP_С21"," level");
define("REP_С22","");
define("REP_С23","Wall wasn't damaged");
define("REP_С24","Wall destroyed");
define("REP_С25","No wall here");
define("REP_С26","Reinfocement attacked in");
define("REP_С27","attacks");
define("REP_С28","Received reinforcement from");
define("REP_С29","Delivered reinforcement from");
define("REP_С30","Occupied oasis");
define("REP_С31","Nothing valuable was found");
define("REP_С32","");
define("REP_С33","Your hero got artefact and got");
define("REP_С34","Your hero got NOT activated artefact and got");
define("REP_С35","Your hero didn't got artefact and got");
define("REP_С36","You have maximum count of artefacts. Hero got");
define("REP_С37","spys");
define("REP_С38","Received resourses from");
define("REP_С39","Delivered resourses from");
define("REP_С40","destroyed");
define("REP_С41","wasn't damaged");
define("REP_С42","The loyalty was lowered from");
define("REP_С43","Animals capturing");
define("REP_С44","");
define("REP_С45","Oasis");
define("REP_С46","your hero did not survive the adventure");
define("REP_С47","");
define("REP_С48","explores");
define("savebankgold","Balance of gold from the previous round you can transfer through");
define("allgold", "All gold");
define("adminhelp"," If you have questions, please contact");
define("endround", "Gold is credited to your account immediately after payment");
define("endround1", "At the end of round / removing gold account is credited to the Bank by the formula:");

//КinЕСТЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫЫ
define("quest1","Next adventure");
define("quest2","During the tutorial, you already collected some experience from an adventure. Start the next adventure as soon as your hero has returned to your village. Loot and experience will allow you to grow more quickly.");
define("quest3","Move on to the second adventure");
define("quest4","30 hero experience");
define("quest5","Nice, your hero is already on their way. Hint: The more fighting strength your hero has, the less damage they will take from adventures.");
define("quest6","Construct a cranny");
define("quest7","Many players live off of robbing the resources from other players. At game start, you have beginners protection and you are safe. Construct a cranny to save at least a part of your resources from being plundered.");
define("quest8","Build a cranny in your village");
define("quest9","Great, now plunderers will not find it as easy to steal from you anymore. Check the info box to see the time of beginners protection you have left.");
define("quest10","Build barracks");
define("quest11","The barracks is the first building that allows you to train troops. Even as a peace-loving player, you will need troops in order to protect yourself and your allies from enemies.");
define("quest12","Construct barracks");
define("quest13","Your barracks has been built! A good step towards world domination!");
define("quest14","Hero level");
define("quest15","Your hero becomes stronger with each new level. Go to the characteristics of the hero and distribute available for your hero points.");
define("quest16","Spread the available points after reaching a new level of hero.");
define("quest17","You can change the distribution of points for each attribute at any time. All you need for this is a book of wisdom, which can be found in adventures.");
define("quest18","Train troops");
define("quest19","Now it is time to train your first troops. In the barracks, you can already train one type of infantry unit.");
define("quest20","Train ".round(250*xQUEST)." troops in the barracks");
define("quest21","The cornerstone for a glorious army has been laid! Always remember that you can still be attacked, even when you are not online.");
define("quest22","City Wall");
define("quest23","Now you should also build some defences. A fortification will increase your base defence and also increases the fighting strength of defending troops.");
define("quest24","Build a fortification around your village.");
define("quest25","Wonderful, the defenders of your village are now better protected.");
define("quest26","Attack oasis");
define("quest27","Search the map for a free oasis nearby and plunder it. In case there are animals defending it, send your hero equipped with cages in order to capture them.");
define("quest28","Open a free oasis on the map and attack it.");
define("quest29","2 base-unit troops");
define("quest30","Congratulations, your first attack is on its way! You can still cancel it for a short period of time from within your rally point.");
define("quest31","10 adventures");
define("quest32","Continue to send your hero on adventures. After having finished 10 of them, you can participate in auctions and trade items with other players.");
define("quest33","Finish 10 adventures");
define("quest34","500 silver");
define("quest35","Congratulations, you can now use the auction house. Take this silver, so you have some money for trading right away.");
define("quest36","Auctions");
define("quest37","Go to the auction house and see which items are currently on offer. Maybe you want to turn some of your loot from adventures into silver as well?");
define("quest38","Create or place a bid in an auction.");
define("quest39","Great, now you know how to trade equipment and consumable items with other players.");
define("quest40","Upgrade barracks");
define("quest41","Upgrade your barracks now. With this, you fulfill the requirements to unlock further buildings.");
define("quest42","Upgrade your barracks to level 3.");
define("quest43","Nice. Your troops are now trained faster and you can construct an academy.");
define("quest44","Construct an academy");
define("quest45","New and stronger units for your village can be researched in the academy. Some units are very expensive and have high requirements before they can be researched.");
define("quest46","Construct an academy now.");
define("quest47","Well done. Soon you will find out more about the soldiers of your tribe.");
define("quest48","Research unit");
define("quest49","Check your research options now. There are infantry and cavalry units, as well as siege weapons. Units are mainly specialised in either attack or defence.");
define("quest50","Research an additional troop type.");
define("quest51","Research alone is of course not enough; your units will also need to be trained.");
define("quest52","Construct a smithy");
define("quest53","A smithy allows you to better arm and equip your soldiers. Furthermore, a smithy is required in order to build additional troop buildings.");
define("quest54","Construct a smithy.");
define("quest55","Perfect. Now you can better equip your soldiers.");
define("quest56","Improve units");
define("quest57","Improving your soldiers' equipment isn't cheap. The more soldiers you have, the more rewarding an improvement will be. This time, you will gain more than a refund of the costs.");
define("quest58","Research a unit improvement in the smithy.");
define("quest59","Perfect, now your troops' ability to attack and defend has improved.");
define("quest60","Iron mine");
define("quest61","Order the construction of an iron mine! Your primary aim is still a high production of resources so that you can grow quickly.");
define("quest62","Start the construction of an iron mine");
define("quest63","One day +25% bonus on the production of all resources");
define("quest64","Higher iron production for your village. A production bonus will help you increase the production of any particular resource even further.");
define("quest65","More resources");
define("quest66","Extend one lumber, clay, iron and crop field each to level 1. To complete this task you need to have at least 2 fields of each resource type above level 0. As long as Travian PLUS is still active, you can always order one further construction at the same time.");
define("quest67","Extend one more of each resource tile to level 1.");
define("quest68","Congratulations! Your village grows and thrives...");
define("quest69","Granary");
define("quest70","In order to store more crop, you need a granary. Your current storage limit can be found when looking at the resources bar.");
define("quest71","Construct a granary");
define("quest72","Nicely done! The granary now allows you to store more crop.");
define("quest73","All to one");
define("quest74","In the beginning, its best to focus on resources. Please upgrade all your resource fields to level 1.");
define("quest75","Upgrade all resource fields to level 1 ");
define("quest76","Your resource production is developing nicely. Soon we can start the construction of more buildings in your village.");
define("quest77","To 2!");
define("quest78","Continue to increase your production. Upgrade one lumber, clay, iron and crop field each to level 2!");
define("quest79","Upgrade one resource field each to level 2");
define("quest80","Well done! If you require more information regarding your production, click on your stocks.");
define("quest81","Marketplace");
define("quest82","In case you have a lack of one resource, you can trade it for other resources with other players at the marketplace. In order to construct a small marketplace, you need a larger main building.");
define("quest83","Construct marketplace");
define("quest84","Your marketplace is ready and you can now start trading with other players. Don't fall for the really bad offers though!");
define("quest85","Trade");
define("quest86","Existing offers on the marketplace can be seen when clicking on \"buy\". Check the exchange rate and the distance. Should you not be able to find a suitable offer, click on \"offer\" to create an offer yourself.");
define("quest87","Create a marketplace offer or accept one");
define("quest88","Awesome, you have initiated your first trade.");
define("quest89","All to 2");
define("quest90","Before you start constructing more expensive buildings, we should further increase your resource production. Upgrade all your resource fields to level 2.");
define("quest91","Extend all resource fields to level 2");
define("quest92","Congratulations! Your resource production is developing nicely.");
define("quest93","Warehouse level 3");
define("quest94","Its time to adjust your warehouse to the increased production. Unplanned loot from your hero may also make your storage overflow.");
define("quest95","Upgrade your warehouse to level 3");
define("quest96","Really good, no valuable resources will be wasted now.");
define("quest97","Granary level 3");
define("quest98","The higher your production, the easier your storage gets filled up. The granary should also be upgraded.");
define("quest99","Upgrade your granary to level 3");
define("quest100","Now there is room again in the granary, so that production can continue even in your absence.");
define("quest101","Grain Mill");
define("quest102","A grain mill increases the production of all your croplands. In order to be worth its price, you need to have a high enough base production.");
define("quest103","Construct a level 1 grain mill");
define("quest104","Grain Mill Level 2");
define("quest105","Now you have a lot of free crop available for further constructions. There are also buildings that increase the production of the other resources.");
define("quest106","All to 5");
define("quest107","You will need a much higher production in order to spare you a long waiting time until you are able to afford the buildings and settlers needed for a second village. Upgrade all resource fields to level 5.");
define("quest108","Upgrade all resource fields to level 5");
define("quest109","One day +25% bonus to the production of all resources.");
define("quest110","Well done, you now have a decent production.");
define("quest111","View statistics");
define("quest112","In the world of Travian, you compete against thousands of other players. Check the statistics to find out more about your own position in the game.");
define("quest113","Open the statistics and compare yourself with other players.");
define("quest114","Apart from the rank, there is other useful information. The tab Top10 will show you the strongest attackers and the most successful robbers.");
define("quest115","Change village name");
define("quest116","A village name chosen by you is a sign to other players, showing them that your empire is being led actively.");
define("quest117","Change the village name on the village sign.");
define("quest118","33 culture points");
define("quest119","Nice, now you have completed the first step to leave your mark in the world of Travian.");
define("quest120","Main building level 3");
define("quest121","A bigger main building unlocks new buildings and your workers' speed will increase. Being able to build more quickly will however only pay out if you produce enough resources.");
define("quest122","Upgrade your main building to level 3.");
define("quest123","Great, the bigger main building now allows you to construct some additional buildings that you've just unlocked.");
define("quest124","Construct an embassy");
define("quest125","The world of Travian is a dangerous place and you need to be able to defend yourself. The best additional defence is offered by strong allies. Construct an embassy in order to join an alliance.");
define("quest126","Construct an embassy.");
define("quest127","Perfect, now you can accept alliance invitations. Invitations can be found inside the embassy.");
define("quest128","Open map");
define("quest129","The map shows you the world of Travian. Check out your neighbours to find allies and identify threats");
define("quest130","Open the map in the menu.");
define("quest131","Are there strong players or alliances near you? The map also helps you find oases and spots where you can settle new villages.");
define("quest132","Read message");
define("quest133","You have just received a message with some helpful hints. Unread messages can be identified by the number above the button. Have a look now.");
define("quest134","Open the messages overview and read the taskmasters message!");
define("quest135","Use messages to communicate with other players. It does always pay out to be calm and polite, even if you are at battle.");
define("quest136","Bonus gold");
define("quest137","During the tutorial, you've already used gold to speed up your construction orders. In the gold shop, you can find out what else you can use your gold for.");
define("quest138","Take a look at the advantages you can buy with gold.");
define("quest139","Here is some free gold again, so that you can make use of some of the gold advantages.");
define("quest140","Alliance");
define("quest141","Search for allies and join an alliance. If you don't have any contacts yet, check the alliances of players near you or search for an alliance on the forum.");
define("quest142","Join an alliance.");
define("quest143","We're off to a great start. The stronger and more active each single player is, the stronger you will be as a team. Have you found out how to report attacks to each other and how to ask for assistance?");
define("quest144","Main building level 5");
define("quest145","It is time to upgrade the main building, so that you can construct new buildings. Please remember to also take care of your resource production at the same time.");
define("quest146","Upgrade your main building to level 5.");
define("quest147","Great, now you can construct a residence. Your workers' speed has also improved.");
define("quest148","Seat of government");
define("quest149","Construct a seat of government now in order to found a new village soon. In case you are not sure if you want this village to remain your capital village, please select the residence.");
define("quest150","Construct a residence or palace.");
define("quest151","This building is necessary in order to settle a new village or conquer one. Its level limits the amount of possible expansions.");
define("quest152","Culture points");
define("quest153","In order to reign over more villages in your empire, you need culture points. The overview in the residence or palace tells you how far away you are and how long it is going to take.");
define("quest154","Open the culture points tab in your residence or palace.");
define("quest155","In the village list you can also see the current status of possible new villages and the amount of missing culture points. Visit \"Answers\" to find out how to quickly increase your culture points.");
define("quest156","Warehouse level 7");
define("quest157","Upgrade your warehouse to prepare yourself for settling a new village. Your current storage capacity won't be enough soon to afford the required buildings and settlers.");
define("quest158","Upgrade your warehouse to level 7.");
define("quest159","Great, your storage capacity should be enough for some time now. Remember to defend or hide your valuable resources.");
define("quest160","Residence or palace level 10");
define("quest161","Settlers can be trained in a palace or a residence. The tab \"Train\" shows you the required building level.");
define("quest162","Upgrade your residence or palace to level 10.");
define("quest163","167 culture points");
define("quest164","From each village you can only control 2 to 3 new villages. All thats missing for a new village now are 3 settlers and a lot of culture points.");
define("quest165","Train three settlers");
define("quest166","Settlers always travel in a small group when founding a new village. Protect your settlers well from attacks until they are ready to go.");
define("quest167","Train three settlers.");
define("quest168","Nice. Settlers will always take some resources for the new village with them, so they can start building it up right away.");
define("quest169","Found new village");
define("quest170","Search the map for a good spot to settle. Would you like it to be near your village, produce more of one particular resource or be near many oases?");
define("quest171","Found a second village using your settlers.");
define("quest172","Well done. I'll now give you another 2 days of Travian Plus - this will do you some good.");
define("quest173","Daily tasks");
define ("quest174", "Daily prizes");
define ("quest175", "Click for daily rewards");


//register mail
define ("register1", "Welcome to");
define ("register2", "Hello");
define ("register3", "Thanks for registering.");
define ("register4", "Login");
define ("register5", "Password");
define ("register6", "Activation code");
define ("register7", "Click the link below to activate your account:");
define ("register8", "Greetings,");
define ("register9", "TravianT4 Team");
define ("register10", "New password");
define ("register11", "You asked for a new password for Travian.");
define ("register12", "Click the link below to activate your new password. Your previous password will become invalid:");
define ("register13", "If you want to change your password go to your in-game profile, there you can change it.");
define ("register14", "If you have not asked for a new password, just ignore that email ..");


define("new_village","New village");
define("new_village2","`s village");


	$lang_winner['1'] = 'Dear '.SERVER_NAME.' players';
	$lang_winner['2'] = 'All good things must come to an end, and so too must this age. Once Solomon was given a ring, upon which was inscribed a message that could take away all the joys or sorrows of the world, that message was roughly translated, "this too shall pass". It is both our joy and sorrow to announce to all '.SERVER_NAME.' players that this too has now passed! We hope you enjoyed your time with us as much as we enjoyed serving you and thank you for your staying until the very end!';
	$lang_winner['3'] = 'The results: Day had long since passed into night, yet the workers of the village';
	$lang_winner['4'] = 'laboured throughout the wintery eve, ever wary of the countless armies marching to destroy their work, knowing that they raced against time and the greatest threat that had ever faced the free tribes. Their tireless struggless were rewarded after a nameless worker laid the final stone in what will be forever known as the greatest and the most magnificent creation in all of history since the fall of the Natars.';
	$lang_winner['5'] = 'Together with the alliance';
	$lang_winner['6'] = 'was the first to finish the Wonder of the World, using millions of resources whilst also protecting it with hundreds of thousands of brave defenders. It is therefore';
	$lang_winner['7'] = 'who recieves the title "winner of this era"!';
	$lang_winner['8'] = 'was ruler over the largest personal empire, followed closely by';
	$lang_winner['9'] = 'and';
	$lang_winner['10'] = 'slew more than any other, and was the mightiest, most fearsome commander.';
	$lang_winner['11'] = 'was the most glorious defender, slaughtering enemies at the village gates, staining the lands around those villages with their blood.';
	$lang_winner['12'] = 'Best regards';
	$lang_winner['13'] = 'Your '.SERVER_NAME.' team';
	$lang_winner['14'] = 'continue';
	$lang_winner['desc1'] = 'Total villages';
	$lang_winner['desc2'] = 'Total population';
	$lang_winner['desc3'] = 'Attack points';
	$lang_winner['desc4'] = 'Defence points';
	define("PL_01", "club gold");
	define("PL_02", "Great features for every gaming experience !!");
	define("PL_03", "Let merchants in a region transfer more resources From once automatically, find crops on a map, and save your messages and decide which battles to fight. Use List the Farms to schedule your attacks ... Protect your attack by making an escape in a capital when you are attacking. Show an opponent attack!");
	define("PL_04", "Travian Plus");
	define("PL_05", "reviews and better features!");
	define("PL_06", "Let merchants in a region transfer more resources From once automatically, find crops on a map, and save your messages and decide which battles to fight. Use List the Farms to schedule your attacks ... Protect your attack by making an escape in a capital when you are attacking. Show an opponent attack!");
	define("PL_07", "+25% wood");
	define("PL_08", "+25% clay");
	define("PL_09", "+25% iron");
	define("PL_10", "+25% crop");
	define("PL_11", "25% increase Production");
	define("PL_12", "25% total production");
	
	define("PL_13", "Please choose the feature you want to use:");
	define("PL_14", "are doing");
	define("PL_15", "");
	define("PL_16", "Whole tour");
	define("PL_17", "And M.");
	define("PL_18", "Do that.");
	define("PL_19", "Next");

	// productionBoostPopup
	define("BD_LEVEL", "level");
	define("MAXLEVEL", "The building has reached the max level");
	define("TOP10", "top 10");


	$lang['buildings']['texts'] = array (
		'TRA0' => 'List the Training',
		'TRA1' => 'Units',
		'TRA2' => 'Duration',
		'TRA3' => 'Finished',
		'AKA1' => 'There is a search with a verb',
		'AKA2' => 'Can be started in a search at the end of the From building process.',
		
	);

	$lang['profile'] = array(
		'1' => 'Profile',
		'2' => 'Population rank',
		'3' => 'Population',
		'4' => 'Attacking Rank',
		'5' => 'Points',
		'6' => 'Defending rank',
		'7' => 'Hero level',
		'8' => 'XP',

		// Medals
		'9' => 'Category',
		'10' => 'Week',
		'11' => 'Rank',
		'12' => 'Points'
	);
	
	
	
	$lang['quests'] = array(
		'Next' => 'continue',
		'getRewards' => 'Take Rewards',
		'ActivateTips' => 'Show Tips',
		'DeactivateTips' => 'Hide Tips',
		'TipsToggleDescription' => 'Tips Show / Hide',
		'GetRewards' => 'Get Reward',
		'Overview' => 'Overview',
		'Battle' => 'Battle',
		'Economy' => 'Economy',
		'World' => 'World',
		
		'1' => array(
			'Title' => 'Welcome',
			'Description' => 'Hello '.$session->username.', Welcome to Travian!<br>As long as you build a new village for yourself, I\'ll help you.In this tutorial, you should make your own village and get to know about the purpose of the game and its features',
			'toDo' => array('Tutorials explaining the main features of the game and may only take a few minutes. Begin now!')
		),
		'2' => array(
			'Title' => 'Tasks and help',
			'Description' => 'You can move task page or close it. To open it again, simply click on my picture in the top left corner. Hints and Tasks will help you in the game.',
			'toDo' => array('Close Tasks', 'click on Consultant to open Hints page', 'Turn off feature hints (disable)'),
			'reward' => 'A Clay pit level 1 waiting for you!',
			'completed' => 'Now you can always get information on your current task. you can start The next task when you receive a taks reward. get your clay pit.'
		),

		'3' => array(
			'Title' => 'Construct a Woodcutter',
			'Description' => 'to raise your village you need a lot of resources,to build and train troops and even grow your empire! First Increase your resource Production - build a Woodcutter!',
			'toDo' => array('Open a forest area by clicking on it', 'Order construction Woodcutter level 1'),
			'reward' => 'finish Woodcutter level 1',
			'completed' => 'It\s a strong start moving in the stronger economy. I just completed Woodcutter construction,to be able to continue.'
		),

		'4' => array(
			'Title' => 'Upgrade woodcutter',
			'Description' => 'A larger building will require more resources with each upgrade, but in turn it will also produce more. Please upgrade the woodcutter from level 1 to level 2 now!',
			'toDo' => array('Open the level 1 woodcutter','Order the construction of a level 2 woodcutter'),
			'reward' => 'Finish construction of woodcutter level 2 immediately',
			'completed' => 'The display of your storage and stock can be found above your village. Construction costs will be taken from the stocks. I\'ll instantly finish the construction for you again.'
		),

		'5' => array(
			'Title' => 'Construct Cropland',
			'Description' => 'When you look at the share of its resources, Note the consumption of wheat in the left corner. This amount is needed to train troops and buildings. Please make a Cropland.',
			'toDo' => array('Click on Cropland','Construct Cropland to level 1'),
			'reward' => 'Finish Cropland level 1 and Upgrade it to level 2',
			'completed' => 'Now Your village\s wheat is produced in sufficient quantities to build a new building. Populations are locally Nutrition forces stationed in the village of wheat are supported.'
		),

		'6' => array(
			'Title' => 'Hero Productions',
			'Description' => 'If Your Hero is alive, it can produce resources for their village. by our Constructions we just have some clay. Change the hero production to clay.',
			'toDo' => array('Click on the hero image and open overview','Change your Hero Productions to Clay and save'),
			'reward' => ''.number_format(200 * SPEED).' <i class="r2"></i>',
			'completed' => 'Great! now your hero will help to product more resource. All produced Resources will add to main village. I will just increase your resource.'
		),

		'7' => array(
			'Title' => 'Enter to your village center',
			'Description' => 'Next, we will increase stock value by village overview at the top of the game\s menu. To do this, we need to have buildings within the village. Go into the village center.',
			'toDo' => array('Enter village center')
		),

		'8' => array(
			'Title' => 'Counstrunct Warehouse',
			'Description' => 'without warehouse, just some of resource can be stored in your village. Click on Building site to build warehouse! In the menu on the construction find warehouse and build it.',
			'toDo' => array('open construction and click infrastructure and the menu','Give orders to build warehouse level 1'),
			'reward' => 'One day Travian Plus',
			'completed' => 'Construction work has started and soon you can save more resources and plunder. I will give you 1.8 hour(s) Travian Plus, which can give commands to a building and put it in the queue that first construction of the building is not finished.'
		),

		'9' => array(
			'Title' => 'Rally Point',
			'Description' => 'in order to send your hero to adventures, you need a rally point - you can find it in village center! Construct it and Upgrade it to level 1.',
			'toDo' => array('Click on the building site of rally point','Construct Rally Point level 1'),
			'reward' => '<img src="img/x.gif" alt="gold" title="gold" class="gold"> 2',
			'completed' => 'It looks great! Now you can send Your Hero to the adventure. To perform this task, I\'ll give you some gold which you can spend it in a proper way.'
		),

		'10' => array(
			'Title' => 'Finish immediately',
			'Description' => 'Below the village, you can find a list with all of your current construction orders. This time, you can speed up the construction yourself. Use the gold from the last task and finish the construction orders by clicking on "complete construction immediately".',
			'toDo' => array('Complete construction orders immediately'),
			'reward' => '<img src="img/x.gif" alt="gold" title="gold" class="gold"> 10',
			'completed' => 'Now you can send your hero adventure. First,give order to build some resources which your village always growing up. Get this Gold and Use it wisely.'
		),

		'11' => array(
			'Title' => 'Join to Adventure',
			'Description' => 'Discover mysterious places in your surroundings to collect experience and valuable loot. Open the adventure list and send your hero on their first adventure.',
			'toDo' => array('Send your hero on their first adventure'),
			'reward' => 'Your Hero will return immediately from Adventure',
			'completed' => 'GREAT, your hero went on his adventure - what did he find? Below the picture of your hero you can see he\s on the road. I will let him arrive quickly to see what happens.'
		),

		'12' => array(
			'Title' => 'Reports',
			'Description' => 'Your hero is now on their way back from the first adventure. In the menu at the top, you can find the reports. Open the report list and read the adventure report.',
			'toDo' => array('Open the Report List','View new report of adventure'),
			'reward' => '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">10</span>',
			'completed' => 'You can see what kind of an award Your Hero Found.Your Hero is also a superficial wound - to prevent from this event, I\'ll give you some ointment.'
		),

		'13' => array(
			'Title' => 'Heal Hero',
			'Description' => 'Your hero was slightly injured. Open the hero overview by clicking on their image. Now click on the ointments in the inventory and use them with "ok". Only the required amount will be used.',
			'toDo' => array('Click on your hero\s image to open the inventory','Click on the ointments in the inventory to use them'),
			'reward' => 'Additionally, Your Hero received '.number_format(20*SPEED).' experience points.',
			'completed' => 'All the tools and weapons can be use in the same way. Depending on its type, you can view item informations by holding the cursor over it.'
		),

		'14' => array(
			'Title' => 'Interface help',
			'Description' => 'Near my image, you can find some additional help regarding the game. There, you can find explanations about the layout and different sections of the user interface. Just give it a try!',
			'toDo' => array('Open the user interface help and have a look around the UI'),
			'reward' => '<i class="r1"></i> '.number_format(270*SPEED).' <i class="r2"></i> '.number_format(300*SPEED).' <i class="r3"></i> '.number_format(270*SPEED).' <i class="r4"></i> '.number_format(220*SPEED).'',
			'completed' => 'If you have specific questions, First search them in "Travian Answers" and get help. To do this, the "i" in the header of this window or in a corner of your screen.'
		),

		'15' => array(
			'Title' => 'End of training',
			'completed' => 'Now you know the basics of the game. Important information such as the time-critical data to support newcomers and the game will be show in the info box on the left. Enjoy Travian!',
			'toDo' => array('End of tutorial'),
			'reward' => 'Finish training'
		),
		'15a' => array(
			'Title' => 'Skip tutorial',
			'Description' => 'Now you know the basics of the game. Important information such as the time-critical data to support newcomers and the game will be show in the info box on the left. Enjoy Travian!',
			'toDo' => array(),
			'reward' => 'Rally point, clay pit, woodcutter 2, cropland 2, 10 gold, 1.8 hour(s) PLUS'
		),

);

$lang['quests']['battle'] = array(
	'1' => array(
		'Title' => 'Next adventure',
		'Description' => 'During the tutorial, you already collected some experience from an adventure. Start the next adventure as soon as your hero has returned to your village. Loot and experience will allow you to grow more quickly.',
		'toDo' => array('Move on to the second adventure'),
		'reward' => ''.number_format(30*SPEED).' hero experience',

		'completed' => 'Nice, your hero is already on their way. Hint: The more fighting strength your hero has, the less damage they will take from adventures.'
	),
	'2' => array(
		'Title' => 'Construct a cranny',
		'Description' => 'Many players live off of robbing the resources from other players. At game start, you have beginner\s protection and you are safe. Construct a cranny to save at least a part of your resources from being plundered.',
		'toDo' => array('Build a cranny in your village'),
		'reward' => '<i class="r1"></i> '.number_format(130*SPEED).' <i class="r2"></i> '.number_format(150*SPEED).' <i class="r3"></i> '.number_format(120*SPEED).' <i class="r4"></i> '.number_format(100*SPEED).'',

		'completed' => 'Great, now plunderers will not find it as easy to steal from you anymore. Check the info box to see the time of beginner\s protection you have left.'
	),
	'3' => array(
		'Title' => 'Build barracks',
		'Description' => 'The barracks is the first building that allows you to train troops. Even as a peace-loving player, you will need troops in order to protect yourself and your allies from enemies.',
		'toDo' => array('Construct barracks'),
		'reward' => '<i class="r1"></i> '.number_format(110*SPEED).' <i class="r2"></i> '.number_format(140*SPEED).' <i class="r3"></i> '.number_format(160*SPEED).' <i class="r4"></i> '.number_format(30*SPEED).'',

		'completed' => 'Your barracks has been built! A good step towards world domination!'
	),
	'4' => array(
		'Title' => 'Complete 5 Adventures',
		'Description' => 'More adventures, more booty, send your hero to adventure whenever adventure becomes available, comfort Hero if his health is poor or give him healing fat.',
		'toDo' => array('Complete 5 Adventures'),
		'reward' => '<img src="img/x.gif" title="Ointments" class="questRewardTypeItem item106"> <span class="questRewardValue">150</span>',

		'completed' => 'Ointments can be used to heal your hero. If you equip ointments they will be used as soon as the hero takes damage.'
	),
	'5' => array(
		'Title' => 'Train troops',
		'Description' => 'Now it is time to train your first troops. In the barracks, you can already train one type of infantry unit.',
		'toDo' => array('Train two troops in the barracks'),
		'reward' => '<img src="img/x.gif" title="Cage" class="questRewardTypeItem item114"> <span class="questRewardValue">1</span>',

		'completed' => 'The cornerstone for a glorious army has been laid! Always remember that you can still be attacked, even when you are not online.'
	),
	'6' => array(
		'Title' => 'Earth Wall',
		'Description' => 'Now you should also build some defences. A fortification will increase your base defence and also increases the fighting strength of defending troops.',
		'toDo' => array('Build a fortification around your village'),
		'reward' => '<i class="r1"></i> '.number_format(120*SPEED).' <i class="r2"></i> '.number_format(120*SPEED).' <i class="r3"></i> '.number_format(90*SPEED).' <i class="r4"></i> '.number_format(50*SPEED).'',

		'completed' => 'Wonderful, the defenders of your village are now better protected.'
	),
	'7' => array(
		'Title' => 'Attack oasis',
		'Description' => 'Search the map for a free oasis nearby and plunder it. In case there are animals defending it, send your hero equipped with cages in order to capture them.',
		'toDo' => array('Open a free oasis on the map and attack it'),
		'reward' => '2 base unit troops',

		'completed' => 'Congratulations, your first attack is on its way! You can still cancel it for a short period of time from within your rally point.'
	),
	'8' => array(
		'Title' => '10 adventures',
		'Description' => 'Continue to send your hero on adventures. After having finished 10 of them, you can participate in auctions and trade items with other players.',
		'toDo' => array('Finish 10 adventures'),
		'reward' => '500 silver',

		'completed' => 'Congratulations, you can now use the auction house. Take this silver, so you have some money for trading right away.'
	),
	'9' => array(
		'Title' => 'Auctions',
		'Description' => 'Go to the auction house and see which items are currently on offer. Maybe you want to turn some of your loot from adventures into silver as well?',
		'toDo' => array('Create or place a bid in an auction'),
		'reward' => '<i class="r1"></i> '.number_format(280*SPEED).' <i class="r2"></i> '.number_format(120*SPEED).' <i class="r3"></i> '.number_format(220*SPEED).' <i class="r4"></i> '.number_format(110*SPEED).'',

		'completed' => 'Great, now you know how to trade equipment and consumable items with other players.'
	),
	'10' => array(
		'Title' => 'Upgrade barracks',
		'Description' => 'Upgrade your barracks now. With this, you fulfill the requirements to unlock further buildings.',
		'toDo' => array('Upgrade your barracks to level 3'),
		'reward' => '<i class="r1"></i> '.number_format(240*SPEED).' <i class="r2"></i> '.number_format(290*SPEED).' <i class="r3"></i> '.number_format(430*SPEED).' <i class="r4"></i> '.number_format(240*SPEED).'',

		'completed' => 'Nice. Your troops are now trained faster and you can construct an academy.'
	),
	'11' => array(
		'Title' => 'Construct an academy',
		'Description' => 'New and stronger units for your village can be researched in the academy. Some units are very expensive and have high requirements before they can be researched!',
		'toDo' => array('Construct an academy now'),
		'reward' => '<i class="r1"></i> '.number_format(210*SPEED).' <i class="r2"></i> '.number_format(170*SPEED).' <i class="r3"></i> '.number_format(245*SPEED).' <i class="r4"></i> '.number_format(115*SPEED).'',

		'completed' => 'Well done. Soon you will find out more about the soldiers of your tribe.'
	),
	'12' => array(
		'Title' => 'Research unit',
		'Description' => 'Check your research options now. There are infantry and cavalry units, as well as siege weapons. Units are mainly specialised in either attack or defence.',
		'toDo' => array('Research an additional troop type'),
		'reward' => '<i class="r1"></i> '.number_format(450*SPEED).' <i class="r2"></i> '.number_format(435*SPEED).' <i class="r3"></i> '.number_format(515*SPEED).' <i class="r4"></i> '.number_format(550*SPEED).'',

		'completed' => 'Research alone is of course not enough; your units will also need to be trained!'
	),
	'13' => array(
		'Title' => 'Construct a smithy',
		'Description' => 'A smithy allows you to better arm and equip your soldiers. Furthermore, a smithy is required in order to build additional troop buildings.',
		'toDo' => array('Construct a smithy'),
		'reward' => '<i class="r1"></i> '.number_format(500*SPEED).' <i class="r2"></i> '.number_format(400*SPEED).' <i class="r3"></i> '.number_format(700*SPEED).' <i class="r4"></i> '.number_format(400*SPEED).'',

		'completed' => 'Perfect. Now you can better equip your soldiers!'
	),
	'14' => array(
		'Title' => 'Improve units',
		'Description' => 'Improving your soldiers\' equipment isn\'t cheap. The more soldiers you have, the more rewarding an improvement will be. This time, you will gain more than a refund of the costs!',
		'toDo' => array('Finish upgrading a troop type'),
		'reward' => '<img src="img/x.gif" class="questRewardTypeItem item112"> <span class="questRewardValue">10</span>',

		'completed' => 'Research a unit improvement in the smithy!'
	),
);

$lang['quests']['economy'] = array(
	'1' => array(
		'Title' => 'Iron mine',
		'Description' => 'Higher iron production for your village. A production bonus will help you increase the production of any particular resource even further.',
		'toDo' => array('Update Iron field'),
		'reward' => '1 day +25% bonus on the production of all resources',

		'completed' => 'Higher iron production for your village. A production bonus will help you increase the production of any particular resource even further.'
	),
	'2' => array(
		'Title' => 'More resources',
		'Description' => 'Extend one lumber, clay, iron and crop field each to level 1. To complete this task you need to have at least 2 fields of each resource type above level 0. As long as Travian PLUS is still active, you can always order one further construction at the same time.',
		'toDo' => array('Extend one more of each resource tile to level 1'),
		'reward' => '<i class="r1"></i> '.number_format(160*SPEED).' <i class="r2"></i> '.number_format(190*SPEED).' <i class="r3"></i> '.number_format(150*SPEED).' <i class="r4"></i> '.number_format(70*SPEED).'',

		'completed' => 'Congratulations! Your village grows and thrives.'
	),
	'3' => array(
		'Title' => 'Granary',
		'Description' => 'In order to store more crop, you need a granary. Your current storage limit can be found when looking at the resources bar.',
		'toDo' => array('Construct a granary'),
		'reward' => '<i class="r1"></i> '.number_format(250*SPEED).' <i class="r2"></i> '.number_format(290*SPEED).' <i class="r3"></i> '.number_format(100*SPEED).' <i class="r4"></i> '.number_format(130*SPEED).'',

		'completed' => 'Nicely done! The granary now allows you to store more crop.'
	),
	'4' => array(
		'Title' => 'All to one',
		'Description' => 'In the beginning, it\s best to focus on resources. Please upgrade all your resource fields to level 1.',
		'toDo' => array('Upgrade all resource fields to level 1'),
		'reward' => '<i class="r1"></i> '.number_format(400*SPEED).' <i class="r2"></i> '.number_format(460*SPEED).' <i class="r3"></i> '.number_format(330*SPEED).' <i class="r4"></i> '.number_format(270*SPEED).'',

		'completed' => 'Your resource production is developing nicely. Soon we can start the construction of more buildings in your village.'
	),
	'5' => array(
		'Title' => 'To 2!',
		'Description' => 'Well done! If you require more information regarding your production, click on your stocks 2.',
		'toDo' => array('Upgrade 1 field of each resource to level 2'),
		'reward' => '<i class="r1"></i> '.number_format(240*SPEED).' <i class="r2"></i> '.number_format(255*SPEED).' <i class="r3"></i> '.number_format(190*SPEED).' <i class="r4"></i> '.number_format(160*SPEED).'',

		'completed' => 'Well done! If you require more information regarding your production, click on your stocks.'
	),
	'6' => array(
		'Title' => 'Marketplace',
		'Description' => 'In case you have a lack of one resource, you can trade it for other resources with other players at the marketplace. In order to construct a small marketplace, you need a larger main building.',
		'toDo' => array('Construct marketplace'),
		'reward' => '<i class="r1"></i> '.number_format(600*SPEED).'',

		'completed' => 'Your marketplace is ready and you can now start trading with other players. Don\'t fall for the really bad offers though!'
	),
	'7' => array(
		'Title' => 'Trade',
		'Description' => 'Existing offers on the marketplace can be seen when clicking on buy. Check the exchange rate and the distance. Should you not be able to find a suitable offer, click on offer to create an offer yourself.',
		'toDo' => array('Create a marketplace offer or accept one'),
		'reward' => '<i class="r1"></i> '.number_format(100*SPEED).' <i class="r2"></i> '.number_format(99*SPEED).' <i class="r3"></i> '.number_format(99*SPEED).' <i class="r4"></i> '.number_format(99*SPEED).'',

		'completed' => 'Awesome, you have initiated your first trade.'
	),
	'8' => array(
		'Title' => 'All to 2',
		'Description' => 'Before you start constructing more expensive buildings, we should further increase your resource production. Upgrade all your resource fields to level 2.',
		'toDo' => array('Extend all resource fields to level 2'),
		'reward' => '<i class="r1"></i> '.number_format(400*SPEED).' <i class="r2"></i> '.number_format(400*SPEED).' <i class="r3"></i> '.number_format(400*SPEED).' <i class="r4"></i> '.number_format(200*SPEED).'',

		'completed' => 'Congratulations! Your resource production is developing nicely.'
	),
	'9' => array(
		'Title' => 'Warehouse Level 3',
		'Description' => 'It\s time to adjust your warehouse to the increased production. Unplanned loot from your hero may also make your storage overflow.',
		'toDo' => array('Upgrade your warehouse to level 3'),
		'reward' => '<i class="r1"></i> '.number_format(620*SPEED).' <i class="r2"></i> '.number_format(730*SPEED).' <i class="r3"></i> '.number_format(560*SPEED).' <i class="r4"></i> '.number_format(230*SPEED).'',

		'completed' => 'Really good, no valuable resources will be wasted now.'
	),
	'10' => array(
		'Title' => 'Granary level 3',
		'Description' => 'The higher your production, the easier your storage gets filled up. The granary should also be upgraded.',
		'toDo' => array('Upgrade your granary to level 3'),
		'reward' => '<i class="r1"></i> '.number_format(880*SPEED).' <i class="r2"></i> '.number_format(1020*SPEED).' <i class="r3"></i> '.number_format(590*SPEED).' <i class="r4"></i> '.number_format(320*SPEED).'',

		'completed' => 'Now there is room again in the granary, so that production can continue even in your absence.'
	),
	'11' => array(
		'Title' => 'Grain Mill',
		'Description' => 'A grain mill increases the production of all your croplands. In order to be worth its price, you need to have a high enough base production.',
		'toDo' => array('Upgrade one cropland to level 1'),
		'reward' => 'Grain Mill Level 2',

		'completed' => 'Now you have a lot of free crop available for further constructions. There are also buildings that increase the production of the other resources.'
	),
	'12' => array(
		'Title' => 'All to 5',
		'Description' => 'You will need a much higher production in order to spare you a long waiting time until you are able to afford the buildings and settlers needed for a second village. Upgrade all resource fields to level 5.',
		'toDo' => array('Upgrade all resource fields to level 5'),
		'reward' => '1 day +25% bonus on the production of all resources',

		'completed' => 'Excellent! Your own production powers will help you extract the Settlers'
	),
);
$lang['quests']['world'] = array(
	'1' => array(
		'Title' => 'View statistics',
		'Description' => 'In the world of Travian, you compete against thousands of other players. Check the statistics to find out more about your own position in the game.',
		'toDo' => array('Open the statistics and compare yourself with other players'),
		'reward' => '<i class="r1"></i> '.number_format(90*SPEED).' <i class="r2"></i> '.number_format(120*SPEED).' <i class="r3"></i> '.number_format(60*SPEED).' <i class="r4"></i> '.number_format(30*SPEED).'',

		'completed' => 'Apart from the rank, there is other useful information. The tab Top10 will show you the strongest attackers and the most successful robbers.'
	),
	'2' => array(
		'Title' => 'Change village name',
		'Description' => 'A village name chosen by you is a sign to other players, showing them that your empire is being led actively.',
		'toDo' => array('Change the village name on the village sign'),
		'reward' => '100 culture points',

		'completed' => 'Nice, now you have completed the first step to leave your mark in the world of Travian.'
	),
	'3' => array(
		'Title' => 'Main building level 3',
		'Description' => 'To be able to mount some daughter, you need a level header building higher; Except that the village engineer will be able to accomplish the most of them at greater speed, the more head building level is raised. But something you should not forget: everything needs resources!',
		'toDo' => array('Upgrade a Level 3 Main building'),
		'reward' => '<i class="r1"></i> '.number_format(170*SPEED).' <i class="r2"></i> '.number_format(100*SPEED).' <i class="r3"></i> '.number_format(130*SPEED).' <i class="r4"></i> '.number_format(70*SPEED).'',

		'completed' => 'Great, the bigger main building now allows you to construct some additional buildings that you\'ve just unlocked.'
	),
	'4' => array(
		'Title' => 'Construct an embassy',
		'Description' => 'The world of Travian is a dangerous place and you need to be able to defend yourself. The best additional defence is offered by strong allies. Construct an embassy in order to join an alliance.',
		'toDo' => array('Construct an embassy'),
		'reward' => '<i class="r1"></i> '.number_format(215*SPEED).' <i class="r2"></i> '.number_format(145*SPEED).' <i class="r3"></i> '.number_format(195*SPEED).' <i class="r4"></i> '.number_format(50*SPEED).'',

		'completed' => 'Perfect, now you can accept alliance invitations. Invitations can be found inside the embassy.'
	),
	'5' => array(
		'Title' => 'Open map',
		'Description' => 'The map shows you the world of Travian. Check out your neighbours to find allies and identify threats!',
		'toDo' => array('Open the map in the menu'),
		'reward' => '<i class="r1"></i> '.number_format(90*SPEED).' <i class="r2"></i> '.number_format(160*SPEED).' <i class="r3"></i> '.number_format(90*SPEED).' <i class="r4"></i> '.number_format(95*SPEED).'',

		'completed' => 'Are there strong players or alliances near you? The map also helps you find oases and spots where you can settle new villages.'
	),
	'6' => array(
		'Title' => 'Read message',
		'Description' => 'You have just received a message with some helpful hints. Unread messages can be identified by the number above the button. Have a look now.',
		'toDo' => array('Open the messages overview and read the taskmaster\s message!'),
		'reward' => '<i class="r1"></i> '.number_format(280*SPEED).' <i class="r2"></i> '.number_format(315*SPEED).' <i class="r3"></i> '.number_format(200*SPEED).' <i class="r4"></i> '.number_format(145*SPEED).'',

		'completed' => 'Use messages to communicate with other players. It does always pay out to be calm and polite, even if you are at battle.'
	),
	'7' => array(
		'Title' => 'Bonus gold',
		'Description' => 'During the tutorial, you\'ve already used gold to speed up your construction orders. In the gold shop, you can find out what else you can use your gold for.',
		'toDo' => array('Take a look at the advantages you can buy with gold'),
		'reward' => '<img src="img/x.gif" title="gold" class="gold"> 20',

		'completed' => 'Here is some free gold again, so that you can make use of some of the gold advantages.'
	),
	'8' => array(
		'Title' => 'Alliance',
		'Description' => 'Search for allies and join an alliance. If you don\'t have any contacts yet, check the alliances of players near you or search for an alliance on the forum.',
		'toDo' => array('Join an alliance'),
		'reward' => '<i class="r1"></i> '.number_format(295*SPEED).' <i class="r2"></i> '.number_format(210*SPEED).' <i class="r3"></i> '.number_format(235*SPEED).' <i class="r4"></i> '.number_format(185*SPEED).'',

		'completed' => 'We\'re off to a great start. The stronger and more active each single player is, the stronger you will be as a team. Have you found out how to report attacks to each other and how to ask for assistance?'
	),
	'9' => array(
		'Title' => 'Main building level 5',
		'Description' => 'It is time to upgrade the main building, so that you can construct new buildings. Please remember to also take care of your resource production at the same time.',
		'toDo' => array('Upgrade your main building to level 5'),
		'reward' => '<i class="r1"></i> '.number_format(570*SPEED).' <i class="r2"></i> '.number_format(470*SPEED).' <i class="r3"></i> '.number_format(560*SPEED).' <i class="r4"></i> '.number_format(265*SPEED).'',

		'completed' => 'Great! isn\'t it ? Now Your Building will Build Faster. Get Your Reward And prepare your self for next Quest.'
	),
	'10' => array(
		'Title' => 'Seat of government',
		'Description' => 'Construct a seat of government now in order to found a new village soon. In case you are not sure if you want this village to remain your capital village, please select the residence.',
		'toDo' => array('Seat of government'),
		'reward' => '<i class="r1"></i> '.number_format(525*SPEED).' <i class="r2"></i> '.number_format(420*SPEED).' <i class="r3"></i> '.number_format(620*SPEED).' <i class="r4"></i> '.number_format(335*SPEED).'',

		'completed' => 'This building is necessary in order to settle a new village or conquer one. Its level limits the amount of possible expansions.'
	),
	'11' => array(
		'Title' => 'Culture points',
		'Description' => 'In order to reign over more villages in your empire, you need culture points. The overview in the residence or palace tells you how far away you are and how long it is going to take.',
		'toDo' => array('Open the culture points tab in your residence or palace'),
		'reward' => '<i class="r1"></i> '.number_format(650*SPEED).' <i class="r2"></i> '.number_format(800*SPEED).' <i class="r3"></i> '.number_format(740*SPEED).' <i class="r4"></i> '.number_format(530*SPEED).'',

		'completed' => 'In the village list you can also see the current status of possible new villages and the amount of missing culture points. Visit \"Answers\" to find out how to quickly increase your culture points.'
	),
	'12' => array(
		'Title' => 'Warehouse level 7',
		'Description' => 'Upgrade your warehouse to prepare yourself for settling a new village. Your current storage capacity won\'t be enough soon to afford the required buildings and settlers.',
		'toDo' => array('Upgrade your warehouse to level 7'),
		'reward' => '<i class="r1"></i> '.number_format(2650*SPEED).' <i class="r2"></i> '.number_format(2150*SPEED).' <i class="r3"></i> '.number_format(1810*SPEED).' <i class="r4"></i> '.number_format(1320*SPEED).'',

		'completed' => 'Great, your storage capacity should be enough for some time now. Remember to defend or hide your valuable resources!'
	),

	'13' => array(
		'Title' => 'Residence or palace level 10',
		'Description' => 'Settlers can be trained in a palace or a residence. The tab "Train" shows you the required building level.',
		'toDo' => array('Upgrade your residence or palace to level 10'),
		'reward' => '500 culture points',

		'completed' => 'From each village you can only control 2 to 3 new villages. All that\s missing for a new village now are 3 settlers and a lot of culture points!'
	),
	'14' => array(
		'Title' => 'Train three settlers',
		'Description' => 'To establish a new village, the three settlers must start together. So you must protect these from attacks by opponents while in the village; And take care of them as soon as possible as soon as conditions are ready.',
		'toDo' => array('Train three settlers'),
		'reward' => '<i class="r1"></i> '.number_format(1050*SPEED).' <i class="r2"></i> '.number_format(800*SPEED).' <i class="r3"></i> '.number_format(900*SPEED).' <i class="r4"></i> '.number_format(750*SPEED).'',

		'completed' => 'Protect your settlers well from attacks until they are ready to go!'
	),
	'15' => array(
		'Title' => 'Creating new village',
		'Description' => 'Search the map for a good spot to settle. Would you like it to be near your village, produce more of one particular resource or be near many oases? Found a second village using your settlers!',
		'toDo' => array('Create new village'),
		'reward' => '48 hour(s) of Travian plus.',

		'completed' => 'Great, you\'re one of the most powerful empires in the world of Travian. Continue playing and traing lots of troops to defend the enemis.'
	),
);

$lang['quests']['monitor'] = array(
	'1' => array('Start tutorial'),
	'2' => array('Close Tasks','Open Tasks','Disable Hints'),
	'3' => array('Open Woodcutter area','construct Woodcutter'),
	'4' => array('Open building','Woodcutter 2'),
	'5' => array('Open Crop land','Construct Crop land'),
	'6' => array('Click On hero Image','Change production'),
	'7' => array('Enter village center'),
	'8' => array('Click on Building site','Construct Warehouse'),
	'9' => array('Click on RallyPoint place','Construct RallyPoint'),
	'10' => array('Complete construction'),
	'11' => array('Hero adventure'),
	'12' => array('Report menu','Read report'),
	'13' => array('Hero inventory','Heal Hero'),
	'14' => array('User Interface Help'),
	'15' => array('End of tutorial')
);

$lang['quests']['monitor']['battle'] = array(
	'01' => 'Next Adventure',
	'02' => 'Build Cranny',
	'03' => 'Build barracks',
	'04' => 'Complete 5 adventures',
	'05' => 'Train troops',
	'06' => 'Earth Wall',
	'07' => 'Attack oasis',
	'08' => '10 adventures',
	'09' => 'Auctions',
	'10' => 'Upgrade barracks',
	'11' => 'Construct an academy',
	'12' => 'Research unit',
	'13' => 'Construct a smithy',
	'14' => 'Improve units'
);

$lang['quests']['monitor']['economy'] = array(
	'01' => 'Iron mine',
	'02' => 'More resources',
	'03' => 'Granary',
	'04' => 'All to one',
	'05' => 'To 2!',
	'06' => 'Marketplace',
	'07' => 'Trade',
	'08' => 'All to 2',
	'09' => 'Warehouse Level 3',
	'10' => 'Granary level 3',
	'11' => 'Grain Mill',
	'12' => 'All to 5'
);

$lang['quests']['monitor']['world'] = array(
	'01' => 'View statistics',
	'02' => 'Change village name',
	'03' => 'Main building level 3',
	'04' => 'Construct an embassy',
	'05' => 'Open map',
	'06' => 'Read message',
	'07' => 'Bonus gold',
	'08' => 'Alliance',
	'09' => 'Main building level 5',
	'10' => 'Seat of government',
	'11' => 'Culture points',
	'12' => 'Warehouse level 7',
	'13' => 'Residence or palace level 10',
	'14' => '3 Settlers',
	'15' => 'New village',
);

$lang['quests']['Main'] = array(
	'QuestsList' => 'Task List',
    'Quest' => 'Quest',
    'Reward' => 'Rewards',
);

$lang['main']['options'] = array(
	'1' => 'Game',
	'2' => 'language settings',
	'3' => 'Language',
	'4' => 'English',
	'5' => 'Arabic',
	'6' => 'Save',
);

$lang['links'] = array(
	'Farms' => 'Farmlist System',
	'Support' => 'Contact Support',
);

$lang['Report'] = array(
	'Silver' => 'Silver',
);


$lang['Msgs'] = array(
	'wMSGT' => 'Message from Multihunter',
	'wMSGI' => 'There is a great prize waiting for you.<br><br>This message has been generated automatically, no need to replay.',
	'Arts' => '<div style="width:450px; height:830px; padding: 95px 60px
	60px 25px; background:
	url(img/Natars_Banner_gross.jpg)
	no-repeat;">
			<center>
				<h1>Artifacts</h1>
				<p style="font-size:85%; text-align:justify; width:400px">
				Artifacts have appeared and it is time to acquire useful artifacts. Hurry up to get a artifact before it is gone
					<br><br><img src="img/msg.jpg" alt="Artefacts" width="400" height="200" style="float:
	right">
					<br><br>
					Artifacts are valuable and usefull, and each artifact has a distinctive impact. The players want to get the most valuable and most valuable artifacts, such as training forces at a faster time and consuming wheat, while others prefer other effects. What do you want? Come on, hurry to own a artifact, and do not forget that owning a artifact alone is not enough, but you need support from your alliance to defend it, so prepare yourself well!	</p><br><br>
	<span style="font-size:60%; color: #666;"></span>
	</center>
	</div>',

	
	'WW' => 'Countless times have passed since the first battles on the walls of Natar, a number of Josh was destroyed on the walls of Natar, and the smell of death began to spread in a This am just started! Be sure to barge for the future!
	<br> <br>
	They have arrived scouts with stories, stories and scenes of awe that shiver the bodies, Josh is light, no one has passed from the road and his life has ended, a very large force, a cruel and merciless force, a crushing hope of people, a race has begun to equip your defense and your army for resistance and attack is not the last.
	<br> <br>
	Plan Building appeared, plan Building with which you can raise the level of miracle, kidnap artefacts before kidnapped by an opponent
	<br> <br>
	Dozens of F scouts wander around collecting and searching for anything but places of strength you will not be able to access! However problems have started and secrets for this Empress have appeared!
	<br> <br>
	It is at the end of the end, when the strongest Josh collides in a battlefield in a this is what Egypt decides to gather sides, swoop against a sword, and this is a war that will be repeated over time, this is your war, your love of digging your name through history, here you can become a legend ...
	<br> <br>
	<span style="font-size:60%; color: #666;"></span>
	<br><br>
	<br><br>
	<b> Requirements </b> <i>: To steal the building plan provides these conditions </i> <br>
	<li> Send attack full village schema </li>
	<li> To successfully attack the village scheme </li>
	<li> To destroy required </li>
	<li> Hero participation in attack is obligatory </li>
	<li> level required 10 </li>
	<br> <br>
	From then get artefacts. If the attack succeeds and the artefacts are hijacked, a specified target must be chosen (required)
	<br> <br>
	To build a Miracle owner, get one building plan up to level 49GB on another player. From alliance having another build plan to continue in a Miracle lift to level 100 ');

$lang['Footer'] = array(
	'Homepage' => 'Homepage',
	'Forum' => 'Forum',
	'Links' => 'Links',
	'FAQ' => 'FAQ - Answers',
	'Terms' => 'Terms',
	'Imprint' => 'Imprint'
);
$lang['Hero'] = array(
	'status01' => 'Hero is on adventure',
	'status02' => 'Hero is on his way back',
	'status03' => 'Hero is dead',
	'status04' => 'Hero is defending in village',
	'status05' => 'Hero is currently in village',

	'adv00' => 'New Adventure',
	'adv01' => 'Adventure time',
	'adv02' => 'Arrival in',
	'adv03' => 'Back in',
	'adv04' => 'Hour',
	'adv05' => 'To adventure',
	'adv06' => 'back',

	'speed' => 'Speed',
	'Attributes' => 'Attributes',
	'saveChanges' => 'Please save changes',

	'FStrength' => 'Fighting Strength',
	'FHero' => 'form hero',

	'OW01' => 'Arrival in',
	'OW02' => 'at',
	'OW03' => 'You can see the adventure progress in',
	'OW04' => 'Rallypoint',

	'Revive01' => 'Hero home is',
	'Revive02' => 'will be revived in village',
	'Revive03' => 'to change the hero main village or reviving him in another village',
	'Revive04' => 'Revive cost',
	'Revive05' => 'Hero is being revived in',
	'Revive06' => 'Remaining time',
);

$lang['Map'] = array(
	'0' => 'Map',
	'1' => 'Filter',
	'2' => 'ok',
	'3' => 'coordinates',
	'4' => 'alliance',

	'5' => 'player',
	'6' => 'population',
	'7' => 'alliance',
	'8' => 'tribe',
	'9' => 'village',
	'10' => 'An unoccupied oasis',
	'11' => 'An occupied oasis',
	'12' => 'Coordinates',
	'13' => 'loading',

	'14' => 'Roman',
	'15' => 'German',
	'16' => 'Gauls',
	'17' => 'Natars',
	'18' => 'Natars',
	'19' => 'Egyptians',
	'20' => 'Huns',

	'21' => 'Natar village',
	'22' => 'You won the attack without losses',
	'23' => 'You won the attack with losses',
	'24' => 'No one escaped from your soldiers',
	'25' => 'You won the Defense without losses',
	'26' => 'You won the Defense with losses',
	'27' => 'The village has been hacked',
	'28' => 'You won Defense with losses',

	'29' => 'Woord',
	'30' => 'Clay',
	'31' => 'Iron',
	'32' => 'Crop',
);

$lang['quests']['achievements'] = array(
	'1' => array(
		'Title' => 'Complete an adventure',
		'Description' => 'Send your hero on an adventure. This quest is accomplished once your hero arrives, even if it fails to survive the adventure. To send your hero on an adventure, just click on the icon shown on the image.<br><br>The points for this quest can be achieved 1 times per day',
		'toDo' => 'This quest is worth + 5 points',
		'questIn' => array('questGive' => 5, 'Hard' => 'moderate', 'needReq' => 'Available adventure')
	),
	'2' => array(
		'Title' => 'Raid an unoccupied oasis',
		'Description' => 'Send troops to raid an unoccupied oasis. This quest is accomplished once your army arrives, even if it is killed during the fight. Using cages to avoid the combat will not grant you any points for this quest. You can calculate the outcome of the raid by using the combat simulator. You can find it within your rally point.<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 3 points',
		'questIn' => array('questGive' => 3, 'Hard' => 'hard', 'needReq' => '(Lots of) troops')
	),
	'3' => array(
		'Title' => 'Raid/attack a Natarian village',
		'Description' => 'Send troops to raid/attack a Natarian village. This quest is accomplished once your army arrives, even if it is killed during the fight. You should not try to raid/attack a Wonder of the World village controlled by the Natarian tribe before you have gathered at least 100,000 troops.
		<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 3 points',
		'questIn' => array('questGive' => 9, 'Hard' => 'challenging', 'needReq' => '(Lots of) troops')
	),
	'4' => array(
		'Title' => 'Win an auction',
		'Description' => 'Participating in an auction will let you win twice - first when you win the auction and gain the item you want and second when you collect points for your daily rewards balance. The points will be awarded once you win any auction you bid on.<br><br>The points for this quest can be achieved 1 times per day',
		'toDo' => 'This quest is worth + 5 points',
		'questIn' => array('questGive' => 9, 'Hard' => 'challenging', 'needReq' => 'Complete 10 adventures')
	),
	'5' => array(
		'Title' => '0 / 3 Gain or spend gold',
		'Description' => 'To achieve the points for this quest, you need to either gain or spend gold. It is up to you to decide how and for what benefit you want to gain/use any amount of your gold balance.<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 2 points',
		'questIn' => array('questGive' => 6, 'Hard' => 'moderate', 'needReq' => 'Gold')
	),
	'6' => array(
		'Title' => 'Upgrade a building',
		'Description' => 'To achieve the points for this quest, you need to either upgrade an existing building or build a new one. The points will be granted once the construction is completed.<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 4 points',
		'questIn' => array('questGive' => 12, 'Hard' => 'moderate', 'needReq' => 'Resources')
	),
	'7' => array(
		'Title' => 'Upgrade a resource field',
		'Description' => 'To achieve the points for this quest, you need to either upgrade an existing resource field or build a new one. The points will be granted once the construction is completed.<br><br>The points for this quest can be achieved 3 times per day.',
		'toDo' => 'This quest is worth + 5 points',
		'questIn' => array('questGive' => 15, 'Hard' => 'moderate', 'needReq' => 'Resources')
	),
	'8' => array(
		'Title' => 'Build 20 infantry units of one type at once',
		'Description' => 'To achieve the points for this quest, you need to order the training of 20 infantry units in your barracks at once. Please be aware that infantry units already in the training queue will not grant you any points for this quest.<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 4 points',
		'questIn' => array('questGive' => 12, 'Hard' => 'challenging', 'needReq' => 'Barracks')
	),
	'9' => array(
		'Title' => 'Build 20 cavalry units of one type at once',
		'Description' => 'To achieve the points for this quest, you need to order the training of 20 cavalry units in your stable at once. Please be aware that cavalry units already in the training queue will not grant you any points for this quest.<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 4 points',
		'questIn' => array('questGive' => 12, 'Hard' => 'challenging', 'needReq' => 'Stable')
	),
	'10' => array(
		'Title' => 'Hold a small or big celebration',
		'Description' => 'Hold a small or big celebration Hold one small or big celebration in your town hall.<br>The points will be granted when you hold any celebration. Already running celebrations do not grant you any points.<br><br>The points for this quest can be achieved 3 times per day',
		'toDo' => 'This quest is worth + 5 points',
		'questIn' => array('questGive' => 15, 'Hard' => 'hard', 'needReq' => 'Town Hall')
	),
);

$lang['Daily'] = array(
	'01' => 'Complete an adventure',
'02' => 'Destroy an oasis',
'03' => 'Destroy / attack a Natar village',
'04' => 'Win an Auction',
'05' => 'Win or spend gold',
'06' => 'Update a building',
'07' => 'Update a resource field',
'08' => 'Build 20 infantry units of one type at a time',
'09' => 'Build 20 identical cavalry units at once',
'10' => 'Have a bigger or bigger holiday',

	'Close' => 'Close',
'Overview' => 'Overview',
'PG' => 'Points earned for the mission:',
'Difficulty' => 'Difficulty',
'Requirement' => 'Requirement',
'CRewards' => 'Collect Rewards',

'Congrats01' => 'Congratulations! You have earned enough points to get a reward! ',
'Congrats02' => 'To collect',
'Congrats03' => 'points, now you can collect your reward',
'Congrats04' => 'The daily reward is determined randomly from these options',
'Congrats05' => 'To collect',
'Congrats06' => 'points, you get the next reward today',
);

define('markASRead', 'Mark as read');
define('rMessage', 'Write Message');
define('Ignored', 'Ignored players');
define('Ignored01', 'To ignore messages from a specific player, go to its profile and click on "Ignore"!');
define('Ignored02', 'Ignore player.');
define('Ignored03', 'Player will be ignored.');
define('Ignored04', 'Stop ignoring this player.');
define('Ignored05', 'Accept messages from player.');

define("herostatus9", "On the way");
define("herostatus100", "In village");
define("herostatus101", "Hero is dead");
define("herostatus102", "Hero is caged");
define("herostatus103", "Hero is defending");


$lang['Profile'] = array(
	'00' => 'Player Profile',
	'01' => 'Details',
	'02' => 'Birthday',
	'03' => 'Gender',
	'04' => 'N/A',
	'05' => 'male',
	'06' => 'female',
);

$lang['Alliance'] = array(
	'00' => 'You are not in alliance.',
);

$lang['Logout'] = array(
	'01' => 'Back to the game',
	'02' => 'Account name or e-mail address',
	'03' => 'Password',
	'04' => 'Login',
);
