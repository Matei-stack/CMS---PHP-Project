<?php


function insert_categories()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {

            echo "Acest camp trebuie completat";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query  .= "VALUES('{$cat_title}') ";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die('Actiune esuata' . mysqli_error($connection));
            }
        }
    }
}

function gasire_categorii()
{
    global $connection;
    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo " <td>{$cat_id}</td>";
        echo " <td>{$cat_title}</td>";
        echo " <td><a href ='categories.php?delete={$cat_id}'>Stergere</a></td>";
        echo " <td><a href ='categories.php?edit={$cat_id}'>Editare</a></td>";
        echo "</tr>";
    }
}

function stergere_categorii()
{
    global $connection;
    if (isset($_GET['delete'])) {

        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function confirm($result)
{
    global $connection;
    if (!$result) {

        die("Actiune nereusita" . mysqli_error($connection));
    }
}

function redirect($location)
{
    return header(header: "Location:" . $location);
}

function online_users()
{
    
    if (isset($_GET['onlineusers'])) {

        
        global $connection;

        if (!$connection) {

            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 60;
            $time_out = $time - $time_out_in_seconds;
            $query = "SELECT * FROM users_online WHERE  session = '$session' ";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time') ");
            } else {

                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
            }
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_query);
        } // get request isset
    }
}
online_users();
