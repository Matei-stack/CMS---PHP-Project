<?php session_start(); ?>
<?php

include "includes/header.php";
include "includes/db.php";

?>


<body>

    <!-- Navigation -->

    <?php

    include "includes/navigation.php";

    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php


                if (isset($_GET['p_id'])) {

                    $the_post_id = $_GET['p_id'];

                    $view_query ="UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id =$the_post_id ";
                    $send_query =mysqli_query($connection, $view_query);
                    if(!$send_query){
                        die("Actiune nereusita");
                    }


                    $query = "SELECT * FROM posts WHERE post_id=$the_post_id ";
                    $select_all_posts_query = mysqli_query($connection, $query);



                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];


                ?>

                     
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"> <?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img width="900" height="300" class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>


                        <hr>


                <?php

                    }
                } else {

                    header("Location: index.php");
                }


                ?>




                <!-- Blog Comments -->
                <?php

                if (isset($_POST['create_comment'])) {
                    $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {


                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'neaprobat', now())";

                        $create_comment_query = mysqli_query($connection, $query);
                        if (!$create_comment_query) {
                            die('ACtiune esuata' . mysqli_error($connection));
                        }

                        // $query = "UPDATE posts SET post_comment_count= post_comment_count + 1 ";
                        // $query .= "WHERE post_id=$the_post_id ";
                        // $update_comment_count = mysqli_query($connection, $query);
                    } else {

                        echo "<script>alert('Campurile nu pot fi necompletate')</script>";
                    }
                    //redirect(location: "/cms/post.php?p_id=$the_post_id");
                    header("location: /cms/post.php?p_id=$the_post_id ");
                }

                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Lasa un comentariu:</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                            <label for="Author">Autor</label>
                            <input type="text" name="comment_author" placeholder="John Smith" class="form-control" name="comment_author">

                        </div>
                        <div class="form-group">
                            <label for="Email">E-mail</label>
                            <input type="email" name="comment_email" placeholder="ceva@gmail.com" class="form-control" name="comment_email">

                        </div>
                        <div class="form-group">
                            <label for="Comment">Comentariul tau</label>
                            <textarea placeholder="continut" name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Trimite</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


                <?php


                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'Aprobat' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);

                if (!$select_comment_query) {
                    die('Actiune esuata' . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_array($select_comment_query)) {

                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                ?>

                    <!-- Comment -->


                    <div class="media">




                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>



                <?php   } ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php

            include "includes/sidebar.php";

            ?>

        </div>
        <!-- /.row -->

        <hr>
        <!-- Footer -->


        </html>
        <?php

        include "includes/footer.php";

        ?>