<?php

class Ranking
{

    public $rankarray = array();

    public function getRank()
    {
        return $this->rankarray;
    }

    public function getUserRank($ref)
    {        
        $ranking = $this->rankarray;
        $set = (is_numeric($ref)) ? 'userid' : 'username';
        for ($i = 1; $i <= (count($ranking)); $i++) {
            if ($ranking[$i][$set] == $ref) {
                return $i;
            }
        }

        return false;
    }

    public function getUserRankIn($ref, $type)
    {        
        global $database;
        switch($type){
            case 1: $get = 'apall'; break;
            case 2: $get = 'dpall'; break;
        }
        $i=0;
        foreach($database->query("SELECT * FROM users ORDER BY ".$get." DESC") as $user){
            $i++;
            if($user['id'] == $ref){
                return $i;
                break;
            }
        }
    }


    public function procRankReq($get)
    {
        global $session;

        if (isset($get['id'])) {
            switch ($get['id']) {
                case 1:
                    $this->procRankArray();
                    $this->getStart($this->getUserRank($session->uid));
                    break;
                case 8:
                    $this->procHeroRankArray();
                    $this->getStart($this->getUserRank($session->uid));
                    break;
                case 11:
                    $this->procRankRaceArray(1);
                    $this->getStart($this->getUserRank($session->uid));
                    break;
                case 12:
                    $this->procRankRaceArray(2);
                    $this->getStart($this->getUserRank($session->uid));
                    break;
                case 13:
                    $this->procRankRaceArray(3);
                    $this->getStart($this->getUserRank($session->uid));
                    break;

                case 31:
                    $this->procAttRankArray();
                    $this->getStart($this->getUserRank($session->uid));

                    break;
                case 32:
                    $this->procDefRankArray();
                    $this->getStart($this->getUserRank($session->uid));
                    break;

                case 4:
                    $this->procARankArray();
                    if ($session->alliance == 0) {
                        $this->getStart(1);
                    } else {
                        $this->getStart($this->getAllianceRank($session->alliance));
                    }
                    break;
                case 41:
                    $this->procAAttRankArray();
                    if ($session->alliance == 0) {
                        $this->getStart(1);
                    } else {
                        $this->getStart($this->getAllianceRank($session->alliance));
                    }

                    break;
                case 42:
                    $this->procADefRankArray();
                    if ($session->alliance == 0) {
                        $this->getStart(1);
                    } else {
                        $this->getStart($this->getAllianceRank($session->alliance));
                    }

                    break;
            }
        } else {
            $this->procRankArray();
            $this->getStart($this->getUserRank($session->uid));
        }
    }

