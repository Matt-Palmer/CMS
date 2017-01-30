<h1 class="page-header">
    Posts
</h1>

<?php

if(isset($_POST['checkboxArray'])){
    foreach($_POST['checkboxArray'] as $checkboxValue){
       $bulk_options = $_POST['bulk_options'];

       switch($bulk_options){

           case 'Published':
           $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$checkboxValue'";
           $bulk_publish_update_query = mysqli_query($connection, $query);
           break;

           case 'Draft':
           $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$checkboxValue'";
           $bulk_draft_update_query = mysqli_query($connection, $query);
           break;

           case 'clone':
           $select_query = "SELECT * FROM posts WHERE post_id = '$checkboxValue'";
    $select_posts = mysqli_query($connection, $select_query);

    while($row = mysqli_fetch_assoc($select_posts)){

        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $post_category_id = $row['post_category_id'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
    }

   

    $date = gmdate("y-m-d h:i:s");

    $insert_query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $insert_query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '$date', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $insert_query);

        if(confirmQuery($create_post_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Post could not be created</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Post successfully created</h4>";

            //header("refresh: 2; URL = posts.php");
        }
           break;

           case 'delete':
           $query = "DELETE FROM posts WHERE post_id = '$checkboxValue'";
           $delete_query = mysqli_query($connection, $query);
           break;

       }
    }
}

?>

<form action="" method="post">

    <div id="bulk-options-container" class="form-group col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-primary" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-default">Add Post</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input id="select-all" type="checkbox"></th>
                <th>Post ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Views</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>

            <?php displayPostData(); ?>

            <?php deletePost(); ?>

        </tbody>
    </table>
</form>