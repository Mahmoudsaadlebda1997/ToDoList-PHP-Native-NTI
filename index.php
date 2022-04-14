<?php 


  require 'helpers/dbConnection.php';

  $sql = "select tasks.* , users.name   from tasks  join users on tasks.user_id = users.id"; 
  $data = mysqli_query($con,$sql);  
  echo $todayDate = date('Y-m-d');


?>



<!DOCTYPE html>
<html>

<head>
    <title>Read All Blogs</title>

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
            <h1>Read Tasks </h1>
            <br>

            <?php
            
            
              if(isset($_SESSION['Message'])){   
               echo $_SESSION['Message'];

               unset($_SESSION['Message']);

              }
            ?>


        </div>

        <a href="create.php">+ Task</a>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Content</th>
                <th>Blog Start Date</th>
                <th>Blog End Date</th>
                <th>action</th>
            </tr>

       <?php 
          
           while($raw = mysqli_fetch_assoc($data)){


       ?>
            <tr>
                   <td><?php echo $raw['id'];?></td>
                   <td><?php echo $raw['name'];?></td>
                   <!-- <td><?php echo '<img src="uploads/'.$raw['image'].'" alt="HTML5 Icon" style="width:200px;height:92px text-align:center; margin-left:90px;">';?></td> -->
                   <td><?php echo $raw['title'];?></td>
                   <td><?php echo $raw['content'];?></td>
                   <td><?php echo $raw['startdate'];?></td>
                   <td><?php echo $raw['enddate'];?></td>

                <td>

                        <a href='delete.php?id=<?php echo $raw['id'];?>' class='btn  btn-danger m-r-3em'>Delete</a>


                    <a href='edit.php?id=<?php echo $raw['id'];?>' class='btn btn-primary m-r-3em'>Edit</a>
                </td>
            </tr>

       <?php 
    } ?>
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