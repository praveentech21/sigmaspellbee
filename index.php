<!doctype html>
<html class="fixed">

<head>
	<?php 
	include "head.php";
	include "connect.php";
	session_start();

	if(isset($_POST['mobile'])) {
		if($_POST['pin'] == "sigma2k24"){
			$pid = $_POST['mobile'];
			$check = mysqli_query($conn,"select * from `users` where `pid` = $pid");
			if(mysqli_num_rows($check) > 0){
				$profile = mysqli_fetch_assoc($check);
				$_SESSION['pid']=$profile['pid'];    	
				 $_SESSION['player_name']=$profile['player_name'];    	
				 $_SESSION['place']=$profile['place'];    	
				 $_SESSION['points']=$profile['points'];    	
				header("location:dashboard.php");
			}
			else echo "<script>alert('Player Not Register')</script>";
		}
		else echo "<script>alert('Invalid Secr	et Pin')</script>";
	}
	?>
</head>

<body>

	<!-- start: page -->
	<section class="body-sign body-locked">
		<div class="center-sign">
			<div class="panel card-sign">
				<div class="card-body">
					<form action="#" method='post'>
						<div class="current-user text-center">
							<img src="img/full_logo.jpg" alt="BO HOUSIE" class="rounded-circle user-image" />
							<h2 class="user-name text-dark m-0" style='font-size:24px;'>SPELL BEE LOGIN</h2>
							<p class="user-email m-0"><span class="alternative-font text-6">Beta Version (Under Testing)</span></p>
						</div>
						<div class="form-group mb-3">
							<div class="input-group">
								<input id="mobile" name="mobile" type="number" class="form-control form-control-lg" placeholder="Mobile Number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" REQUIRED />
								<span class="input-group-append">
									<span class="input-group-text">
										<i class="fas fa-phone"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group">
								<!-- <input id="pin" name="pin" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" class="form-control form-control-lg" placeholder="4 Digit PIN" MAXLENGTH='4' value='' REQUIRED/> -->
								<input id="pin" name="pin" type="password" class="form-control form-control-lg" placeholder="SECRET PIN" MAXLENGTH='10' value='' autocomplete="off" REQUIRED />
								<span class="input-group-append">
									<span class="input-group-text">
										<i class="fas fa-th-large"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="help-block text-center">
							<?php

							if (isset($_REQUEST['logout'])) {
								session_start();
								$pid = $_SESSION['pid'];
								include "connect.php";
								mysqli_query($conn, "update users set status=0 where pid='$pid'");

								$_SESSION = array();
								session_destroy();
								if (!isset($_SESSION['pid'])) {
									echo "<center><span style='color:red;'>You are now logged out!</span></center>";
								}
							} else if (isset($_REQUEST['pwderror'])) {
								session_start();
								$_SESSION = array();
								session_destroy();
								echo "<center><span style='color:red;' id='foo'><b>Invalid Secret Pin / Mobile!</b></span></center>";
							} else if (isset($_REQUEST['stop'])) {
								session_start();
								$_SESSION = array();
								session_destroy();
								echo "<center><span style='color:red;' id='foo'><b>You are Misusing the Game</b></span></center>";
							} else if (isset($_REQUEST['wpin'])) {
								session_start();
								$_SESSION = array();
								session_destroy();
								echo "<center><span style='color:red;' id='foo'><b>Invalid Secret Pin</b></span></center>";
							} else {
								//echo "<span style='font-size:14px;'>Default PIN: <b style='color:red;'>0000</b></span>";
							}

							?>


						</div>

						<div class="row">
							<div class="col-6">
								<p class="mt-1 mb-3">
									<!--<a href="signup.php">Not Registered? SIGNUP FOR FREE</a>-->
								</p>
							</div>
							<div class="col-6">
								<button type="submit" class="btn btn-primary pull-right">LOGIN TO PLAY</button>
							</div>
						</div>


					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- end: page -->

	<!-- Vendor -->
	<script src="vendor/jquery/jquery.js"></script>
	<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="vendor/popper/umd/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.js"></script>
	<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="vendor/jquery-placeholder/jquery-placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="js/theme.js"></script>

	<!-- Theme Custom -->
	<!-- Theme Initialization Files -->
	<script src="js/theme.init.js"></script>

	<script>
		setTimeout(function() {
			document.getElementById('foo').style.display = 'none';
		}, 5000);
	</script>

	<!-- GetButton.io widget -->
	<script type="text/javascript">
		(function() {
			var options = {
				whatsapp: "+919293940004", // WhatsApp number
				call_to_action: "WhatsApp for Help", // Call to action
				position: "left", // Position may be 'right' or 'left'
			};
			var proto = document.location.protocol,
				host = "getbutton.io",
				url = proto + "//static." + host;
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = url + '/widget-send-button/js/init.js';
			s.onload = function() {
				WhWidgetSendButton.init(host, proto, options);
			};
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
		})();
	</script>



	<!-- /GetButton.io widget -->
</body>

</html>