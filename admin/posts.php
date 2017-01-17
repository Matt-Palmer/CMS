<?php include "includes/admin_header.php";?>
<?php include "functions.php"; ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Administration
                            <small>Subheading</small>
                        </h1>

                        <?php 
                        
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }
                        
                            switch($source){

                                case '67':
                                include 'includes/add_post.php';
                                break;

                                case '45':
                                echo '';
                                break;

                                case '23':
                                echo '';
                                break;

                                case '98':
                                echo '';
                                break;

                                default:
                                include 'includes/view_all_posts.php';
                                break;

                            }
                        ?>
                        
                    </div>   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    

<?php include "includes/admin_footer.php";?>