    public function procRank($post)
    {
        global $database;
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "r1":
                case "r8":
                case "r11":
                case "r12":
                case "r13":
                case "r31":
                case "r32":
                    if (isset($post['rank']) && $post['rank'] != "") {
                        $this->getStart($database->filterIntValue($database->filterVar($post['rank'])));
                    }
                    if (isset($post['name']) && $post['name'] != "") {
                        $this->getStart($this->getUserRank(stripslashes($post['name'])));
                    }
                    break;
                case "r2":
                case "r4":
                case "r42":
                case "r41":
                    if (isset($post['rank']) && $post['rank'] != "") {
                        $this->getStart($post['rank']);
                    }
                    if (isset($post['name']) && $post['name'] != "") {
                        $this->getStart($this->getAllianceRank(stripslashes($post['name'])));
                    }
                    break;
            }
        }
    }

    private function getStart($search)
    {
        $multiplier = 1;
        $startfrom = 0;
        if (!is_numeric($search)) {

        } else {
            if ($search > count($this->rankarray)) {
                $search = count($this->rankarray) - 1;
            }
            while ($search > (20 * $multiplier)) {
                $multiplier += 1;
                $startfrom += 1;
            }


        }
        $_SESSION['start'] = (20 * $startfrom);
        $_SESSION['search'] = $search;
    }

    public function getAllianceRank($ref)
    {

        $co = count($this->rankarray);

        $set = is_numeric($ref) ? 'id' : 'tag';
        if ($co >= 1) {
            for ($i = 1; $i < ($co); $i++) {
                if ($this->rankarray[$i][$set] == $ref) {

                    return $i;
                    break;
                }
            }

        }
        return 0;


    }

    public function searchRank($field)
    {
        if (isset($name["userid"])) {
            $key = key($this->rankarray);
            if ($this->rankarray[$key][$field] == $name) {
                return $key;

            } else {
                if (!next($this->rankarray)) {
                    return $name;

                }
            }
        }
        return false;
    }

    public function procRankArray2()
    {
        global $database;

        $holder = array();
        $q = "SELECT users.id userid,users.oldrank oldrank,  (

			SELECT SUM( vdata.pop )
			FROM vdata
			WHERE vdata.owner = userid
			)totalpop

			FROM users
			WHERE users.access <> 8  AND id>4
			ORDER BY totalpop DESC,userid DESC";

        $datas = $database->query($q);
        foreach ($datas as $result) {
            $value['userid'] = $result['userid'];
            $value['oldrank'] = $result['oldrank'];
            $value['totalpop'] = $result['totalpop'];
            array_push($holder, $value);
        }


        return $holder;
    }

    public function procRankArray()
    {
        global $database;
        $holder = array();
        $q = "SELECT users.id as userid,users.access, users.username,users.alliance, (

			SELECT SUM( vdata.pop )
			FROM vdata
			WHERE vdata.owner = userid
			)totalpop, (

			SELECT COUNT( vdata.wref )
			FROM vdata
			WHERE vdata.owner = userid AND type != 99
			)totalvillages, (

			SELECT alidata.tag
			FROM alidata, users
			WHERE alidata.id = users.alliance
			AND users.id = userid
			)allitag
			FROM users
			WHERE users.access <> 8 AND id>4
			 ORDER BY totalpop DESC, userid DESC";

        $datas = $database->query($q);
        foreach ($datas as $result) {
            $value['userid'] = $result['userid'];
            $value['username'] = $result['username'];
            $value['alliance'] = $result['alliance'];
            $value['aname'] = $result['allitag'];
            $value['totalpop'] = $result['totalpop'];
            $value['totalvillage'] = $result['totalvillages'];
            $value['access'] = $result['access'];
            array_push($holder, $value);
        }

        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }
        $this->rankarray = $newholder;

    }

    private function procRankRaceArray($race)
    {
        global $database;
        $holder = array();
        $q = "SELECT users.id userid, users.tribe tribe, users.username username,users.alliance alliance, (

			SELECT SUM( vdata.pop )
			FROM vdata
			WHERE vdata.owner = userid
			)totalpop, (

			SELECT COUNT( vdata.wref )
			FROM vdata
			WHERE vdata.owner = userid AND type != 99
			)totalvillages, (

			SELECT alidata.tag
			FROM alidata, users
			WHERE alidata.id = users.alliance
			AND users.id = userid
			)allitag
			FROM users
			WHERE users.tribe = '".$race."' AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . "  and id>4
			ORDER BY totalpop DESC, userid DESC";


        $datas = $database->query($q);

        foreach ($datas as $result) {
            //$value = $array[$result['userid']];
            $value['userid'] = $result['userid'];
            $value['username'] = $result['username'];
            $value['alliance'] = $result['alliance'];
            $value['aname'] = $result['allitag'];
            $value['totalpop'] = $result['totalpop'];
            $value['totalvillage'] = $result['totalvillages'];
            array_push($holder, $value);
        }

        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }
        $this->rankarray = $newholder;
    }

    private function procAttRankArray()
    {
        global $database;
        $holder = array();

        $q = "SELECT users.id userid, users.username username, users.apall,   (

			SELECT SUM( vdata.pop )
			FROM vdata
			WHERE vdata.owner = userid
			)pop
			FROM users
			WHERE users.apall >=0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . "   and id>4
			ORDER BY users.apall DESC,  userid DESC";
        $datas = $database->query($q);

        foreach ($datas as $row) {
            //$value = $array[$row['userid']];
            $value['username'] = $database->RemoveXSS($row['username']);
            $value['id'] = $row['userid'];
            $value['userid'] = $row['userid'];
            $value['totalpop'] = $row['pop'];
            $value['apall'] = $row['apall'];
            array_push($holder, $value);
        }

        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }
        $this->rankarray = $newholder;
    }

    private function procDefRankArray()
    {
        global $database;
        //global $database;
        //$array = $database->getRanking();
        $holder = array();
        $q = "SELECT users.id userid, users.username username, users.dpall,  (

			SELECT COUNT( vdata.wref )
			FROM vdata
			WHERE vdata.owner = userid AND type != 99
			)totalvillages, (

			SELECT SUM( vdata.pop )
			FROM vdata
			WHERE vdata.owner = userid
			)pop
			FROM users
			WHERE users.dpall >=0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>4
			ORDER BY users.dpall DESC,userid DESC";
        $datas = $database->query($q);

        foreach ($datas as $row) {
            //$value = $array[$row['userid']];
            $value['username'] = $database->RemoveXSS($row['username']);
            $value['totalvillages'] = $row['totalvillages'];
            $value['userid'] = $row['userid'];
            $value['id'] = $row['userid'];
            $value['totalpop'] = $row['pop'];
            $value['dpall'] = $row['dpall'];
            array_push($holder, $value);

        }
        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }
        $this->rankarray = $newholder;
    }

    public function procARankArray()
    {
        global $database;
        $array = $database->getARanking();
        $holder  = array();

        foreach ($array as $value) {
            $members = $database->getAllMemO($value['id']);
            $totalpop = $members['pop'];
            $value['players'] = $members['user'];
            $value['totalpop'] = $totalpop;
            if (!isset($value['avg'])) {
                $value['avg'] = @round($totalpop / $members['user']);
            } else {
                $value['avg'] = 0;
            }

            array_push($holder, $value);
        }
        $holder = $this->array_orderby($holder, 'totalpop', SORT_DESC);
        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }
        $this->rankarray = $newholder;
    }



    private function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = & $data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    function PlayerClimber()
    {
        global $database;

        $now=$this->procRankArray2();
        $q = "SELECT max(week) as max FROM medal where allycheck=0";
        $result = $database->query($q);
        if(count($result)) {
            $row=$result[0];
            $week=($row['max']+1);
        } else {
            $week=1;
        }
        $i=0;
        foreach ($now as $session) {

         $i++;
            $oldrank = $i;
if($week>1){
            if ($session['oldrank'] > $oldrank) {
                $totalpoints = $session['oldrank'] - $oldrank;
                $database->addclimberrankpop($session['userid'], $totalpoints);
                $database->updateoldrank($session['userid'], $oldrank);
            } elseif ($session['oldrank'] < $oldrank) {
                if ($session['oldrank'] != 0) {
                    $totalpoints = $oldrank - $session['oldrank'];
                } else {
                    $totalpoints = 0;
                }

                if ($totalpoints != 0) {
                    $database->removeclimberrankpop($session['userid'], $totalpoints);
                }
                $database->updateoldrank($session['userid'], $oldrank);
            }

}else{
    $this->procRankArray();
    $newrank = $this->getUserRank($session['userid']);
    $totalpoints = count($this->getRank()) - $newrank;
    $database->setclimberrankpop($session['userid'], $totalpoints);
    $database->updateoldrank($session['userid'], $newrank);


}
        }
    }



    private function procHeroRankArray()
    {
        global $database;
        $array = $database->getHeroRanking();
        $newholder = array(0 => array());
        foreach ($array as $key) {
            array_push($newholder, $key);
        }
        $this->rankarray = $newholder;
    }

    private function procAAttRankArray()
    {
        global $database;
        $array = $database->getARanking();
        $holder = array();
        foreach ($array as $value) {
            $memberlist = $database->getAllMember($value['id']);

            $val['players'] = count($memberlist);
            $val['totalap'] = $value['Aap'];
            $val['name'] = $value['name'];
            $val['id'] = $value['id'];
            $val['tag'] = $value['tag'];
            array_push($holder, $val);
        }
        $holder = $this->array_orderby($holder, 'totalap', SORT_DESC);
        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }

        $this->rankarray = $newholder;

    }

    private function procADefRankArray()
    {
        global $database;
        $array = $database->getARanking();
        $holder = array();
        foreach ($array as $value) {
            $memberlist = $database->getAllMember($value['id']);

            $val['players'] = count($memberlist);
            $val['id'] = $value['id'];
            $val['totaldp'] = $value['Adp'];
            $val['name'] = $value['name'];
            $val['tag'] = $value['tag'];
            array_push($holder, $val);
        }
        $holder = $this->array_orderby($holder, 'totaldp', SORT_DESC);
        $newholder = array(0 => array());
        foreach ($holder as $key) {
            array_push($newholder, $key);
        }

        $this->rankarray = $newholder;
    }

}


$ranking = new Ranking;
