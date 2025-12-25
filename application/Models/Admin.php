<?php
Class Admin{
    
    // Empty all oases from monsters
    function emptyO(){
        global $database, $session;

        if($session->access == 9){
            $oases = $database->query("SELECT * FROM odata WHERE conqured = 0");
            foreach($oases as $oasis){
                $database->query('UPDATE units SET u1=0,u2=0,u3=0,u4=0,u5=0,u6=0,u7=0,u8=0,u9=0,u10=0 WHERE vref = '.$oasis['wref'].'');
            }
        }
    }

    function deleteMsg($id){
        global $database;
        $database->query('DELETE FROM mdata WHERE id = '.$id.'');
    }

    function sUpdate($key, $value){
        global $database;
        $database->query('UPDATE config SET '.$key.' = "'.$value.'"');
    }

}

$panel = new Admin;