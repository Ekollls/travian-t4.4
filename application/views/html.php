<!DOCTYPE html>
<html>
<head>
    <title><?= SERVER_NAME ?></title>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="content-language" content="<?php echo LANG_UR; ?>"/>
    <link href="gpack/lang/<?php echo LANG_UR; ?>/compact.css" rel="stylesheet" type="text/css"/>
    <link href="gpack/lang/<?php echo LANG_UR; ?>/lang.css" rel="stylesheet" type="text/css"/>
	<link href="gpack/lang/<?php echo LANG_UR; ?>/fixes.css?rev13" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="js/default/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/default/jquery.md5.min.js"></script>
    <script type="text/javascript" src="js/default/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="js/default/d3/d3.min.js"></script>
    <script type="text/javascript" src="js/default/d3/d3pie.min.js"></script>
    <script type="text/javascript" src="js/default/gsap/minified/TweenMax.min.js"></script>
    <script type="text/javascript" src="js/default/gsap/minified/plugins/MorphSVGPlugin.min.js"></script>
    <script type="text/javascript" src="js/Game/General/General.js"></script>

	<script type="text/javascript">
		var j$ = $.noConflict();
	</script>
    <script type="text/javascript">
        window.TravianDefaults = {
            Map: { Size: { width: 201, height: 201, left: -100, right: 100, bottom: -100, top: 100 } }
        };
        function getMapSize() {return 100;}
        function getAutoReloadStatus(){return 1;}
    </script>

    <script type="text/javascript" src="crypt.js"></script>
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <script type="text/javascript">
        Travian.Translation.add({
            'allgemein.anleitung': '<?php echo $lang['Manual']['Instructions']; ?>',
            'allgemein.cancel': 'Cancel',
            'allgemein.ok': 'OK',
            'allgemein.close': '<?php echo $lang['Daily']['Close']; ?>',
            'cropfinder.keine_ergebnisse': 'There are no results'
        });
        Travian.applicationId = 'T4.4 Game';
        Travian.Game.version = '4.4';
        Travian.Game.worldId = 'vip7';
        Travian.Game.speed = <?php echo SPEED; ?>;
        Travian.Templates = {};
        Travian.Templates.ButtonTemplate = "<button >\n\t<div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\"><\/div>\n\t<\/div>\n<\/button>\n";
    </script>
    <script type="text/javascript">
        Travian.Game.eventJamHtml = '&lt;a href=&quot;http://t4.answers.travian.ir/index.php?aid=249#go2answer&quot; target=&quot;blank&quot; title=&quot;Response&zwnj;Travian&quot;&gt;&lt;span class=&quot;c0 t&quot;&gt;0:00:0&lt;/span&gt;?&lt;/a&gt;'.unescapeHtml();
                Travian.Game.eventJamHtml = '&lt;a href=&quot;javascript:void&quot; onclick=&quot;document.location.reload();&quot;&gt;&lt;img src=&quot;img/refresh.png&quot;&gt;&lt;/a&gt;'.unescapeHtml();
            </script>


</head>
<script type="text/javascript">
    window.ajaxToken = '765784eba4d5b4156277301c5674432faca910fc';
    window._player_uuid = '';
    Travian.Game.Preferences.initialize({"highlightsToggle":"true","travian_toggle_hero":"expanded","travian_toggle_infobox":"expanded","travian_toggle_villagelist":"collapsed","travian_toggle_alliance":"expanded","WMBlueprints":"[]","QuestDialogPosition":"{\"position\":null,\"preferenceKey\":\"QuestDialogPosition\"}"});
    Travian.Game.Quest.init();
</script>

