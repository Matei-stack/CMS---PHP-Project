<?php

if(isset($_POST['create_post'])){

    //$post_id = $row['post_id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp= $_FILES['image']['tmp_name'];

    $post_tag = $_POST['post_tag'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    //$post_comment_count = 4;


    move_uploaded_file($post_image_temp, "../images/$post_image" );

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_status) ";
    $query .="VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tag}','{$post_status}' )";
    $create_post_query = mysqli_query($connection, $query);

    confirm($create_post_query);

    echo "<p class='bg-success'> Articol creat: " . "" . "<a href='posts.php'>Vizualizare articol</a></p>";
}

?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">

        <label for="title">Titlu articol</label>
        <input type="text" class="form-control" name="title">

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
        <input type="text" class="form-control" name="author">

    </div>


    <div class="form-group">

        <label for="post_status"> Status articol</label>
<br>
        <select name="post_status" id="">

        <option value="draft">Selectare optiune</option>
        <option value="Publicat">Publcare</option>
        <option value="draft">Draft</option>
        
        </select>
        

    </div>

    <div class="form-group">

<label for="post_image"> Imagine articol</label>
<input type="file" name="image">

</div>


<div class="form-group">

<label for="post_tag"> Tag articol</label>
<input type="text" class="form-control" name="post_tag">

</div>


<div class="form-group">

<label for="summernote"> Continut articol</label>
<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10">
</textarea>

</div>


<div class="form-group">

<input class="btn btn-primary" type="submit" name="create_post" value="Publicare articol">

</div>


</form>