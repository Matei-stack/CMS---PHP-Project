<?php include "includes/admin_header.php";

?>


<!-- Navigation -->

<?php include "includes/admin_navigation.php"; ?>


<div id="wrapper">

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Bun venit in zona de comentarii
                        <small>Autor</small>
                    </h1>


<table class="table table-bordered table-hover">
    <thead>

        <th>Id</th>
        <th>Autor</th>
        <th>Comentariu</th>
        <th>E-mail</th>
        <th>Status</th>
        <th>Raspuns pentru</th>
        <th>Data</th>
        <th>Aprobat</th>
        <th>Neaprobat</th>
        <th>Editare</th>
        <th>Stergere</th>
        
        <?php

        $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
           



            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";

            // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            // $select_categories_id = mysqli_query($connection, $query);

            // while ($row = mysqli_fetch_assoc($select_categories_id)) {
            //     $cat_id = $row['cat_id'];
            //     $cat_title = $row['cat_title'];


            //     echo "<td>{$cat_title}</td>";
            // }


            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";

            $query= "SELECT * FROM posts WHERE post_id=$comment_post_id ";
            $select_post_id_query = mysqli_query($connection, $query);
            while($row =mysqli_fetch_assoc($select_post_id_query)){

                $post_id = $row['post_id'];
                $post_title =$row['post_title'];
                echo "<td><a href ='../post.php?p_id=$post_id'>$post_title</a></td>";


            }

          


            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Aprobare</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Respingere</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id='>Editare</a></td>";
            echo "<td><a href='post_comments.php?delete=$comment_id&id=" . $_GET['id'] ."'>Sterge</a></td>";
            
            echo "</tr>";
        }
        ?>

    </thead>


</table>

<?php

if (isset($_GET['unapprove'])) {

    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status ='Neaprobat' WHERE comment_id=$the_comment_id";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['approve'])) {

    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status ='Aprobat' WHERE comment_id=$the_comment_id";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}




if (isset($_GET['delete'])) {

    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id={$the_comment_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: post_comments.php?id=" . $_GET['id'] ."");
}

?>

</div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>