<?php
session_start();
require('connectDB.php');

if (isset($_POST['get_admin_info'])) {
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

        echo 'Name: ' . $row['admin_name'] . ' <br> Designation: ' . $row['designation'] . ' <br> Dept.: ' . $row['department'] . ' <br> Email: ' . $row['admin_email'] . '';
    }
    exit();
} else if (isset($_POST['update_admin_info'])) {

    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];

    if (empty($admin_name)) {
        echo 'Please enter admin name!!';
        http_response_code(400);
        exit();
    } elseif (empty($admin_email)) {
        echo 'Please enter admin email!!';
        http_response_code(400);
        exit();
    } elseif (empty($department)) {
        echo 'Please, Select department!!';
        http_response_code(400);
        exit();
    } elseif (empty($designation)) {
        echo 'Please, Select designation!!';
        http_response_code(400);
        exit();
    } else {

        $admin_current_email = $_SESSION['Admin-email'];

        if (empty($admin_current_email)) {
            echo 'Something went wrong!!';
            http_response_code(400);
            exit();
        } else {
            if ($admin_current_email != $admin_email) {
                // check admin new email exist
                if ($result = $conn->query("SELECT `id` FROM `admin` WHERE `admin_email`='$admin_email'")) {

                    /* determine number of rows result set */
                    $row_cnt = $result->num_rows;
    
                    if ($row_cnt) {
                        // found admin
                        $isNewEmailExist = true;
                        echo "Another admin already exist  with this email: " . $admin_email;
                        http_response_code(400);
                        exit();
                    }
                }
                /* close result set */
                $result->close();
            }

            $sql = "UPDATE admin SET admin_name=?, admin_email=?, department=?, designation=? WHERE admin_email=?";

            $result = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($result, $sql)) {
                echo '<p class="alert alert-danger">SQL Error</p>';
            } else {
                mysqli_stmt_bind_param($result, "sssss", $admin_name, $admin_email, $department, $designation, $admin_current_email);
                mysqli_stmt_execute($result);
                session_unset();
                $_SESSION['Admin-name'] = $admin_name;
                $_SESSION['Admin-email'] = $admin_email;
                echo 1;
            }
            mysqli_stmt_close($result);
            mysqli_close($conn);
            exit();
        }
    }
} 

