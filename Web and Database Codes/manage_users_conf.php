<?php
//Connect to database
require 'connectDB.php';

//Add Student
if (isset($_POST['add_student'])) {

    $studentID = $_POST['studentID'];
    $studentName = $_POST['studentName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $department = $_POST['department'];
    $batch = $_POST['batch'];
    $section = $_POST['section'];

    $device_uid = $_POST['device_uid'];
    $fingerprint_id = $_POST['fingerprint_id'];



    if (empty($studentName)) {
        echo "Enter the Student Name!";
        http_response_code(400);
        exit();
    }

    if (empty($email)) {
        echo "Enter the Student email address!";
        http_response_code(400);
        exit();
    }

    if (empty($phone)) {
        echo "Enter the Student Phone number!";
        http_response_code(400);
        exit();
    }

    if (empty($department)) {
        echo "Select the student department!";
        http_response_code(400);
        exit();
    }

    if (empty($batch)) {
        echo "Enter the Student batch!";
        http_response_code(400);
        exit();
    }


    if (empty($device_uid)) {
        echo "Select the Device!";
        http_response_code(400);
        exit();
    }

    if (empty($fingerprint_id)) {
        echo "Enter the student fingerprint ID!";
        http_response_code(400);
        exit();
    } else {
        if ($fingerprint_id > 0 && $fingerprint_id < 128) {
            //  OR phone=$phone
            if ($result = $conn->query("SELECT studentID, email, phone FROM users WHERE studentID=$studentID")) {

                /* determine number of rows result set */
                $row_cnt = $result->num_rows;

                if ($row_cnt) {
                    echo "Student ID already exists.";
                    http_response_code(400);
                } else {
                    $sql = "SELECT * FROM devices WHERE id=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($result, "i", $dev_uid);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if ($row = mysqli_fetch_assoc($resultl)) {
                            $dev_name = $row['device_dep'];
                            $dev_uid = $row['device_uid'];
                        }
                    }
                    $sql = "SELECT fingerprint_id FROM users WHERE fingerprint_id=? AND device_uid=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($result, "is", $fingerprint_id, $dev_uid);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {

                            $sql = "SELECT add_fingerid FROM users WHERE add_fingerid=1 AND device_uid=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($result, "s", $dev_uid);
                                mysqli_stmt_execute($result);
                                $resultl = mysqli_stmt_get_result($result);
                                if (!$row = mysqli_fetch_assoc($resultl)) {
                                    //check if there any selected user
                                    $sql = "UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1 AND device_uid=?";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error";
                                        exit();
                                    } else {
                                        mysqli_stmt_bind_param($result, "s", $dev_uid);
                                        mysqli_stmt_execute($result);
                                        // $sql = "INSERT INTO users ( fingerprint_id, fingerprint_select, user_date, device_uid, device_dep, del_fingerid , add_fingerid) VALUES (?, 1, CURDATE(), ?, ?, 0, 1)";
                                        $sql = "INSERT INTO users ( studentID, studentName, email, phone, department, batch , section, device_uid, fingerprint_id, user_date, del_fingerid , add_fingerid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), 0, 1)";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error";
                                            exit();
                                        } else {
                                            mysqli_stmt_bind_param($result, "ssssssssi", $studentID, $studentName, $email, $phone, $department, $batch, $section, $device_uid, $fingerprint_id);
                                            mysqli_stmt_execute($result);
                                            echo 1;
                                            exit();
                                        }
                                    }
                                } else {
                                    echo "You can't add more than one ID each time";
                                }
                            }
                        } else {
                            echo "This ID is already exist! Delete it from the scanner";
                            exit();
                        }
                    }
                }

                /* close result set */
                $result->close();
            }
        } else {
            echo "The Fingerprint ID must be between 1 & 127";
            exit();
        }
    }
}
//Update Student
if (isset($_POST['update_student'])) {

    $studentOldID = $_POST['studentOldID'];
    $studentID = $_POST['studentID'];
    $studentName = $_POST['studentName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $department = $_POST['department'];
    $batch = $_POST['batch'];
    $section = $_POST['section'];

    $device_uid = $_POST['device_uid'];
    $fingerprint_id = $_POST['fingerprint_id'];



    if (empty($studentName)) {
        echo "Enter the Student Name!";
        http_response_code(400);
        exit();
    }

    if (empty($studentID)) {
        echo "Enter the Student ID!";
        http_response_code(400);
        exit();
    }

    if (empty($email)) {
        echo "Enter the Student email address!";
        http_response_code(400);
        exit();
    }

    if (empty($phone)) {
        echo "Enter the Student Phone number!";
        http_response_code(400);
        exit();
    }

    if (empty($department)) {
        echo "Select the student department!";
        http_response_code(400);
        exit();
    }

    if (empty($batch)) {
        echo "Enter the Student batch!";
        http_response_code(400);
        exit();
    }

    if (empty($device_uid)) {
        echo "Select the Device!";
        http_response_code(400);
        exit();
    }

    if (empty($fingerprint_id)) {
        echo "Enter the student fingerprint ID!";
        http_response_code(400);
        exit();
    } else {
        if ($fingerprint_id > 0 && $fingerprint_id < 128) {

            if ($result1 = $conn->query("SELECT studentID FROM users WHERE studentID='$studentOldID'")) {

                /* determine number of rows result set */
                $row_cnt = $result1->num_rows;

                if ($row_cnt) {
                    $sql = "UPDATE users SET studentID=?, studentName=?, email=?, phone=?, department=?, batch=? , section=?, device_uid=?, fingerprint_id=? WHERE studentID=?";

                    $result = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo '<p class="alert alert-danger">SQL Error</p>';
                    } else {
                        mysqli_stmt_bind_param($result, "ssssssssis", $studentID, $studentName, $email, $phone, $department, $batch, $section, $device_uid, $fingerprint_id, $studentOldID);
                        mysqli_stmt_execute($result);
                        echo 1;
                    }
                    mysqli_stmt_close($result);
                    mysqli_close($conn);
                } else {
                    echo "Student not exists.";
                    http_response_code(400);
                }
            }
            /* close result set */
            $result1->close();
        } else {
            echo "The Fingerprint ID must be between 1 & 127";
            exit();
        }
    }
}

