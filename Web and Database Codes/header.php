<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="icons/b_logo.png">
	<link rel="stylesheet" type="text/css" href="css/header.css" />
</head>
<header>
	<div class="header">
		<a href="https://metrouni.edu.bd/"><img src="icons/mu_logo.png" alt="Metropolitan University Logo" class="muLogo" /></a>	
		<div class="icon-bar"><a href="AdminPanel.php"><i class="fa fa-home"></i></a></div>
		<div class="header">
			<p>Department of Electrical & Electronic Engineering</p>
			<p>Biometric Attendance System</p>
		</div>
	</div>

	<div class="sidenav" id="mysidenav">
		<!-- <a href="UsersLog.php"><i class="fa fa-bar-chart"></i> Attendance Log</a> -->
		<a href="AdminPanel.php"><i class="fa fa-shield"></i> Admin Panel</a>
		<a href="index.php"><i class="fa fa-address-book"></i> Student Profile</a>
		<a href="ManageUsers.php"><i class="fa fa-user-plus"></i> Manage Student</a>
		<a href="devices.php"><i class="fa fa-laptop"></i> Device Manager</a>
		<!-- <a href="AdminPanel.php"><i class="fa fa-shield"></i> Admin Panel</a> -->
		<a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a>
		<a style="margin-top: 90%;" href="AboutUs.php"><i class="fa fa-info-circle"></i> About</a>
		<a href="javascript:void(0);" class="icon" onclick="navFunction()"><i class="fa fa-bars"></i></a>
	</div>
</header>
<script>
	function navFunction() {
		var x = document.getElementById("mysidenav");
		if (x.className === "sidenav") {
			x.className += " responsive";
		} else {
			x.className = "sidenav";
		}
	}
</script>