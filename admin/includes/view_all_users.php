<h1 class="page-header">
    Users
</h1>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>

    <tbody>

        <?php displayUserData();?>

        <?php deleteUser();?>
    
    </tbody>
</table>