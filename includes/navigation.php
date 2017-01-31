<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 
                    
                    global $connection;
                    
                    $query = "SELECT * FROM categories";

                    $select_all_categories_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $cat_title = $row['cat_title'];

                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }
                    ?>


                    <?php
                    
                        

                    ?>


                    <?php
                    
                        if(isset($_SESSION['user_role'])){

                            if($_SESSION['user_role'] == "Admin"){

                                echo "<li><a href='admin'>Admin</a></li>";

                            }
                            if(isset($_GET['p_id'])){
                                $p_id = $_GET['p_id'];
                                echo "<li><a href='admin/posts.php?source=edit_post&p_id={$p_id}'>Edit Post</a></li>";
                            }
                        }

                    ?>



                </ul>
                <?php if(isset($_SESSION['username'])){ ?> 
                    <ul class="nav navbar-right top-nav">                    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                                <?php
                                    if(isset($_SESSION['username'])){
                                        echo ' ' . $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']; 
                                    }

                                    $session = session_id();
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="includes/logout.php?delete=<?php echo $session;?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php } ?> 
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>