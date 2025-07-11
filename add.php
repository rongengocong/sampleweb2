<?php
    include_once("./php/db.php");
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
    <h1 class="text-secondary mb-3">Add User</h1>
    
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
                            $insert_data = mysqli_prepare($con, "INSERT INTO tbl_users(firstname, lastname, email, username) VALUES(?,?,?,?)");

                            mysqli_stmt_bind_param($insert_data, "ssss", $firstname, $lastname, $email, $username);

                            if(mysqli_stmt_execute($insert_data)){
                                $successMessage = "Added successfully";
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
                        <input type="text" name="firstname" id="firstname" class="form-control mb-3">
                        
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control mb-3">
                        
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control mb-3">                
                        
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control mb-3">
                        
                        <input type="submit" name="submit" value="Add" class="btn btn-primary px-5 mb-3">
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

