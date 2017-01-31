<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <?php

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    

    $error = '';

    if(empty($first_name)){
        $error .= "You need to insert your first name.<br>" ;
    }

    if(empty($last_name)){
        $error .= "You need to insert your last name.<br>" ;
    }

    if(empty($username)){
        $error .= "You need to insert a username.<br>" ;
    }

    if(empty($email)){
        $error .= "Your email is required.<br>";
    }

    if(empty($password)){
        $error .= "You need to enter a password.<br>";
    }
    

    if($error){
       echo "<div class='alert alert-danger' role='alert'>";
       echo $error ;
       echo "</div>";
    }else{
        

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $insert_query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        $insert_query .= "VALUES('{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', 'Subscriber')";

        $register_user_query = mysqli_query($connection, $insert_query);

        if(!$register_user_query){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Registration Failed</h4>";

            die("Query Failed" . mysqli_error($connection));
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Registration Successful</h4>";

            header("refresh: 2; URL = index.php");
        }
    }

    
}

?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Please enter your first name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Please enter your last name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Please enter a username">
                        </div>
                         <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
