<?php 

function displayCategories(){

    global $connection;

    $query = "SELECT * FROM categories";

    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "  <tr>
                    <td>{$cat_id}</td>
                    <td>{$cat_title}</td>
                    <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                    <td><a href='categories.php?edit={$cat_id}'>Update</a></td>
                </tr>";

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

function confirmQuery($query){

    global $connection;

    if(!$query){
        die("Query Failed" . mysqli_error($connection));
    }

}



?>