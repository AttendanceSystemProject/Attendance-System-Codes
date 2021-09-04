<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootbox.min.js"></script>
	<script src="js/admin_panel_config.js"></script>
	<script src="js/clockgenerator.js"></script>

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
				url: "admin_up.php",
				type: 'POST',
				data: {
					'course_up': 1,
				}
			}).done(function(data) {
				$('#courses').html(data);
			});

			// admin info
			$.ajax({
				url: "admin_panel_config.php",
				type: 'POST',
				data: {
					'get_admin_info': 1,
				}
			}).done(function(data) {
				$('#adminInfo').html(data);
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
					<a class="navbar-brand" style="font-weight: bold;"><i class="fa fa-shield"></i> Admin Panel</a>
				</div>
			</nav>
		</section>

		<section class="slideInRight animated">
			<!-- add/update/remove device tab navigation bar -->
			<nav>
				<div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
					<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Admin Profile</button>
					<!-- <button class="nav-link" id="nav-exportAtt-tab" data-bs-toggle="tab" data-bs-target="#nav-exportAtt" type="button" role="tab" aria-controls="nav-exportAtt" aria-selected="false">Export Attendance</button> -->
					<button class="nav-link" id="nav-addCourse-tab" data-bs-toggle="tab" data-bs-target="#nav-addCourse" type="button" role="tab" aria-controls="nav-addCourse" aria-selected="false">Add New Course</button>
					<button class="nav-link" id="nav-deleteCourse-tab" data-bs-toggle="tab" data-bs-target="#nav-deleteCourse" type="button" role="tab" aria-controls="nav-deleteCourse" aria-selected="false">Delete Existing Course</button>
				</div>
			</nav>

			<div class="tab-content" id="nav-tabContent">

				<!-- admin profile tab -->
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<div class="row align-items-center">
						<div class="col ms-3">
							<div id="adminInfo">Loading...</div>
							<!-- data from database -->
						</div>
						<div class="col-2 col-2 align-self-end d-grid">
							<button class="btn btn-outline-primary" type="button" id="btnManageProfile" data-bs-toggle="modal" data-bs-target="#manage_profile">Manage Profile</button>
						</div>
					</div>
				</div>

				
				<!-- add new course tab -->
				<div class="tab-pane fade" id="nav-addCourse" role="tabpanel" aria-labelledby="nav-addCourse-tab">
					<form>
						<div class="row align-items-center">
							<div class="col">
								<label for="on_program_select" class="form-label">Program Name</label>
								<select class="form-select" name="programName" id="on_program_select" aria-label="select-on_program_select">
									<option selected disabled value="">Select Program</option>
									<option value="BSc. in EEE">BSc. in EEE</option>
									<option value="BSc. in CSE">BSc. in CSE</option>
									<option value="BSc. in SE">BSc. in SE</option>
									<option value="Business">Business</option>
									<option value="Economics">Economics</option>
									<option value="English">English</option>
									<option value="LLB">LLB</option>
								</select>
							</div>
							<div class="col-4">
								<label for="course_list" class="form-label">Course Name</label>
								<select class="form-select" name="courseName" id="course_list" aria-label="select-course_list" data-width="100%">
									<option selected disabled value="">Select Program First</option>
								</select>
							</div>
							<div class="col">
								<label for="term" class="form-label">Term</label>
								<select class="form-select" name="term" id="term" aria-label="select-term">
									<option selected disabled value="">Select Term</option>
									<option value="Spring">Spring</option>
									<option value="Summer">Summer</option>
									<option value="Fall">Fall</option>
								</select>
							</div>
							<div class="col">
								<label for="year" class="form-label">Year</label>
								<input type="number" min="2021" max="2099" class="form-control" name="year" id="year" placeholder="Enter Year" required>
							</div>
							<div class="col-2 align-self-end d-grid">
								<button class="btn btn-outline-success" id="course_add" type="button">Add Course</button>
							</div>
						</div>
					</form>
				</div>

				<!-- delete course tab -->
				<div class="tab-pane fade" id="nav-deleteCourse" role="tabpanel" aria-labelledby="nav-deleteCourse-tab">
					<form>
						<div class="row align-items-center">
							<div class="col">
								<label for="programDelete" class="form-label">Program Name</label>
								<select class="form-select" id="programDelete" aria-label="select-programDelete">
									<option selected disabled value="">Select Program</option>
									<option value="BSc. in EEE">BSc. in EEE</option>
									<option value="BSc. in CSE">BSc. in CSE</option>
									<option value="BSc. in SE">BSc. in SE</option>
									<option value="Business">Business</option>
									<option value="Economics">Economics</option>
									<option value="English">English</option>
									<option value="LLB">LLB</option>
								</select>
							</div>
							<div class="col-4">
								<label for="courseDelete" class="form-label">Course Name</label>
								<select class="form-select" id="courseDelete" aria-label="select-courseDelete" data-width="100%">
									<option selected disabled value="">Select Program First</option>
								</select>
							</div>
							<div class="col">
								<label for="termDelete" class="form-label">Term</label>
								<select class="form-select" id="termDelete" aria-label="select-termDelete">
									<option selected disabled value="">Select Term</option>
									<option value="Spring">Spring</option>
									<option value="Summer">Summer</option>
									<option value="Fall">Fall</option>
								</select>
							</div>
							<div class="col">
								<label for="yearDelete" class="form-label">Year</label>
								<input type="number" min="2021" max="2099" class="form-control" id="yearDelete" placeholder="Enter Year" required>
							</div>
							<div class="col-2 align-self-end d-grid">
								<button class="btn btn-outline-danger" id="course_del" type="button">Delete Course</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>


		<!--course list table-->
		<section>
			<div class="table-responsive slideInDown animated">
				<div id="courses">Loading...</div>
			</div>
		</section>

		<!-- Modal: manage course-->
		<div class="modal fade" id="edit_info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_infoLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="edit_infoLabel">Manage Course</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row">
						<button class="col btn btn-outline-success mx-3" onclick="selectedAction('assignStudent')" type="button" data-bs-toggle="modal" data-bs-target="#assign_student">Assign Student</button>
						<button class="col btn btn-outline-primary me-3" onclick="selectedAction('viewStudent')" type="button" data-bs-toggle="modal" data-bs-target="#view-student">View Student</button>
						<button class="col btn btn-outline-danger me-3" onclick="selectedAction('unassignStudent')" type="button" data-bs-toggle="modal" data-bs-target="#unassign_student">Unassign Student</button>
						<button class="col btn btn-outline-info me-3" onclick="selectedAction('editCourseInfo')" type="button" data-bs-toggle="modal" data-bs-target="#edit_course_info">Edit Course Info</button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Return to Admin Panel</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal: assign student to course-->
		<div class="modal fade" id="assign_student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assign_studentLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="assign_studentLabel">Assign Student to Course</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="alert_dev"></div>
					<div class="modal-body">
						<div id="courseInfo1">Loading...</div>
						<!-- view student form -->
						<form>
							<div class="row mb-3">
								<div class="col-2">
									<label for="StudentDept" class="form-label">Department*</label>
									<select class="form-select" id="StudentDept" aria-label="select-StudentDept" required>
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
								<div class="col-2">
									<label for="StudentBatch" class="form-label">Batch*</label>
									<input type="number" min="1" class="form-control" id="StudentBatch" placeholder="Enter Batch" required>
								</div>
								<div class="col-2">
									<label for="StudentSection" class="form-label">Section*</label>
									<select class="form-select" id="StudentSection" aria-label="select-StudentSection" required>
										<option selected disabled value="">Select Section</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
									</select>
								</div>
								<div class="col-2 align-self-end d-grid">
									<button type="button" id="viewStudentsForAssign" class="btn btn-outline-success">View Student</button>
								</div>
							</div>
						</form>

						<div id="studentAssignTableData">
							Search Student for assign in course.
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
						<button type="button" id="btnAssignStudent" class="btn btn-outline-success">Assign Student</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal: view assigned student-->
		<div class="modal fade" id="view-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="view-studentLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="view-studentLabel">All Assigned Student</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<div id="courseInfo2">Loading...</div>
						<div id="allAssignedStudentTable">Loading...</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal: unassign student from course-->
		<div class="modal fade" id="unassign_student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="unassign_studentLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="unassign_studentLabel">Unassign Student from Course</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="alert_for_modal"></div>

					<div class="modal-body">
						<div id="courseInfo3">Loading...</div>
						<!-- filter student form -->
						<form>
							<div class="row mb-3">
								<div class="col-2">
									<label for="filter_StudentDept" class="form-label">Department</label>
									<select class="form-select" id="filter_StudentDept" aria-label="select-filter_StudentDept" required>
										<option selected disabled value="">Select Dept.</option>
										<option value="">All</option>
										<option value="BSc. in EEE">BSc. in EEE</option>
										<option value="BSc. in CSE">BSc. in CSE</option>
										<option value="BSc. in SE">BSc. in SE</option>
										<option value="Business">Business</option>
										<option value="Economics">Economics</option>
										<option value="English">English</option>
										<option value="LLB">LLB</option>
									</select>
								</div>
								<div class="col-2">
									<label for="filter_StudentBatch" class="form-label">Batch</label>
									<input type="number" min="1" class="form-control" id="filter_StudentBatch" placeholder="Enter Batch" required>
								</div>
								<div class="col-2">
									<label for="filter_StudentSection" class="form-label">Section</label>
									<select class="form-select" id="filter_StudentSection" aria-label="select-filter_StudentSection" required>
										<option selected disabled value="">Select Section</option>
										<option value="">All</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
									</select>
								</div>
								<div class="col-2 align-self-end d-grid">
									<button type="button" class="btn btn-outline-success" id="filterStudentsForUnassign">Filter Student</button>
								</div>
							</div>
						</form>

						<!--assigned student table showed from database  -->
						<div id="allAssignedStudentTableForUnassigned">Loading...</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-outline-danger" id="btnUnassignStudent">Unassign Student</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal: edit course info-->
		<div class="modal fade" id="edit_course_info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_course_infoLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="edit_course_infoLabel">Edit Course Info</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="alert_edit_course_modal"></div>
					<div class="modal-body">

						<div id="courseInfo4">Loading...</div>

						<form>
							<div class="row mb-3">
								<div class="col-4">
									<label for="editinfo_program" class="form-label">Program Name</label>
									<select class="form-select" name="" id="editinfo_program" aria-label="select-editinfo_program">
										<option selected disabled value="">Select Program</option>
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
									<label for="editinfo_course" class="form-label">Course Name</label>
									<select class="form-select" name="" id="editinfo_course" aria-label="select-editinfo_course" data-width="100%">
										<option selected disabled value="">Select Program First</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label for="editinfo_term" class="form-label">Term</label>
									<select class="form-select" name="" id="editinfo_term" aria-label="select-editinfo_term">
										<option selected disabled value="">Select Term</option>
										<option value="Spring">Spring</option>
										<option value="Summer">Summer</option>
										<option value="Fall">Fall</option>
									</select>
								</div>
								<div class="col-4">
									<label for="editinfo_year" class="form-label">Year</label>
									<input type="number" min="2021" max="2099" class="form-control" name="" id="editinfo_year" placeholder="Enter Year" required>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
						<button class="btn btn-outline-primary" id="updateCourseInfo" type="button">Update Info</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal: export attendance-->
		<div class="modal fade" id="export_att" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="export_attLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="export_attLabel">Export Attendance</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- export attendance form   -->
						<form>
							<div class="row mb-3">
								<div class="col">
									<label for="filterStudentDept" class="form-label">Department</label>
									<select class="form-select" id="filterStudentDept" aria-label="select-filterStudentDept">
										<option selected disabled value="">Select Dept.</option>
										<option value="1">EEE</option>
										<option value="2">CSE</option>
										<option value="3">SE</option>
										<option value="4">Business</option>
										<option value="5">Economics</option>
										<option value="6">English</option>
										<option value="7">LLB</option>
									</select>
								</div>
								<div class="col">
									<label for="filterStudentBatch" class="form-label">Batch</label>
									<input type="number" min="1" class="form-control" id="filterStudentBatch" placeholder="Enter Batch" required>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label for="filterStudentSection" class="form-label">Section</label>
									<select class="form-select" id="filterStudentSection" aria-label="select-filterStudentSection">
										<option selected disabled value="">Select Section</option>
										<option value="1">A</option>
										<option value="2">B</option>
										<option value="3">C</option>
										<option value="4">D</option>
										<option value="5">E</option>
										<option value="6">F</option>
									</select>
								</div>
								<div class="col">
									<label for="filterStudentID" class="form-label">Student ID</label>
									<input type="text" class="form-control" id="filterStudentID" placeholder="Enter Student ID" required>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
						<button class="btn btn-outline-secondary" type="submit">Export Attendance</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal: edit profile-->
		<div class="modal fade" id="manage_profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage_profileLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="manage_profileLabel">Edit Admin Profile</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="alert_for_modal"></div>
					<div class="modal-body">
						<form>
							<div id="admin_update_profile_input">Loading...</div>
						</form>
					</div>

					<div class="modal-header">
						<h5 class="modal-title" id="manage_profileLabel">Change Admin Password</h5>
					</div>

					<div class="modal-body">
						<form>
							<div class="row">
								<div class="col">
									<div class="row mb-3">
										<div class="col">
											<label for="current_pass" class="form-label">Password</label>
											<input type="text" class="form-control" id="current_pass" placeholder="Enter Password" required>
										</div>
										<div class="col">
											<label for="current_passconf" class="form-label">Confirm Password</label>
											<input type="text" class="form-control" id="current_passconf" placeholder="Enter Password Again" required>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<label for="new_pass" class="form-label">New Password</label>
											<input type="text" class="form-control" id="new_pass" placeholder="Enter New Password" required>
										</div>
										<div class="col">
											<label for="new_passconf" class="form-label">Confirm New Password</label>
											<input type="text" class="form-control" id="new_passconf" placeholder="Enter New Password Again" required>
										</div>
									</div>
								</div>
								<div class="col-3 align-self-end d-grid">
									<button class="btn btn-outline-danger" id="btnChangePassword" type="button">Change Password</button>
								</div>
							</div>
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>

</html>