<?php
	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (!$_SESSION['userid']) {
		header('location:index.php');
	}
	$useremail = $_SESSION['userid'];
	$sql = "SELECT * FROM user WHERE email='$useremail'";
	$result = $con->query($sql);
		if ($result) {
			$rs = $result;
		} else {
			print_r($mysqli_error($con));
		}
		?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>G&R Driving</title>
<!-- custom-theme -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/main.js"></script>

<!-- //js -->

<!-- font-awesome-icons -->

<link href="css/font-awesome.css" rel="stylesheet">

<!-- //font-awesome-icons -->

<link href="//fonts.googleapis.com/css?family=Prompt:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">

</head>

<body>



	<?php include_once('includes/header.php');?>

	<div class="banner1">

	</div>

<!-- //banner -->

<!-- about -->



	<div class="about-top">

		<div class="container">

			<div class="w3l-heading">

				<h2 class="G_head">MY PROFILE</h2>

			</div>

			<div class="wthree-services-bottom-grids">

				<div class="row">

					<div class="col-md-3"></div>

					 <?php



					while ($row=mysqli_fetch_array($rs)) {



					?>

					<div class="col-md-6">

						<div class="card shadow">

							<div class="card-header bg-info	" style="padding: 15px; border: 1px solid;">

								<h4>Booking Number: <?php if ($_SESSION['regno'] == ''){
									echo "N/A";
								}else{
									echo $_SESSION['regno'];
								} ?></h4>

							</div>

							<div class="card-body" style="padding: 15px; border: 1px solid #ccc;">

								<form action="change_profile.php" id="change_profile">

								<label>Full Name :</label><br>

								<input type="text" name="user_name" value="<?php echo $_SESSION['user_fullname']; ?>" class="form-control user_name" style="margin-top: 10px;" readonly>



								<br>



								<label>Email ID :</label>

								<input type="text" name="email" value="<?php echo $_SESSION['userid']; ?>" class="form-control" style="margin-top: 10px;" readonly>



								<br>

								<button class="btn btn-primary edit_details">Edit Details</button>

								<button class="btn btn-primary save_changes" style="display: none;">Save Changes</button>





								</form>
								<br>
								<button class="btn btn-warning change_password" data-toggle="modal" data-target="#changePassword">Change Password</button>

							</div>

						</div>

					</div>



				<?php } ?>

					<div class="col-md-3"></div>

				</div>

			</div>

		</div>

	</div>



	<!-- Modal -->

<div id="changePassword" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Change Password</h4>

      </div>

      <div class="modal-body">

      	<form action="change_password.php" id="changePgh">

	      	<p>

	        	<label>Old Password</label>

	        	<input type="password" name="oldpassword" class="form-control">

	        </p>

	        <p>

	        	<label>New Password</label>

	        	<input type="password" name="newpassword" class="form-control">

	        </p>

	        <p>

	        	<label>Confirm Password</label>

	        	<input type="text" name="confirmpassword" class="form-control">

	        </p>

	        <p>

	        	<button type="submit" class="btn btn-primary">Change Password</button>

	        </p>

        </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

	<!-- footer -->

	<?php include_once('includes/footer.php');?>

	<!-- //footer -->



<!-- start-smooth-scrolling -->

<script type="text/javascript" src="js/move-top.js"></script>

<script type="text/javascript" src="js/easing.js"></script>

<script type="text/javascript">

	jQuery(document).ready(function($) {

		$(".scroll").click(function(event){

			event.preventDefault();

			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);

		});

	});

</script>

<!-- start-smooth-scrolling -->

<!-- for bootstrap working -->

	<script src="js/bootstrap.js"></script>

<!-- //for bootstrap working -->

<!-- here stars scrolling icon -->

	<script type="text/javascript">

		$(document).ready(function() {

			/*

				var defaults = {

				containerID: 'toTop', // fading element id

				containerHoverID: 'toTopHover', // fading element hover id

				scrollSpeed: 1200,

				easingType: 'linear'

				};

			*/



			$().UItoTop({ easingType: 'easeOutQuart' });



			});

	</script>

<!-- //here ends scrolling icon -->



<script type="text/javascript">

	$('.edit_details').click(function(e){

		e.preventDefault();

		$(this).hide();

		$('.save_changes').show();

		$('input[name="user_name"]').attr('readonly', false);

	});

	$('.save_changes').click(function(es){

		es.preventDefault();

		if ($('input[name="user_name"]').val() == '') {

			alert('Full Name Cannot be blank');

		}else{

			$.ajax({

				url : $('#change_profile').attr('action'),

				data: $('#change_profile').serialize(),

				method:'post',

				dataType:'json',

				success:function(red){

					if (red.status == 'success') {

						alert("Name Successfully Changed");

						window.location.reload();

					}else{

						alert('something is wrong');

					}

				}

			});

		}







	});

</script>



<script type="text/javascript">

	$('#changePgh').on('submit', function(e){

		e.preventDefault();



		if ($('input[name="oldpassword"]').val() == '' || $('input[name="newpassword"]').val() == '' || $('input[name="confirmpassword"]').val() == '') {

			alert('Please Fill Out All Fields');

		}else{



			if ($('input[name="newpassword"]').val() != $('input[name="confirmpassword"]').val()) {

				alert('New Password & Confirm Password Not Matched');

			}else{

				let url = $(this).attr('action');

				$.ajax({

					url:url,

					data:$(this).serialize(),

					method:"POST",

					dataType:"JSON",

					success:function(res){

						if (res.status =='success') {

							$('#changePgh').trigger('reset');

							alert('Password changed success');



						}else if(res.status == 'oldpassword'){

							alert('Old password not matched');

						}else{

							alert('Something Went Worng');

						}

					}

				});

			}



		}







	});

</script>

</body>

</html>
