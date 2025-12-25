<?php
/*
    By iRedux - https://www.facebook.com/opito8
*/
Class Msg{
    function getUser($username){
        global $database;

        $uData = $database->queryFetch('SELECT * FROM  users WHERE username = "'.$username.'"');
        if($uData['id']){
            $m = '<a href="spieler.php?uid='.$uData['id'].'">'.$uData['username'].'</a>';
        }else{
            $m = '<span style="font-style:italic;">No player was found</span>';
        }

        return $m;
    }

    function getAlliance(){

    }
}

$msg = new Msg;