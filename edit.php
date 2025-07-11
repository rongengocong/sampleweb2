<?php
    include_once("./php/db.php");

    if(!isset($_GET['id'])){
        header("location: /php_prog/home.php");
    }

      $getID = !empty($_GET['id']) ? $_GET['id'] : '';

      $selectData = mysqli_query($con, "SELECT * FROM tbl_users WHERE id = $getID");

      $tempFirstName = "";
      $tempLastName = "";
      $tempEmail = "";
      $tempUsername = "";
      if(mysqli_num_rows($selectData) > 0){
        if($getUserRow = mysqli_fetch_assoc($selectData)){
            $tempFirstName = $getUserRow['firstname'];
            $tempLastName = $getUserRow['lastname'];
            $tempEmail = $getUserRow['email'];
            $tempUsername = $getUserRow['username'];
        }
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body>

    <div class="container mt-5">
    <h1 class="text-secondary mb-3">Edit User ID: <?= $getID ?> </h1>
    
        <a href="home.php" class="btn btn-primary">Back</a>
        <div class="card">
            <div class="card-body">
                <?php
                    $errorMessage = "";
                    $successMessage = "";

                    if(isset($_POST['submit'])){
                        $firstname = mysqli_real_escape_string($con,$_POST['firstname']);

                        $lastname = mysqli_real_escape_string($con,$_POST['lastname']);

                        $email = mysqli_real_escape_string($con,$_POST['email']);

                        $username = mysqli_real_escape_string($con,$_POST['username']);

                        
                        if(empty($firstname) || empty($lastname) || empty($email) || empty($email) || empty($username)){
                            $errorMessage = "Empty fields";
                        }else{
                            $update_data = mysqli_prepare($con, "UPDATE tbl_users SET firstname = ?, lastname = ?, email = ?, username = ? WHERE id = ?");

                            mysqli_stmt_bind_param($update_data, "ssssi", $firstname, $lastname, $email, $username, $getID);

                            if(mysqli_stmt_execute($update_data)){
                                header("location: /php_prog/home.php");
                            }else{
                                $errorMessage = "Something went wrong, please try again later";
                            }
                        }

                        if(empty($errorMessage) && !empty($successMessage)){
                            echo "<div class='bg-success p-2 text-center text-white'>$successMessage</div>";
                        }else{
                            echo "<div class='bg-danger p-2 text-center text-white'>$errorMessage</div>";
                        }
                    }

                ?>
                <form action="" method="POST">               
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname"value="<?= $tempFirstName ?>" class=form-control mb-3">
                        
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname"value="<?= $tempLastName ?>" class="form-control mb-3">
                        
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email"value="<?= $tempEmail ?>" class="form-control mb-3">                
                        
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"value="<?= $tempUsername ?>" class="form-control mb-3">
                        
                        <input type="submit" name="submit" value="Edit" class="btn btn-primary px-5 mb-3">
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

