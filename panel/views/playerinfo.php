<table class="table" cellpadding="1" cellspacing="1" >

			<thead>

				<tr>

					<th colspan="2">player <a href="index.php?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>

				</tr>

				<tr>

					<td>Detail</td>

					<td>description</td>

				</tr>

			</thead>

			<tbody>

				<tr>

					<td class="empty"></td><td class="empty"></td>

				</tr>

				<tr>

					<td class="details">

						<table cellpadding="0" cellspacing="0">

							<tr>

								<th>Rank</th>

								<td>????<?php /* echo $ranking->searchRank($user['id'], "rank");*/ ?></td>

							</tr>

							<tr>

								<th>Tribes</th>

								<td>

									<?php

										if($user['tribe'] == 1)

										{

											echo "Roman";

										}

										else if($user['tribe'] == 2)

										{

											echo "Teuton";

										}

										else if($user['tribe'] == 3)

										{

											echo "Gauls";

										}

										else if($user['tribe'] == 4)

										{

											echo "Wild";

										}

										else if($user['tribe'] == 5)

										{

											echo "Natar";

										}

									?>

								</td>

							</tr>

							<tr>

								<th>alliance</th>

								<td>

									<?php

										if($user['alliance'] == 0)

										{

											echo "-";

										}

										else

										{

											echo "<a href=\"?p=alliance&aid=".$user['alliance']."\">".$database->getAllianceName($user['alliance'])."</a>";

										}

									?>

								</td>

							</tr>

							<tr>

								<th></th>

								<td><?php echo count($varray);?></td>

							</tr>

							<tr>

								<th>population</th>

								<td><?php echo $totalpop;?> <a href="?action=recountPopUsr&uid=<?php echo $user['id'];?>"><?php echo $refreshicon; ?></a></td>

							</tr>

							<tr>

								<th>age</td>

								<td>

									<?php

										if(isset($user['birthday']) && $user['birthday'] != 0)

										{

											$age = date("Y")-substr($user['birthday'],0,4);

											echo $age;

										}

										else

										{

											echo "<font color=\"red\">Not available</font>";

										}

									?>

								</td>

							</tr>

							<tr>

								<th>Gender</td>

								<td>

									<?php

										if(isset($user['gender']) && $user['gender'] != 0)

										{

											$gender = ($user['gender']== 1)? "Male" : "Female";

											echo $gender;

										}

										else

										{

											echo "<font color=\"red\">Not available</font>";

										}

									?>

								</td>

							</tr>



							<tr>



								<th>Location</th>

								<td>

									<input type="text" style="width: 80%;" disabled="disabled" class="fm" name="location" value="<?php echo $user['location']; ?>">  <a href="index.php?p=editUser&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Modification"></a>

								</td>

							</tr>



							<tr>

								<?php if($_SESSION['access'] == 9){?><th>password</th>

								<td>

									Change <a href="index.php?p=editPassword&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Change Password"></a>

								</td>

							</tr>



							<tr>

								<?php include("playerplusbonus.php"); ?>

								<tr>

<th>mail</th>

<td>

	<input disabled="disabled" style="width: 80%;" class="fm" name="email" value="<?php echo $user['email']; ?>"> <a href="index.php?p=editUser&uid=<?php echo $id; ?>"><img src="../img/Admin/edit.gif" title="Edit Email"></a>

</td>

</tr>
<tr>

<th>Father</th>
<?php $pData = $database->queryFetch("SELECT * FROM palevo WHERE uid = ".$user['id'].""); ?>
<td>

	<input disabled="disabled" style="width: 80%;" class="fm" name="email" value="<?php echo $pData['infa']; ?>">

</td>

</tr>

                                   <?php }   ?>



							<tr>

								<td colspan="2" class="empty"></td>

							</tr>



							<?php

								if($_SESSION['access'] >=8)

								{

									echo '

									<tr>

										<td colspan="2">

											<a href="?p=editUser&uid='.$user['id'].'"><font color="blue">&raquo;</font> Modification player</a>

										</td>

									</tr>';

								}

								else if($_SESSION['access'] == MULTIHUNTER)

								{

									echo '';

								}

								if($_SESSION['access'] == ADMIN)

								{

									echo '

									<tr>

										<td colspan="2">

											<a class="rn3" href="?p=deletion&uid='.$user['id'].'"><font color="red">&raquo;</font> delete player</a>

										</td>

									</tr>';

								}

								else if($_SESSION['access'] == MULTIHUNTER)

								{

									echo '';

								}

							?>



							<tr>

								<td colspan="2"><a href="?p=ban&uid=<?php echo $user['id']; ?>">&raquo; Ban</a></td>

							</tr>



							<tr>

								<td colspan="2"><a href="?p=Newmessage&uid=<?php echo $user['id']; ?>">&raquo; Dock</a></td>

							</tr>



							<tr>

								<?php if($_SESSION['access'] == 9){ ?><td colspan="2"><a href="?p=editPlus&uid=<?php echo $user['id']; ?>">&raquo; Modification Plus Resources</a></td>

							</tr>



							<tr>

								<td colspan="2"><a href="?p=editSitter&uid=<?php echo $user['id']; ?>">&raquo; Modification Sitter</a></td>  <?php  } ?>

							</tr>

                                <?php if($_SESSION['access'] == ADMIN)

								{?>

							<tr>

								<td colspan="2"><a href="?p=editWeek&uid=<?php echo $user['id']; ?>">&raquo; Modification attack & Defense</a></td>

							</tr>



							<tr>

								<td colspan="2"><a href="?p=editOverall&uid=<?php echo $user['id']; ?>">&raquo; Modification week Points</a></td>

							</tr>

                                    <?php  } ?>

							<tr>

								<td colspan="2"><a href="?p=userlogin&uid=<?php echo $user['id']; ?>">&raquo; Log in</a></td>

							</tr>







							<tr>

								<td colspan="2" class="desc2">

									<div class="desc2div">

										<center><?php echo nl2br($user['desc1']); ?></center>

									</div>

								</td>

							</tr>

						</table>

					<td class="desc1">

						<center><?php echo nl2br($user['desc2']); ?></center>

					</td>

				</tr>

			</tbody>

		</table>