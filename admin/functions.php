<?php 

function displayCategories(){

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";          
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Update</a></td>";
        echo "</tr>";
    }
}

function insertCategories(){

    global $connection;

    if(isset($_POST['submit'])){                                  
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "You have not entered a title for the category";
        }else{
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
            $create_category = mysqli_query($connection, $query);

            if(!$create_category){
                die('Query Failed' . mysqli_error($connection));
            }
        }
    }
}

function deleteCategories(){

    global $connection;

    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: categories.php");
    }
}

function addPost(){

    global $connection;

    if(isset($_POST['create-post'])){
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date('d-m-y');
        $date = gmdate("d-m-y h:i:s");

        echo $date;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '$date', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        if(confirmQuery($create_post_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Post could not be created</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Post successfully created</h4>";

            header("refresh: 2; URL = posts.php");
        }
    }
}

function displayPostData(){

    global $connection;

    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $post_category_id = $row['post_category_id'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_comment_count = $row['post_comment_count'];

        echo "<tr>";
        echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='{$post_id}'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_content}</td>";

        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>{$cat_title}</td>";
        }

        echo "<td>{$post_status}</td>";
        echo "<td><img src='../images/{$post_image}' width='50px' height='50px'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='../post.php?p_id=$post_id'>View</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
        echo "<td><a href='posts.php?delete=$post_id'>Delete</a></td>";
        echo "</tr>";
    }
}

function editPost($post_id){

    global $connection;

    if(isset($_POST['update-post'])){
            
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_status = $_POST['post_status'];
        $post_content = $_POST['content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id";

            $select_current_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_current_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_date = now(), post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', post_category_id = '{$post_category_id}', ";
        $query .= "post_image = '{$post_image}', post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}', post_content = '{$post_content}' ";
        $query .= "WHERE post_id = {$post_id}";
        $update_query = mysqli_query($connection, $query);
                                            
        if(confirmQuery($update_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Post could not be updated</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Post successfully updated</h4>";

            header("refresh: 2; URL = posts.php");
        }
    }
}

function deletePost(){

    global $connection;

    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'
        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
}

function addUser(){

    global $connection;

    if(isset($_POST['create_user'])){
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $user_password = $_POST['user_password'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}')";

        $create_user_query = mysqli_query($connection, $query);

        if(confirmQuery($create_user_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>User could not be created</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>User successfully created</h4>";

            header("refresh: 2; URL = users.php");
        }
    }
}

function displayUserData(){

    global $connection;

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $user_image = $row['user_image'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";       
        echo "<td><img src='../images/{$user_image}' width='50px' height='50px'></td>";          
        echo "<td>{$username}</td>";            
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>"; 
        echo "<td>{$user_role}</td>";           
        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";           
        echo "<td><a href='users.php?source=edit_user&p_id=$user_id'>Edit</a></td>";            
        echo "</tr>";
    }
}

function editUser($user_id){

    global $connection;

    if(isset($_POST['create_user'])){   
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $user_password = $_POST['user_password'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_current_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_current_image)){
                $user_image = $row['user_image'];
            }
        }

        $query = "UPDATE users SET user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', user_email = '{$user_email}', ";
        $query .= "username = '{$username}', user_password = '{$user_password}', ";
        $query .= "user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_id = {$user_id} ";

        $update_query = mysqli_query($connection, $query);
                                            
        if(!$update_query){
            die("Query Failed" . mysqli_error($connection));
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>User successfully updated</h4>";

            header("refresh: 2; URL = users.php");
        }
    }
}

function deleteUser(){

    global $connection;

    if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'
        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }
}

function createComment(){
    global $connection;

    if(isset($_POST['create_comment'])){
        $post_id = $_GET['p_id'];

        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];
        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
        $query .= "VALUES($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

        $create_comment_query = mysqli_query($connection, $query);

        if(confirmQuery($create_comment_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Comment could not be added</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Comment successfully added</h4>";
        }

        $update_comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";

        $update_comment_count = mysqli_query($connection, $update_comment_count_query);

        confirmQuery($update_comment_count);
    }
}

function displayCommentTable(){

    global $connection;

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_category_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        

        echo "<tr>";
        echo "<td>{$comment_id}</td>";       
        echo "<td>{$comment_author}</td>";            
        echo "<td>{$comment_content}</td>";            
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

        $query = "SELECT * FROM posts WHERE post_id = $comment_category_id";
        $select_post_id_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>"; 
        }

        echo "<td>{$comment_date}</td>";            
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";            
        echo "<td><a href='comments.php?decline=$comment_id'>Decline</a></td>";            
        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";           
        echo "</tr>";
    }
}

function deleteComments(){

    global $connection;

    if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'

        $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";

        $delete_query = mysqli_query($connection, $query);

        header("Location: comments.php");
    }
}

function approveComment(){
    global $connection;

    if(isset($_GET['approve'])){
        $comment_id = $_GET['approve'];//delete refers to the href in the link 'posts.php?delete'

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";

        $decline_query = mysqli_query($connection, $query);

        header("Location: comments.php");
    }
}

function rejectComment(){

    global $connection;
    
    if(isset($_GET['decline'])){
        $comment_id = $_GET['decline'];//delete refers to the href in the link 'posts.php?delete'

        $query = "UPDATE comments SET comment_status = 'declined' WHERE comment_id = $comment_id";

        $decline_query = mysqli_query($connection, $query);

        header("Location: comments.php");
    }
}

function confirmQuery($query){

    global $connection;

    if(!$query){
        die("Query Failed" . mysqli_error($connection));
    }
}

?>