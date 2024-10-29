<?php

if (isset($_POST['create_user'])) {

    //$post_id = $row['post_id'];

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');
    //$post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users (user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}' )";
    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);

    echo "<p class='bg-success'>Utilizator creat: " . "" . "<a href='users.php'>Vizualizare utilizatori</a></p>";
}

?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">

        <label for="post_title"> Prenume</label>
        <input type="text" class="form-control" name="user_firstname">

    </div>

    <div class="form-group">

        <label for="post_status"> Nume </label>
        <input type="text" class="form-control" name="user_lastname">

    </div>


    <select name="user_role" id="">


        <option value="abonat">Selectare rol</option>
        <option value="admin">Admin</option>
        <option value="abonat">Abonat</option>

    </select>
    <br></br>
    <!-- 
    <div class="form-group">

        <label for="post_image"> Imagine articol</label>
        <input type="file" name="image">

    </div> -->


    <div class="form-group">

        <label for="post_tag"> Username </label>
        <input type="text" class="form-control" name="username">

    </div>


    <div class="form-group">

        <label for="post_content"> E-mail </label>
        <input type="email" class="form-control" name="user_email">


    </div>

    <div class="form-group">

        <label for="post_content"> Parola </label>
        <input type="password" class="form-control" name="user_password">


    </div>


    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="create_user" value="Creare utilizator">

    </div>


</form>