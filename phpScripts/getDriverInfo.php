<?php
    session_start();
    include 'dbconn.php';
    if(isset($_POST['licence_no'])){
        $query = "SELECT * FROM driver WHERE Licence_No = '$_POST[licence_no]'" ; 
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $_POST['licence_no'];
    }
    if(isset($_GET['Licence_No'])){
        $query = "SELECT * FROM driver WHERE Licence_No = '$_GET[Licence_No]'" ; 
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $_GET['Licence_No'];
    }
    else if($_SESSION['user_type'] == 3){
        //driver info
        $query = "SELECT * FROM driver WHERE Licence_No = '$_SESSION[id]'" ; 
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $_SESSION['id'];
       
    }
    //class info
    $query2 = "SELECT * FROM class WHERE class_id =(SELECT Class_ID FROM driver WHERE Licence_No = '$id')" ;
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    
    //Championship Points
    $query3 = "SELECT * FROM leaderboard WHERE Licence_No = '$row[Licence_No]' and Class_ID = '$row[Class_ID]';";
    $result3 = mysqli_query($conn, $query3);
    $row3 = mysqli_fetch_assoc($result3);
    
    //Championship Leaderboard
    $query4 = "SELECT d.Name, l.Points FROM driver d, leaderboard l WHERE d.Licence_No = l.Licence_No and l.Class_ID = '$row[Class_ID]' order by Points desc limit 3";
    $result4 = mysqli_query($conn, $query4);
    
    //Championship rank
     $query5 = "SELECT  * from leaderboard WHERE Class_ID = '$row[Class_ID]' order by Points desc";
     $result5 = mysqli_query($conn, $query5);
    $ranks = 1;
    while( $row5 = mysqli_fetch_assoc($result5)){
        if($row5['Licence_No'] != $row['Licence_No']){
            $ranks = $ranks +1;        
        }
        else{
            $dRank = $ranks;
        }
    }
    
    //results
    //get latest race
    $query5 = "SELECT  * from results order by race_num desc ,race_type_id desc limit 1";
    $result5 = mysqli_query($conn, $query5);
    $row5 = mysqli_fetch_assoc($result5);
    $lastRace = $row5['race_num'];
    
    //get top 5
    $query6 = "select d.Name, r.position from driver d, results r where race_num = '$row5[race_num]' and r.race_class = '$row[Class_ID]'  and race_type_id = '$row5[race_type_id]' and d.Licence_No = r.driver_id and position > 0 order by position asc limit 5";
    $result6 = mysqli_query($conn, $query6);

        
?>