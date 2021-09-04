$(document).ready(function () {
  console.log("manage student loaded");

  // Add student
  $(document).on("click", "#add_student", function () {
    console.log("add_student===>>");
    var studentID = $("#studentID").val();
    var studentName = $("#studentName").val();
    var email = $("#email").val();
    var phone = $("#phone").val();

    var department = $("#department option:selected").val();
    var batch = $("#batch").val();
    var section = $("#section").val();

    var device_uid = $("#device_uid option:selected").val();
    var fingerprint_id = $("#fingerprint_id").val();

    $.ajax({
      url: "manage_users_conf.php",
      type: "POST",
      data: {
        add_student: 1,
        studentID,
        studentName,
        email,
        phone,
        department,
        batch,
        section,
        device_uid,
        fingerprint_id,
      },
      success: function (response) {
        if (response == "1") {
          $("#studentID").val("");
          $("#studentName").val("");
          $("#email").val("");
          $("#phone").val("");

          $("#department").val("");
          $("#batch").val("");
          $("#section").val("");

          $("#device_uid").val("");
          $("#fingerprint_id").val("");

          $(".alert_dev").fadeIn(500);
          
          $(".alert_dev").html(
            `<p class="alert alert-success">Student Profile Added Successfully.</p>`
          );
          
        } else {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(
            `<p class="alert alert-danger">${response}</p>`
          );
        }

        setTimeout(function () {
          $(".alert_dev").fadeOut(500);
        }, 6000);

        $.ajax({
          url: "manage_users_up.php",
        }).done(function (data) {
          $("#manage_users").html(data);
        });
      },
      error: function (e) {
        console.log(e.responseText);
        $(".alert_dev").fadeIn(500);
        $(".alert_dev").html(
          `<p class="alert alert-danger">${e.responseText}</p>`
        );

        setTimeout(function () {
          $(".alert_dev").fadeOut(500);
        }, 2000);
      },
    });
  });
  // Update student
  $(document).on("click", "#update_student", function () {
    console.log("update_student===>>");
    var studentOldID = $("#studentOldID").val();
    var studentOldIDConf = $("#studentOldIDConf").val();

    if (!studentOldID) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please Input Student ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (!studentOldIDConf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please Input Confirm Student ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (studentOldID !== studentOldIDConf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Student ID & Confirm Student ID Do Not Match!.</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    }

    var studentID = $("#updateStudentID").val();
    var studentName = $("#updateStudentName").val();
    var email = $("#updateStudentEmail").val();
    var phone = $("#updateStudentPhone").val();

    var department = $("#studentDept option:selected").val();
    var batch = $("#studentBatch").val();
    var section = $("#studentSection").val();

    var device_uid = $("#update_device_uid option:selected").val();
    var fingerprint_id = $("#updateStudentFingerID").val();

    $.ajax({
      url: "manage_users_conf.php",
      type: "POST",
      data: {
        update_student: 1,
        studentOldID,
        studentID,
        studentName,
        email,
        phone,
        department,
        batch,
        section,
        device_uid,
        fingerprint_id,
      },
      success: function (response) {
        if (response == "1") {
          $("#studentOldID").val("");
          $("#studentOldIDConf").val("");
          $("#updateStudentID").val("");
          $("#updateStudentName").val("");
          $("#updateStudentEmail").val("");
          $("#updateStudentPhone").val("");

          $("#studentDept").val("");
          $("#studentBatch").val("");
          $("#studentSection").val("");

          $("#update_device_uid").val("");
          $("#updateStudentFingerID").val("");

          $(".alert_dev").fadeIn(500);
          
          $(".alert_dev").html(
            `<p class="alert alert-success">Student Porfile Updated Successfully.</p>`
          );
        } else {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").text(response);
        }

        setTimeout(function () {
          $(".alert_dev").fadeOut(500);
        }, 6000);

        $.ajax({
          url: "manage_users_up.php",
        }).done(function (data) {
          $("#manage_users").html(data);
        });
      },
      error: function (e) {
        console.log(e.responseText);
        $(".alert_dev").fadeIn(500);
        $(".alert_dev").html(
          `<p class="alert alert-danger">${e.responseText}</p>`
        );

        setTimeout(function () {
          $(".alert_dev").fadeOut(500);
        }, 2000);
      },
    });
  });

  // delete student
  $(document).on("click", "#delete_student", function () {
    var deleteStudentID = $("#deleteStudentID").val();
    var deleteStudentIDConf = $("#deleteStudentIDConf").val();

    if (!deleteStudentID) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please Input Student ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (!deleteStudentIDConf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please Input Confirm Student ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (deleteStudentID !== deleteStudentIDConf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Student ID & Confirm Student ID Do Not match!.</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    }

    // bootbox.confirm(
    //   "Do you really want to delete this User?",
    //   function (result) {
    //     if (result) {
         
    //     }
    //   }
    // );

    $.ajax({
      url: "manage_users_conf.php",
      type: "POST",
      data: {
        delete: 1,
        studentID: deleteStudentID,
        // finger_id: finger_id,
      },
      success: function (response) {
        if (response == "1") {
          $("#deleteStudentID").val("");
          $("#deleteStudentIDConf").val("");
          
          $(".alert_dev").fadeIn(500);
          
          $(".alert_dev").html(
            `<p class="alert alert-success">Student Profile Deleted Successfully!</p>`
          );
        } else {
          $(".alert_dev").fadeIn(500);
      
          $(".alert_dev").html(
            `<p class="alert alert-danger">${response}</p>`
          );
        }

        setTimeout(function () {
          $(".alert_dev").fadeOut(500);
        }, 5000);

        $.ajax({
          url: "manage_users_up.php",
        }).done(function (data) {
          $("#manage_users").html(data);
        });
      },
      error: function (e) {
        console.log(e.responseText);
        $(".alert_dev").fadeIn(500);
        $(".alert_dev").html(
          `<p class="alert alert-danger">${e.responseText}</p>`
        );

        setTimeout(function () {
          $(".alert_dev").fadeOut(500);
        }, 2000);
      }
    });
  });

});
