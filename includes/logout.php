<?php include "db.php"; ?>
<?php session_start();?>


<?php 

    $_SESSION['username'] = NULL;
    $_SESSION['user_firstname'] = NULL;
    $_SESSION['user_lastname'] = NULL;
    $_SESSION['user_role'] = NULL;

    if(isset($_GET['delete'])){
        $session = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'

        $delete_session_query = "DELETE FROM users_online WHERE session = '{$session}'";
        $delete_query = mysqli_query($connection, $delete_session_query);

        
    }

    header("Location: ../index.php");

    
 ?>