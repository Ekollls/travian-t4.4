			<?php
				    $tribe = $session->tribe;
                  echo "<tr id=\"unitRowAtTown\">";
                  $vC = $database->getCoor($village->wid);
                  echo '<th class="coords">&lrm;<span class="coordinates coordinatesWrapper coordinatesAligned coordinates'.ucwords(DIRECTION).'"><span class="coordinateX">('.$vC['x'].'</span><span class="coordinatePipe">|</span><span class="coordinateY">'.$vC['y'].')</span></span></th>';
                  for($i=1;$i<=10;$i++) {
                    $uni=($tribe-1)*10+$i;
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$uni."\" title=\"".$technology->getUnitName($uni)."\" alt=\"".$technology->getUnitName($uni)."\" /></td>";
                  }
                  $coolspan=10;
				  if($village->unitarray['u11'] != 0) {
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                   $coolspan=11;
				  }

			?>
			</tr><tr><th>Forces</th>
            <?php
            for($i=1;$i<=$coolspan;$i++) {
            	if($village->unitarray['u'.$i] == 0) {
                	echo "<td class=\"none\">";
                }
                else {
                echo "<td>";
                }
                echo $village->unitarray['u'.$i]."</td>";
            }



            ?>
           </tr></tbody>
            <tbody class="infos"><tr><th>Consumption</th>
            <td colspan="<?php echo $coolspan; ?>">
            <div class="sup"><div class="inlineIconList supplyWrapper"><div class="inlineIcon resources"><span class="value "><?php echo $database->getUpkeep($village->unitarray,$tribe,$village->resarray); ?></span><i class="r4"></i></div></div>&nbsp;In the hour</div>
            </td></tr>
