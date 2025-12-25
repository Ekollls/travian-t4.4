		<table class="table">

			<thead>

				<tr>

					<th colspan="2">Information also in a</th>

				</tr>

			</thead>

			<tbody>

				<tr>

					<td>Access</td>

					<td>

						<?php

							if($user['access'] == 0){ echo "forbidden"; }

							else if($user['access'] == 2)

							{ echo "Player"; }

							else if($user['access'] == 8)

							{

								echo "<b>repellent</b>";

							}

							else if($user['access'] == 9)

							{

								echo "<b>Admin</b>";

							}

						?> <a href="index.php?p=editAccess&uid=<?php echo $_GET['uid']; ?>"><img src="../img/Admin/edit.gif" title="Give Gold"></a>

					</td>

				</tr>

				<tr>

					<td>gold</td>

					<td><img src="../img/Admin/gold.gif"> <?php echo $user['gold']; ?> <a href=?p=givegoldd&uid=<?php echo $user['id'];?>><img src="../img/Admin/edit.gif" title="Give Gold"></a>

				</tr>

                <?php if(isset($user['silver'])){?>

                <tr>

                    <td>silver</td>

                    <td> <?php echo $user['silver']; ?> <a href=?p=givegoldd&uid=<?php echo $user['id'];?>><img src="../img/Admin/edit.gif" title="Give Gold"></a>

                </tr>

                        <?php } ?>

				<tr>

					<td></td>

					<td></td>

				</tr>

				<tr>

					<td>1 Sitter</td>

					<td><a href="?p=editSitter&uid=<?php echo $user['id']; ?>"><img src="../img/Admin/edit.gif" title="Edit Sitters"></a>

						<?php

							if($user['sit1'] >= 1)

							{

								echo '<a href="index.php?p=player&uid='.$user['sit1'].'">'.$database->getUserField($user['sit1'],"username",0).'</a>';

							}

							else if($user['sit1'] == 0)

							{

								echo 'No agents found';

							}

						?>

					</td>

				</tr>

				<tr>

					<td>Sitter 2</td>

					<td><a href="?p=editSitter&uid=<?php echo $user['id']; ?>"><img src="../img/Admin/edit.gif" title="Edit Sitters"></a>

						<?php

							if($user['sit2'] >= 1)

							{

								echo '<a href="index.php?p=player&uid='.$user['sit2'].'">'.$database->getUserField($user['sit2'],"username",0).'</a>';

							}

							else if($user['sit2'] == 0)

							{

								echo 'No agents found';

							}

						?>

					</td>

				</tr>

				<tr>

					<td></td>

					<td></td>

				</tr>
<!--
				<tr>


					<td>

						<?php

							$datetime = $user['protect'];
							$now = time();
							if($datetime ==0){
								echo '<img src="../img/Admin/del.gif">';
								echo "<font color=\"red\"> No protectors found</font>";
							}

							else

							{

								if($datetime <= $now)

								{

									echo '<img src="../img/Admin/del.gif">';

									echo "<font color=\"red\"> No protectors found</font>";

								}

								else

								{

									$tsdiffact = $datetime - $now;

									$timetoecho = $timeformat->getTimeFormat($tsdiffact);

									echo '<img src="../img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['protect']+3600*2).'">';

									echo "<font color=\"blue\"> $timetoecho</font>";

								}

							}



						?>

					 <a href="index.php?p=editProtection&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Give Player Protection"></a></td>

				</tr>
-->
				<tr>

					<td>culture Points</td>

					<td><a href='index.php?p=player&uid=<?php echo $id; ?>&cp'><img src="../img/Admin/edit.gif" title="Modification culture Points"></a>
						<?php
							echo round($user['cp'], 0);
							if($_SESSION['access'] == ADMIN)
							{ ?>
								<a href='index.php?p=player&uid=<?php echo $id; ?>&cp'><?php
							}
						?>

					</td>
				</tr>
				<?php

					if($_SESSION['access'] == ADMIN){
						if($_GET['cp'] == 'ok'){
							echo '';
						}

						else

						{

							if(isset($_GET['cp']))

							{ ?>

								<form action="../application/panel/Mods/cp.php" method="POST">

									<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">

									<input type="hidden" name="id" value="<?php echo $id; ?>">

									<tr>

										<td>add gold</td>

										<td>

											<input class="give_gold" name="cp" value="0">

											<input type="image" src="../img/new/tick.png" value="submit">

											<a href="index.php?p=player&uid=<?php echo $id; ?>"><img src="../img/Admin/del.gif" title="Cancel"></a>

										</td>

									</tr>

								</form><?php

							}

						}

					}

				?>

				<tr>

					<td>Last activity</td>

					<td>

						<?php

							echo ''.date('d.m.Y H:i',$user['timestamp']+3600*2).'';

						?>

					</td>

				</tr>

				<tr>

					<td></td>

					<td></td>

				</tr>

				<tr>

					<td>Attack points ("This week")</td>

					<td><a href="index.php?p=editWeek&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Edit Weekly Points"></a>

						<?php

							echo $user['ap'];

						?>

					</td>

				</tr>

				<tr>

					<td>Defence points ("This week")</td>

					<td><a href="index.php?p=editWeek&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Edit Weekly Points"></a>

						<?php

							echo $user['dp'];

						?>

					</td>

				</tr>

				<tr>

					<td>Plunder Points ("This Week")</td>

					<td><a href="index.php?p=editWeek&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Edit Weekly Points"></a>

						<?php

							echo $user['RR'];

						?>

					</td>

				</tr>

				<tr>

					<td></td>

					<td></td>

				</tr>

				<tr>

					<td>Total attack score</td>

					<td><a href="index.php?p=editOverall&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Edit Overall Points"></a>

						<?php

							echo $user['apall'];

						?>

					</td>

				</tr>

				<tr>

					<td>Total defence score</td>

					<td><a href="index.php?p=editOverall&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Edit Overall Points"></a>

						<?php

							echo $user['dpall'];

						?>

					</td>

				</tr>

			</tbody>

		</table>