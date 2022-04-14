<?php

require 'helpers/dbConnection.php';
require 'helpers/functions.php';

$id = $_GET['id'];
$user_id =$_SESSION['user']['id'];

$sql = "select * from tasks where id = $id";
$op  = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);
$blogdate = date('Y-m-d', strtotime($_POST['blogdate']));
$test_arr  = explode('-', $blogdate);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Clean($_POST['title']);
    $content = Clean($_POST['content']);
    $blogstartdate = date('Y-m-d', strtotime($_POST['blogstartdate']));
    $blogenddate = date('Y-m-d', strtotime($_POST['blogenddate']));
    $test_arr1  = explode('-', $blogstartdate);
    $test_arr2  = explode('-', $blogenddate);
    $todayDate = date('Y-m-d');


    // echo $new_date;

    # Validate ...... 

    $errors = [];
    #validate date
    if (empty($blogstartdate)) {
        $errors['date'] = " Start Date  Required";
    }
    else if (checkdate($test_arr1[0], $test_arr1[1], $test_arr1[2])) {
        $errors['date'] = "Start Date  Not Valid";
    }
    else if (strtotime($blogstartdate) < strtotime($todayDate)) {
        $errors['date'] = " Cannot Add  Date From Past";
    }
    if (empty($blogenddate)) {
        $errors['date'] = "End Date  Required";
    }
    else if (strtotime($blogstartdate) > strtotime($blogenddate)) {
        $errors['date'] = " End Date Cannot become before Start Date";
    }
    else if (checkdate($test_arr2[0], $test_arr2[1], $test_arr2[2])) {
        $errors['date'] = "End Date  Not Valid";
    }
    # validate title .... 
    if (empty($title)) {
        $errors['title'] = "Title  Required";
    }
    else if (is_numeric($title))
    {
         $errors['title']= "title Cannot Be Numbers Only Must Be String";
    }
    # validate content

    if (empty($content)) {
        $errors['content'] = "Content Required";
    } elseif (strlen($content) > 50) {
        $errors['content'] = "Length Must be smaller than 50 chars";
    }

    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

         # DB OP ......... 
         $sql = "update tasks set title='$title' , content = '$content' , startdate = '$blogstartdate' , enddate='$blogenddate' where  id = $id AND user_id = $user_id";
         $op =  mysqli_query($con,$sql);

         if($op){
             echo 'Raw Updated';
         }else{
             echo 'Error Try Again '. mysqli_error($con);
         }
     # Close Connection .... 
      mysqli_close($con); 
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit New Task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <h2>Edit Task</h2>

    <form   method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title"
            value="<?php echo $data['title'] ?>"       placeholder="Enter Title">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail">Content</label>
            <input type="text" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp"
            value="<?php echo $data['content'] ?>"         name="content" placeholder="Enter Content">
        </div>
        <div class="form-group">
        <label for="start">Choose Start date:</label>
        <input type="date" name="blogstartdate"  id="dateOfBirth"  placeholder="MM/DD/YYYY"  value="<?php echo $data['startdate'] ?>" required>
        </div>
        <div class="form-group">
        <label for="end">Choose End date:</label>
        <input type="date" name="blogenddate"  id="dateOfBirth"  placeholder="MM/DD/YYYY"  value="<?php echo $data['enddate'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>


</body>

</html>