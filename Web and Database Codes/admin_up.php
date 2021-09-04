<?php
session_start();
if (isset($_POST['course_up'])) {
?>
	<table style="font: 18px; text-align:center;" class="table align-middle table-hover">
		<thead class="table-primary">
			<tr>
				<th style="width: 5%;">S/N</th>
				<th style="width: 40%;">Course Details</th>
				<th style="width: 40%">Assigned Students</th>
				<th style="width: 15%">Action</th>
			</tr>
		</thead>

		<tbody class="table-secondary">

			<?php
			require 'connectDB.php';
			$sql = "SELECT * FROM courses ORDER BY id DESC";
			$result = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($result, $sql)) {
				echo '<p class="error">SQL Error</p>';
			} else {
				$index = 0;
				mysqli_stmt_execute($result);
				$resultl = mysqli_stmt_get_result($result);
				while ($row = mysqli_fetch_assoc($resultl)) {
					echo '<tr>
				<td>' . ($index + 1) . '
				</td>
				<td>
					Program: ' . $row["programName"] . '
					<br>Course:' . $row["courseName"] . '
					<br>Term:' . $row["term"] . '
					<br>Year:' . $row["courseYear"] . '
				</td>
				<td>
					table showing <br> Department-batch-section
					<!-- from database -->
				</td>
				<td>
					<div class="d-grid gap-2 mx-auto">
					<button class="btn btn-sm btn-outline-primary" onClick="manageCourse(' . $row["id"] . ')" type="button" data-bs-toggle="modal" data-bs-target="#edit_info">Manage Course</button>
					<button class="btn btn-sm btn-outline-secondary" onClick="exportAttendance(' . $row["id"] . ')" type="button" data-bs-toggle="modal" data-bs-target="#export_att">Export Attendance</button>
					</div>
				</td>
			</tr>';
					$index++;
				}

				if ($index == 0) {
					echo '
				<tr>
					<td colspan="4">No course added.</td>
				</tr>';
				}
			}
			?>
		</tbody>
	</table>
<?php

} else if (isset($_POST['get_course_Info'])) {

	$courseId = $_POST['courseId'];
	if (empty($courseId)) {
		echo 'Something went wrong, courseId did not get!!';
		http_response_code(400);
		exit();
	}
	require 'connectDB.php';
	$sql = "SELECT * FROM courses WHERE courses.id='$courseId';";
	$result = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($result, $sql)) {
		echo '<p class="error">SQL Error</p>';
	} else {
		
		mysqli_stmt_execute($result);
		$resultl = mysqli_stmt_get_result($result);
		$row = mysqli_fetch_assoc($resultl);

		echo '<div class="row">
				<div class="col-6">
					Program Name : <strong>'.$row['programName'].'</strong>
				</div>
				<div class="col">
					Term: <strong>'.$row['term'].'</strong>
				</div>
				<div class="col">
					Year: <strong>'.$row['courseYear'].'</strong>
				</div>
				</div>
				<div class="row mb-4 mt-1">
					<div class="col">
						Course Name: <strong>'.$row['courseName'].'</strong>
					</div>
				</div>';
	}
	exit();

} else if (isset($_POST['viewStudentsForAssign'])) {
	// echo 'viewStudentsForAssign=== php called';
	$department = $_POST['department'];
	$batch = $_POST['batch'];
	$section = $_POST['section'];
	$courseId = $_POST['courseId'];

	if (empty($department)) {
		echo 'Please, Select a department!!';
		http_response_code(400);
		exit();
	} elseif (empty($batch)) {
		echo 'Please, Select a batch!!';
		http_response_code(400);
		exit();
	} elseif (empty($section)) {
		echo 'Please, Select a section!!';
		http_response_code(400);
		exit();
	}
?>

	<table style="font: 18px; text-align:center;" class="table align-middle table-hover">
		<thead class="table-primary">
			<tr>
				<th style="width: 6%;">
					<input class="form-check-input" type="checkbox" name="select_all_for_assign" id="select_all_for_assign">
					<label class="form-check-label" for="select_all_for_assign">All</label>
				</th>
				<th style="width: 4%;">S/N</th>
				<th style="width: 22%;">Student Name</th>
				<th style="width: 18%;">Student ID</th>
				<th style="width: 10%;">Department</th>
				<th style="width: 10%;">Batch</th>
				<th style="width: 10%;">Section</th>
				<th style="width: 16%;">Already In Course</th>
			</tr>
		</thead>

		<tbody id="assignStudentTable" class="table-secondary">

			<?php
			require 'connectDB.php';

			$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section,  
			IF(course_students.studentID IS NULL, FALSE, TRUE) as isStudentInCourseAlready  FROM users 
			LEFT JOIN course_students ON users.studentID=course_students.studentID AND course_students.courseID='$courseId'
			WHERE users.department='$department' AND users.batch='$batch' AND users.section='$section' 
			-- GROUP BY(users.studentID)
			ORDER BY users.studentID DESC";
			$result = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($result, $sql)) {
				echo '<p class="error">SQL Error</p>';
			} else {
				$index = 0;
				mysqli_stmt_execute($result);
				$resultl = mysqli_stmt_get_result($result);
				while ($row = mysqli_fetch_assoc($resultl)) {
					$isStudentInCourse =  $row["isStudentInCourseAlready"] ? 'Yes' : 'No';

					echo '
						<tr>
							<td><input class="form-check-input select_item_for_assign" type="checkbox"  id="' . $row["studentID"] . '" value="' . $row["studentID"] . '"></td>
							<td>' . ($index + 1) . '</td>
							<td>' . $row["studentName"] . '</td>
							<td>' . $row["studentID"] . '</td>
							<td>' . $row["department"] . '</td>
							<td>' . $row["batch"] . '</td>
							<td>' . $row["section"] . '</td>
							<td>' . $isStudentInCourse . '</td>
						</tr>';

					$index++;
				}

				if ($index == 0) {
					echo '
				<tr>
					<td colspan="8">No student found.</td>
				</tr>';
				}
			}
			?>
		</tbody>
	</table>

