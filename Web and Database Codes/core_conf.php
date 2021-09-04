<?php  
//Connect to database
require 'connectDB.php';
date_default_timezone_set('Asia/Damascus');
$d = date("Y-m-d");
$t = date("H:i:s");

if (isset($_GET['login'])) {

    $loginPassword = $_GET['login'];

    // Getting all admin user
    $sql = "SELECT * FROM admin";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        header("location: login.php?error=sqlerror");
          exit();
    }
    else{
        // mysqli_stmt_bind_param($result, "s", $login_password_hash);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);

        $adminFound = false;

        while ($row = mysqli_fetch_assoc($resultl)) {
            $pwdCheck = password_verify($loginPassword, $row['admin_pwd']);
				if ($pwdCheck == true) {
                    $adminFound = true;
                    break;
                }
        }

        if ($adminFound) {
            // login success
            // echo "Login Success";

            $sql = "SELECT DISTINCT courseName FROM `courses` JOIN course_students ON courses.id=course_students.courseID";

            $result = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($result, $sql)) {
				echo '<p class="error">SQL Error</p>';
			} else {
				$courseCode = "";
                mysqli_stmt_execute($result);
				$resultl = mysqli_stmt_get_result($result);
				while ($row = mysqli_fetch_assoc($resultl)) {
                    if ($courseCode != "") {
                            $courseCode = $courseCode.",";
                    }
                    $courseCode = $courseCode.substr($row["courseName"], 0, 7);
                }
                echo $courseCode;
            }
                        
        } else {
            echo "Login Failed";
        }
    }

}

if (isset($_GET['device_uid']) && isset($_GET['fingerprint_id']) && isset($_GET['course_code'])) {

    $device_uid = $_GET['device_uid'];
    $fingerprint_id = $_GET['fingerprint_id'];
    $course_code = $_GET['course_code'];


    $sql = "SELECT * FROM `courses` WHERE courses.courseName LIKE '$course_code%';";
    // $sql = "SELECT * FROM `courses` WHERE courses.courseName LIKE 'EEE-111%';";

    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        header("location: login.php?error=sqlerror");
          exit();
    }
    else{
        // mysqli_stmt_bind_param($result, "s", $login_password_hash);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);

        

        if ($row = mysqli_fetch_assoc($resultl)) {
            $courseId = $row["id"];

            $sql = "SELECT users.id, users.studentID, users.fingerprint_id, users.device_uid FROM `users` LEFT JOIN course_students ON users.studentID=course_students.studentID WHERE users.fingerprint_id=$fingerprint_id AND course_students.courseID='$courseId'";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                header("location: login.php?error=sqlerror");
                  exit();
            }
            else{
                // mysqli_stmt_bind_param($result, "s", $login_password_hash);
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
    
                if ($row = mysqli_fetch_assoc($resultl)) {
                
                    if ($row["device_uid"] == $device_uid) {
                        // log the student
                        $sql = "INSERT INTO users_logs (student_id, fingerprint_id, device_uid, course_id, checkindate, timein) VALUES (? ,?, ?, ?, ?, ?)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_login1";
                            exit();
                        }
                        else{
                            $timeout = "00:00:00";
                            mysqli_stmt_bind_param($result, "sisiss", $row["studentID"], $fingerprint_id, $device_uid, $courseId, $d, $t);
                            mysqli_stmt_execute($result);

                            echo $row["studentID"];
                            exit();
                        }

                    } else {
                        echo "This student is not assigned in this device.";
                    }

                } else {
                    echo "No student found";
                }
           
            }
        } else {
            echo "No course found with course code!";
        }
    }



    
}


if (isset($_GET['student_id'])) {

    $student_id = $_GET['student_id'];


    $sql = "SELECT fingerprint_id FROM `users` WHERE studentID='$student_id'";
    // $sql = "SELECT * FROM `courses` WHERE courses.courseName LIKE 'EEE-121%';";

    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        header("location: login.php?error=sqlerror");
          exit();
    }
    else{
        // mysqli_stmt_bind_param($result, "s", $login_password_hash);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);

        if ($row = mysqli_fetch_assoc($resultl)) {
            echo $row["fingerprint_id"];
        } else {
            echo 0;
        }
    }
}
?>