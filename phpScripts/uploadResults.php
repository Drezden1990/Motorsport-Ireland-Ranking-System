<?php
session_start();
$target_pre = "../pre_final/";
$target_final = "../final/";
$uploadOk = 1;
$count = 0;
$errors = 0;


$pre = $_FILES['preFinals']['name'];
$final = $_FILES['finals']['name'];

$incorrect = "Please enter *CSV* files for *Both* races";


// Allow only csv file formats
foreach ($_FILES['preFinals']['name'] as $race => $name){
      //check file extension is .csv
      if(pathinfo($name,PATHINFO_EXTENSION) != "csv" ) {
           header("Location: ../siteAdmin/uploadRaceResults.php?error='$incorrect'");
            exit();
        }

}
foreach ($_FILES['finals']['name'] as $race => $name){
      //check file extension is .csv
      if(pathinfo($name,PATHINFO_EXTENSION) != "csv" ) {
           header("Location: ../siteAdmin/uploadRaceResults.php?error='$incorrect'");
            exit();
        }

}



// Check if $uploadOk is set to 0 by an error
//more errors may be added
if ($uploadOk == 0) {
    header("Location: ../siteAdmin/uploadRaceResults.php?error=error");
            exit();
// if no errors were detected, try to upload files
} 
else {
    //Delete all files in target directory
    //create array of files
    $file_list = glob($target_pre . "*.*");
    foreach($file_list as $file){
        //delete file
        unlink($file);
    }
    $file_list = glob($target_final . "*.*");
    foreach($file_list as $file){
        //delete file
        unlink($file);
    }
    
    foreach ($_FILES['preFinals']['name'] as $race => $name){
        if (move_uploaded_file($_FILES["preFinals"]["tmp_name"][$race], $target_pre.$name)) {
            $count = $count +1;
        }
        else {
            $errors = $errors + 1;
        }
    }
    
    foreach ($_FILES['finals']['name'] as $race => $name){
        move_uploaded_file($_FILES["finals"]["tmp_name"][$race], $target_final.$name);
        }


    if ($errors == 0){
        include '../MI_System.php';
    }
}

?>