<?php

} else if (isset($_POST['allAssignedStudentTableForUnassigned'])) {
	$department = $_POST['department'];
	$batch = $_POST['batch'];
	$section = $_POST['section'];
	$courseId = $_POST['courseId'];
?>

	<table style="font: 18px; text-align:center;" class="table align-middle table-hover">
		<thead class="table-primary">
			<tr>
				<th style="width: 6%;">
					<input class="form-check-input" type="checkbox" name="select_all_for_unassign" id="select_all_for_unassign">
					<label class="form-check-label" for="select_all_for_unassign">All</label>
				</th>
				<th style="width: 4%;">S/N</th>
				<th style="width: 22%;">Student Name</th>
				<th style="width: 18%;">Student ID</th>
				<th style="width: 10%;">Department</th>
				<th style="width: 10%;">Batch</th>
				<th style="width: 10%;">Section</th>
			</tr>
		</thead>

		<tbody id="unassignStudentTable" class="table-secondary">

			<?php
			require 'connectDB.php';

			$sql = "";

			if (empty($department) && empty($batch) && empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
							LEFT JOIN course_students ON users.studentID=course_students.studentID
							WHERE course_students.courseID='$courseId'
							GROUP BY(users.studentID)
							ORDER BY users.studentID DESC";
			} elseif (empty($department) && empty($batch) && !empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE users.section='$section' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			} elseif (empty($department) && !empty($batch) && empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE users.batch='$batch' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			} elseif (empty($department) && !empty($batch) && !empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE AND users.batch='$batch' AND users.section='$section' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			} elseif (!empty($department) && empty($batch) && empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE users.department='$department' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			} elseif (!empty($department) && empty($batch) && !empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE users.department='$department' AND users.section='$section' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			} elseif (!empty($department) && !empty($batch) && empty($section)) {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE users.department='$department' AND users.batch='$batch' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			} else {
				$sql = "SELECT users.id, users.studentID, users.studentName, users.department, users.batch, users.section  FROM users 
						LEFT JOIN course_students ON users.studentID=course_students.studentID
						WHERE users.department='$department' AND users.batch='$batch' AND users.section='$section' AND course_students.courseID='$courseId'
						GROUP BY(users.studentID)
						ORDER BY users.studentID DESC";
			}

			$result = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($result, $sql)) {
				echo '<p class="error">SQL Error</p>';
			} else {
				$index = 0;
				mysqli_stmt_execute($result);
				$resultl = mysqli_stmt_get_result($result);
				while ($row = mysqli_fetch_assoc($resultl)) {
					echo '
						<tr>
							<td><input class="form-check-input select_item_for_unassign" type="checkbox"  id="' . $row["studentID"] . '" value="' . $row["studentID"] . '"></td>
							<td>' . ($index + 1) . '</td>
							<td>' . $row["studentName"] . '</td>
							<td>' . $row["studentID"] . '</td>
							<td>' . $row["department"] . '</td>
							<td>' . $row["batch"] . '</td>
							<td>' . $row["section"] . '</td>
						</tr>';

					$index++;
				}

				if ($index == 0) {
					echo '
				<tr>
					<td colspan="7">No student found.</td>
				</tr>';
				}
			}
			?>
		</tbody>
	</table>

