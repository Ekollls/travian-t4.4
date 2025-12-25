<?php
Class Map{

    
    function oasisphoto($type){
        // types
        // 1 -> 25% lumber , 2 -> 50% lumber , 3 -> 25% lumber and 25% crop
        // 4 -> 25% clay , 5 -> 50% clay , 6 -> 25% clay and 25% crop
        // 7 -> 25% iron , 8 -> 50% iron , 9 -> 25% iron and 25% crop
        // 10, 11 -> 25% crop , 12 -> 50% crop
        switch($type){
            case 1:case 2: return 2; break;
            case 3: return 3; break;
            case 4:case 5: return 6; break;
            case 6: return 7; break;
            case 7:case 8: return 10; break;
            case 9: return 11; break;
            case 10:case 11: return 14; break;
            case 12: return 15; break;
        }
    }
}

$map = new Map;