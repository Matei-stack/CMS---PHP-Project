<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {


        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);


        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
        if (!$select_randsalt_query) {

            die("a esuat" . mysqli_error($connection));
        }



        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";

        $hashF_and_salt = $hashFormat . $salt;

        $password = crypt($password, $hashF_and_salt);


        $query = "INSERT INTO users (username, user_email, user_password, user_role)";
        $query .= "VALUES ('{$username}','{$email}','{$password}', 'abonat')";
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query) {
            die("Actiune esuata " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }

        $message = "Inregistrarea ta a fost procesata. ";
    } else {

        $message = "Toate campurile trebuie completate";
    }
} else {

    $message = "";
}

?>
<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Inregistrare</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center"><?php echo $message; ?></h6>

                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Introduceti numele de utilizator">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="exemplu@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Parola">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Inregistrare">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>