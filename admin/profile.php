<?php include "includes/admin_header.php";


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM  users WHERE username = '{$username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)){

        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

    }


} ?>

<?php 

if (isset($_POST['edit_user'])) {

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

    
    
    $query = "UPDATE users SET ";
    $query .="user_firstname = '{$user_firstname}', ";
    $query .="user_lastname = '{$user_lastname}', ";
    $query .="user_role = '{$user_role}', ";
    $query .="username = '{$username}', ";
    $query .="user_email = '{$user_email}', ";
    $query .="user_password = '{$user_password}' ";
    //$query .="user_image = '{$user_image}', ";
    $query .="WHERE username = '{$username}' ";

    $update_user = mysqli_query($connection, $query);
    confirm($update_user);

}


?>


<div id="wrapper">

<!-- Navigation -->

<?php include "includes/admin_navigation.php"; ?>



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Bun venit
                        <small>Autor</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">


                        <div class="form-group">

                            <label for="post_title"> Prenume</label>
                            <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">

                        </div>

                        <div class="form-group">

                            <label for="post_status"> Nume </label>
                            <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">

                        </div>


                        <select name="user_role" id="">
                            <option value="abonat"><?php echo $user_role; ?></option>


                            <?php

                            if ($user_role == 'Admin') {
                                echo "<option value='abonat'>Abonat</option>";
                            } else {
                                echo "<option value='admin'>Admin</option>";
                            }
                            ?>





                        </select>
                        <br></br>
                        <!-- 
<div class="form-group">

    <label for="post_image"> Imagine articol</label>
    <input type="file" name="image">

</div> -->


                        <div class="form-group">

                            <label for="post_tag"> Username </label>
                            <input type="text" value="<?php echo $username ?>" class="form-control" name="username">

                        </div>


                        <div class="form-group">

                            <label for="post_content"> E-mail </label>
                            <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">


                        </div>

                        <div class="form-group">

                            <label for="post_content"> Parola </label>
                            <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">


                        </div>


                        <div class="form-group">

                            <input class="btn btn-primary" type="submit" name="edit_user" value="Actualizare profil">

                        </div>


                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>