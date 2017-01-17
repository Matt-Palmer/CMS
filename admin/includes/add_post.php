<?php

    if(isset($_POST['create-post'])){

        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post-category-id'];
        $post_status = $_POST['status'];


        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];


        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_comment_count = 4;

        $post_date = date('d-m-y');


        move_uploaded_file($post_image_temp, "../images/$post_image");

    }

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post-category-id">Post Category ID</label>
        <input type="text" class="form-control" name="post-category-id">
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status">
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