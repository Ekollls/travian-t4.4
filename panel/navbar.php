<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
          <h1><a href="index.php" class="logo">Panel</a></h1>

	        <ul class="list-unstyled components mb-5">
          <li><a href="index.php"><?php echo $lang['Admin']['sidebar01']; ?></a></li>
	          <li>
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lang['Admin']['sidebar02']; ?></a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="?p=players"><?php echo $lang['Admin']['sidebar03']; ?></a></li>
                <li><a href="?p=online"><?php echo $lang['Admin']['sidebar04']; ?></a></li>
                <li><a href="?p=notregistered"><?php echo $lang['Admin']['sidebar05']; ?></a></li>
                <li><a href="?p=multi"><?php echo $lang['Admin']['sidebar06']; ?></a></li>
                <li><a href="../massmessage.php"><?php echo $lang['Admin']['sidebar07']; ?></a></li>
                <li><a href="?p=pmails"><?php echo $lang['Admin']['sidebar09']; ?></a></li>
                <li><a href="?p=ban"><?php echo $lang['Admin']['sidebar11']; ?></a></li>
                
	            </ul>
            </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lang['Admin']['sidebar12']; ?></a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="?p=search"><?php echo $lang['Admin']['sidebar13']; ?></a></li>
                <li><a href="?p=message"><?php echo $lang['Admin']['sidebar14']; ?></a></li>
              </ul>
            </li>
            <li>
              <a href="#goldSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lang['Admin']['sidebar15']; ?></a>
              <ul class="collapse list-unstyled" id="goldSubmenu">
                <li><a href="?p=gold"><?php echo $lang['Admin']['sidebar16']; ?></a></li>
                <li><a href="?p=usergold"><?php echo $lang['Admin']['sidebar17']; ?></a></li>
                <li><a href="?p=mgold"><?php echo $lang['Admin']['sidebar10']; ?></a></li>
                <li><a href="?p=recharge">recharge gold</a></li>
                <li><a href="?p=codes">gold code</a></li>
              </ul>
            </li> 
            <li>
              <a href="#impoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-setting"></i> <?php echo $lang['Admin']['sidebar18']; ?></a>
              <ul class="collapse list-unstyled" id="impoSubmenu">
                <li><a href="?p=register"><?php echo $lang['Admin']['sidebar19']; ?></a></li>
                <li><a href="?p=empoasis"><?php echo $lang['Admin']['sidebar20']; ?></a></li>
                <li><a href="?p=farms"><?php echo $lang['Admin']['sidebar21']; ?></a></li>
              </ul>
            </li> 

	          <li><a href="?p=allmsgs"><?php echo $lang['Admin']['sidebar22']; ?></a></li>
            <li>
              <a href="#settingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lang['Admin']['sidebar23']; ?></a>
              <ul class="collapse list-unstyled" id="settingSubmenu">
                <li><a href="?p=setting"><?php echo $lang['Admin']['sidebar24']; ?></a></li>
                <li><a href="?p=natars"><?php echo $lang['Admin']['sidebar25']; ?></a></li>
                <li><a href="?p=plus"><?php echo $lang['Admin']['sidebar26']; ?></a></li>
                <li><a href="?p=payments">Operations</a></li>
                <li><a href="?p=news">List the news</a></li>
                <li><a href="?p=global"><?php echo $lang['Admin']['sidebar08']; ?></a></li>

              </ul>
            </li> 
	          <li><a href="?p=support">Support messages</a></li>
	          <li><a href="../dorf1.php"><?php echo $lang['Admin']['sidebar27']; ?></a></li>
	          <li><a href="../logout.php"><?php echo $lang['Admin']['sidebar28']; ?></a></li>
	        </ul>


	        <div class="footer">
            <?php $isOkay = TRUE; ?>
	        	<p><?php echo $lang['Admin']['sidebar29']; ?> <a style="color:white;" href="https://www.facebook.com/opito8">iRedux</a>.</p>
	        </div>

	      </div>
    	</nav>
