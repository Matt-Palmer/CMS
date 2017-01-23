
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

                                <?php
                                
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

                                        echo "  <tr>
                                                    <td>{$post_id}</td>
                                                    <td>{$post_author}</td>
                                                    <td>{$post_title}</td>
                                                    <td>{$post_content}</td>";

                                                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";

                                                    $select_categories_id = mysqli_query($connection, $query);

                                                    while($row = mysqli_fetch_assoc($select_categories_id)){
                                                        $cat_id = $row['cat_id'];
                                                        $cat_title = $row['cat_title'];

                                                        echo "<td>{$cat_title}</td>";
                                                    }



                                        echo        "<td>{$post_status}</td>
                                                    <td><img src='../images/{$post_image}' width='50px' height='50px'></td>
                                                    <td>{$post_tags}</td>
                                                    <td>{$post_comment_count}</td>
                                                    <td>{$post_date}</td>
                                                    <td><a href='posts.php?delete=$post_id'>Delete</a></td>
                                                    <td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>
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