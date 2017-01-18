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
                                    <th>Edit</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                
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
                                        

                                        echo "  <tr>
                                                    <td>{$comment_id}</td>
                                                    <td>{$comment_author}</td>
                                                    <td>{$comment_content}</td>
                                                    <td>{$comment_email}</td>";

                                                    /*$query = "SELECT * FROM categories WHERE cat_id = $post_category_id";

                                                    $select_categories_id = mysqli_query($connection, $query);

                                                    while($row = mysqli_fetch_assoc($select_categories_id)){
                                                        $cat_id = $row['cat_id'];
                                                        $cat_title = $row['cat_title'];

                                                        echo "<td>{$cat_title}</td>";
                                                    }*/



                                        echo        "<td>{$comment_status}</td>
                                                    <td>{$comment_category_id}</td>
                                                    <td>{$comment_date}</td>
                                                    <td><a href='posts.php?delete=$comment_id'>Approve</a></td>
                                                    <td><a href='posts.php?source=edit_post&p_id=$comment_id'>Decline</a></td>
                                                    <td><a href='posts.php?delete=$comment_id'>Delete</a></td>
                                                    <td><a href='posts.php?source=edit_post&p_id=$comment_id'>Edit</a></td>
                                                </tr>";

                                    }

                                    if(isset($_GET['delete'])){
                                        $post_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'

                                        $query = "DELETE FROM posts WHERE post_id = {$post_id}";

                                        $delete_query = mysqli_query($connection, $query);

                                        header("Location: posts.php");
                                    }
                                
                                ?>

                            </tbody>
                        </table>