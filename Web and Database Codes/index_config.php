<?php
if (isset($_POST['get_student_info'])) {

    $studentID = $_POST['studentID'];

    if (empty($studentID)) {
        echo 'Something went wrong, Student ID did not get!!';
        http_response_code(400);
        exit();
    }
    require 'connectDB.php';
    $sql = "SELECT * FROM users WHERE users.studentID='$studentID';";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
    } else {

        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        $row = mysqli_fetch_assoc($resultl);

        echo '
        <table class="table table-borderless">
              <tbody>
                <tr>
                  <td colspan="2"><b>Name: </b>' . $row['studentName'] . '</td>
                </tr>
                <tr>
                  <td colspan="2"><b>Student ID: </b>' . $row['studentID'] . '</td>
                </tr>
                <tr>
                  <td colspan="2"><b>Department: </b>' . $row['department'] . '</td>
                </tr>
                <tr>
                  <td><b>Batch: </b>' . $row['batch'] . '</td>
                  <td><b>Section: </b>' . $row['section'] . '</td>
                <tr>
                  <td colspan="2"><b>Email: </b>' . $row['email'] . '</td>
                </tr>
                <tr>
                  <td colspan="2"><b>Phone: </b>' . $row['phone'] . '</td>
                </tr>
                <tr>
                  <td><b>Finger ID: </b>' . $row['fingerprint_id'] . '</td>
                  <td><b>Device ID: </b>' . $row['device_uid'] . '</td>
                </tr>
                </tr>
              </tbody>
            </table>';
    }
    exit();
}
