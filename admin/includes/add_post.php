<h1 class="page-header">
    Add Post
</h1>

<form action="" method="post" enctype="multipart/form-data">

    <?php addPost(); ?>

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