<?php

} else if (isset($_POST['allAssignedStudent'])) {
	$selectedCourseId = $_POST['courseId'];
?>
	<table style="font: 18px; text-align:center;" class="table align-middle table-hover">
		<thead class="table-secondary">
			<tr>
				<th style="width: 5%;">S/N</th>
				<th style="width: 45%;">Student Name</th>
				<th style="width: 20%;">Student ID</th>
				<th style="width: 10%;">Department</th>
				<th style="width: 10%;">Batch</th>
				<th style="width: 10%;">Section</th>
			</tr>
		</thead>

		<tbody class="table-light">

			<?php
			require 'connectDB.php';
			$sql = "SELECT * FROM course_students JOIN courses ON courses.id = course_students.courseID JOIN users ON  users.studentID = course_students.studentID WHERE course_students.courseID='$selectedCourseId' ORDER BY course_students.id DESC;";
			$result = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($result, $sql)) {
				echo '<p class="error">SQL Error</p>';
			} else {
				$index = 0;
				mysqli_stmt_execute($result);
				$resultl = mysqli_stmt_get_result($result);
				while ($row = mysqli_fetch_assoc($resultl)) {
					echo '<tr>
							<td>' . ($index + 1) . '</td>
							<td>' . $row["studentName"] . '
							<td>' . $row["studentID"] . '
							<td>' . $row["department"] . '
							<td>' . $row["batch"] . '</td>
							<td>' . $row["section"] . '</td>
						</tr>';
					$index++;
				}

				if ($index == 0) {
					echo '
				<tr>
					<td colspan="6">No students added.</td>
				</tr>';
				}
			}
			?>
		</tbody>
	</table>
<?php
}

else if (isset($_POST['get_edit_admin_profile_input'])) {
	$admin_email = $_SESSION['Admin-email'];

    if (empty($admin_email)) {
        echo 'Something went wrong!!';
        http_response_code(400);
        exit();
    }
    require 'connectDB.php';
    $sql = "SELECT admin_name, admin_email, department, designation FROM `admin` WHERE `admin_email`='$admin_email';";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
    } else {

        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        $row = mysqli_fetch_assoc($resultl);

		echo '<div class="row mb-3">
		<div class="col">
			<label for="admin_name" class="form-label">Admin Name</label>
			<input type="text" class="form-control" id="admin_name" value="'.$row["admin_name"].'" placeholder="Enter Name" required>
		</div>
		<div class="col">
			<label for="admin_dept" class="form-label">Department</label>
			<select class="form-select" id="admin_dept" value="'.$row["department"].'" aria-label="select-admin_dept" data-width="100%">
				<option selected disabled value="">Select Dept.</option>
				<option value="Department of Electrical & Electronic Engineering">Department of Electrical & Electronic Engineering</option>
				<option value="Department of Computer Science & Engineering">Department of Computer Science & Engineering</option>
				<option value="Department of Software Engineering">Department of Software Engineering</option>
				<option value="Department of Business Administration">Department of Business Administration</option>
				<option value="Department of Economics">Department of Economics</option>
				<option value="Department of English">Department of English</option>
				<option value="Department of Law & Justice">Department of Law & Justice</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-auto">
			<label for="designation" class="form-label">Designation</label>
			<select class="form-select" id="admin_designation" value="'.$row["designation"].'" aria-label="select-designation" data-width="100%">
				<option selected disabled value="">Select Designation</option>
				<option value="Lecturer">Lecturer</option>
				<option value="Senior Lecturer">Senior Lecturer</option>
				<option value="Assistant Professor">Assistant Professor</option>
				<option value="Associate Professor">Associate Professor</option>
				<option value="Professor">Professor</option>
			</select>
		</div>
		<div class="col">
			<label for="admin_email" class="form-label">Email</label>
			<input type="email" class="form-control" id="admin_email" value="'.$row["admin_email"].'" placeholder="Enter Email" required>
		</div>
		<div class="col-3 align-self-end d-grid">
			<button class="btn btn-outline-primary" id="btnUpdateAdminInfo"  type="button">Update Information</button>
		</div>
	</div>';
    }
}
?>