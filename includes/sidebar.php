<div class="col-md-4">

<?php if(!isset($_SESSION['username'])){ ?> 
                <!-- Login -->
                <div class="well">
                    <h4>Blog Search</h4>
                    
                    
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter your Username">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter your Password">
                        </div>

                        <div class="form-group">
                            <input name="login" type="submit" class="btn btn-primary" value="Login">
                            <a name="logout" type="submit" class="btn btn-default" href="includes/logout.php?delete=<?php echo $session = session_id();?>">Log Out</a>
                        </div>

                        
                        

                    </form>
                    <!-- /.input-group -->
                </div>
<?php } ?> 

                <!-- Blog Search Well -->
                <div class="well">
                    <?php echo $_SESSION['user_role'];?>
                    <h4>Blog Search</h4>

                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">

                    <?php 
                    
                    $query = "SELECT * FROM categories";

                    $select_categories_sidebar = mysqli_query($connection, $query);
                    
                   
                    
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                                <?php 
                                
                                 while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];

                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                }
                                
                                ?>
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>