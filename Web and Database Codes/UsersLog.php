<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Users Logs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="icons/b_logo.png">
  <link rel="stylesheet" type="text/css" href="css/main.css" />

  <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
  <script src="js/user_log.js"></script>
  <script>
    $(window).on("load resize ", function() {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({
        'padding-right': scrollWidth
      });
    }).resize();

    $(document).ready(function() {
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
          'select_date': 1,
        }
      }).done(function(data) {
        $('#userslog').html(data);
      });
    });

    $(document).ready(function() {
      setInterval(function() {
        $.ajax({
          url: "user_log_up.php",
          type: 'POST',
          data: {
            'select_date': 0,
          }
        }).done(function(data) {
          $('#userslog').html(data);
        });
      }, 5000);
    });
  </script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main class="page-layout">
    <section>
      <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" style="font-weight: bold;"><i class="fa fa-bar-chart"></i> Attendance Log</a>
        </div>
      </nav>
    </section>

    <!-- export attendance form   -->
    <section class="slideInRight animated" style=" border:1px solid #001877 !important; border-radius:5px; background-color:#ebebeb; padding:10px;">
      <form>
        <div class="row mb-3">
          <div class="col">
            <label for="filterProgram" class="form-label">Program Name</label>
            <select class="form-select" id="filterProgram" aria-label="select-filterProgram">
              <option selected disabled value="">Select Program</option>
              <option value="1">BSc. in EEE</option>
              <option value="2">BSc. in CSE</option>
              <option value="3">BSc. in SE</option>
              <option value="4">Business</option>
              <option value="5">Economics</option>
              <option value="6">English</option>
              <option value="7">LLB</option>
            </select>
          </div>

          <div class="col-5">
            <label for="filterCourse" class="form-label">Course Name</label>
            <select class="form-select" id="filterCourse" aria-label="select-filterCourse">
              <option selected disabled value="">Select Course</option>
              <option value="1">example2</option>
              <option value="2">example2</option>
              <!-- need program oriented course list -->
            </select>
          </div>

          <div class="col">
            <label for="filterTerm" class="form-label">Term</label>
            <select class="form-select" id="filterTerm" aria-label="select-filterTerm">
              <option selected disabled value="">Select Term</option>
              <option value="1">Spring</option>
              <option value="2">Summer</option>
              <option value="3">Fall</option>
            </select>
          </div>

          <div class="col">
            <label for="filterYear" class="form-label">Year</label>
            <input type="number" min="2021" max="2099" class="form-control" id="filterYear" placeholder="Enter Year" required>
          </div>
        </div>

        <!-- second row---------------------- -->
        <div class="row">
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
          <div class="col-2 align-self-end d-grid">
            <button class="btn btn-outline-secondary" type="submit">Export Attendance</button>
          </div>
        </div>
      </form>
    </section>

    <!--Student attendance table-->
    <section>
      <div class="slideInDown animated">
        <div id="userslog">Loading...</div>
      </div>
    </section>
  </main>
</body>

</html>