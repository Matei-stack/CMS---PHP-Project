<?php

if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);


while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tag = $row['post_tag'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}

if (isset($_POST['update_post'])) {

    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tag = $_POST['post_tag'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tag = '{$post_tag}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";


    $update_post = mysqli_query($connection, $query);
    confirm($update_post);

    echo "<p class='bg-success'>Articol editat: " . "" . "<a href='../post.php?p_id={$the_post_id}'>Vizualizare articol</a> sau <a href= 'posts.php'> Editeaza alte articole </a></p>";
}

?>




<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">

        <label for="title">Titlu articol</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">

    </div>


    <div class="form-group">

        <select name="post_category" id="post_category">

            <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirm($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>


        </select>

    </div>


    <div class="form-group">

        <label for="post_title"> Autor articol</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">

    </div>

    <div class="form-group">
    <label for="post_image"> Status articol</label>
    <br>
        <select name="post_status" id="">

            <option value='<?php $post_status ?>'><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'Publicat') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='Publicat'>Publicat</option>";
            }
            ?>
        </select>

    </div>

    <div class="form-group">

        <label for="post_image"> Imagine articol</label>
        <input type="file" name="image">

        <img width="250" src="../images/<?php echo $post_image; ?>" alt="">

    </div>


    <div class="form-group">

        <label for="post_tag"> Tag articol</label>
        <input value="<?php echo $post_tag; ?>" type="text" class="form-control" name="post_tag">

    </div>


    <div class="form-group">

        <label for="post_content"> Continut articol</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>

    </div>


    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="update_post" value="Editare articol">

    </div>


</form>