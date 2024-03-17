<?php include 'access_check.php'; ?>

<?php

$right = -1;

include 'connect.php';

$sid = $_SESSION['pid'];

$checkstart = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `start_time` from users where pid='$sid';"))['start_time'];
if ($checkstart == NULL)
header('Location: startgame.php');

$nqres = mysqli_query($conn, "SELECT count(*) from responses where sid='$sid';");

$qres = mysqli_fetch_array($nqres);

$q = $qres[0] + 1;

if (isset($_GET['qid'])) {
	$qid = (int) $_GET['qid'];
	$response = strtoupper(trim($_GET['op']));

	$ans = mysqli_query($conn, "SELECT * FROM words where qid=$qid;");

	$answer = mysqli_fetch_row($ans);

	$sid = $_SESSION['pid'];

	$ranswer = strtoupper($answer[1]);

	$level = $answer[3];

	$right = 1;
	$marks = 100;

	if ($ranswer != $response) {
		$marks = 0;
		$right = 0;
	}

	$query = "insert into responses (sid, qid, answer,marks) values ('$sid', $qid, '$response', $marks)";

	mysqli_query($conn, $query);
}

$nqres = mysqli_query($conn, "SELECT count(*) from responses where sid='$sid';");

$qres = mysqli_fetch_array($nqres);

$q = $qres[0] + 1;

?>

<!doctype html>

<html class="sidebar-light fixed sidebar-left-collapsed">

<head>

	<?php include 'head.php'; ?>

	<style>
		td {

			color: #000000;

		}



		.ui-pnotify.red .ui-pnotify-container {

			background-color: #DC143C !important;

			color: #ffffff;

			border: 0px;

		}



		.ui-pnotify.blue .ui-pnotify-container {

			background-color: #0088cc !important;

			color: #ffffff;

			border: 0px;

		}



		.code {

			display: inline-block;

			overflow-wrap: break-word;

			word-wrap: break-word;

			text-align: left;

		}
	</style>



	<?php

		if ($right == 1) {
	?>



		<script>
			var audio = new Audio("sounds/ipl.mp3");

			audio.play();

			var audio = new Audio("sounds/claps.mp3");

			audio.play();
		</script>



	<?php
		}

		if ($right == 0) {
			?>



		<script>
			var audio = new Audio("sounds/aipaye.mp3");

			audio.play();
		</script>



	<?php
		}

			?>



</head>

