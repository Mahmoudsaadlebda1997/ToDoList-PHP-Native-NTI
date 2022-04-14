<?php 

// delete raw from db  ..... 

require 'helpers/dbConnection.php';
echo $todayDate = date('Y-m-d');

$id = $_GET['id'];
$enddatesql="select * from tasks where id = $id"; 
$op =  mysqli_query($con,$enddatesql);
$time = mysqli_fetch_assoc($op);

if(strtotime($time['enddate']) < strtotime($todayDate)){

    if(filter_var($id,FILTER_VALIDATE_INT)){
        // code .... 
        
        $sql = "delete from tasks where id = $id"; 
        
        $op = mysqli_query($con,$sql); 
        
        if($op){
            $message = 'Raw Removed';
            
        }else{
            $message = 'Error Try Again';
        }
        
        
    }else{
        $message = 'invalid ID';
    }
    
    # Set Message to Session
    
    $_SESSION['Message'] = $message; 
    
    header("location: index.php"); 
    
}else {
    echo "Cannot Delete Before Expiration Of Task";
}
    ?>