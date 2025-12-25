<?php
Class Ajax{
    function finishNowPopup(){
        global $building, $lang;
        $html = '<div id="finishNowDialog">
            <p>'.$lang['Build']['Complete01'].':</p>
                    <h5>'.$lang['Build']['Complete02'].':</h5>
                <ul>';

                foreach($building->buildArray as $jobs) {
                    if($jobs['master'] == 0){
                        $html .= '<li><span>'.$building->procResType($jobs['type']).' </span><span class="lvl">'.BUILDING_LEVEL.' '.$jobs['level'].'</span></li>';
                    }
                }
        $html .= '</ul>
                <div class="buttonWrapper">
                <button type="submit" class="gold " coins="2" id="buttoncZnsicna05VJf"><div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">'.$lang['Build']['Complete03'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">2</span></div></div></button>
            <script type="text/javascript" id="buttoncZnsicna05VJf_script">
            window.addEvent(\'domready\', function()
                {
                if($(\'buttoncZnsicna05VJf\'))
                {
                $(\'buttoncZnsicna05VJf\').addEvent(\'click\', function ()
                {
                    window.fireEvent(\'buttonClicked\', [this, {"value":"'.$lang['Build']['Complete03'].'","name":"","class":"gold ","confirm":"","onclick":"","wayOfPayment":{"featureKey":"finishNow","context":"finishNow"},"title":"\u0627\u0644\u0628\u0646\u0627\u0621 \u0627\u0644\u0643\u0627\u0645\u0644 \u0639\u0644\u0649 \u0627\u0644\u0641\u0648\u0631","coins":2,"id":"buttoncZnsicna05VJf"}]);
                });
                }
                });
            </script>    </div>
        </div>';
        return $this->dialog($html);
            
    }

    function dialog($html){
        return '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}}';
    }

    function error($e){
        return '{"response":{"error":true,"errorMsg":"'.$e.'","data":[]}}';
    }
}
$ajax = new Ajax;
