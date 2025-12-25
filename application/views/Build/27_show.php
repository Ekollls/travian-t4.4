<?php

                    if($artefact['size'] == 1){
                       $reqlvl = 10;
                       $effect = sokr1;
                   }elseif($artefact['size'] == 2 OR $artefact['size'] == 3){
                       $reqlvl = 20;
                       $effect = pluss11;
                   }
                   if($artefact['activated']==0){$active=sokr21;}else{$active=sokr22;}

                   

                   $te = $artefact['type'];
                   $se = $artefact['size'];
                    if($te== 1 AND $se == 1){
                    $name = ART1;
                    $desc = ART16;
                    $bonus= "(4x) " ;
                    $img = 2;
                    }
                     if($te== 1 AND $se == 2){
                    $name = ART2;
                    $desc =ART16;
                    $bonus= "(3x) " ;
                    $img = 2;

                    }
                     if($te== 1 AND $se == 3){
                    $name = ART3;
                    $desc =  ART16;
                    $bonus= "(5x) " ;
                    $img = 2;

                    }
                     if($te== 2 AND $se == 1){
                    $name = ART4;
                    $desc = ART17;
                    $bonus= "(2x) " ;
                    $img = 4;

                    }
                     if($te== 2 AND $se == 2){
                    $name = ART5;
                    $desc =  ART17;
                    $bonus= "(1.5x) " ;
                    $img = 4;

                    }
                     if($te== 2 AND $se == 3){
                    $name = ART6;
                    $desc =  ART17;
                    $bonus= "(3x) " ;
                    $img = 4;

                    }
                     if($te== 3 AND $se == 1){
                    $name = ART7;
                     $desc = ART18;
                    $bonus= "(5x) " ;
                    $img = 5;
                    }
                     if($te== 3 AND $se == 2){
                    $name = ART8;
                     $desc =  ART18  ;
                    $bonus= "(3x) " ;
                    $img = 5;
                    }
                     if($te== 3 AND $se == 3){
                    $name = ART9;
                     $desc = ART18   ;
                    $bonus= "(10x) " ;
                    $img = 5;
                   }
                     if($te== 5 AND $se == 1){
                    $name = ART10;
                     $desc =   ART19  ;
                    $bonus= "(50%) " ;
                    $img = 8;
                   }
                     if($te== 5 AND $se == 2){
                    $name = ART11;
                     $desc =     ART19      ;
                    $bonus= "(25%) " ;
                    $img = 8;
                   }
                     if($te== 5 AND $se == 3){
                    $name = ART12;
                     $desc =       ART19 ;
                    $bonus= "(50%) " ;
                    $img = 8;
                   }
                     if($te== 6){
                    $name = ART13;
                    $desc = ART20;
                    $bonus= ART15 ;
                    $img = 9;
                     }


                     if($te== 11 ){
                    $name = ART14;
                     $desc =    ART21;
                    $bonus= ART15;

                   }
                                           $alli="";
                   if($artefact['owner']==3){ $user=TRIBE5;}else{
                   $ui=$database->getUserforsoc($artefact['owner']);
                   if($ui['id']){
                   $alli='<a href="allianz.php?aid='.$ui['id'].'">'.$ui['tag'];
                   $user=$ui['username'];
                   }
                   }

?>
<div class="artefact">
    <h4><?php echo $name;?></h4>

    <p><?php echo $desc;?></p>

    <table id="art_details" class="transparent" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <th>owner</th>
            <td>
                <a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $user;?></a>            </td>
        </tr>
        <tr>
            <th>village</th>
            <td>
            <a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a>
            </td>
        </tr>
        <tr>
            <th>Alliance</th>
            <td><?php echo $alli ? $alli : '-'; ?></td>
        </tr>
        <tr>
            <th>the influence</th>
            <td><?php echo $effect; ?></td>
        </tr>
                    <tr>
                <th>reward</th>
                <td><?php echo $bonus; ?></td>
            </tr>
                <tr>
            <th>Treasury Level</th>
            <td>The safe is level <b><?php echo $reqlvl; ?></b></td>
        </tr>

        <tr>
            <th>seized</th>
            <td><?php echo date("Y-m-d H:i:s",$artefact['conquered']);?></td>
        </tr>

        <tr>
            <th>Act in</th>
            <td><?php echo $active; ?></td>
        </tr>
        </tbody>
    </table>
        <br>
    <img class="artefact image-<?php echo $img; ?>" src="img/x.gif" alt="artefact">
</div>
