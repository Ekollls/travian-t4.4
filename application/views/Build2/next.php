<?php
$cur=$building->isCurrent($id);
$loop=$building->isLoop($id);
	$loopsame = ($cur || $loop)?1:0;
	$doublebuild = ($cur && $loop)?1:0;
