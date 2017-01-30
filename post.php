<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "admin/functions.php";?>


<!-- Navigation -->
<?php include "includes/navigation.php";?>




<!-- Page Content -->
<div class="container">

    <div class="row">

    <!-- Blog Entries Column -->
        <div class="col-md-8">

        <?php 

            if(isset($_GET['p_id'])){
            
            $post_id = $_GET['p_id'];

            $views_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $post_id";
            $send_view_query = mysqli_query($connection, $views_query);

            $query = "SELECT * FROM posts WHERE post_id = $post_id";

            $select_all_posts_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts_query)){

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_views = $row['post_views'];
        ?>

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!--Form Validation-->
        <?php

            if(isset($_POST['create_comment'])){
                $error = '';

                $name = $_POST['comment_author'];
                $email = $_POST['comment_email'];
                $comment = $_POST['comment_content'];

                if(empty($name)){
                    $error .= "Your name is required.<br>" ;
                }

                if(empty($email)){
                    $error .= "Your email is required.<br>";
                }

                if(empty($comment)){
                    $error .= "Your have left the comment empty.<br>";
                }
                

                if($error){
                echo "<div class='alert alert-danger' role='alert'>";
                echo $error ;
                echo "</div>";
                }else{
                    createComment();
                }
            }


        ?>

        <!-- First Blog Post -->
        <h2>
            <a href="#"><?php echo $post_title; ?></a>
        </h2>

        <p class="lead">by <a href="index.php"><?php echo $post_author; ?></a></p>
        <p><span class="glyphicon glyphicon-time"></span><?php echo ' ' . $post_date; ?></p>
        <p><span class="fa fa-eye"></span> Views <?php echo $post_views; ?></p>

        <hr>

        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

        <hr>

        <p><?php echo $post_content;?></p>

        <hr>

        <?php

            }
        
        }else{
            header("Location: index.php");
        }

        ?>

        <!-- Blog Comments -->



        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="comment_author">Name</label>
                    <input type="text" name="comment_author" class="form-control" value="<?php if(isset($_POST['comment_author'])){ echo $name; }?>">
                </div>

                <div class="form-group">
                    <label for="comment_email">Email</label>
                    <input type="email" name="comment_email" class="form-control" value="<?php if(isset($_POST['comment_email'])){ echo $email; }?>">
                </div>

                <div class="form-group">
                    <label for="comment_content">Comment</label>
                    <textarea class="form-control" name="comment_content" rows="3"><?php if(isset($_POST['comment_content'])){ echo $comment; }?></textarea>
                </div>

                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <?php 

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";


            $select_comment_query = mysqli_query($connection, $query);

            //confirmQuery($select_comment_query);

            while($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

        ?>


        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>

            <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author; ?>
                    <small><?php echo $comment_date; ?></small>
                </h4>

                <?php echo $comment_content; ?>
            </div>
        </div>
        
        <?php 
            }
        ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php";?>

</div>

<!-- /.row -->
<hr>

<?php include "includes/footer.php";?>
