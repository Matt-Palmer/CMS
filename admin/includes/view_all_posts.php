<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Post ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
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
                                                    <td>{$post_category_id}</td>
                                                    <td>{$post_status}</td>
                                                    <td><img src='../images/{$post_image}' width='50px' height='50px'></td>
                                                    <td>{$post_tags}</td>
                                                    <td>{$post_comment_count}</td>
                                                    <td>{$post_date}</td>
                                                </tr>";

                                    }
                                
                                ?>

                            </tbody>
                        </table>