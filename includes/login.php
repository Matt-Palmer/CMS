<?php include "db.php"; ?>

<?php session_start();?>

<?php 

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";

        $select_username_query = mysqli_query($connection, $query);


        if(!$select_username_query){
            die("query failed" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_username_query)){
            
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];

        }

        if(password_verify($password, $db_user_password)){

            $_SESSION['username'] = $db_username;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            if(isset($_SESSION['user_role'])){
                if($_SESSION['user_role'] == 'Admin'){

                    header("Location: ../admin");

                }else{

                    $session = session_id();
                    $time = time();
                    $timeout_in_seconds = 30;
                    $timeout = $time - $timeout_in_seconds;
                    
                    $query = "SELECT * FROM users_online WHERE session = '$session'";
                    $send_query = mysqli_query($connection, $query);

                    $count = mysqli_num_rows($send_query);

                    if($count == NULL){
                        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
                    }else{
                        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
                    }

                    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online");
                    
                    header("Location: ../index.php");

                }
            }
        }else{

            header("Location: ../index.php");
            
        }
    }


 ?>