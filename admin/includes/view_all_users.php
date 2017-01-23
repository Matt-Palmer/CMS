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

                                <?php
                                
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

                                                    /*$query = "SELECT * FROM categories WHERE cat_id = $post_category_id";

                                                    $select_categories_id = mysqli_query($connection, $query);

                                                    while($row = mysqli_fetch_assoc($select_categories_id)){
                                                        $cat_id = $row['cat_id'];
                                                        $cat_title = $row['cat_title'];

                                                        echo "<td>{$cat_title}</td>";
                                                    }*/



                                        echo "<td>{$user_lastname}</td>";

                                       /* $query = "SELECT * FROM posts WHERE post_id = $comment_category_id";
                                        $select_post_id_query = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_post_id_query)){

                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];
                                            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>"; 
                                        }*/

                                                   
                                        echo "<td>{$user_email}</td>"; 
                                        echo "<td>{$user_role}</td>";           
                                        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";           
                                        echo "<td><a href='users.php?source=edit_user&p_id=$user_id'>Edit</a></td>";            
                                        echo "</tr>";

                                    }

                                    if(isset($_GET['delete'])){
                                        $user_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'

                                        $query = "DELETE FROM users WHERE user_id = {$user_id}";

                                        $delete_query = mysqli_query($connection, $query);

                                        header("Location: users.php");
                                    }
                                
                                ?>

                                <?php

                                    if(isset($_GET['change_to_admin'])){
                                        $user_id = $_GET['change_to_admin'];//delete refers to the href in the link 'posts.php?delete'

                                        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";

                                        $change_to_admin_query = mysqli_query($connection, $query);

                                        header("Location: users.php");
                                    }

                                    if(isset($_GET['change_to_sub'])){
                                        $user_id = $_GET['change_to_sub'];//delete refers to the href in the link 'posts.php?delete'

                                        $query = "UPDATE users SET user_role = 'subcriber' WHERE user_id = $user_id";

                                        $change_to_subscriber_query = mysqli_query($connection, $query);

                                        header("Location: users.php");
                                    }
                                
                                ?>

                            </tbody>
                        </table>