else if (isset($_POST['update_admin_password'])) {
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $admin_email = $_SESSION['Admin-email'];

    if (empty($current_pass)) {
        echo 'Please current password!!';
        http_response_code(400);
        exit();
    } elseif (empty($new_pass)) {
        echo 'Please enter new password!!';
        http_response_code(400);
        exit();
    } else if (empty($admin_email)) {
        echo 'Something went wrong!!';
        http_response_code(400);
        exit();
    } else {

        $sql = "SELECT * FROM admin WHERE admin_email=?";
		$result = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($result, $sql)) {
			header("location: login.php?error=sqlerror");
  			exit();
		}
        else{
			mysqli_stmt_bind_param($result, "s", $admin_email);
			mysqli_stmt_execute($result);
			$resultl = mysqli_stmt_get_result($result);

			if ($row = mysqli_fetch_assoc($resultl)) {
				$pwdCheck = password_verify($current_pass, $row['admin_pwd']);
				if ($pwdCheck == false) {
					echo 'Wrong Current Password!!';
                    http_response_code(400);
  					exit();
				}
				else if ($pwdCheck == true) {
                    $sql = "UPDATE admin SET admin_pwd=? WHERE admin_email=?";

                    $result = mysqli_stmt_init($conn);
        
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo '<p class="alert alert-danger">SQL Error</p>';
                    } else {
                        $options = [
                            'cost' => 12,
                        ];
                        $new_pass_hash = password_hash($new_pass, PASSWORD_BCRYPT, $options);
                        mysqli_stmt_bind_param($result, "ss", $new_pass_hash, $admin_email);
                        mysqli_stmt_execute($result);
                        echo 1;
                    }
                    mysqli_stmt_close($result);
                    mysqli_close($conn);
                    exit();
				}
			}
			else{
				echo 'Something went wrong! Please login again and try.';
  				exit();
			}
		}
        
        mysqli_stmt_close($result);    
        mysqli_close($conn);

    }

} else if (isset($_POST['course_add'])) {
    $programName = $_POST['programName'];
    $courseName = $_POST['courseName'];
    $term = $_POST['term'];
    $courseYear = $_POST['year'];

    if (empty($programName)) {
        echo 'Please, Select a program name!!';
        http_response_code(400);
        exit();
    } elseif (empty($courseName)) {
        echo 'Please, Select a course!!';
        http_response_code(400);
        exit();
    } elseif (empty($term)) {
        echo 'Please, Select a term!!';
        http_response_code(400);
        exit();
    } elseif (empty($courseYear)) {
        echo 'Please, Enter the year!!';
        http_response_code(400);
        exit();
    } else {

        if ($result1 = $conn->query("SELECT id FROM courses WHERE programName='$programName' AND courseName='$courseName' AND term='$term' AND courseYear='$courseYear' ")) {

            /* determine number of rows result set */
            $row_cnt = $result1->num_rows;

            if ($row_cnt) {
                // already device_uid exists
                echo "Course already exists.";
                http_response_code(400);
            } else {
                // go ahead...for add new device
                $sql = "INSERT INTO courses (programName, courseName, term, courseYear, courseDate) VALUES(?, ?, ?, ?, CURDATE())";
                $result = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo '<p class="alert alert-danger">SQL Error</p>';
                    http_response_code(400);
                } else {
                    mysqli_stmt_bind_param($result, "ssss", $programName, $courseName, $term, $courseYear);
                    mysqli_stmt_execute($result);
                    echo 1;
                }
                mysqli_stmt_close($result);
                mysqli_close($conn);
            }
            /* close result set */
            $result1->close();
        }
    }
} else if (isset($_POST['course_up'])) {
    $courseId = $_POST['courseId'];
    $programName = $_POST['programName'];
    $courseName = $_POST['courseName'];
    $term = $_POST['term'];
    $courseYear = $_POST['year'];

    if (empty($courseId)) {
        // course id not get from localStorage
        echo 'Something went wrong, please try again later!!';
        http_response_code(400);
    } else if (empty($programName)) {
        echo 'Please, Select a program!!';
        http_response_code(400);
    } elseif (empty($courseName)) {
        echo 'Please, Select a course!!';
        http_response_code(400);
    } elseif (empty($term)) {
        echo 'Please, Select a term!!';
        http_response_code(400);
    } elseif (empty($courseYear)) {
        echo 'Please, Enter the year!!';
        http_response_code(400);
    } else {


        $sql = "UPDATE courses SET programName=?, courseName =?, term=?, courseYear=? WHERE id=?";

        $result = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="alert alert-danger">SQL Error</p>';
        } else {
            mysqli_stmt_bind_param($result, "ssssi", $programName, $courseName, $term, $courseYear, $courseId);
            mysqli_stmt_execute($result);
            echo 1;
        }
        mysqli_stmt_close($result);
        mysqli_close($conn);
    }
} elseif (isset($_POST['course_del'])) {
    $programName = $_POST['programName'];
    $courseName = $_POST['courseName'];
    $term = $_POST['term'];
    $courseYear = $_POST['year'];

    if (empty($programName)) {
        echo 'Please, Select a program name!!';
        http_response_code(400);
    } elseif (empty($courseName)) {
        echo 'Please, Select a course!!';
        http_response_code(400);
    } elseif (empty($term)) {
        echo 'Please, Select a term!!';
        http_response_code(400);
    } elseif (empty($courseYear)) {
        echo 'Please, Enter the year!!';
        http_response_code(400);
    } else {

        if ($result1 = $conn->query("SELECT id FROM courses WHERE programName='$programName' AND courseName='$courseName' AND term='$term' AND courseYear='$courseYear' ")) {

            /* determine number of rows result set */
            $row_cnt = $result1->num_rows;
            $row = mysqli_fetch_assoc($result1);



            // go ahead...for delete
            if ($row_cnt) {
                $sql = "DELETE FROM courses WHERE id=?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo '<p class="alert alert-danger">SQL Error</p>';
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $row['id']);
                    mysqli_stmt_execute($stmt);
                    echo 1;
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                }
            } else {
                echo '<p class="alert alert-danger">Course Not Exist!</p>';
            }
            /* close result set */
            $result1->close();
        }
    }
} else if (isset($_POST['assign_student'])) {
    $courseId = $_POST['courseId'];
    $studentIds = $_POST['studentIds'];
    $assignStatus = 1;


    if (empty($courseId)) {
        echo 'Something went wrong! Course id undefined!!';
        http_response_code(400);
        exit();
    } elseif (empty($studentIds)) {
        echo 'Please select some student!!';
        http_response_code(400);
        exit();
    } else {
        $sql = "INSERT INTO course_students (studentID , courseID, assignStatus) VALUES(?, ?, ?)";
        $result = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="alert alert-danger">SQL Error</p>';
            http_response_code(400);
        } else {
            foreach ($studentIds as $row) {
                mysqli_stmt_bind_param($result, "sii", $row, $courseId, $assignStatus);
                mysqli_stmt_execute($result);
            }
            echo 1;
        }

        mysqli_stmt_close($result);
        mysqli_close($conn);
    }
} else if (isset($_POST['unassign_student'])) {
    $courseId = $_POST['courseId'];
    $studentIds = $_POST['studentIds'];
    $assignStatus = 0;


    if (empty($courseId)) {
        echo 'Something went wrong! Course id undefined!!';
        http_response_code(400);
        exit();
    } elseif (empty($studentIds)) {
        echo 'Please select some student!!';
        http_response_code(400);
        exit();
    } else {
        $sql = "DELETE FROM course_students WHERE studentID=? AND courseID=?";
        // $sql = "INSERT INTO course_students (studentID , courseID, assignStatus) VALUES(?, ?, ?)";
        $result = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="alert alert-danger">SQL Error</p>';
            http_response_code(400);
        } else {
            foreach ($studentIds as $row) {
                mysqli_stmt_bind_param($result, "si", $row, $courseId);
                mysqli_stmt_execute($result);
            }
            echo 1;
        }

        mysqli_stmt_close($result);
        mysqli_close($conn);
    }
} else {
    header("location: index.php");
    exit();
}
//*********************************************************************************