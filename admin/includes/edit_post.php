<?php


    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];

        $query = "SELECT * FROM posts WHERE post_id = $post_id";

        $select_post = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_post)){

            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_status = $row['post_status'];
            $post_comment_count = $row['post_comment_count'];
            $post_content = $row['post_content'];

        }   
    }




?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title;?>">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
        
            <?php 
            
            
                $edit_query = "SELECT * FROM categories";

                $select_categories_id = mysqli_query($connection, $edit_query);

                while($row = mysqli_fetch_assoc($select_categories_id)){
                    
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";

                }
            
            
            ?>
        
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author;?>">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status" value="<?php echo $post_status;?>">
    </div>

    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="50px" height="50px" src="../images/<?php echo $post_image?>" alt="">

        
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post_tags;?>">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update-post" value="Publish Post">
    </div>

    <?php 
    
        if(isset($_POST['update-post'])){
            
            $post_author = $_POST['author'];
            $post_title = $_POST['title'];
            $post_category_id = $_POST['post_category_id'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['tags'];
            $post_status = $_POST['status'];
            $post_content = $_POST['content'];

            move_uploaded_file($post_image_temp, "../images/$post_image");

            if(empty($post_image)){
                $query = "SELECT * FROM posts WHERE post_id = $post_id";

                $select_current_image = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_current_image)){
                    $post_image = $row['post_image'];
                }
            }

            $query = "UPDATE posts SET post_date = now(), post_title = '{$post_title}', post_author = '{$post_author}', post_category_id = '{$post_category_id}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_status = '{$post_status}', post_content = '{$post_content}' WHERE post_id = {$post_id} ";

            $update_query = mysqli_query($connection, $query);
                                                
            if(!$update_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: posts.php");
            }
        }
    
    ?>

</form>