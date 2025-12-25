<div class="card">
	<div class="card-header"><?php echo $lang['Admin']['home01']; ?></div>
	<div class="card-body">
	<?php echo $lang['Admin']['home02']; ?> <b><?php echo $_SESSION['username']; ?></b>, <?php echo $lang['Admin']['home03']; ?>: <b><font color="Red"><?php echo $lang['Admin']['home04']; ?></font></b>
	</div>
</div>

<div class="row mt-3">
	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-header"><?php echo $lang['Admin']['home05']; ?></div>
			<div class="card-body">
				<div class="card-title"><b class="h2 text-danger"><?php echo $database->queryNumRow('SELECT * FROM users'); ?></b> <?php echo $lang['Admin']['home06']; ?></div> 
				<p class="card-text"><?php echo $lang['Admin']['home07']; ?>.</p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-header"><?php echo $lang['Admin']['home17']; ?></div>
			<div class="card-body">
				<div class="card-title"><b class="h2 text-danger"><?php echo count($admin->getUserActive()); ?></b> <?php echo $lang['Admin']['Player']; ?></div> 
				<p class="card-text"><?php echo $lang['Admin']['home18']; ?>.</p>
			</div>
		</div>
	</div>

	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-header"><?php echo $lang['Admin']['home08']; ?></div>
			<div class="card-body">
				<div class="card-title"><b class="h2 text-danger"><?php echo $database->queryNumRow('SELECT * FROM payments'); ?></b> <?php echo $lang['Admin']['home09']; ?></div> 
				<p class="card-text"><?php echo $lang['Admin']['home10']; ?>.</p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-header"><?php echo $lang['Admin']['home11']; ?></div>
			<div class="card-body">
				<?php 
					$fullM = 0;
					$paymentsD = $database->query('SELECT cost FROM payments');

					foreach($paymentsD as $payment){
						$fullM = $fullM + $payment['cost'];
					}
				?>
				<div class="card-title"><b class="h2 text-danger"><?php echo $fullM; ?></b>$</div> 
				<p class="card-text"><?php echo $lang['Admin']['home12']; ?>.</p>
			</div>
		</div>
	</div>

	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-header"><?php echo $lang['Admin']['home13']; ?></div>
			<div class="card-body">
				<div class="card-title"><b class="h2 text-danger"><?php echo $database->queryNumRow('SELECT * FROM support'); ?></b> <?php echo $lang['Admin']['Message']; ?></div> 
				<p class="card-text"><?php echo $lang['Admin']['home14']; ?>.</p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-header"><?php echo $lang['Admin']['home15']; ?></div>
			<div class="card-body">
			<?php 
					$fullG = 0;
					$goldD = $database->query('SELECT gold FROM users');

					foreach($goldD as $gold){
						$fullG = $fullG + $gold['gold'];
					}
				?>
				<div class="card-title"><b class="h2 text-danger"><?php echo number_format($fullG); ?></b> <?php echo $lang['Admin']['Gold']; ?></div> 
				<p class="card-text"><?php echo $lang['Admin']['home16']; ?>.</p>
			</div>
		</div>
	</div>

</div>