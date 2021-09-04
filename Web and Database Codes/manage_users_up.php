<?php
session_start();
?>

<table style="font: 18px; text-align:center;" class="table align-middle table-hover">
  <thead class="table-primary">
    <tr>

      <th style="width: 5%;">S/N</th>
      <th style="width: 30%;">Student Name</th>
      <th style="width: 13%;">Student ID</th>
      <th style="width: 12%;">Department</th>
      <th style="width: 8%;">Batch</th>
      <th style="width: 8%;">Section</th>
      <th style="width: 16%;">Fingerprint ID</th>
      <th style="width: 8%;">Device ID</th>
    </tr>
  </thead>
  <tbody class="table-secondary">

    <?php
    //Connect to database
    require 'connectDB.php';

    $sql = "SELECT * FROM users WHERE del_fingerid=0 ORDER BY id DESC";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo '<p class="error">SQL Error</p>';
    } else {
      mysqli_stmt_execute($result);
      $resultl = mysqli_stmt_get_result($result);
      if (mysqli_num_rows($resultl) > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($resultl)) {
    ?>
          <tr>
            <td><?php echo $index + 1 ?></td>
            <td><?php echo $row['studentName']; ?></td>
            <td><?php echo $row['studentID']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['batch']; ?></td>
            <td><?php echo $row['section']; ?></td>
            <td><?php echo $row['fingerprint_id']; ?></td>
            <td><?php echo $row['device_uid']; ?></td>
          </tr>
    <?php
          $index++;
        }
      }
    }
    ?>
  </tbody>
</table>