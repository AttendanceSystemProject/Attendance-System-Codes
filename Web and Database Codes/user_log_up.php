<?php
session_start();
?>
<div class="table-responsive" style="max-height: 500px;">
  <table style="font: 18px; text-align:center;" class="table align-middle table-hover">
    <thead class="table-primary">
      <tr>
        <th style="width: 10%;">S/N</th>
        <th style="width: 40%;">Student Name</th>
        <th style="width: 15%;">Student ID</th>
        <th style="width: 20%;">Course</th>
        <th style="width: 15%;">Action</th>
      </tr>
    </thead>
    <tbody class="table-secondary">
      <?php

      //Connect to database
      require 'connectDB.php';
      $searchQuery = " ";
      $Start_date = " ";
      $End_date = " ";
      $Start_time = " ";
      $End_time = " ";
      $Finger_sel = " ";

        //Fingerprint filter
        if ($_POST['fing_sel'] != 0) {
          $Finger_sel = $_POST['fing_sel'];
          $_SESSION['searchQuery'] .= " AND fingerprint_id='" . $Finger_sel . "'";
        }
        //Department filter
        if ($_POST['dev_id'] != 0) {
          $dev_id = $_POST['dev_id'];
          $sql = "SELECT device_uid FROM devices WHERE id=?";
          $result = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error";
            exit();
          } else {
            mysqli_stmt_bind_param($result, "i", $dev_id);
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
              $dev_uid = $row['device_uid'];
            }
          }
          $_SESSION['searchQuery'] .= " AND device_uid='" . $dev_uid . "'";
        }
      }

      if ($_POST['select_date'] == 1) {
        $Start_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
      }
      // echo $_SESSION['searchQuery'];
      $sql = "SELECT users_logs.id, users.studentName, users.studentID, courses.courseName 
              FROM users_logs 
              JOIN users ON users_logs.student_id=users.studentID 
              JOIN courses ON users_logs.course_id=courses.id 
              WHERE " . $_SESSION['searchQuery'] . " ORDER BY id DESC";
    
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
      } else {
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if (mysqli_num_rows($resultl) > 0) {
          $index = 0;
          while ($row = mysqli_fetch_assoc($resultl)) {
            $index++;
      ?>  
            <tr>
              <td><?php echo $index; ?></td>
              <td><?php echo $row['studentName']; ?></td>
              <td><?php echo $row['studentID']; ?></td>
              <td><?php echo $row['courseName']; ?></td>
              <td><button class="btn btn-sm btn-outline-secondary" type="button">Export Attendance</button></td>
            </tr>
      <?php
          }
        }
      }
      // echo $sql;
      ?>
    </tbody>
  </table>
</div>