<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

  <link rel="icon" type="image/png" href="icons/b_logo.png">
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <script>
    $(window).on("load resize ", function() {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({
        'padding-right': scrollWidth
      });
    }).resize();

    $(document).on("click", ".studentDetails", function() {
      const selectedStudentId = $(this).attr("id");
      console.log("selectedStudentId===>>", selectedStudentId);

      $.ajax({
        url: "index_config.php",
        type: "POST",
        data: {
          get_student_info: 1,
          studentID: selectedStudentId
        },
      }).done(function(data) {
        $("#studentInfoTable").html(data);
      });

    });
  </script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main class="page-layout">
    <!-- top navigation bar including search bar -->
    <section>
      <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" style="font-weight: bold;"><i class="fa fa-address-book"></i> Student Profile</a>
          <form class="d-flex">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search by Student ID" aria-label="Search" required>
            <button class="btn btn-secondary btn-sm" type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </nav>
    </section>

    <!--Student List table-->
    <section>
      <div class="table-responsive slideInDown animated">
        <table style="font: 18px; text-align:center;" class="table align-middle table-hover">
          <thead class="table-primary">
            <tr>
              <th style="width: 8%;">S/N</th>
              <th style="width: 38%;">Student Name</th>
              <th style="width: 17%;">Student ID</th>
              <th style="width: 10%;">Department</th>
              <th style="width: 10%;">Batch</th>
              <th style="width: 10%;">Section</th>
              <th style="width: 7%;">Details</th>
            </tr>
          </thead>

          <tbody class="table-secondary">
            <?php
            //Connect to database
            require 'connectDB.php';

            $sql = "SELECT * FROM users ORDER BY id DESC";
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
                    <td id="<?php echo $row['studentID']; ?>" class="studentDetails" data-bs-toggle="modal" data-bs-target="#studentInfo"><i class="fa fa-info-circle"></i></td>
                  </tr>
            <?php
                  $index++;
                }
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Modal: Student Details-->
    <div class="modal fade" id="studentInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="studentInfoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentInfoLabel">Student Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="studentInfoTable">Loading...</div>
          </div>
        </div>
      </div>
    </div>

  </main>
</body>

</html>