<?php
/*
    By iRedux - https://www.facebook.com/opito8
*/
Class gMsg{
    public function getMsg(){
        global $database,$lang;

        $qData = $database->queryFetch("SELECT `global` FROM `config`");
        switch($qData['global']){
            case 'Arts':
                return $lang['Msgs']['Arts'];
            break;

            case 'WW':
                return $lang['Msgs']['WW'];
            break;

            default:
                return $qData['global'];
            break;
        }
    }

    function updateGlobal($g){
        global $database;
        
        $database->query('UPDATE `config` SET `global` = "'.addslashes($g).'"');
        $database->query('UPDATE `users` SET `msg` = 0');
    }
}

$global = new gMsg;