$(document).ready(function () {
  //Add Device
  $(document).on("click", "#dev_add", function () {
    var dev_name = $("#dev_name").val();
    var dev_dep = $("#dev_dep").val();
    var dev_uid = $("#dev_uid").val();

    $.ajax({
      url: "dev_config.php",
      type: "POST",
      data: {
        dev_add: 1,
        dev_name: dev_name,
        dev_dep: dev_dep,
        dev_uid: dev_uid,
      },
      success: function (response) {
        console.log(response);
        $("#dev_name").val("");
        $("#dev_dep").val("");
        $("#dev_uid").val("");

        if (response == 1) {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(
            '<p class="alert alert-success">A new device has been added successfully</p>'
          );
          $("#new-device").modal("hide");
          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
        } else {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(response);

          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
        }

        $.ajax({
          url: "dev_up.php",
          type: "POST",
          data: {
            dev_up: 1,
          },
        }).done(function (data) {
          $("#devices").html(data);
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

  //Update Device
  $(document).on("click", "#dev_update", function () {
    var dev_old_uid = $("#dev_old_uid").val();
    var dev_old_uid_conf = $("#dev_old_uid_conf").val();
    if (!dev_old_uid) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please input Device Unique ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (!dev_old_uid_conf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please input Confirm Device Unique ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (dev_old_uid !== dev_old_uid_conf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Device Unique ID and Confirm Device Unique ID not matched.</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    }

    var dev_name = $("#update_dev_name").val();
    var dev_dep = $("#update_dev_dep").val();
    var dev_uid = $("#update_dev_uid").val();

    $.ajax({
      url: "dev_config.php",
      type: "POST",
      data: {
        dev_update: 1,
        dev_old_uid: dev_old_uid,
        dev_name: dev_name,
        dev_dep: dev_dep,
        dev_uid: dev_uid,
      },
      success: function (response) {
        $("#dev_old_uid").val("");
        $("#dev_old_uid_conf").val("");
        $("#update_dev_name").val("");
        $("#update_dev_dep").val("");
        $("#update_dev_uid").val("");

        if (response == 1) {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(
            '<p class="alert alert-success">Device info has been updated successfully</p>'
          );
          $("#new-device").modal("hide");
          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
        } else {
          $(".alert_dev").fadeIn(500);

          $(".alert_dev").html(`<p class="alert alert-danger">${response}</p>`);

          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
        }

        $.ajax({
          url: "dev_up.php",
          type: "POST",
          data: {
            dev_up: 1,
          },
        }).done(function (data) {
          $("#devices").html(data);
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

  //Delete Device
  $(document).on("click", "#dev_delete", function () {
    var del_dev_uid = $("#del_dev_uid").val();
    var del_dev_uid_conf = $("#del_dev_uid_conf").val();

    if (!del_dev_uid) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please input Device Unique ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (!del_dev_uid_conf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Please input Confirm Device Unique ID!</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    } else if (del_dev_uid !== del_dev_uid_conf) {
      $(".alert_dev").fadeIn(500);
      $(".alert_dev").html(
        '<p class="alert alert-danger">Device Unique ID and Confirm Device Unique ID not matched.</p>'
      );

      setTimeout(function () {
        $(".alert_dev").fadeOut(500);
      }, 2000);

      return;
    }

    // AJAX Request
    $.ajax({
      url: "dev_config.php",
      type: "POST",
      data: {
        dev_del: 1,
        dev_uid: del_dev_uid,
      },
      success: function (response) {
        console.log("response----->> delete: ", response);
        if (response == 1) {
          $("#del_dev_uid").val("");
          $("#del_dev_uid_conf").val("");

          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(
            '<p class="alert alert-success">The device deleted successfully</p>'
          );

          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
          $.ajax({
            url: "dev_up.php",
            type: "POST",
            data: {
              dev_up: 1,
            },
          }).done(function (data) {
            $("#devices").html(data);
          });
        } else if (response == 0) {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(
            '<p class="alert alert-danger">This Device Unique ID not exist.</p>'
          );

          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
        } else {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(response);

          setTimeout(function () {
            $(".alert_dev").fadeOut(500);
          }, 2000);
        }
      },
    });
  });
});
