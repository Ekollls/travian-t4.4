<?php 
/*
    By iRedux - https://www.facebook.com/opito8
*/

Class Manual{

    public function getTroopRequirements($id){
        switch($id){
            case 1: $requirements = array( 19 => 1 ); break;
            case 2: $requirements = array( 13 => 1, 22 => 1 ); break;
            case 3: $requirements = array( 12 => 1, 22 => 5 ); break;
            case 4: $requirements = array( 20 => 1, 22 => 5 ); break;
            case 5: $requirements = array( 20 => 5, 22 => 5 ); break;
            case 6: $requirements = array( 20 => 10, 22 => 5 ); break;
            case 7: $requirements = array( 21 => 1, 22 => 10 ); break;
            case 8: $requirements = array( 21 => 10, 22 => 15 ); break;
            case 9: $requirements = array( 16 => 10, 22 => 20 ); break;
            case 10: $requirements = array(); break;

            case 11: $requirements = array( 19 => 1 ); break;
            case 12: $requirements = array( 22 => 1 ); break;
            case 13: $requirements = array( 12 => 1, 22 => 3 ); break;
            case 14: $requirements = array( 15 => 5, 22 => 1 ); break;
            case 15: $requirements = array( 20 => 3, 22 => 5 ); break;
            case 16: $requirements = array( 20 => 10, 22 => 15 ); break;
            case 17: $requirements = array( 21 => 1, 22 => 10 ); break;
            case 18: $requirements = array( 21 => 10, 22 => 15 ); break;
            case 19: $requirements = array( 16 => 5, 22 => 20 ); break;
            case 20: $requirements = array(); break;

            case 21: $requirements = array( 19 => 1 ); break;
            case 22: $requirements = array( 12 => 1, 22 => 3 ); break;
            case 23: $requirements = array( 20 => 1, 22 => 5 ); break;
            case 24: $requirements = array( 20 => 3, 22 => 5 ); break;
            case 25: $requirements = array( 20 => 5, 22 => 5 ); break;
            case 26: $requirements = array( 20 => 10, 22 => 15 ); break;
            case 27: $requirements = array( 21 => 1, 22 => 10 ); break;
            case 28: $requirements = array( 21 => 10, 22 => 15 ); break;
            case 29: $requirements = array( 16 => 10, 22 => 20 ); break;
            case 30: $requirements = array(); break;

            case 51: $requirements = array( 19 => 1 ); break;
            case 52: $requirements = array( 19 => 1, 12 => 1 ); break;
            case 53: $requirements = array( 22 => 5, 12 => 1 ); break;
            case 54: $requirements = array( 20 => 1, 22 => 5 ); break;
            case 55: $requirements = array( 20 => 5, 22 => 5 ); break;
            case 56: $requirements = array( 20 => 10, 22 => 5 ); break;
            case 57: $requirements = array( 22 => 10, 21 => 5 ); break;
            case 58: $requirements = array( 21 => 10, 22 => 15 ); break;
            case 59: $requirements = array( 16 => 10, 22 => 20 ); break;
            case 60: $requirements = array(); break;

            case 61: $requirements = array( 19 => 1 ); break;
            case 62: $requirements = array( 22 => 3, 12 => 1 ); break;
            case 63: $requirements = array( 22 => 5, 20 => 1 ); break;
            case 64: $requirements = array( 22 => 5, 20 => 3 ); break;
            case 65: $requirements = array( 22 => 5, 20 => 5 ); break;
            case 66: $requirements = array( 22 => 15, 20 => 10 ); break;
            case 67: $requirements = array( 22 => 10, 21 => 1 ); break;
            case 68: $requirements = array( 21 => 10, 22 => 15 ); break;
            case 69: $requirements = array( 16 => 10, 22 => 20 ); break;
            case 70: $requirements = array(); break;

            default:
                $requirements = array();
            break;
        }
        return ($requirements);
    }

    public function getBuildRequirements($id){
        switch($id){
            case 5: $requirements = array( 1 => 10, 15 =>5 ); break;
            case 6: $requirements = array( 2 => 10, 15 =>5 ); break;
            case 7: $requirements = array( 3 => 10, 15 =>5 ); break;
            case 8: $requirements = array( 4 => 5, 15 =>5 ); break;
            case 9: $requirements = array( 4 => 10, 8 =>5, 15 =>5  ); break;
            case 10: $requirements = array( 15 => 1 ); break;
            case 11: $requirements = array( 15 => 1 ); break;
            case 12: case 13: $requirements = array( 15 => 3, 22 => 1 ); break;
            case 14: $requirements = array( 16 => 15 ); break;
            case 17: $requirements = array( 10 => 1, 11 => 1, 15 => 3 ); break;
            case 18: $requirements = array( 15 => 1 ); break;
            case 19: $requirements = array( 15 => 3, 16 => 1 ); break;
            case 20: $requirements = array( 12 => 3, 22 => 5 ); break;
            case 21: $requirements = array( 15 => 5, 22 => 10 ); break;
            case 22: $requirements = array( 15 => 3, 19 => 3 ); break;
            case 24: $requirements = array( 15 => 10, 22 => 10 ); break;
            case 25: $requirements = array( 15 => 5, 26 => 0, 44 => 0 ); break;
            case 26: $requirements = array( 15 => 5, 18 => 1, 25 => 0, 44 => 0 ); break;
            case 27: $requirements = array( 15 => 10, 40 => 0); break;
            case 28: $requirements = array( 17 => 20, 20 => 10); break;
            case 29: $requirements = array( 19 => 20); break;
            case 30: $requirements = array( 20 => 20); break;
            case 31: $requirements = array(); break;
            case 34: $requirements = array(15 => 5); break;
            case 35: $requirements = array(11 => 20, 16 => 10); break;
            case 36: $requirements = array(16 => 1); break;
            case 37: $requirements = array(16 => 1); break;
            case 38: $requirements = array(15 => 10); break;
            case 39: $requirements = array(15 => 10); break;
            case 40: $requirements = array(); break;
            case 41: $requirements = array(16 => 10, 20 => 20); break;
            case 44: $requirements = array(15 => 5, 25 => 0, 26 => 0); break;
            case 45: $requirements = array(37 => 10); break;
            

            default:
                $requirements = array();
            break;
       }

        return ($requirements);
    }
}

$manual = new Manual;