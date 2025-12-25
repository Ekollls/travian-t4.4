<?php
$q1 = "SELECT `infa` FROM palevo WHERE `type` = '0' AND `sit` = '0' GROUP BY `infa` HAVING count(`uid`) > 1";
$work_arr = $database->query($q1);
?>
<div class="card">
<div class="card-header"><?php echo $lang['Admin']['multi01']; ?></div>
<div class="card-body">
<table class="table">
    <thead>
    <td class="b"><?php echo $lang['Admin']['multi02']; ?></td>
    <td class="b"><?php echo $lang['Admin']['multi03']; ?></td>
    </thead>
    <tbody>


        <?php
        foreach($work_arr as $work_inf){
        //$output[] = '<a href="?p=player&uid='.$u['id'].'">'.$u['username'].'</a>'; }
        $q2 = "SELECT `uid` FROM palevo WHERE `infa` = '".$work_inf['infa']."' AND `sit`='0' GROUP BY `uid`";
        $inf_arr = $database->query($q2);
        $output = "";
        if(count($inf_arr)>1){
            unset($userdata);
            foreach($inf_arr as $work_use){
            $userdata = $database->query("SELECT `id`,`username` FROM users WHERE id = ".$work_use['uid']);
                foreach ($userdata as $u) {
                    $output = $output.'<a href="?p=player&uid='.$u['id'].'">'.$u['username'].'</a> + '; 
                }
            }
        ?>
    <tr>
        <td><?php echo $output; ?></td>
        <td><?php echo $work_inf['infa']; ?></td>
    </tr>
        <?php
        }
        }

echo '</tbody></table>';
?>
</div>