//Add user
if (isset($_POST['Add'])) {

    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    // $Email= $_POST['email'];
    $dev_uid = $_POST['dev_uid'];
    $finger_id = $_POST['finger_id'];

}
// Update an existance user 
if (isset($_POST['Update'])) {

    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    // $Email= $_POST['email'];
    $dev_uid = $_POST['dev_uid'];
    $finger_id = $_POST['finger_id'];


}
// select fingerprint 
if (isset($_GET['select'])) {

    $finger_id = $_GET['finger_id'];
    $dev_uid = $_GET['dev_uid'];

    $sql = "UPDATE users SET fingerprint_select=0 WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    } else {
        mysqli_stmt_bind_param($result, "s", $dev_uid);
        mysqli_stmt_execute($result);

        $sql = "UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=? AND device_uid=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_select_Fingerprint";
            exit();
        } else {
            mysqli_stmt_bind_param($result, "is", $finger_id, $dev_uid);
            mysqli_stmt_execute($result);

            // echo "User Fingerprint selected";
            // exit();
            header('Content-Type: application/json');
            $data = array();
            $sqls = "SELECT * FROM users WHERE fingerprint_id=? AND device_uid=?";
            $results = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($results, $sqls)) {
                echo "SQL_Error";
                exit();
            } else {
                mysqli_stmt_bind_param($results, "is", $finger_id, $dev_uid);
                mysqli_stmt_execute($results);
                $resultls = mysqli_stmt_get_result($results);
                if ($rows = mysqli_fetch_assoc($resultls)) {
                    foreach ($resultls as $rows) {
                        $data[] = $rows;
                    }
                }
            }
            $result->close();
            $conn->close();
            print json_encode($data);
        }
    }
}
// delete user 
if (isset($_POST['delete'])) {
    $studentID = $_POST['studentID'];

    if (empty($studentID)) {
        echo "Please enter student ID!";
        exit();
    } else {
        if ($result1 = $conn->query("SELECT studentID FROM users WHERE studentID='$studentID'")) {

            /* determine number of rows result set */
            $row_cnt = $result1->num_rows;

            if ($row_cnt) {
                // $sql = "UPDATE users SET del_fingerid=1 WHERE fingerprint_id=? AND device_uid=?";
                $sql = "DELETE FROM users WHERE studentID=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_delete";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "s", $studentID);
                    mysqli_stmt_execute($result);
                    echo 1;
                    exit();
                }
            } else {
                echo "Student not exists.";
                http_response_code(400);
            }
        }
        /* close result set */
        $result1->close();
    }
}
