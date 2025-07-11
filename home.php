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
        <a href="add.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
        <div class="card">
            
            <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>UserName</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select_data = mysqli_query($con, "SELECT * FROM tbl_users");

                        if(mysqli_num_rows($select_data) > 0){
                            while($row = mysqli_fetch_assoc($select_data)){

                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['firstname'] ?></td>
                            <td><?= $row['lastname'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td>
                                <a href="edit.php/php?id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa-solid fa-edit"></i></a>
                                <a href="delete.php/php?id=<?= $row['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            
                            </td>
                        </tr>
                    <?php }
                        }else{
                            echo "<tr><td>No record.<td></tr>";
                        } ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

