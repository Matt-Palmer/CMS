<?php


    if(isset($_GET['p_id'])){
        $user_id = $_GET['p_id'];

        $query = "SELECT * FROM users WHERE user_id = $user_id";

        $select_user = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_user)){

            $user_id = $row['user_id'];
            $user_image = $row['user_image'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];
        }   
    }




?>


<form action="" method="post" enctype="multipart/form-data">

    <!--<div class="form-group">
        <label for="user_role">User Role</label>
        <br>
        <select name="user_role" id="">
        
        <?php

            /*$query = "SELECT * FROM users";
            $select_roles = mysqli_query($connection, $query);

            confirmQuery($select_roles);

            while($row = mysqli_fetch_assoc($select_roles)){
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];

                echo "<option value='$user_id'>$user_role</option>";
                
            }*/
        
        ?>

        </select>
    </div>-->



    <div class="form-group">
        <label for="user_image">Post Image</label><br>
        <img width="50px" height="50px" src="../images/<?php echo $user_image?>" alt="">
        <input type="file" class="form-control" name="">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email?>">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username?>">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password?>">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <br>
        <select name="user_role" id="">

            <option value="<?php echo $user_role?>"><?php echo $user_role?></option>

            <?php

                if($user_role == 'Admin'){
                    echo "<option value='Subscriber'>Subscriber</option>";
                } else {
                    echo "<option value='Admin'>Admin</option>";
                }

            ?>
            

        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

    <?php 
    
        if(isset($_POST['create_user'])){
            
            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_role = $_POST['user_role'];
            $user_password = $_POST['user_password'];

            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            move_uploaded_file($user_image_temp, "../images/$user_image");

            if(empty($user_image)){
                $query = "SELECT * FROM users WHERE user_id = $user_id";

                $select_current_image = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_current_image)){
                    $user_image = $row['user_image'];
                }
            }

            $query = "UPDATE users SET user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', user_email = '{$user_email}', ";
            $query .= "username = '{$username}', user_password = '{$user_password}', ";
            $query .= "user_role = '{$user_role}' WHERE user_id = {$user_id} ";

            $update_query = mysqli_query($connection, $query);
                                                
            if(!$update_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: users.php");
            }
        }
    
    ?>

</form>