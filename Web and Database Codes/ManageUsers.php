<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Manage Users</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="icons/b_logo.png">
	<link rel="stylesheet" type="text/css" href="css/main.css" />

	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/bootbox.min.js"></script>
	<script src="js/manage_users.js"></script>
	<script>
		$(window).on("load resize ", function() {
			var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
			$('.tbl-header').css({
				'padding-right': scrollWidth
			});
		}).resize();

		$(document).ready(function() {
			$.ajax({
				url: "manage_users_up.php"
			}).done(function(data) {
				$('#manage_users').html(data);
			});
			// setInterval(function() {
			// 	$.ajax({
			// 		url: "manage_users_up.php"
			// 	}).done(function(data) {
			// 		$('#manage_users').html(data);
			// 	});
			// }, 5000);

			$.ajax({
				url: "device_list_dropdown_component.php",
				type: 'POST',
				data: {
					'dev_up': 1,
				}
			}).done(function(data) {
				$('#devices').html(data);
			});
			$.ajax({
				url: "device_list_dropdown_component_for_update_profile.php",
				type: 'POST',
				data: {
					'dev_up': 1,
				}
			}).done(function(data) {
				$('#updateDevices').html(data);
			});
		});
	</script>
</head>

<body>
	<?php include 'header.php'; ?>
	<main class="page-layout">
		<div class="alert_dev"></div>
		<!-- top navigation bar including search bar -->
		<section>
			<nav class="navbar navbar-dark">
				<div class="container-fluid">
					<a class="navbar-brand" style="font-weight: bold;"><i class="fa fa-user-plus"></i> Manage Student</a>
					<form class="d-flex">
						<input class="form-control form-control-sm me-2" type="search" placeholder="Search by Student ID" aria-label="Search" required>
						<button class="btn btn-secondary btn-sm" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</nav>
		</section>

		<section class="slideInRight animated">
			<!-- add/update/remove studen profile tab navigation bar -->
			<nav>
				<div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
					<button class="nav-link active" id="nav-addStudent-tab" data-bs-toggle="tab" data-bs-target="#nav-addStudent" type="button" role="tab" aria-controls="nav-addStudent" aria-selected="true">Add New Student Profile</button>
					<button class="nav-link" id="nav-updateStudent-tab" data-bs-toggle="tab" data-bs-target="#nav-updateStudent" type="button" role="tab" aria-controls="nav-updateStudent" aria-selected="false">Update Student Profile</button>
					<button class="nav-link" id="nav-deleteStudent-tab" data-bs-toggle="tab" data-bs-target="#nav-deleteStudent" type="button" role="tab" aria-controls="nav-deleteStudent" aria-selected="false">Delete Student Profile</button>
				</div>
			</nav>

			<div class="tab-content" id="nav-tabContent">
				<!-- add student profile tab -->
				<div class="tab-pane fade show active" id="nav-addStudent" role="tabpanel" aria-labelledby="nav-addStudent-tab">
					<form>
						<div class="row mb-3">
							<div class="col-4">
								<label for="studentName" class="form-label">Student Name</label>
								<input type="text" class="form-control" name="studentName" id="studentName" placeholder="Enter Student Name" required>
							</div>
							<div class="col-2">
								<label for="studentID" class="form-label">Student ID</label>
								<input type="text" class="form-control" name="studentID" id="studentID" placeholder="Enter Student ID" required>
							</div>
							<div class="col">
								<label for="department" class="form-label">Department</label>
								<select class="form-select" name="department" id="department" aria-label="select-department">
									<option selected disabled value="">Select Dept.</option>
									<option value="BSc. in EEE">BSc. in EEE</option>
									<option value="BSc. in CSE">BSc. in CSE</option>
									<option value="BSc. in SE">BSc. in SE</option>
									<option value="Business">Business</option>
									<option value="Economics">Economics</option>
									<option value="English">English</option>
									<option value="LLB">LLB</option>
								</select>
							</div>
							<div class="col">
								<label for="batch" class="form-label">Batch</label>
								<input type="number" min="1" class="form-control" name="batch" id="batch" placeholder="Enter Batch" required>
							</div>
							<div class="col">
								<label for="section" class="form-label">Section</label>
								<select class="form-select" name="section" id="section" aria-label="select-section">
									<option selected disabled value="">Select Section</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
									<option value="E">E</option>
									<option value="F">F</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="email" class="form-label">Email Address</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" required>
							</div>
							<div class="col-3">
								<label for="phone" class="form-label">Phone Number</label>
								<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required>
							</div>
							<div class="col-2">
								<label for="devices" class="form-label">Select Device</label>
								<div id="devices">Loading...</div>
							</div>
							<div class="col-2">
								<label for="fingerprint_id" class="form-label">Fingerprint ID</label>
								<input type="number" min="1" max="127" class="form-control" name="fingerprint_id" id="fingerprint_id" placeholder="Enter ID" required>
							</div>
							<div class="col-2 align-self-end d-grid">
								<button class="btn btn-outline-success" name="add_student" id="add_student" type="button">Add Profile</button>
							</div>
						</div>
					</form>
				</div>

				<!-- update student profile tab -->
				<div class="tab-pane fade" id="nav-updateStudent" role="tabpanel" aria-labelledby="nav-updateStudent-tab">
					<form>
						<div class="row align-items-center mb-4">
							<div class="col-3">
								<p style="text-align:center; margin: auto !important;">Enter Student ID <br> to Update Student Profile</p>
							</div>
							<div class="col-3">
								<label for="StudentOldID" class="form-label">Student ID</label>
								<input type="text" class="form-control" name="studentOldID" id="studentOldID" placeholder="Enter Student ID to Update" required>
							</div>
							<div class="col-3">
								<label for="StudentOldIDconf" class="form-label">Confirm Student ID</label>
								<input type="text" class="form-control" name="studentOldIDConf" id="studentOldIDConf" placeholder="Confirm Student ID to Update" required>
							</div>
						</div>

						<div class="row mb-2">
							<p style="text-align:center; margin: auto !important;"><b>Enter Student Information Below to Update Existing Student Profile</b></p>
						</div>

						<div class="row mb-3">
							<div class="col-4">
								<label for="updateStudentName" class="form-label">Student Name</label>
								<input type="text" class="form-control" name="updateStudentName" id="updateStudentName" placeholder="Enter Student Name" required>
							</div>
							<div class="col-2">
								<label for="updateStudentID" class="form-label">Student ID</label>
								<input type="text" class="form-control" name="updateStudentID" id="updateStudentID" placeholder="Enter Student ID" required>
							</div>
							<div class="col">
								<label for="studentDept" class="form-label">Department</label>
								<select class="form-select" name="studentDept" id="studentDept" aria-label="select-studentDept">
									<option selected disabled value="">Select Dept.</option>
									<option value="BSc. in EEE">BSc. in EEE</option>
									<option value="BSc. in CSE">BSc. in CSE</option>
									<option value="BSc. in SE">BSc. in SE</option>
									<option value="Business">Business</option>
									<option value="Economics">Economics</option>
									<option value="English">English</option>
									<option value="LLB">LLB</option>
								</select>
							</div>
							<div class="col">
								<label for="studentBatch" class="form-label">Batch</label>
								<input type="number" min="1" class="form-control" name="studentBatch" id="studentBatch" placeholder="Enter Batch" required>
							</div>
							<div class="col">
								<label for="studentSection" class="form-label">Section</label>
								<select class="form-select" name="updateStudentSection" id="studentSection" aria-label="select-studentSection">
									<option selected disabled value="">Select Section</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
									<option value="E">E</option>
									<option value="F">F</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="updateStudentEmail" class="form-label">Email Address</label>
								<input type="email" class="form-control" name="updateStudentEmail" id="updateStudentEmail" placeholder="Enter Email Address" required>
							</div>
							<div class="col-3">
								<label for="updateStudentPhone" class="form-label">Phone Number</label>
								<input type="text" class="form-control" name="updateStudentPhone" id="updateStudentPhone" placeholder="Enter Phone Number" required>
							</div>
							<div class="col-2">
								<label for="updateDevices" class="form-label"> Select Device</label>
								<div id="updateDevices">Loading...</div>
							</div>
							<div class="col-2">
								<label for="updateStudentFingerID" class="form-label">Fingerprint ID</label>
								<input type="number" min="1" max="127" class="form-control" name="updateStudentFingerID" id="updateStudentFingerID" placeholder="Enter Fingerprint ID" required>
							</div>
							<div class="col-2 align-self-end d-grid">
								<button class="btn btn-outline-primary" name="update_student" id="update_student" type="button">Update Profile</button>
							</div>
						</div>
					</form>
				</div>

				<!-- delete student profile tab -->
				<div class="tab-pane fade" id="nav-deleteStudent" role="tabpanel" aria-labelledby="nav-deleteStudent-tab">
					<form class="row align-items-center">
						<div class="col">
							<p style="text-align:center; margin: auto !important;">Enter the Student ID <br> to Delete Student Profile</p>
						</div>
						<div class="col">
							<label for="deleteStudentID" class="form-label">Student ID</label>
							<input type="text" class="form-control" name="deleteStudentID" id="deleteStudentID" placeholder="Enter Student ID to Delete" required>
						</div>
						<div class="col">
							<label for="deleteStudentIDConf" class="form-label">Confirm Student ID</label>
							<input type="text" class="form-control" name="deleteStudentIDConf" id="deleteStudentIDConf" placeholder="Confirm Student ID to Delete" required>
						</div>
						<div class="col-2 align-self-end d-grid">
							<button class="btn btn-outline-danger" id="delete_student" type="button">Delete Profile</button>
						</div>
					</form>
				</div>
			</div>
		</section>

		<section>
			<!-- student table -->

			<div class="table-responsive slideInRight animated">
				<div id="manage_users">Loading...</div>
			</div>
		</section>

	</main>
</body>

</html>