<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Decline</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

        <?php displayCommentTable();?>

        <?php deleteComments();?>

        <?php approveComment();?>

        <?php rejectComment();?>

    </tbody>
</table>