<h1 class="page-header">
    Posts
</h1>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
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
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>

    <tbody>

        <?php displayPostData(); ?>

        <?php deletePost(); ?>

    </tbody>
</table>