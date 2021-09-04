<?php
session_start();
require('connectDB.php');

if (isset($_POST['dev_add'])) {

    $dev_name = $_POST['dev_name'];
    $dev_dep = $_POST['dev_dep'];
    $dev_uid = $_POST['dev_uid'];

    if (empty($dev_name)) {
        echo '<p class="alert alert-danger">Please, Set the device name!!</p>';
        http_response_code(400);
    } elseif (empty($dev_dep)) {
        echo '<p class="alert alert-danger">Please, Set the device department!!</p>';
        http_response_code(400);
    } elseif (empty($dev_uid)) {
        echo '<p class="alert alert-danger">Please, Set the device unique id!!</p>';
        http_response_code(400);
    } else {

        if ($result = $conn->query("SELECT device_uid FROM devices WHERE device_uid='$dev_uid'")) {

            /* determine number of rows result set */
            $row_cnt = $result->num_rows;

            if ($row_cnt) {
                // already device_uid exists
                echo "Device Unique ID already exists.";
                http_response_code(400);
            } else {
                // go ahead...for add new device
                $sql = "INSERT INTO devices (device_name, device_dep, device_uid, device_date) VALUES(?, ?, ?, CURDATE())";
                $result = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo '<p class="alert alert-danger">SQL Error</p>';
                    http_response_code(400);
                } else {
                    mysqli_stmt_bind_param($result, "sss", $dev_name, $dev_dep, $dev_uid);
                    mysqli_stmt_execute($result);
                    echo 1;
                }
                mysqli_stmt_close($result);
                mysqli_close($conn);
            }
        }
    }
} else if (isset($_POST['dev_update'])) {

    $dev_old_uid = $_POST['dev_old_uid'];
    $dev_name = $_POST['dev_name'];
    $dev_dep = $_POST['dev_dep'];
    $dev_uid = $_POST['dev_uid'];


    if (empty($dev_old_uid)) {
        echo '<p class="alert alert-danger">Please, Set the Old Device Unique ID!!</p>';
        http_response_code(400);
    }
    if (empty($dev_name)) {
        echo '<p class="alert alert-danger">Please, Set the device name!!</p>';
        http_response_code(400);
    } elseif (empty($dev_dep)) {
        echo '<p class="alert alert-danger">Please, Set the device department!!</p>';
        http_response_code(400);
    } elseif (empty($dev_uid)) {
        echo '<p class="alert alert-danger">Please, Set the device unique id!!</p>';
        http_response_code(400);
    } else {

        $foundDevice = false;
        if ($result = $conn->query("SELECT device_uid FROM devices WHERE device_uid='$dev_old_uid'")) {

            /* determine number of rows result set */
            $row_cnt = $result->num_rows;

            if ($row_cnt) {
                // found device; go ahead for update
                $foundDevice = true;
            } else {
                echo "Device not found with the ID: " . $dev_old_uid;
                http_response_code(400);
            }
        }

        /* close result set */
        $result->close();

        if ($foundDevice) {

            if ($dev_uid == $dev_old_uid) {
                $sql = "UPDATE devices SET device_name=?, device_dep=? WHERE device_uid=?";

                $result = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo '<p class="alert alert-danger">SQL Error</p>';
                } else {
                    mysqli_stmt_bind_param($result, "sss", $dev_name, $dev_dep, $dev_old_uid);
                    mysqli_stmt_execute($result);
                    echo 1;
                }
                mysqli_stmt_close($result);
                mysqli_close($conn);
            } else if ($result1 = $conn->query("SELECT device_uid FROM devices WHERE device_uid='$dev_uid'")) {

                /* determine number of rows result set */
                $row_cnt = $result1->num_rows;

                if ($row_cnt) {
                    echo "New Device Unique ID \"" .$dev_uid."\" already assign to another device.";
                    http_response_code(400);
                } else {
                    $sql = "UPDATE devices SET device_name=?, device_dep=?, device_uid=? WHERE device_uid=?";

                    $result = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo '<p class="alert alert-danger">SQL Error</p>';
                    } else {
                        mysqli_stmt_bind_param($result, "ssss", $dev_name, $dev_dep, $dev_uid, $dev_old_uid);
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
    }
} elseif (isset($_POST['dev_del'])) {

    $dev_uid = $_POST['dev_uid'];


    if ($result = $conn->query("SELECT device_uid FROM devices WHERE device_uid='$dev_uid'")) {

        /* determine number of rows result set */
        $row_cnt = $result->num_rows;

        if ($row_cnt) {
            $sql = "DELETE FROM devices WHERE device_uid=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo '<p class="alert alert-danger">SQL Error</p>';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $dev_uid);
                mysqli_stmt_execute($stmt);
                echo 1;
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        } else {
            echo 0;
        }

        /* close result set */
        $result->close();
    }
} else {
    header("location: index.php");
    exit();
}
//*********************************************************************************
