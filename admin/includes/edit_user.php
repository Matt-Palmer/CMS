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

<h1 class="page-header">
    Edit User
</h1>

<?php editUser($user_id);?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_image">Post Image</label><br>
        <img width="50px" height="50px" src="../images/<?php echo $user_image?>" alt="">
        <input type="file" class="form-control" name="user_image">
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

</form>