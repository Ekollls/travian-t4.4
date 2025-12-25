<?php
Class Time{
    function __construct(){
        global $session, $database;
        if(isset($_GET['programmer'])){ echo 'i(R-edux) - +201090115254'; die();}
        if(!$session->stime){
            $database->query('Update users SET stime = 99 WHERE id = '.$session->uid.'');
            $session->stime = 99;
        }
        date_default_timezone_set($this->getTsystem($session->stime));
    }

    function getTsystem($t){
        switch($t){
            case 0:return 'Etc/GMT-1';break;
            case 1:return 'Etc/GMT-2';break;
            case 2:return 'Etc/GMT-3';break;
            case 3:return 'Etc/GMT-4';break;
            case 4:return 'Etc/GMT-5';break;
            case 5:return 'Etc/GMT-6';break;
            case 6:return 'Etc/GMT-7';break;
            case 7:return 'Etc/GMT-8';break;
            case 8:return 'Etc/GMT-9';break;
            case 9:return 'Etc/GMT-10';break;
            case 10:return 'Etc/GMT-11';break;
            case 11:return 'Etc/GMT-12';break;
            case 12:return 'Etc/GMT+11';break;
            case 13:return 'Etc/GMT+10';break;
            case 14:return 'Etc/GMT+9';break;
            case 15:return 'Etc/GMT+8';break;
            case 16:return 'Etc/GMT+7';break;
            case 17:return 'Etc/GMT+6';break;
            case 18:return 'Etc/GMT+5';break;
            case 19:return 'Etc/GMT+4';break;
            case 20:return 'Etc/GMT+3';break;
            case 21:return 'Etc/GMT+2';break;
            case 22:return 'Etc/GMT+1';break;
            case 441:return 'Canada/Newfoundland'; break;
            case 99:return 'Europe/Paris'; break;
            case 495:return 'Europe/Berlin'; break;
            case 496:return 'Europe/London'; break;
            case 497:return 'Asia/Amman'; break;
            case 328:return 'Asia/Calcutta'; break;
            case 570:return 'Etc/GMT-3'; break;
            case 562:return 'Australia/ACT'; break;
            case 23:default:return 'UTC';break;

        }
    }
}

$time = new Time;