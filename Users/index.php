<?php 


  require '../helpers/dbConnection.php';
  require 'checklogin.php';

  $sql = "select users.* , departments.title   from users  join departments on users.dep_id = departments.id "; 
  $data = mysqli_query($con,$sql);  


?>



<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Read Users </h1>
            <br>
              <?php    
                
                 echo 'Welcome ,'.$_SESSION['user']['name'];
              
              ?>
            <br>

            <?php
            
            
              if(isset($_SESSION['Message'])){   
               echo $_SESSION['Message'];

               unset($_SESSION['Message']);

              }
            ?>


        </div>

        <a href="create.php">+ Account</a>   ||    <a href="logout.php">LogOut</a>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                 <th>Image</th>
                 <th>Department</th>
                <th>action</th>
            </tr>

       <?php 
          
           while($raw = mysqli_fetch_assoc($data)){


       ?>
            <tr>
                   <td><?php echo $raw['id'];?></td>
                   <td><?php echo $raw['name'];?></td>
                   <td><?php echo $raw['email'];?></td>
                   <td> <img src="uploads/<?php echo $raw['image'];?>" alt="userImage"  height="50px" width="50px" > </td>  
                   <td><?php echo $raw['title'];?></td>
                <td>
                    
              <?php 
                if($_SESSION['user']['id'] != $raw['id'] ){
              ?> 
                <a href='delete.php?id=<?php echo $raw['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>

              <?php } ?>

                    <a href='edit.php?id=<?php echo $raw['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                </td>
            </tr>

       <?php } ?>
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>