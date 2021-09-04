<?php
session_start();
?>
<table style="font: 18px; text-align:center;" class="table align-middle table-hover">
	<thead class="table-primary">
		<tr>
			<th style="width: 10%;">S/N</th>
			<th style="width: 30%;">Device Name</th>
			<th style="width: 25%;">Device Department</th>
			<th style="width: 20%">Device Unique ID</th>
			<th style="width: 15%">Date</th>
		</tr>
	</thead>

	<tbody class="table-secondary">

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

				echo '
					<tr>
						<td>' . ($index + 1) . '</td>
						<td>' . $row["device_name"] . '</td>
						<td>' . $row["device_dep"] . '</td>
						<td>' . $row["device_uid"] . '</td>
						<td>' . $row["device_date"] . '</td>
					</tr>';
				$index++;
			}

			if ($index == 0) {
				echo '
				<tr>
					<td colspan="5">No device added.</td>
				</tr>';
			}
		}
		?>
	</tbody>
</table>