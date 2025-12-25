<table class="table">

	<thead>

		<tr>

			<th colspan="10">Troops in village</th>

				<?php



					if($units['u1'] == 0){$u1 = '<font color="gray">'.$units['u1'].'';}

					else if($units['u1'] > 0){$u1 = '<font color="black">'.$units['u1'].'';}

					if($units['u2'] == 0){$u2 = '<font color="gray">'.$units['u2'].'';}

					else if($units['u2'] > 0){$u2 = '<font color="black">'.$units['u2'].'';}

					if($units['u3'] == 0){$u3 = '<font color="gray">'.$units['u3'].'';}

					else if($units['u3'] > 0){$u3 = '<font color="black">'.$units['u3'].'';}

					if($units['u4'] == 0){$u4 = '<font color="gray">'.$units['u4'].'';}

					else if($units['u4'] > 0){$u4 = '<font color="black">'.$units['u4'].'';}

					if($units['u5'] == 0){$u5 = '<font color="gray">'.$units['u5'].'';}

					else if($units['u5'] > 0){$u5 = '<font color="black">'.$units['u5'].'';}

					if($units['u6'] == 0){$u6 = '<font color="gray">'.$units['u6'].'';}

					else if($units['u6'] > 0){$u6 = '<font color="black">'.$units['u6'].'';}

					if($units['u7'] == 0){$u7 = '<font color="gray">'.$units['u7'].'';}

					else if($units['u7'] > 0){$u7 = '<font color="black">'.$units['u7'].'';}

					if($units['u8'] == 0){$u8 = '<font color="gray">'.$units['u8'].'';}

					else if($units['u8'] > 0){$u8 = '<font color="black">'.$units['u8'].'';}

					if($units['u9'] == 0){$u9 = '<font color="gray">'.$units['u9'].'';}

					else if($units['u9'] > 0){$u9 = '<font color="black">'.$units['u9'].'';}

					if($units['u10'] == 0){$u10 = '<font color="gray">'.$units['u10'].'';}

					else if($units['u10'] > 0){$u10 = '<font color="black">'.$units['u10'].'';}



					if($_SESSION['access'] == ADMIN)

					{

						if($user['tribe'] == 1)

						{

							echo '

							</tr></thead><tbody>

							<tr>

								<td><center /><img src="../img/Admin/en/u/1.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/2.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/3.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/4.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/5.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/6.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/7.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/8.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/9.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/10.gif"></img></td>

							</tr>

							<tr>

								<td><center />'.$u1.'</td>

								<td><center />'.$u2.'</td>

								<td><center />'.$u3.'</td>

								<td><center />'.$u4.'</td>

								<td><center />'.$u5.'</td>

								<td><center />'.$u6.'</td>

								<td><center />'.$u7.'</td>

								<td><center />'.$u8.'</td>

								<td><center />'.$u9.'</td>

								<td><center />'.$u10.'</td>

							 </tr>';

						}

						// TEUTON UNITS

						else if($user['tribe'] == 2)

						{

							echo '

							</tr></thead><tbody>

							<tr>

								<td><center /><img src="../img/Admin/en/u/11.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/12.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/13.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/14.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/15.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/16.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/17.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/18.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/19.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/20.gif"></img></td>

							</tr>

							<tr>

								<td><center />'.$u1.'</td>

								<td><center />'.$u2.'</td>

								<td><center />'.$u3.'</td>

								<td><center />'.$u4.'</td>

								<td><center />'.$u5.'</td>

								<td><center />'.$u6.'</td>

								<td><center />'.$u7.'</td>

								<td><center />'.$u8.'</td>

								<td><center />'.$u9.'</td>

								<td><center />'.$u10.'</td>

							</tr>';

						}

						// GAUL UNITS

						else if($user['tribe'] == 3)

						{

							echo '

							</tr></thead><tbody>

							<tr>

								<td><center /><img src="../img/Admin/en/u/21.gif"></img></td>

							<td><center /><img src="../img/Admin/en/u/22.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/23.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/24.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/25.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/26.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/27.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/28.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/29.gif"></img></td>

								<td><center /><img src="../img/Admin/en/u/30.gif"></img></td>

							</tr>





							<tr>

								<td><center />'.$u1.'</td>

								<td><center />'.$u2.'</td>

								<td><center />'.$u3.'</td>

								<td><center />'.$u4.'</td>

								<td><center />'.$u5.'</td>

								<td><center />'.$u6.'</td>

								<td><center />'.$u7.'</td>

								<td><center />'.$u8.'</td>

								<td><center />'.$u9.'</td>

								<td><center />'.$u10.'</td>

							</tr>';

						}

						// Nature UNITS

						else if($user['tribe'] == 4)

						{

							echo '

							</tr></thead><tbody>

							<tr>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/31.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/32.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/33.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/34.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/35.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/36.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/37.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/38.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/39.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/40.gif"></img></td>

							</tr>

						   <tr>

								<td><center />'.$u1.'</td>

								<td><center />'.$u2.'</td>

								<td><center />'.$u3.'</td>

								<td><center />'.$u4.'</td>

								<td><center />'.$u5.'</td>

								<td><center />'.$u6.'</td>

								<td><center />'.$u7.'</td>

								<td><center />'.$u8.'</td>

								<td><center />'.$u9.'</td>

								<td><center />'.$u10.'</td>

							</tr>';

						}

						// Natar Units

						else if($user['tribe'] == 5)

						{

							echo '

							</tr></thead><tbody>

							<tr>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/41.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/42.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/43.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/44.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/45.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/46.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/47.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/48.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/49.gif"></img></td>

								<td><center /><img src="../<?php echo GP_LOCATE; ?>img/u/50.gif"></img></td>

							</tr>





						   <tr>

								<td><center />'.$u1.'</td>

								<td><center />'.$u2.'</td>

								<td><center />'.$u3.'</td>

								<td><center />'.$u4.'</td>

								<td><center />'.$u5.'</td>

								<td><center />'.$u6.'</td>

								<td><center />'.$u7.'</td>

								<td><center />'.$u8.'</td>

								<td><center />'.$u9.'</td>

								<td><center />'.$u10.'</td>

							</tr>';

						}

					}

				?>

			</tbody>

		</table>

	<?php

		if($_SESSION['access'] == ADMIN)

		{

			echo '<a href="index.php?p=addTroops&did='.$_GET['did'].'">Edit Troops</a>';

		}



	?>