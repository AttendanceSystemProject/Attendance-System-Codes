<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Manage Devices</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootbox.min.js"></script>
	<script src="js/dev_config.js"></script>

	<link rel="icon" type="image/png" href="icons/b_logo.png">
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<script>
		$(window).on("load resize ", function() {
			var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
			$('.tbl-header').css({
				'padding-right': scrollWidth
			});
		}).resize();

		$(document).ready(function() {
			$.ajax({
				url: "dev_up.php",
				type: 'POST',
				data: {
					'dev_up': 1,
				}
			}).done(function(data) {
				$('#devices').html(data);
			});
		});
	</script>
</head>

<body>
	<?php include 'header.php'; ?>
	<main class="page-layout">
		<div class="alert_dev"></div>
		<section>
			<nav class="navbar navbar-dark">
				<div class="container-fluid">
					<a class="navbar-brand" style="font-weight: bold;"><i class="fa fa-laptop"></i> Device Manager</a>
				</div>
			</nav>
		</section>

		<section class="slideInRight animated">
			<!-- add/update/remove device tab navigation bar -->
			<nav>
				<div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
					<button class="nav-link active" id="nav-addDevice-tab" data-bs-toggle="tab" data-bs-target="#nav-addDevice" type="button" role="tab" aria-controls="nav-addDevice" aria-selected="true">Add New Fingerprint Device</button>
					<button class="nav-link" id="nav-updateDevice-tab" data-bs-toggle="tab" data-bs-target="#nav-updateDevice" type="button" role="tab" aria-controls="nav-updateDevice" aria-selected="false">Update Fingerprint Device</button>
					<button class="nav-link" id="nav-deleteDevice-tab" data-bs-toggle="tab" data-bs-target="#nav-deleteDevice" type="button" role="tab" aria-controls="nav-deleteDevice" aria-selected="false">Delete Fingerprint Device</button>
				</div>
			</nav>

			<div class="tab-content" id="nav-tabContent">
				<!-- add new device tab -->
				<div class="tab-pane fade show active" id="nav-addDevice" role="tabpanel" aria-labelledby="nav-addDevice-tab">
					<form class="row align-items-center" action="" method="POST" enctype="multipart/form-data">
						<div class="col">
							<label for="dev_name" class="form-label">Device Name</label>
							<input type="text" class="form-control" name="dev_name" id="dev_name" placeholder="Input a Device Name" required>
						</div>
						<div class="col">
							<label for="dev_dep" class="form-label">Device Department</label>
							<select class="form-select" name="dev_dep" id="dev_dep" aria-label="select-deviceDept">
								<option selected disabled value="">Select Device Department</option>
								<option value="EEE">EEE</option>
								<option value="CSE">CSE</option>
								<option value="SE">SE</option>
								<option value="Business">Business</option>
								<option value="Economics">Economics</option>
								<option value="English">English</option>
								<option value="LLB">LLB</option>
							</select>
						</div>
						<div class="col">
							<label for="dev_uid" class="form-label">Device Unique ID</label>
							<input type="text" class="form-control" name="dev_uid" id="dev_uid" placeholder="Enter Device Unique ID" required>
						</div>
						<div class="col-2 align-self-end d-grid">
							<button class="btn btn-outline-success" name="dev_add" id="dev_add" type="button">Add Device</button>
						</div>
					</form>
				</div>

				<!-- update device tab -->
				<div class="tab-pane fade" id="nav-updateDevice" role="tabpanel" aria-labelledby="nav-updateDevice-tab">
					<form>
						<div class="row">
							<div class="col">
								<div class="row align-items-center mb-4">
									<div class="col">
										<p style="text-align:center; margin: auto !important;">Enter a Device Unique ID <br> to Update the Device.</p>
									</div>
									<div class="col">
										<label for="dev_old_uid" class="form-label">Device Unique ID</label>
										<input type="text" class="form-control" name="dev_old_uid" id="dev_old_uid" placeholder="Enter Device Unique ID to Update" required>
									</div>
									<div class="col">
										<label for="dev_old_uid_conf" class="form-label">Confirm Device Unique ID</label>
										<input type="text" class="form-control" name="dev_old_uid_conf" id="dev_old_uid_conf" placeholder="Confirm Device Unique ID to Update" required>
									</div>
								</div>

								<div class="row mb-2">
									<p style="text-align:center; margin: auto !important;"><b>Enter Device Information Below to Update Existing Device</b></p>
								</div>

								<div class="row">
									<div class="col">
										<label for="update_dev_name" class="form-label">Device Name</label>
										<input type="text" class="form-control" name="update_dev_name" id="update_dev_name" placeholder="Input a Device Name" required>
									</div>
									<div class="col">
										<label for="update_dev_dep" class="form-label">Device Department</label>
										<select class="form-select" name="update_dev_dep" id="update_dev_dep" aria-label="select-deviceDept">
											<option selected disabled value="">Select Device Department</option>
											<option value="EEE">EEE</option>
											<option value="CSE">CSE</option>
											<option value="SE">SE</option>
											<option value="Business">Business</option>
											<option value="Economics">Economics</option>
											<option value="English">English</option>
											<option value="LLB">LLB</option>
										</select>
									</div>
									<div class="col">
										<label for="update_dev_uid" class="form-label">Device Unique ID</label>
										<input type="text" class="form-control" name="update_dev_uid" id="update_dev_uid" placeholder="Enter Device Unique ID" required>
									</div>
								</div>
							</div>

							<div class="col-2 align-self-end d-grid">
								<button class="btn btn-outline-primary" name="dev_update" id=dev_update type="button">Update Device</button>
							</div>
						</div>
					</form>
				</div>

				<!-- delete device tab -->
				<div class="tab-pane fade" id="nav-deleteDevice" role="tabpanel" aria-labelledby="nav-deleteDevice-tab">
					<form>
						<div class="row align-items-center">
							<div class="col">
								<p style="text-align:center; margin: auto !important;">Enter the Device Unique ID <br> to Delete a Device.</p>
							</div>
							<div class="col">
								<label for="del_dev_uid" class="form-label">Device Unique ID</label>
								<input type="text" class="form-control" name="del_dev_uid" id="del_dev_uid" placeholder="Enter Device Unique ID to Delete" required>
							</div>
							<div class="col">
								<label for="del_dev_uid_conf" class="form-label">Confirm Device Unique ID</label>
								<input type="text" class="form-control" name="del_dev_uid_conf" id="del_dev_uid_conf" placeholder="Confirm Device Unique ID to Delete" required>
							</div>
							<div class="col-2 align-self-end d-grid">
								<button class="btn btn-outline-danger" name="dev_delete" id="dev_delete" type="button">Delete Device</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>

		<!--device list table-->
		<section>
			<div class="table-responsive slideInDown animated">
				<div id="devices">Loading...</div>
			</div>
		</section>
	</main>
</body>

</html>