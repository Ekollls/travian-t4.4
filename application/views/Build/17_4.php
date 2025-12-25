<?php if($session->goldclub == 1 && count($session->villages) > 1) {

    if(isset($_GET['create']) && $session->gold > 1){
        include("17_create.php");
    }else if($_GET['action'] == 'editRoute' && isset($_GET['routeid']) && $_GET['routeid'] != ""){
        $traderoute = $database->getTradeRouteUid($_GET['routeid']);
        if($traderoute == $session->uid){
            include("17_edit.php");
        }
    }else{
        ?>

        <table id="npc" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="2"><?=OVERVIEW3?></th>
                <th><?=market45?></th>
                <th><?=MERCHANTS?></th>
                <th><?=market8?></th>
            </tr></thead><tbody>
            <?php
            $routes = $database->getTradeRoute($session->uid);
            if(count($routes) == 0) {
                echo "<td colspan=\"5\" class=\"none\">".market46."</td></tr>";
            }else{
                foreach($routes as $route){
                    ?>
                    <tr>
                        <th><a href="build.php?id=<?=$id?>&t=4&action=delRoute&routeid=<?php echo $route['id']; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></a></th>
                        <th>
                            <?php
                            echo "".market47." <a href=karte.php?d=".$route['wid']."&c=".$generator->getMapCheck($route['wid']).">".$database->getVillageField($route['wid'],"name")."</a></br>";
                            ?>
                            <img class="r1" src="img/x.gif" alt="Wood" title="Wood"> <?php echo $route['wood']; ?>
                            <img class="r2" src="img/x.gif" alt="Clay" title="Clay"> <?php echo $route['clay']; ?>
                            <img class="r3" src="img/x.gif" alt="Iron" title="Iron"> <?php echo $route['iron']; ?>
                            <img class="r4" src="img/x.gif" alt="Crop" title="Crop"> <?php echo $route['crop']; ?>

                        </th>
                        <th><?php if($route['start'] > 9){ echo $route['start'];}else{ echo "0".$route['start'];} echo ":00"; ?></th>
                        <th><?php echo $route['deliveries']."x".$route['merchant']; ?></th>
                        <th><a href="build.php?id=<?php echo $id; ?>&t=4&action=editRoute&routeid=<?php echo $route['id']; ?>">» <?=market48?></a></th>
                    </tr>
                <?php }} ?>
            </tbody></table>
        <br>
        <div class="options">
            <a class="arrow" href="build.php?s=17&t=4&create"> <?=market49?></a>
        </div>

    <?php
    }}else{
    header("Location: build.php?id=".$_GET['id']."");
}
?>