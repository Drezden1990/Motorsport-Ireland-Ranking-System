<?php
    include 'dbconn.php';
    $sql = "select * from race where `date` > DATE(now()) order by `date` limit 1";
    $result = mysqli_query($conn, $sql);
    $raceRow = mysqli_fetch_assoc($result);
  
    $sql2 = "select r.race_type, r.race_type, r.date, t.type_meaning from race r, race_type t where race_number = '$raceRow[race_number]' and r.race_type = t.race_type order by `date`";
    $result2 = mysqli_query($conn, $sql2);
    //$infoRow = mysqli_fetch_assoc($result2);
    
    $sql3 = "select town from track where track_id = '$raceRow[track_no]'";
    $result3 = mysqli_query($conn, $sql3);
    $town = mysqli_fetch_assoc($result3);

?>