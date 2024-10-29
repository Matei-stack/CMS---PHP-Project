<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $postValueId) {


        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'Publicat':
                $query ="UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection, $query);
                break;

            case 'draft':
                $query ="UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft_status = mysqli_query($connection, $query);
                break;

            case 'delete':
                $query ="DELETE FROM posts WHERE post_id = {$postValueId} ";
                $delete_posts = mysqli_query($connection, $query);
                break;
             case 'copie':
                $query ="SELECT * FROM posts WHERE post_id = {$postValueId} ";
                $select_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_posts_query)){
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tag = $row['post_tag'];
                    $post_content = $row['post_content'];
                  
                
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_status) ";
                $query .="VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tag}','{$post_status}' )";
                $copy_query = mysqli_query($connection, $query);
                if(!$copy_query){
                    die("Actiune nereusita" . mysqli_error($connection));
                }

                break;
        }
    }
}

?>



<form action="" method='post'>


    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">

                <option value="">Selectare optiune </option>
                <option value="Publicat">Publicare </option>
                <option value="draft">Draft </option>
                <option value="delete">Stergere </option>
                <option value="copie">Copiere </option>


            </select>


        </div>
        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Aplicare">
            <a class="btn btn-primary" href="posts.php?source=add_post">Adaugare articol nou</a>

        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Autor</th>
                <th>Titlu</th>
                <th>Categorie</th>
                <th>Status</th>
                <th>Imagine</th>
                <th>Tag-uri</th>
                <th>Comentarii</th>
                <th>Data</th>
                <th>Vizualizari</th>
                <th>Vizualizare</th>
                <th>Editare</th>
                <th>Stergere</th>
                <th>Stergere vizualizari</th>
                
            </tr>
            <?php

            $query = "SELECT * FROM posts ORDER BY post_id DESC ";
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tag = $row['post_tag'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];


                echo "<tr>";

            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;  ?>'></td>

            <?php

                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];


                    echo "<td>{$cat_title}</td>";
                }


                echo "<td>$post_status</td>";
                echo "<td><img width = '150' src = '../images/$post_image' alt = 'imagine'></td>";
                echo "<td>$post_tag</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($send_comment_query)) {
                    $comment_id = $row['comment_id'];
                }
                $count_comments = mysqli_num_rows($send_comment_query);
                echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";



                echo "<td>$post_date</td>";
                echo "<td>{$post_views_count}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>Vizualizare</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Editare</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Esti sigur ca vrei sa stergi accest articol?'); \"href='posts.php?delete={$post_id}'>Sterge</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Esti sigur ca vrei sa stergi vizualizarile acestui articol?'); \"href='posts.php?delete_views={$post_id}'>Sterge vizualizari</a></td>";
                
                echo "</tr>";
            }
            ?>

        </thead>


    </table>

    <?php

    if (isset($_GET['delete'])) {

        $the_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php"); //refresh automat dupa stergere
    }
//Cod cod cod 
    if (isset($_GET['delete_views'])) {

        $the_post_id = $_GET['delete_views'];

        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id={$the_post_id}";
        $delete_views_query = mysqli_query($connection, $query);
        header("Location: posts.php"); //refresh automat dupa stergere
    }

    ?>
</form>