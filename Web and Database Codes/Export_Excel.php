<?php
//Connect to database
require 'connectDB.php';

$output = '';

if(isset($_POST["To_Excel"])){
  
    $searchQuery = " ";
    $Start_date = " ";
    $End_date = " ";
    $Start_time = " ";
    $End_time = " ";
    $Finger_sel = " ";

    
    //Fingerprint filter
    if ($_POST['fing_sel'] != 0) {
        $Finger_sel = $_POST['fing_sel'];
        $_SESSION['searchQuery'] .= " AND fingerprint_id='".$Finger_sel."'";
    }
    //Department filter
    if ($_POST['dev_id'] != 0) {
        $dev_id = $_POST['dev_id'];
        $sql = "SELECT device_uid FROM devices WHERE id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "i", $dev_id);
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                $dev_uid = $row['device_uid'];
            }
        }
        $_SESSION['searchQuery'] .= " AND device_uid='".$dev_uid."'";
    }

    $sql = "SELECT * FROM users_logs WHERE ".$_SESSION['searchQuery']." ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
      $output .= '
                  <table class="table" bordered="1">  
                    <TR>
                      <TH>ID</TH>
                      <TH>Name</TH>
                      <TH>Fingerprint ID</TH>
                      <TH>Device ID</TH>
                      <TH>Device Dep</TH>
                    </TR>';
        while($row=$result->fetch_assoc()) {
            $output .= '
                        <TR> 
                            <TD> '.$row['id'].'</TD>
                            <TD> '.$row['username'].'</TD>
                            <TD> '.$row['fingerprint_id'].'</TD>
                            <TD> '.$row['device_uid'].'</TD>
                            <TD> '.$row['device_dep'].'</TD>
                        </TR>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log'.$Start_date.'.xls');
        
        echo $output;
        exit();
    }
    else{
      header( "location: UsersLog.php" );
      exit();
    }
}
?>
