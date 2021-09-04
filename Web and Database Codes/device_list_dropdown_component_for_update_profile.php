<?php
session_start();
?>

<select class="form-select" name="update_device_uid" id="update_device_uid" aria-label="select-studentDevice">
	<option selected disabled value="">Select Device</option>
	<?php
	require 'connectDB.php';
	$sql = "SELECT * FROM devices ORDER BY id DESC";
	$result = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($result, $sql)) {
		echo '<p class="error">SQL Error</p>';
	} else {
		$index = 0;
		mysqli_stmt_execute($result);
		$resultl = mysqli_stmt_get_result($result);
		while ($row = mysqli_fetch_assoc($resultl)) {
			echo '<option value="' . $row["device_uid"] . '">' . $row["device_name"] . '</option>';
		}
	}
	?>

</select>