<body>

	<section class="body">

		<?php include 'header.php'; ?>

		<div class="inner-wrapper">

			<!-- start: sidebar -->

			<?php include 'sidebar.php'; ?>

			<!-- end: sidebar -->

			<section role="main" class="content-body">

				<header class="page-header">

					<h2>SRKR SPELL BEE</h2>

				</header>

				<?php

					if ($right == 1) {
				?>

					<div id="swinner" class="modal-block modal-header-color modal-block-primary">

						<section class="card">

							<header class="card-header">

								<div class="card-actions">

									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

									<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>

								</div>

								<h2 class="card-title">SRKR SPELL BEE ANSWER</h2>

							</header>

							<div class="card-body" style='text-align:center;'>

								<ul class="simple-bullet-list mb-3">

									<img src="img/congrats.gif">

								</ul>

								<h5><b>YOUR ANSWER:</b> <?php echo $response; ?><br> <b>RIGHT ANSWER:</b> <?php echo $ranswer; ?></h5>

							</div>

							<footer class="card-footer">

								<div class="row">

									<div class="col-md-12 text-right">

										<button class="btn btn-success modal-dismiss"><a href="#" class="card-action card-action-dismiss" style='color:#ffffff;' data-card-dismiss> CLOSE</a></button>

									</div>

								</div>

							</footer>



						</section>

					</div>

				<?php
					} else if ($right == 0) {
									?>

					<div id="srunner" class="modal-block modal-header-color modal-block-danger">

						<section class="card">

							<header class="card-header">

								<div class="card-actions">

									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

									<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>

								</div>

								<h2 class="card-title">SRKR SPELL BEE ANSWER</h2>

							</header>

							<div class="card-body" style='text-align:center;'>

								<ul class="simple-bullet-list mb-3">

									<img src="img/fail.gif">

								</ul>

								<h5><b>YOUR ANSWER:</b> <?php echo $response; ?><br> <b>RIGHT ANSWER:</b> <?php echo $ranswer; ?></h5>

							</div>

							<footer class="card-footer">

								<div class="row">

									<div class="col-md-12 text-right">

										<button class="btn btn-success modal-dismiss"><a href="#" class="card-action card-action-dismiss" style='color:#ffffff;' data-card-dismiss> CLOSE</a></button>

									</div>

								</div>

							</footer>

						</section>

					</div>

				<?php
					}

				?>

				<div class='row'>

					<div class="col-xl-8">

						<h5 class="font-weight-semibold text-dark text-uppercase mb-3 mt-3">YOUR SPELL BEE WORD HERE</h5>

						<section class="card mt-4">

							<div class="card-body">

								<?php

									if ($q <= 5) {
										$bl = 1;
										$be = 3;
									} else if ($q <= 10) {
										$bl = 4;
										$be = 6;
									} else {
										$bl = 7;
										$be = 10;
									}

									if ($q <= 15) {
										echo "<h4 align='center' STYLE='COLOR:RED;'><B>YOUR QUESTION NO - $q</B></h4>";

										$ques = mysqli_query($conn, "SELECT * FROM words where qid not in (select qid from responses where sid='$sid') and level between $bl and $be ORDER BY RAND() LIMIT 1;");

										$qrow = mysqli_fetch_array($ques);

										$qid = $qrow['qid'];

										$ranswer = strtoupper($qrow['word']);

										$question = $qrow['meaning'];

										$lvl = $qrow['level'];

										if ($lvl <= 3) {
											$level = 'Easy';
										} else if ($lvl <= 6) {
											$level = 'Moderate';
										} else if ($lvl <= 10) {
											$level = 'Difficult';
										}

										$opr = array($qrow['option1'], $qrow['option2'], $qrow['option3'], $ranswer);

										shuffle($opr);

										$option1 = strtoupper($opr[0]);

										$option2 = strtoupper($opr[1]);

										$option3 = strtoupper($opr[2]);

										$option4 = strtoupper($opr[3]);

										echo "<div align='center'><h4><b>Word Meaning: </b>" . $question . '</h4></div>';

										echo "<div align='center'><h4><b>Difficulty Level: </b>" . $level . "</h4></div><div align='center'>";

										echo "<button class='mb-1 mt-1 mr-1 btn btn-danger' onclick='spell_sound($qid);'><span style='color:#ffffff;'><i class='fas fa-volume-up'></i> SPELL WORD <i class='fas fa-play'></i></span></button>";


										echo '<div>CLICK ON THE RIGHT SPELLING</div>';

										echo "<a href='dashboard.php?qid=$qid&op=$option1'><button type='submit' class='mb-1 mt-1 mr-1 btn btn-primary'>$option1</button></a>";

										echo "<a href='dashboard.php?qid=$qid&op=$option2'><button type='submit' class='mb-1 mt-1 mr-1 btn btn-primary'>$option2</button></a>";

										echo "<a href='dashboard.php?qid=$qid&op=$option3'><button type='submit' class='mb-1 mt-1 mr-1 btn btn-primary'>$option3</button></a>";

										echo "<a href='dashboard.php?qid=$qid&op=$option4'><button type='submit' class='mb-1 mt-1 mr-1 btn btn-primary'>$option4</button></a>";

										echo '</div>';
									} else {
										$points = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(marks) as points from responses where sid='$sid';"))['points'];

										mysqli_query($conn, "UPDATE users set `points`=$points where pid='$sid';");


									}
									if ($q > 15) echo "<script> window.location = 'dashboard2.php'; </script>";

								?>

							</div>

						</section>

					</div>

					<div class="col-xl-4">

						<h5 class="font-weight-semibold text-dark text-uppercase mb-3 mt-3">LEADERBOARD</h5>

						<div class="row">

							<div class="col-12">

								<section class="card mb-4">

									<div class="card-body" id='lboard' align='center'>

									</div>

								</section>

							</div>

						</div>

					</div>
				
				</div>

			</section>

		</div>

	</section>

	</section>

	</div>

	<script src="vendor/jquery/jquery.js"></script>

	<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>

	<script src="vendor/popper/umd/popper.min.js"></script>

	<script src="vendor/bootstrap/js/bootstrap.js"></script>

	<script src="vendor/common/common.js"></script>

	<script src="vendor/nanoscroller/nanoscroller.js"></script>

	<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>

	<script src="vendor/jquery-placeholder/jquery-placeholder.js"></script>

	<script src="vendor/jquery-ui/jquery-ui.js"></script>

	<script src="vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>

	<script src="vendor/jquery-appear/jquery-appear.js"></script>

	<script src="vendor/owl.carousel/owl.carousel.js"></script>

	<script src="js/theme.js"></script>

	<script src="js/examples/examples.modals.js"></script>

	<script src="vendor/pnotify/pnotify.custom.js"></script>

	<script src="js/theme.init.js"></script>

	<script>
		function spell_sound(id)

		{

			var audio = new Audio("sounds/machine/" + id + ".mp3");

			audio.play();

		}
	</script>

	<script>
		function spell_human(id)

		{

			var audio = new Audio("sounds/human/" + id + ".mp3");

			audio.play();

		}
	</script>

	<script>
		var source = new EventSource("leaderboard3.php");

		source.onmessage = function(event) {

			document.getElementById('lboard').innerHTML = event.data;

		};
	</script>

	

	<br><br>

	<?php include 'footer.php'; ?>

</body>

</html>