$(document).ready(function () {
  let courses = {
    "BSc. in EEE": [
      "EEE-121 Electrical Circuits I",
      "EEE-122 Electrical Circuits I Lab",
      "EEE-123 Electrical Circuits II",
      "EEE-124 Electrical Circuits II",
      "EEE-131 Electronics I",
      "EEE-132 Electronics I Lab",
      "EEE-211 Electronics II",
      "EEE-212 Electronics II Lab",
      "EEE-213 Energy Conversion I",
      "EEE-214 Energy Conversion I Lab",
      "EEE-221 Energy Conversion II",
      "EEE-222 Energy Conversion II",
      "EEE-225 Digital Electronics",
      "EEE-226 Digital Electronics Lab",
      "EEE-227 Engineering Electromagnetics",
      "EEE-231 Continuous Signals and Linear Systems",
      "EEE-232 Continuous Signals and Linear Systems Lab",
      "EEE-233 Electrical Services Design",
      "EEE-235 Electrical Properties of Materials",
      "EEE-237 Communication Theory",
      "EEE-238 Communication Theory Lab",
      "EEE-300 Project",
      "EEE-313 Power System I",
      "EEE-314 Power System I Lab",
      "EEE-315 Microprocessor & Computer Interfacing",
      "EEE-316 Microprocessor & Computer Interfacing Lab",
      "EEE-321 Control System I",
      "EEE-322 Control System I Lab",
      "EEE-311 Digital Signal Processing I",
      "EEE-312 Digital Signal Processing I Lab",
      "EEE-335 Measurement and Instrumentation",
      "EEE-336 Measurement and Instrumentation Lab",

      "EEE-411 Power System II",
      "EEE-413 Energy Conversion III",
      "EEE-415 Power Electronics",
      "EEE-416 Power Electronics Lab",
      "EEE-417 Power Plant Engineering",
      "EEE-435 Renewable Energy Systems",
      "EEE-427 Power System Protection",
      "EEE-428 Power System Protection Lab",
      "EEE-423 High Voltage Engineering",
      "EEE-424 High Voltage Engineering Lab",
      "EEE-425 Power System Reliability",
      "EEE-431 Power System Operation and Control",
      "EEE-433 Advanced Machines",

      "ECE-411 Random Signals and Processes",
      "ECE-413 Digital Signal Processing II",
      "ECE-415 Microwave Engineering",
      "ECE-416 Microwave Engineering Lab",
      "ECE-419 Optical Fiber Communication",
      "ECE-417 Advanced Digital Communication",
      "ECE-418 Advanced Digital Communication Lab",
      "ECE-421 Cellular Mobile & Satellite Communication",
      "ECE-423 Telecommunication Engineering",
      "ECE-425 Control System II",
      "ECE-426 Control System II Lab",
      "ECE-427 RF and Microwave Engineering",
      "ECE-429 Data Communication",
      "ECE-431 Remote Sensing Technology",
      "ECE-432 Remote Sensing Technology Lab",
      "ECE-439 Wireless Communication",
      "ECE-435 Broadband Communication Networks",
      "ECE-436 Broadband Communication Networks ",
      "ECE-433 Digital Communication and Coding Techniques",

      "EEE-317 Robotics & Computer Vision",
      "EEE-318 Robotics & Computer Vision Lab",
      "EEE-331 IC Processing and Fabrication Technology",
      "EEE-333 Radio and Television Engineering",
      "EEE-334 Radio and Television Engineering Lab",
      "EEE-337 Biomedical Instrumentation",
      "EEE-338 Biomedical Instrumentation Lab",
      "EEE-419 Analog Integrated Circuits",
      "EEE-421 VLSI I",
      "EEE-422 VLSI I Lab",
      "EEE-429 Solid State Devices",
      "EEE-437 VLSI II",
      "EEE-438 VLSI II Lab",
      "EEE-439 Optoelectronics",

      "EEE 400 Final Year Internship",
      "EEE 401 Final Year Project",

      "CSE-223 Operating Systems",
      "CSE-224 Operating Systems Lab",
      "CSE-231 Database Management System",
      "CSE-232 Database Management System Lab",
      "CSE-311 Computer Networks",
      "CSE-312 Computer Networks Lab",
      "CSE-333 System Analysis, Design and Development",
      "CSE-335 Management Information System",
      "CSE-337 Object Oriented Software Development Using UML",
      "CSE-338 Object Oriented Software Development Using UM Lab",
      "CSE-415 Microprocessor System Design",
      "CSE-416 Microprocessor System Design Lab",
      "CSE-413 Real Time Computer System",
      "CSE-425 Computer Architecture",
      "CSE-435 Multimedia Communications",

      "ENG-114 English Language I",
      "ENG-115 English Language II",

      "GED-201 Bangladesh Studies",
      "BBA-115 Functional Accounting",
      "BBA-211 Business Communication",
      "GED-202 History of Emergence of Bangladesh",

      "GED-129 Functional Bangla",
      "GED-221 Principles of Economics",
      "GED-131 Introduction to Sociology",
      "GED-213 Professional Ethics",
      "GED-323 Industrial Management",
      "GED-335 Public Administration",
      "GED-337 Political Science",

      "PHY-111 Physics I",
      "PHY-112 Physics Lab",
      "PHY-124 Physics II",
      "PHY-126 Physics Lab",
      "CHE-213 Chemistry",

      "MAT-112 Differential and Integral Calculus",
      "MAT-135 Matrices, CV & Fourier analysis",
      "MAT-123 Differential Equations & Laplace transform",
      "MAT-216 Geometry & Vector Analysis",
      "STA-215 Basic Statistics & Probability",

      "CSE-121 Structured Programming",
      "CSE-122 Structured Programming Lab",
      "MAT-235 Numerical Analysis",
      "MAT-236 Numerical Analysis Lab",

      "CHE-221 Chemical Process Principles",
      "EGD-213 Engineering Drawing Lab",
      "MEG-213 Mechanical Engineering Fundamentals",
    ],
    "BSc. in CSE": ["Introduction to computer CSE-101", "Java CSE-201"],
    "BSc. in SE": ["SE 1 SE-101", "SE 2 SE-102"],
    Business: ["Business 1 Business-101", "Business 2 Business-102"],
    Economics: ["Economics 1 Economics-101", "Economics 2 Economics-102"],
    English: ["English 1 English-101", "English 2 English-102"],
    LLB: ["LLB 1 LLB-101", "LLB 2 LLB-102"],
  };

  //showing course name in add course form
  $(document).on("click", "#on_program_select", function () {
    console.log("on_program_select");

    let selectedProgram = $("#on_program_select").val();

    console.log("value: ", selectedProgram);

    if (selectedProgram) {
      const programCourses = courses[selectedProgram];
      let programCoursesHtml =
        '<select class="form-select" id="course_list" aria-label="select-course_list" data-width="100%">';
      programCoursesHtml += `<option selected disabled value="">Select Course</option>`;

      programCourses.map((course) => {
        programCoursesHtml += `<option value="${course}">${course}</option>`;
      });

      programCoursesHtml += "</select>";

      $("#course_list").html(programCoursesHtml);
    } else {
      $("#course_list").html(
        `<select class="form-select" id="course_list" aria-label="select-course_list" data-width="100%">
         <option selected disabled value="">Select Course</option></select>`
      );
    }
  });

  //showing course name in Edit Course Info form
  $(document).on("click", "#editinfo_program", function () {
    console.log("on_program_select");

    let selectedProgram = $("#editinfo_program").val();

    console.log("value: ", selectedProgram);

    if (selectedProgram) {
      const programCourses = courses[selectedProgram];
      let programCoursesHtml =
        '<select class="form-select" id="course_list" aria-label="select-course_list" data-width="100%">';
      programCoursesHtml += `<option selected disabled value="">Select Course</option>`;

      programCourses.map((course) => {
        programCoursesHtml += `<option value="${course}">${course}</option>`;
      });

      programCoursesHtml += "</select>";

      $("#editinfo_course").html(programCoursesHtml);
    } else {
      $("#editinfo_course").html(
        `<select class="form-select" id="course_list" aria-label="select-course_list" data-width="100%">
         <option selected disabled value="">Select Course</option></select>`
      );
    }
  });

  //showing course name in delete course form
  $(document).on("click", "#programDelete", function () {
    console.log("on_programDelete");

    let selectedProgram = $("#programDelete").val();

    console.log("value: ", selectedProgram);

    if (selectedProgram) {
      const programCourses = courses[selectedProgram];
      let programCoursesHtml =
        '<select class="form-select" id="courseDelete" aria-label="select-courseDelete" data-width="100%">';
      programCoursesHtml += `<option selected disabled value="">Select Course</option>`;

      programCourses.map((course) => {
        programCoursesHtml += `<option value="${course}">${course}</option>`;
      });

      programCoursesHtml += "</select>";

      $("#courseDelete").html(programCoursesHtml);
    } else {
      $("#courseDelete").html(
        `<select class="form-select" id="courseDelete" aria-label="select-courseDelete" data-width="100%"">
        <option selected disabled value="">Select Course</option>`
      );
    }
  });

  //Add course
  $(document).on("click", "#course_add", function () {
    console.log("course adding...");

    const programName = $("#on_program_select").val();
    const courseName = $("#course_list").val();
    const term = $("#term").val();
    const year = $("#year").val();

    $.ajax({
      url: "admin_panel_config.php",
      type: "POST",
      data: {
        course_add: 1,
        programName: programName,
        courseName: courseName,
        term: term,
        year: year,
      },
      success: function (response) {
        console.log(response);
        $("#on_program_select").val("");
        $("#course_list").val("");
        $("#term").val("");
        $("#year").val("");

        if (response == 1) {
          $(".alert_dev").fadeIn(500);
          $(".alert_dev").html(
            '<p class="alert alert-success">Course added successfully</p>'
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
          url: "admin_up.php",
          type: "POST",
          data: {
            course_up: 1,
          },
        }).done(function (data) {
          $("#courses").html(data);
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
});

//update Course Info
$(document).on("click", "#updateCourseInfo", function () {
  console.log("updateCourseInfo...");
  const courseId = localStorage.getItem("courseId");
  const programName = $("#editinfo_program").val();
  const courseName = $("#editinfo_course").val();
  const term = $("#editinfo_term").val();
  const year = $("#editinfo_year").val();

  $.ajax({
    url: "admin_panel_config.php",
    type: "POST",
    data: {
      course_up: 1,
      courseId: courseId,
      programName: programName,
      courseName: courseName,
      term: term,
      year: year,
    },
    success: function (response) {
      console.log("updateCourseInfo: ", response);
      $("#editinfo_program").val("");
      $("#editinfo_course").val("");
      $("#editinfo_term").val("");
      $("#editinfo_year").val("");

      if (response == 1) {
        $(".alert_edit_course_modal").fadeIn(500);
        $(".alert_edit_course_modal").html(
          '<p class="alert alert-success">Course updated successfully</p>'
        );
        $("#new-device").modal("hide");
        setTimeout(function () {
          $(".alert_edit_course_modal").fadeOut(500);
        }, 2000);
      } else {
        $(".alert_edit_course_modal").fadeIn(500);
        $(".alert_edit_course_modal").html(response);

        setTimeout(function () {
          $(".alert_edit_course_modal").fadeOut(500);
        }, 2000);
      }

      getCourseInfo();

      $.ajax({
        url: "admin_up.php",
        type: "POST",
        data: {
          course_up: 1,
        },
      }).done(function (data) {
        $("#courses").html(data);
      });
    },
    error: function (e) {
      console.log(e.responseText);
      $(".alert_edit_course_modal").fadeIn(500);
      $(".alert_edit_course_modal").html(
        `<p class="alert alert-danger">${e.responseText}</p>`
      );

      setTimeout(function () {
        $(".alert_edit_course_modal").fadeOut(500);
      }, 2000);
    },
  });
});

//Delete Course
$(document).on("click", "#course_del", function () {
  console.log("course deleting...");

  const programName = $("#programDelete").val();
  const courseName = $("#courseDelete").val();
  const term = $("#termDelete").val();
  const year = $("#yearDelete").val();

  $.ajax({
    url: "admin_panel_config.php",
    type: "POST",
    data: {
      course_del: 1,
      programName: programName,
      courseName: courseName,
      term: term,
      year: year,
    },
    success: function (response) {
      console.log(response);
      $("#programDelete").val("");
      $("#courseDelete").val("");
      $("#termDelete").val("");
      $("#yearDelete").val("");

      if (response == 1) {
        $(".alert_dev").fadeIn(500);
        $(".alert_dev").html(
          '<p class="alert alert-success">Course deleted successfully</p>'
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
        url: "admin_up.php",
        type: "POST",
        data: {
          course_up: 1,
        },
      }).done(function (data) {
        $("#courses").html(data);
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

//View Students for Assign into course
$(document).on("click", "#viewStudentsForAssign", function () {
  console.log("viewStudentsForAssign===>>");
  const StudentDept = $("#StudentDept").val();
  const StudentBatch = $("#StudentBatch").val();
  const StudentSection = $("#StudentSection").val();
  const courseId = localStorage.getItem("courseId");
  $.ajax({
    url: "admin_up.php",
    type: "POST",
    data: {
      viewStudentsForAssign: 1,
      department: StudentDept,
      batch: StudentBatch,
      section: StudentSection,
      courseId: courseId,
    },
    success: function (response) {
      console.log(response);
      // $("#StudentDept").val("");
      // $("#StudentBatch").val("");
      // $("#StudentSection").val("");

      $("#studentAssignTableData").html(response);

      // $.ajax({
      //   url: "admin_up.php",
      //   type: "POST",
      //   data: {
      //     course_up: 1,
      //   },
      // }).done(function (data) {
      //   $("#studentAssignTableData").html(response);
      // });
    },
    error: function (e) {
      console.log(e.responseText);
      $(".alert_edit_course_modal").fadeIn(500);
      $(".alert_edit_course_modal").html(
        `<p class="alert alert-danger">${e.responseText}</p>`
      );

      setTimeout(function () {
        $(".alert_edit_course_modal").fadeOut(500);
      }, 2000);
    },
  });
});

function viewStudentForAssignNetworkCall() {
  console.log("viewStudentForAssignNetworkCall===>>");
  const StudentDept = $("#StudentDept").val();
  const StudentBatch = $("#StudentBatch").val();
  const StudentSection = $("#StudentSection").val();
  const courseId = localStorage.getItem("courseId");
  $.ajax({
    url: "admin_up.php",
    type: "POST",
    data: {
      viewStudentsForAssign: 1,
      department: StudentDept,
      batch: StudentBatch,
      section: StudentSection,
      courseId: courseId,
    },
    success: function (response) {
      console.log(response);
      // $("#StudentDept").val("");
      // $("#StudentBatch").val("");
      // $("#StudentSection").val("");

      $("#studentAssignTableData").html(response);

      // $.ajax({
      //   url: "admin_up.php",
      //   type: "POST",
      //   data: {
      //     course_up: 1,
      //   },
      // }).done(function (data) {
      //   $("#studentAssignTableData").html(response);
      // });
    },
    error: function (e) {
      console.log(e.responseText);
      $(".alert_edit_course_modal").fadeIn(500);
      $(".alert_edit_course_modal").html(
        `<p class="alert alert-danger">${e.responseText}</p>`
      );

      setTimeout(function () {
        $(".alert_edit_course_modal").fadeOut(500);
      }, 2000);
    },
  });
}

function manageCourse(courseId) {
  console.log("manageCourse ==>>", courseId);
  localStorage.setItem("courseId", courseId);
}

function exportAttendance(courseId) {
  console.log("exportAttendance ==>>", courseId);
  localStorage.setItem("courseId", courseId);
}

function selectedAction(actionName) {
  console.log("selectedAction ==>>", actionName);
  localStorage.setItem("actionName", actionName);

  if (actionName === "assignStudent") {
    getCourseInfo();
    localStorage.setItem("studentIds", []);
  } else if (actionName === "viewStudent") {
    // allAssignedStudent
    getCourseInfo();
    const courseId = localStorage.getItem("courseId");
    console.log("courseId===>", courseId);
    $.ajax({
      url: "admin_up.php",
      type: "POST",
      data: {
        allAssignedStudent: 1,
        courseId: courseId,
      },
    }).done(function (data) {
      $("#allAssignedStudentTable").html(data);
    });
  } else if (actionName === "unassignStudent") {
    getCourseInfo();
    // allAssignedStudent
    console.log("unassignStudent--->>");
    localStorage.setItem("unassignStudentIds", []);
    filterStudentsForUnassign();
  } else if (actionName === "editCourseInfo") {
    console.log("editCourseInfo--->>");
    getCourseInfo();
  }
}

function getCourseInfo() {
  const courseId = localStorage.getItem("courseId");
  $.ajax({
    url: "admin_up.php",
    type: "POST",
    data: {
      get_course_Info: 1,
      courseId: courseId,
    },
  }).done(function (data) {
    $("#courseInfo1").html(data);
    $("#courseInfo2").html(data);
    $("#courseInfo3").html(data);
    $("#courseInfo4").html(data);
  });
}

function onSelectStudentId(studentId) {
  console.log("onSelectStudentId ==>>", studentId);
  let studentIds = localStorage.getItem("studentIds")
    ? JSON.parse(localStorage.getItem("studentIds"))
    : [];
  studentIds.push(studentId);
  localStorage.setItem("studentIds", studentId);
}

$(document).on("click", "#filterStudentsForUnassign", function () {
  console.log("filterStudentsForUnassign==>");
  filterStudentsForUnassign();
});

function filterStudentsForUnassign() {
  console.log("filterStudentsForUnassign() called");
  const StudentDept = $("#filter_StudentDept").val();
  const StudentBatch = $("#filter_StudentBatch").val();
  const StudentSection = $("#filter_StudentSection").val();
  const courseId = localStorage.getItem("courseId");
  console.log("courseId===>", courseId);
  $.ajax({
    url: "admin_up.php",
    type: "POST",
    data: {
      allAssignedStudentTableForUnassigned: 1,
      department: StudentDept,
      batch: StudentBatch,
      section: StudentSection,
      courseId: courseId,
    },
  }).done(function (data) {
    $("#allAssignedStudentTableForUnassigned").html(data);
  });
}

$(document).on("click", "#btnAssignStudent", function () {
  const courseId = parseInt(localStorage.getItem("courseId"));
  const studentIds = JSON.parse(localStorage.getItem("studentIds"));
  console.log("type of", typeof studentIds);
  $.ajax({
    url: "admin_panel_config.php",
    type: "POST",
    data: {
      assign_student: 1,
      courseId: courseId,
      studentIds: studentIds,
    },
    success: function (response) {
      console.log(response);
      // $("#on_program_select").val("");
      // $("#course_list").val("");

      if (response == 1) {
        localStorage.setItem("studentIds", []);
        viewStudentForAssignNetworkCall();

        $(".alert_dev").fadeIn(500);
        $(".alert_dev").html(
          '<p class="alert alert-success">Student assigned successfully</p>'
        );
        // $("#new-device").modal("hide");
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
        url: "admin_up.php",
        type: "POST",
        data: {
          course_up: 1,
        },
      }).done(function (data) {
        $("#courses").html(data);
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

$(document).on("click", "#btnUnassignStudent", function () {
  const courseId = parseInt(localStorage.getItem("courseId"));
  const unassignStudentIds = JSON.parse(
    localStorage.getItem("unassignStudentIds")
  );
  console.log("type of", typeof unassignStudentIds);
  $.ajax({
    url: "admin_panel_config.php",
    type: "POST",
    data: {
      unassign_student: 1,
      courseId: courseId,
      studentIds: unassignStudentIds,
    },
    success: function (response) {
      console.log(response);
      // $("#on_program_select").val("");
      // $("#course_list").val("");

      if (response == 1) {
        localStorage.setItem("studentIds", []);
        filterStudentsForUnassign();

        $(".alert_for_modal").fadeIn(500);
        $(".alert_for_modal").html(
          '<p class="alert alert-success">Student unassigned successfully</p>'
        );
        // $("#new-device").modal("hide");
        setTimeout(function () {
          $(".alert_for_modal").fadeOut(500);
        }, 2000);
      } else {
        $(".alert_for_modal").fadeIn(500);
        $(".alert_for_modal").html(response);

        setTimeout(function () {
          $(".alert_for_modal").fadeOut(500);
        }, 2000);
      }

      $.ajax({
        url: "admin_up.php",
        type: "POST",
        data: {
          course_up: 1,
        },
      }).done(function (data) {
        $("#courses").html(data);
      });
    },
    error: function (e) {
      console.log(e.responseText);
      $(".alert_for_modal").fadeIn(500);
      $(".alert_for_modal").html(
        `<p class="alert alert-danger">${e.responseText}</p>`
      );

      setTimeout(function () {
        $(".alert_for_modal").fadeOut(500);
      }, 2000);
    },
  });
});

$(document).on("click", "#select_all_for_assign", function () {
  if ($("input#select_all_for_assign").prop("checked")) {
    var values = []; // will contain all checkbox values that you can send via ajax
    $('table > tbody input[type="checkbox"]').each(function (i, el) {
      $(el).prop("checked", true);
      if (el.value !== "") {
        values.push(el.value);
      }
    });

    localStorage.setItem("studentIds", JSON.stringify(values));
  } else {
    $('table > tbody input[type="checkbox"]').each(function (i, el) {
      $(el).prop("checked", false);
    });
    localStorage.setItem("studentIds", JSON.stringify([]));
  }
});

$(document).on("click", ".select_item_for_assign", function () {
  const selectedStudentId = $(this).attr("id");
  console.log("select_item_for_assign===>>", selectedStudentId);
  let studentIds = localStorage.getItem("studentIds");
  console.log("studentIds");
  if (studentIds) {
    console.log("not null");
    studentIds = JSON.parse(studentIds);
  } else {
    console.log("null");
    studentIds = [];
  }

  console.log("studentIds type", typeof studentIds);

  const index = studentIds.indexOf(selectedStudentId);
  if (index !== -1) {
    $("input#select_all_for_assign").prop("checked", false);
    studentIds.splice(index, 1);
  } else {
    studentIds.push(selectedStudentId);
  }

  localStorage.setItem("studentIds", JSON.stringify(studentIds));
});

$(document).on("click", "#select_all_for_unassign", function () {
  if ($("input#select_all_for_unassign").prop("checked")) {
    var values = []; // will contain all checkbox values that you can send via ajax
    $('table > tbody input[type="checkbox"]').each(function (i, el) {
      $(el).prop("checked", true);
      if (el.value !== "") {
        values.push(el.value);
      }
    });

    localStorage.setItem("unassignStudentIds", JSON.stringify(values));
  } else {
    $('table > tbody input[type="checkbox"]').each(function (i, el) {
      $(el).prop("checked", false);
    });
    localStorage.setItem("unassignStudentIds", JSON.stringify([]));
  }
});

$(document).on("click", ".select_item_for_unassign", function () {
  const selectedStudentId = $(this).attr("id");
  console.log("selectedStudentId value: ", $(this).val());
  console.log("select_item_for_unassign===>>", selectedStudentId);
  let unassignStudentIds = localStorage.getItem("unassignStudentIds");
  console.log("unassignStudentIds");
  if (unassignStudentIds) {
    console.log("not null");
    unassignStudentIds = JSON.parse(unassignStudentIds);
  } else {
    console.log("null");
    unassignStudentIds = [];
  }

  console.log("unassignStudentIds type", typeof unassignStudentIds);

  const index = unassignStudentIds.indexOf(selectedStudentId);
  if (index !== -1) {
    $("input#select_all_for_unassign").prop("checked", false);
    unassignStudentIds.splice(index, 1);
  } else {
    unassignStudentIds.push(selectedStudentId);
  }

  localStorage.setItem(
    "unassignStudentIds",
    JSON.stringify(unassignStudentIds)
  );
});

$(document).on("click", "#btnManageProfile", function () {
  console.log('btnManageProfile clicked');
    $.ajax({
      url: "admin_up.php",
      type: 'POST',
      data: {
        'get_edit_admin_profile_input': 1,
      }
    }).done(function(data) {
      $('#admin_update_profile_input').html(data);
    });

});

$(document).on("click", "#btnUpdateAdminInfo", function () {
  console.log('update profile...');

  const admin_name = $("#admin_name").val();
  const admin_email = $("#admin_email").val();
  const department = $("#admin_dept").val();
  const designation = $("#admin_designation").val();
  $.ajax({
    url: "admin_panel_config.php",
    type: "POST",
    data: {
      update_admin_info: 1,
      admin_name: admin_name,
      admin_email: admin_email,
      department: department,
      designation: designation,
    },
    success: function (response) {
      console.log(response);
      if (response == 1) {
        $(".alert_for_modal").fadeIn(500);
        $(".alert_for_modal").html(
          '<p class="alert alert-success">Admin info has been updated successfully</p>'
        );
        
        //$("#id").modal("hide");

        setTimeout(function () {
          $(".alert_for_modal").fadeOut(500);
        }, 2000);

        // update admin info in page
        $.ajax({
          url: "admin_panel_config.php",
          type: 'POST',
          data: {
            'get_admin_info': 1,
          }
        }).done(function(data) {
          $('#adminInfo').html(data);
        });

      } else {
        $(".alert_for_modal").fadeIn(500);

        $(".alert_for_modal").html(`<p class="alert alert-danger">${response}</p>`);

        setTimeout(function () {
          $(".alert_for_modal").fadeOut(500);
        }, 3000);
      }
    },
    error: function (e) {
      console.log(e.responseText);
      $(".alert_for_modal").fadeIn(500);
      $(".alert_for_modal").html(
        `<p class="alert alert-danger">${e.responseText}</p>`
      );

      setTimeout(function () {
        $(".alert_for_modal").fadeOut(500);
      }, 2000);
    },
  });
});

$(document).on("click", "#btnChangePassword", function () {
  console.log('Change Password...');

  const current_pass = $("#current_pass").val();
  const current_passconf = $("#current_passconf").val();
  const new_pass = $("#new_pass").val();
  const new_passconf = $("#new_passconf").val();
  
  if (!current_pass || !current_passconf || !new_pass || !new_passconf) {
    $(".alert_for_modal").fadeIn(500);
    $(".alert_for_modal").html(
      '<p class="alert alert-warning">Please input all the password field</p>'
    );
    setTimeout(function () {
      $(".alert_for_modal").fadeOut(500);
    }, 3000);
    return;

  } else if (current_pass.length < 3) {

    $(".alert_for_modal").fadeIn(500);
    $(".alert_for_modal").html(
      '<p class="alert alert-warning">Current password length do not match with minimum requirement!</p>'
    );
    setTimeout(function () {
      $(".alert_for_modal").fadeOut(500);
    }, 3000);
    return;

  }  else if (current_pass !== current_passconf) {

    $(".alert_for_modal").fadeIn(500);
    $(".alert_for_modal").html(
      '<p class="alert alert-warning">Password and Confirm Password not matched!</p>'
    );
    setTimeout(function () {
      $(".alert_for_modal").fadeOut(500);
    }, 3000);
    return;

  } else if (new_pass.length < 3) {

    $(".alert_for_modal").fadeIn(500);
    $(".alert_for_modal").html(
      '<p class="alert alert-warning">New password length do not match with minimum requirement!</p>'
    );
    setTimeout(function () {
      $(".alert_for_modal").fadeOut(500);
    }, 3000);
    return;

  } else if (new_pass !== new_passconf) {

    $(".alert_for_modal").fadeIn(500);
    $(".alert_for_modal").html(
      '<p class="alert alert-warning">New Password and Confirm New Password not matched!</p>'
    );
    setTimeout(function () {
      $(".alert_for_modal").fadeOut(500);
    }, 3000);
    return;
  }

  $.ajax({
    url: "admin_panel_config.php",
    type: "POST",
    data: {
      update_admin_password: 1,
      current_pass: current_pass,
      new_pass: new_pass
    },
    success: function (response) {
      console.log(response);
      if (response == 1) {
        $("#current_pass").val("");
        $("#current_passconf").val("");
        $("#new_pass").val("");
        $("#new_passconf").val("");

        $(".alert_for_modal").fadeIn(500);
        $(".alert_for_modal").html(
          '<p class="alert alert-success">Admin password has been updated successfully</p>'
        );
        
        //$("#id").modal("hide");

        setTimeout(function () {
          $(".alert_for_modal").fadeOut(500);
        }, 2000);

      } else {
        $(".alert_for_modal").fadeIn(500);

        $(".alert_for_modal").html(`<p class="alert alert-danger">${response}</p>`);

        setTimeout(function () {
          $(".alert_for_modal").fadeOut(500);
        }, 3000);
      }
    },
    error: function (e) {
      console.log(e.responseText);
      $(".alert_for_modal").fadeIn(500);
      $(".alert_for_modal").html(
        `<p class="alert alert-danger">${e.responseText}</p>`
      );

      setTimeout(function () {
        $(".alert_for_modal").fadeOut(500);
      }, 3000);
    },
  });
});