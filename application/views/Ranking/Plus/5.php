<?php
include("application/views/Plus/pmenu.php");
  $g = '<img src="img/x.gif" class="gold" alt="gold">';
?>

    <h2><?=mkg0?></h2>

     <br>


    <h2><?=mkg1?></h2>

    <h3><?=mkg2?> </h3><b><?=mkg2?></b>:
    <br>
    <span class="link"><?php echo HOMEPAGE; ?>anmelden.php?ref=<?php echo $session->uid; ?></span>
<br/><br/><b><?=mkg4?></b>
    <p><?=mkg5?> <b><?= REF_POP?></b> <?=mkg6?> <b><?= REF_GOLD?></b> <?=mkg7?> <?php echo $g;?>.</p>
    <p><?=mkg8?>

    <table id="brought_in" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <th colspan="6"><?=mkg9?></th>
    </tr>

    <tr>
        <td><?=mkg10?></td>

        <td><?=mkg11?></td>

        <td><?=mkg12?></td>

        <td><?=mkg13?></td>

        <td><?=mkg14?> <?php echo $g;?></td>
    </tr>
    </thead>
    <tbody>
    <?php
    $invite = $database->getInvitedUser($session->uid);
    if(count($invite) > 0){
        foreach($invite as $invited) {
            $varray = $database->getProfileVillages($invited['id']);
            $totalpop = 0;
            foreach($varray as $vil) {
                $totalpop += $vil['pop'];
            }
            $uidg=$session->uid;
            $go = '<img src="img/x.gif" class="gold" alt="gold">';
            $gol = '<img src="'.GP_LOCATE.'img/a/gold_g.gif">'; ?>




            <tr>
                <td><?php echo'<a href="spieler.php?uid='.$database->getUserField($invited['id'],"id",0).'">'.$database->getUserField($invited['id'],"username",0).'</a>' ?> </td>

                <td><?php echo date("j.m.y",$invited['ptime']); ?></td>

                <td><?php echo $totalpop; ?></td>

                <td><?php echo count($varray); ?></td>

                <td><center><?php
                        if($totalpop>=REF_POP){
                            ?>
                            <a href="?utakegold=<?php echo $invited['id'];?>&checker=<?php echo $session->checker;?>"  title="Получить золото"><?php echo $go;?></a>
                        <?php }else{ echo $gol;} ?>




                    </center></td>
            </tr>
        <?php
        }}else{
        ?>
        <tr>
            <td class="none" colspan="6"><?=mkg15?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>


