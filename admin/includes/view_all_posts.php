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
            <option value="delete">Delete</option>
        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-primary" value="Apply">
        <a href="" class="btn btn-default">Add Post</a>
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