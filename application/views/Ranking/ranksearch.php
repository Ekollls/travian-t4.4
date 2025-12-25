<?php
if (!isset($_GET['id'])) {
    $_GET['id'] = '1';
}
?>
<div id="search_navi">
    <form method="post" action="statistiken.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : 1; ?>">
        <div class="boxes boxesColor gray">
            <div class="boxes-tl"></div>
            <div class="boxes-tr"></div>
            <div class="boxes-tc"></div>
            <div class="boxes-ml"></div>
            <div class="boxes-mr"></div>
            <div class="boxes-mc"></div>
            <div class="boxes-bl"></div>
            <div class="boxes-br"></div>
            <div class="boxes-bc"></div>
            <div class="boxes-contents w292">
                <table class="transparent">
                    <tbody>
                    <tr>
                        <td>
                            <span><?php echo OVERVIEW4; ?><input type="text" class="text ra" maxlength="5" name="rank" value="<?php echo ($search == 0) ? $start : $search; ?>"/></span>
                        </td>
                        <td>
                            <span><?php echo OVERVIEW17; ?><input type="text" class="text name" maxlength="20" name="name" value="<?php if (!is_numeric($search)) {echo $search;} ?>"/></span>
                        <td>
                            <input type="hidden" name="ft"
                                   value="r<?php echo isset($_GET['id']) ? $_GET['id'] : 1; ?>"/>
                            <button type="submit" value="search" name="search" id="btn_ok" class="green dynamic_img" src="img/x.gif">
                                <div class="button-container addHoverClick ">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content">
                                    Search
                                    </div>
                                </div>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <div class="paginator">
<?php
$nazad = STATISTIC34;
$vpered = STATISTIC35;
if ($start != 1 && $start + 20 < count($ranking)) {
    echo "<a href=\"statistiken.php?id=" . $_GET['id'] . "&amp;rank=" . ($start - 20) . "\">&laquo; $nazad</a> | <a href=\"statistiken.php?id=" . $_GET['id'] . "&amp;rank=" . ($start + 20) . "\">$vpered &raquo;</a>";
} else if ($start == 1 && $start + 20 < count($ranking)) {
    echo "&laquo; $nazad | <a href=\"statistiken.php?id=" . $_GET['id'] . "&amp;rank=" . ($start + 20) . "\">$vpered &raquo;</a>";
} else if ($start != 1 && $start - 20 < count($ranking)) {
    echo "<a href=\"statistiken.php?id=" . $_GET['id'] . "&amp;rank=" . ($start - 20) . "\">&laquo; $nazad</a> | $vpered &raquo;";
} else {
    echo "&laquo; $nazad | $vpered &raquo;";
}
?>
</div>
</div>
<div class="clear">&nbsp;</div>