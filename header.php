<!--
			<header class="header">
				<div class="logo-container">
						<img src="img/sponsor.png" alt="BO HOUSIE" />
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			</header>
-->
			<!-- end: header -->

				<header class="header">
				<div class="logo-container">
					<a href="dashboard.php" class="logo">
						<img src="img/logo_main.png" alt="MCR WEB" />
					</a>
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">			
					<span class="separator"></span>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<div class="profile-info">
								<span class="name"><?php echo $_SESSION['player_name']; ?></span>
								<span class="role"><?php echo $_SESSION['place']; ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="#"><i class="fas fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="index.php?logout"><i class="fas fa-power-off"></i> Logout</a>
								</li>
							</ul>
							
						</div>
					</div>
				</div>
				<!-- end: search & user box -->


			</header>
			
		<script>
			
					//GET GAMES......
		function get_sgames()
          {
			if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
			else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}

			xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==1)
					  {
						document.getElementById("scheduled_games").innerHTML="<div align='center'>Fetching Scheduled Games!<br><img src='img/loader.gif'></div>";
					  }
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					  {
						document.getElementById('scheduled_games').innerHTML=xmlhttp.responseText;
					  }
				}
			xmlhttp.open("GET","today_games.php", true);
			xmlhttp.send();
		  }
			
		</script>