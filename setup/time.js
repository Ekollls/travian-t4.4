function EpochToHuman(){
	var datum = new Date(document.ef.TimeStamp.value * 1000);
	document.getElementById('result1').innerHTML = "<b>GMT</b>: "+datum.toGMTString()+"<br /><b>Ваша временная зона</b>: "+datum.toLocaleString();
}
	
function HumanToEpoch(){
    	var datum = new Date(Date.UTC(document.hf.yyyy.value,document.hf.mm.value-1,document.hf.dd.value,document.hf.hh.value,document.hf.mn.value,document.hf.ss.value));
    	document.getElementById('result2').innerHTML = "<b>Epoch timestamp</b>: "+(datum.getTime()/1000.0)+"<br />Обычное время:  "+datum.toGMTString();
}
function HumanToEpoch2(){
   	var datum = new Date(document.fs.DateTime.value);
   	document.getElementById('result3').innerHTML = "<b>Epoch timestamp</b>: "+(datum.getTime()/1000.0);
}
	
function TimeCounter(){
	var t = parseInt(document.tc.DateTime.value);
	var days = parseInt(t/86400);
	t = t-(days*86400);
	var hours = parseInt(t/3600);
	t = t-(hours*3600);
	var minutes = parseInt(t/60);
	t = t-(minutes*60);
	var content = "";
	if(days)content+=days+" days";
	if(hours||days){ if(content)content+=", "; content+=hours+" hours"; }
	if(content)content+=", "; content+=minutes+" min "+t+" sec.";
	document.getElementById('result4').innerHTML = content;
}
var clockActive=1;
var timerID=0;
function now(){
	var today = new Date();
	document.getElementById('now').innerHTML = Math.round(today.getTime()/1000.0);
	if(clockActive){timerID = setTimeout("now()", 1000);}
return false;
}
function startClock() { clockActive=1; now(); }
function stopClock() { clockActive=0; clearTimeout(timerID); }
var currentBeginEnd = "month";
function updateBe(a){
	if(a!=currentBeginEnd){
		if(a=="day"){document.br.mm.disabled=0;document.br.dd.disabled=0;}
		if(a=="month"){document.br.mm.disabled=0;document.br.dd.disabled=1;}
		if(a=="year"){document.br.mm.disabled=1;document.br.dd.disabled=1;}
		currentBeginEnd = a;
		beginEnd();
	}
}
function beginEnd(){
	var outputText="<table cellpadding=2 border=0><tr><td></td><td><b>Epoch</b></td><td>&nbsp;&nbsp;<b>Обычная дата</b></td></tr><tr><td>Начало "+currentBeginEnd+":&nbsp;</td><td>";
	var mon=0;var day=1;var yr=document.br.yyyy.value;
	if(currentBeginEnd!="year"){ mon = document.br.mm.value-1; }
	if(currentBeginEnd=="day"){ day = document.br.dd.value; }
   	var startDate = new Date(Date.UTC(yr,mon,day,0,0,0));
   	outputText = outputText+(startDate.getTime()/1000.0)+"</td><td>&nbsp;&nbsp;"+startDate.toGMTString()+"</td></tr>";
   	outputText = outputText+"<tr><td>Конец "+currentBeginEnd+":&nbsp;</td><td>";
    	if(currentBeginEnd=="year")yr++;
    	if(currentBeginEnd=="month")mon++;
    	if(currentBeginEnd=="day")day++;
    	var endDate = new Date(Date.UTC(yr,mon,day,0,0,-1));
    	outputText = outputText+(endDate.getTime()/1000.0)+"</td><td>&nbsp;&nbsp;"+endDate.toGMTString()+"</td></tr>";
	document.getElementById('resultbe').innerHTML = outputText;    	
}