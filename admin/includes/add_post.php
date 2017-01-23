<h1 class="page-header">
    Add Post
</h1>

<?php

    if(isset($_POST['create-post'])){

        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];


        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];


        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        //$post_comment_count = 4;

        $post_date = date('d-m-y');

        $date = gmdate("d-m-y h:i:s");

        echo $date;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '$date', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        confirmQuery($create_post_query);

        if($create_post_query){
            echo "<h4 class='bg-success text-success' style='padding: 5px'>User successfully created</h4>";

            header("refresh: 2; URL = posts.php");
        }
    }

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <select name="status" id="">

            <option value="Draft">Draft</option>
            <option value="Published">Publish</option>
            
            

        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create-post" value="Publish Post">
    </div>

</form>