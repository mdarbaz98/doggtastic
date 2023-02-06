<?php include('../include/db.php');
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);

    if($_POST['btn']=="addBlog")
        {
             $content="";
            if(isset($_POST['content'])){
                $content = trim_data($_POST['content']);
            }else{
                $content="";
            }
            $title="";
            if(isset($_POST['blog_title'])){
                $title = trim_data($_POST['blog_title']);
            }
            else{
                $title="";
            }
            $seo_title="";
            if(isset($_POST['blog_title_seo'])){
                $seo_title = trim_data($_POST['blog_title_seo']);
            }
            else{
                $seo_title="";
            }
            $blog_slug="";
            if(isset($_POST['blog_slug'])){
                $blog_slug = strtolower(str_replace(" ","-",$_POST['blog_slug']));
            }
            else{
                $blog_slug="";
            }
            $meta_desc="";
            if(isset($_POST['meta_desc'])){
                $meta_desc = trim_data($_POST['meta_desc']);
            }
            else{
                $meta_desc="";
            }
            $author_name="";
            if(isset($_POST['author_name'])) {
                $author_name = ($_POST['author_name']);
            }
            $author_values="";
            if(!empty($author_name)){
                $author_values  = implode(",",$author_name);            
            }
            else{
                 $author_values = "0";
            }

            $review="";
            if(isset($_POST['review'])){
            $review = ($_POST['review']);
            }
                $review_value="";
                if(!empty($review)){
                    $review_value  = implode(",",$review);            
                }
                else{
                    $review_value = "0";
                }

            if(isset($_POST['bot_robot'])){
                $bot_robot = ($_POST['bot_robot']);
            }
            $bot_robot_value="";
            if(!empty($bot_robot)){
                $bot_robot_value  = implode(", ",$bot_robot);            
            }
            else{
                $bot_robot_value = "0";
            }
            if(isset($_POST['max_snippet'])){
                $max_snippet = $_POST['max_snippet'];
            }
            else{
                 $max_snippet = "max-snippet:";
            }
            if(isset($_POST['max_video'])){
            $max_video =($_POST['max_video']);
            }
            else{
                $max_video = "max-video:";
            }

            if(isset($_POST['max_image'])){
            $max_image=$_POST['max_image'];
            }
            else{
                $max_image="max-image:";
            }
                $max_snippet_value =$_POST['max_snippet_value'];   
                $concat_snippet = $max_snippet.$max_snippet_value;
                $max_video_value =$_POST['max_video_value'];
                $concat_video = $max_video.$max_video_value;    
                $max_image_value =$_POST['max_image_value'];
                $concat_image = $max_image.$max_image_value;

                $advance_bot = $bot_robot_value.", ".$concat_snippet.", ".$concat_video.", ".$concat_image;
                
                $focus_key="";
                if(isset($_POST['focus_keyword'])){
                    $focus_key=trim_data($_POST['focus_keyword']);
                }
                else{
                    $focus_key="";
                }

                $category="";
                if(isset($_POST['category'])){
                    $category = trim_data($_POST['category']);
                }
                else{
                    $category="";
                }
                $sub_category="";
                if(isset($_POST['sub_category'])){
                $sub_category = trim_data($_POST['sub_category']);
                }
                $sub_category_value="";
                if(!empty($sub_category)){
                    $sub_category_value  = implode(",",$sub_category);            
                }
                else{
                    $sub_category_value="";
                }

                $draft=0;
                if(isset($_POST['draft'])){
                    $draft = $_POST['draft'];
                }
                else{
                    $draft = 0;
                }
                $message="";
                if(isset($_POST['message'])){
                    $message = trim_data($_POST['message']);
                }
                else{
                    $message="";
                }
                $filename="";
                if(isset($_FILES["img"]["name"])){
                    $filename = trim_data($_FILES["img"]["name"]);
                    $tempname = $_FILES["img"]["tmp_name"];
                }
                else{
                    $filename="";
                }
                $img_alt="";
                if(isset($_POST['img_alt'])){
                    $img_alt = trim_data($_POST['img_alt']);
                }
                else{
                    $img_alt="";
                }
                $img_title="";
                if(isset($_POST['img_title'])){
                    $img_title = trim_data($_POST['img_title']);
                }
                else{
                    $img_title="";
                }
                $blogPostDate="";
                if(isset($_POST['blogPostDate'])){
                    $blogPostDate = date("Y-m-d H:i", strtotime($_POST['blogPostDate']));
                    // $blogPostDate = trim_data($_POST['blogPostDate']);
                }
                else{
                    $blogPostDate="";
                }
                $folder = "../assets/upload/".$filename;
                if (move_uploaded_file($tempname, $folder))
                {
                    //$msg = "Image uploaded successfully";
                }
                
                
                
                $sql ="INSERT INTO `blog`(`blog_id`, `post_author`, `post_review`, `post_content`, `post_title`, `post_name`, `parent_category`, `category`, `description`, `featured_image`, `img_alt`, `img_title`, `title_slug`, `slug_title`, `focus_keyword`, `meta_desc`, `bot_meta_data`, `PostDate`, `status`) 
                    VALUES (0,'$author_values','$review_value',?,'$title','$title','$category','$sub_category_value','$message','$filename','$img_alt','$img_title','$seo_title','$blog_slug','$focus_key','$meta_desc','$advance_bot','$blogPostDate',$draft)";

                    $stmt1 = $conn->prepare($sql);
                    if($stmt1->execute([$content]))
                    {
                        $last_blog_id = $conn->lastInsertId();
                        $sql1 = "UPDATE `blog` SET `blog_id`='$last_blog_id' WHERE id='$last_blog_id'";
                        $stmt2 = $conn->prepare($sql1);
                        if($stmt2->execute()){
                                echo "inserted";
                                }   
                    }
        }//add blog end
                        
                   

                
            
    // trash blog id
        if($_POST['btn']=="blog_id_trash")
        {

            $blog_id = $_POST['blog_id_trash'];
            $sql=$conn->prepare("UPDATE `blog` SET `status`='1' WHERE `id`=?");            
            $sql->execute([$blog_id]);
            echo "Trashed";
           
        }

    // blog permenant delete

        if($_POST['btn']=="blogPermenetDelete_id")
        {
            $blogPermenetDelete = $_POST['blogPermenetDelete_id'];
            $sql=$conn->prepare("DELETE FROM `blog` WHERE `id`=?");            
            $sql->execute([$blogPermenetDelete]);
            echo "Deleted";
           
        }

        // blog restore data
        if($_POST['btn']=="blog_id_restore")
        {
           $blog_id_restore = $_POST['blog_id_restore'];
           $sql=$conn->prepare("UPDATE `blog` SET `status`='0' WHERE `id`=?");            
           $sql->execute([$blog_id_restore]);
            echo "Restored";
                    
        }

            // blog upload data
            if($_POST['btn']=="blogUploadRows_id")
            {
                $blogUploadRows_id = $_POST['blogUploadRows_id'];
                $sql=$conn->prepare("UPDATE `blog` SET `status`='0' WHERE `id`=?");            
                $sql->execute([$blogUploadRows_id]);
                echo "Uploaded";
             
            }
            
        // trash quotes data
        if($_POST['btn']=="quotesTrashRows_id")
        {

            $quotesTrashRows_id = $_POST['quotesTrashRows_id'];
            $sql=$conn->prepare("UPDATE `quotes` SET `status`='1' WHERE `id`=?");            
            $sql->execute([$quotesTrashRows_id]);
            echo "Trashed";
         
        }

                // permanent delete quotes data
                if($_POST['btn']=="quotesPermenetDelete_id")
                {
        
                    $quotesPermenetDelete_id = $_POST['quotesPermenetDelete_id'];
                    $sql=$conn->prepare("DELETE FROM `quotes` WHERE `id`=?");            
                    $sql->execute([$quotesPermenetDelete_id]);
                    echo "Deleted";
                 
                }

    //page trash here
    
        if($_POST['btn']=="page_id_trash")
        {

            $page_id = $_POST['page_id_trash'];
            $sql=$conn->prepare("UPDATE `page` SET `status`='1' WHERE `id`=?");            
            $sql->execute([$page_id]);
            echo "Trashed";
           
        }
        
        // page restore data
        if($_POST['btn']=="page_id_restore")
        {
           $page_id_restore = $_POST['page_id_restore'];
           $sql=$conn->prepare("UPDATE `page` SET `status`='0' WHERE `id`=?");            
           $sql->execute([$page_id_restore]);
            echo "Restored";
                    
        }
        // author trash
        if($_POST['btn']=="authorTrashRow_id")
        {

            $author_id = $_POST['authorTrashRow_id'];
            $sql=$conn->prepare("UPDATE `author` SET `status`='1' WHERE `id`=?");            
            $sql->execute([$author_id]);
            echo "Trashed";
           
        }
        // author restore
        if($_POST['btn']=="authorRestoreRows_id")
        {  
           $authorRestoreRows_id = $_POST['authorRestoreRows_id'];
           $sql=$conn->prepare("UPDATE `author` SET `status`='0' WHERE `id`=?");            
           $sql->execute([$authorRestoreRows_id]);
           echo "Restored";
        }
        
        if($_POST['btn']=="deleteAuthor_id")
        {
        $deleteAuthor_id = $_POST['deleteAuthor_id'];
        $sql=$conn->prepare("DELETE FROM `author` WHERE `id`=?");            
        $sql->execute([$deleteAuthor_id]);
        echo "Deleted";
    }
    
            if($_POST['btn']=="imageDelete_id")
            {
                $id = $_POST['imageDelete_id'];
                $selectAuthor=$conn->prepare("SELECT * FROM author WHERE id = '$id'");
                $selectAuthor->execute();
                while($row=$selectAuthor->fetch(PDO::FETCH_ASSOC)){
                    $filename = $row['image'];
                    $path = '../assets/upload/authorProfile/'.$filename;
                    if(file_exists($path)) {
                        unlink($path);
                        $sql=$conn->prepare("UPDATE `author` SET `image`='' WHERE `id`=?");            
                        $sql->execute([$id]);
                        echo "Updated";
                        } 
                  
                }
        }
        
            if($_POST['btn']=="imageblogDelete_id")
            {
                $id = $_POST['imageblogDelete_id'];
                $selectAuthor=$conn->prepare("SELECT * FROM blog WHERE id = '$id'");
                $selectAuthor->execute();
                while($row=$selectAuthor->fetch(PDO::FETCH_ASSOC)){
                    $filename = $row['featured_image'];
                    $path = '../assets/upload/'.$filename;
                    if(file_exists($path)) {
                        unlink($path);
                        $sql=$conn->prepare("UPDATE `blog` SET `featured_image`='' WHERE `id`=?");            
                        $sql->execute([$id]);
                        echo "Updated";
                        } 
                  
                }
            }
            
            if($_POST['btn']=="imagepageDelete_id")
            {
                $id = $_POST['imagepageDelete_id'];
                $selectAuthor=$conn->prepare("SELECT * FROM page WHERE id = '$id'");
                $selectAuthor->execute();
                while($row=$selectAuthor->fetch(PDO::FETCH_ASSOC)){
                    $filename = $row['featured_image'];
                    $path = '../assets/upload/'.$filename;
                    if(file_exists($path)) {
                        unlink($path);
                        $sql=$conn->prepare("UPDATE `page` SET `featured_image`='' WHERE `id`=?");            
                        $sql->execute([$id]);
                        echo "Updated";
                        } 
                  
                }
            }
            if($_POST['btn']=="imagequoteDelete_id")
            {
                $id = $_POST['imagequoteDelete_id'];
                $selectAuthor=$conn->prepare("SELECT * FROM quotes WHERE id = '$id'");
                $selectAuthor->execute();
                while($row=$selectAuthor->fetch(PDO::FETCH_ASSOC)){
                    $filename = $row['image'];
                    $path = '../assets/upload/quotes/'.$filename;
                    if(file_exists($path)) {
                        unlink($path);
                        $sql=$conn->prepare("UPDATE `quotes` SET `image`='' WHERE `id`=?");            
                        $sql->execute([$id]);
                        echo "Updated";
                        } 
                  
                }
            }
            
        if($_POST['btn']=="imagequoteDataDelete_id")
            {
                $id = $_POST['imagequoteDataDelete_id'];
                $selectAuthor=$conn->prepare("SELECT * FROM quotes_data WHERE id = '$id'");
                $selectAuthor->execute();
                while($row=$selectAuthor->fetch(PDO::FETCH_ASSOC)){
                    $filename = $row['author_image'];
                    $path = '../assets/upload/quotes/'.$filename;
                    if(file_exists($path)) {
                        unlink($path);
                        $sql=$conn->prepare("UPDATE `quotes_data` SET `author_image`='' WHERE `id`=?");            
                        $sql->execute([$id]);
                        echo "Updated";
                        } 
                  
                }
            }
            
            if($_POST['btn']=="commentCheckid")
            {
                        $status = $_POST['commentVal'];    
                        $id = $_POST['commentCheckid'];
                        $sql=$conn->prepare("UPDATE `tbl_comment` SET `status`=? WHERE `comment_id`=?");            
                        $sql->execute([$status, $id]);
                        echo "updated";
            }
            
            

// Category Delete here 

if($_POST['btn']=="deleteCategory_id")
{

    $deleteCategory_id = $_POST['deleteCategory_id'];
    $sql=$conn->prepare("DELETE FROM `categories` WHERE `id`=?");            
    $sql->execute([$deleteCategory_id]);
    echo "Deleted";
 
}
// Quotes Category Delete here 

if($_POST['btn']=="deletequotesCategory_id")
{

    $deletequotesCategory_id = $_POST['deletequotesCategory_id'];
    $sql=$conn->prepare("DELETE FROM `quotescat` WHERE `id`=?");            
    $sql->execute([$deletequotesCategory_id]);
    echo "Deleted";
 
}


        // quotes restore
        if($_POST['btn']=="quoteRestoreRows_id")
        {
            $quoteRestoreRows_id = $_POST['quoteRestoreRows_id'];
            $sql=$conn->prepare("UPDATE `quotes` SET `status`='0' WHERE `id`=?");            
            $sql->execute([$quoteRestoreRows_id]);
            echo "Restored";
            
        }
        // quotes upload draft data

        
        if($_POST['btn']=="uploadDraftdata_id")
        {
            $uploadDraftdata_id = $_POST['uploadDraftdata_id'];
            $sql=$conn->prepare("UPDATE `quotes` SET `status`='0' WHERE `id`=?");            
            $sql->execute([$uploadDraftdata_id]);
            echo "Uploaded";
        
        }

        
        if($_POST['btn']=="addCategory")
    {
        $cat="";
        if(isset($_POST['cat'])){
            $cat = trim_data($_POST['cat']);
        }
        $cat_slug="";
        if(isset($_POST['cat_slug'])){
            $cat_slug = trim_data($_POST['cat_slug']);
        }
        $cat_desc="";
        if(isset($_POST['description'])){
            $cat_desc = trim_data($_POST['description']);
        }
        $cat_title="";
        if(isset($_POST['cat_title'])){
            $cat_title = trim_data($_POST['cat_title']);
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        
        $parent_cat="";
        if(isset($_POST['parent_cat'])){
            $parent_cat = $_POST['parent_cat'];
        }
        // if($parent_cat==0){
            
        // }
        
        
         $sql = "INSERT INTO `categories`
        (`cat_id`, `cat_name`, `cat_slug`, `cat_desc`, `cat_title`, `meta_desc`, `status`)
        VALUES ('0','$cat','$cat_slug','$cat_desc',
        '$cat_title','$meta_desc','$parent_cat')";

        $stmt = $conn->prepare($sql);
        if($stmt->execute()){

            $last_id = $conn->lastInsertId();
            if(!empty($last_id))
            {
                $sql = "UPDATE `categories` SET `cat_id`='$last_id' WHERE id='$last_id'";
                $stmt = $conn->prepare($sql);
                if($stmt->execute()){
                echo "inserted";
            }
        }
    }

  
}
        if($_POST['btn']=="updateCategory")
        {
        $cat_id="";
        if(isset($_POST['cat_id'])){
            $cat_id = $_POST['cat_id'];
        }
        
        $cat="";
        if(isset($_POST['cat'])){
            $cat = trim_data($_POST['cat']);
        }
        $cat_slug="";
        if(isset($_POST['cat_slug'])){
            $cat_slug = trim_data($_POST['cat_slug']);
        }
        $cat_desc="";
        if(isset($_POST['description'])){
            $cat_desc = trim_data($_POST['description']);
        }
        $cat_title="";
        if(isset($_POST['cat_title'])){
            $cat_title = trim_data($_POST['cat_title']);
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        
        $parent_cat="";
        if(isset($_POST['parent_cat'])){
            $parent_cat = $_POST['parent_cat'];
        }
        
        $sql = "UPDATE `categories` SET `cat_name`='$cat',`cat_slug`='$cat_slug',`cat_desc`='$cat_desc',`cat_title`='$cat_title',`meta_desc`='$meta_desc',`status`='$parent_cat' WHERE `id`='$cat_id'";

        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
        echo "updated";
        }
    
    }



        if($_POST['btn']=="addQuotescategory")
    {
        $cat="";
        if(isset($_POST['cat'])){
            $cat = trim_data($_POST['cat']);
        }
        $cat_slug="";
        if(isset($_POST['cat_slug'])){
            $cat_slug = trim_data($_POST['cat_slug']);
        }
        $cat_desc="";
        if(isset($_POST['description'])){
            $cat_desc = trim_data($_POST['description']);
        }
        $cat_title="";
        if(isset($_POST['cat_title'])){
            $cat_title = trim_data($_POST['cat_title']);
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        
         $sql = "INSERT INTO `quotescat`(`categoryName`, `slug`, `title`, `meta_desc`, `description`, `status`)
         VALUES('$cat','$cat_slug','$cat_title','$meta_desc','$cat_desc',1)";

        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
        echo "inserted";

        }
    }
        
        if($_POST['btn']=="updateQuotescategory")
        {
            $cat_id="";
            if(isset($_POST['cat_id'])){
                $cat_id = $_POST['cat_id'];
            }
            $cat="";
            if(isset($_POST['cat'])){
                $cat = trim_data($_POST['cat']);
            }
            $cat_slug="";
            if(isset($_POST['cat_slug'])){
                $cat_slug = trim_data($_POST['cat_slug']);
            }
            $cat_desc="";
            if(isset($_POST['description'])){
                $cat_desc = trim_data($_POST['description']);
            }
            $cat_title="";
            if(isset($_POST['cat_title'])){
                $cat_title = trim_data($_POST['cat_title']);
            }
            $meta_desc="";
            if(isset($_POST['meta_desc'])){
                $meta_desc = trim_data($_POST['meta_desc']);
            }
        
        
        
        $sql = "UPDATE `quotescat` SET `categoryName`='$cat',`slug`='$cat_slug',`title`='$cat_title',`meta_desc`='$meta_desc',`description`='$cat_desc',`status`=1 WHERE `id`='$cat_id'";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
        echo "updated";
        }
    
    }
        
        
        if($_POST['btn']=="addQuotes")
        {
            $title="";
            if(isset($_POST['quote_title'])){
                $title = trim_data($_POST['quote_title']);
            }
            else{
                $title="";
            }
            $seo_title="";
            if(isset($_POST['quote_title_seo'])){
                $seo_title = trim_data($_POST['quote_title_seo']);
            }
            else{
                $seo_title="";
            }

            $slug="";
            if(isset($_POST['quote_slug'])){
                $slug = strtolower(str_replace(" ","-",$_POST['quote_slug']));
            }
            else{
                $slug="";
            }

            $meta_desc="";
            if(isset($_POST['meta_desc'])){
                $meta_desc = trim_data($_POST['meta_desc']);
            }
            else{
                $meta_desc="";
            }

            $content="";
            if(isset($_POST['content'])){
                $content =$_POST['content'];
            }
            else{
                 $content="";
            }
           

            if(isset($_POST['bot_robot'])){
            $bot_robot = ($_POST['bot_robot']);
            }
            $bot_robot_value="";
            if(!empty($bot_robot)){
                $bot_robot_value  = implode(", ",$bot_robot);            
            }
            else{
                $bot_robot_value = "0";
            }
            if(isset($_POST['max_snippet'])){
                $max_snippet = $_POST['max_snippet'];
            }
            else{
                 $max_snippet = "max-snippet:";
            }
            if(isset($_POST['max_video'])){
            $max_video =($_POST['max_video']);
            }
            else{
                $max_video = "max-video:";
            }

            if(isset($_POST['max_image'])){
            $max_image=$_POST['max_image'];
            }
            else{
                $max_image="max-image:";
            }
                $max_snippet_value =$_POST['max_snippet_value'];   
                $concat_snippet = $max_snippet.$max_snippet_value;
                $max_video_value =$_POST['max_video_value'];
                $concat_video = $max_video.$max_video_value;    
                $max_image_value =$_POST['max_image_value'];
                $concat_image = $max_image.$max_image_value;
                $advance_bot = $bot_robot_value.", ".$concat_snippet.", ".$concat_video.", ".$concat_image;
                $content=trim_data($_POST['content']);
                $focus_key=trim_data($_POST['focus_keyword']);
                $category = trim_data($_POST['category']);


                $message="";
                if(isset($_POST['message'])){
                    $message = trim_data($_POST['message']);
                }
                else{
                    $message="";
                }
                $filename="";
                if(isset($_FILES["img"]["name"])){
                    $filename = $_FILES["img"]["name"];
                    $tempname = $_FILES["img"]["tmp_name"];
                    $folder = "../assets/upload/quotes/".$filename;
                    if (move_uploaded_file($tempname, $folder))
                    {
                        //$msg = "Image uploaded successfully";
                    }     
                }
                else{
                    $filename="";
                }
                $img_alt="";
                if(isset($_POST['img_alt'])){
                    $img_alt = trim_data($_POST['img_alt']);
                }
                else{
                    $img_alt="";
                }
                $img_title="";
                if(isset($_POST['img_title'])){
                    $img_title = trim_data($_POST['img_title']);
                }
                else{
                    $img_title="";
                }

                $draft=0;
                if(isset($_POST['draft'])){
                    $draft = $_POST['draft'];
                }
                else{
                    $draft = 0;
                }
   

        $sql ="INSERT INTO `quotes`(`title`, `cat_id`, `content`, `image`, `seo_title`, `slug`, `focus_keyword`, `meta_desc`, `img_alt`, `img_title`, `rank_math_bot`, `quotes_desc`, `status`) VALUES
        ('$title','$category','$content','$filename','$seo_title','$slug','$focus_key','$meta_desc','$img_alt','$img_title','$advance_bot','$message',$draft)";

                    $stmt_quotes = $conn->prepare($sql);
                    if($stmt_quotes->execute())
                    {

                        $last_quote_id = $conn->lastInsertId();
                        if(!empty($last_quote_id)){
                
                            $totalAuthor = count($_POST['authorname']);
                            for($i=0;$i<$totalAuthor;$i++){
                                    $name = trim_data($_POST['authorname'][$i]);
                                    $image_alt = trim_data($_POST['image_alt'][$i]);
                                    $content = trim_data($_POST['quote'][$i]);
                                    $image = $_FILES["author_image"]["name"][$i];
                                    $image_temp = $_FILES["author_image"]["tmp_name"][$i];
                
                                    $folder_author = "../assets/upload/quotes/".$image;
                                    if (move_uploaded_file($image_temp, $folder_author))
                                    {
                                        //$msg = "Image uploaded successfully author";
                                    }
                                    $sql = "INSERT INTO `quotes_data`(`quotes_id`, `author_name`, `author_content`, `author_image`,`alt_image`) 
                                    VALUES ('$last_quote_id','$name','$content','$image','$image_alt')";
                                    $stmt = $conn->prepare($sql);
                                    if($stmt->execute()){
                                    echo "inserted";              
                                    }
                                }
                        }
                      
                    }
                     
        }
        //add quotes end

        // edit quotes start here 
        if($_POST['btn']=="editQuotes")
        {

            $title="";
            if(isset($_POST['quote_title'])){
                $title = trim_data($_POST['quote_title']);
            }
            else{
                $title="";
            }
            $seo_title="";
            if(isset($_POST['quote_title_seo'])){
                $seo_title = trim_data($_POST['quote_title_seo']);
            }
            else{
                $seo_title="";
            }

            $slug="";
            if(isset($_POST['quote_slug'])){
                $slug = strtolower(str_replace(" ","-",$_POST['quote_slug']));
            }
            else{
                $slug="";
            }

            $meta_desc="";
            if(isset($_POST['meta_desc'])){
                $meta_desc = trim_data($_POST['meta_desc']);
            }
            else{
                $meta_desc="";
            }

            $content="";
            if(isset($_POST['content'])){
                $content = $_POST['content'];
            }
            else{
                $content="";
            }

            $focus_key="";
            if(isset($_POST['focus_keyword'])){
                $focus_key = trim_data($_POST['focus_keyword']);
            }
            else{
                $focus_key="";
            }
            $category="";
            if(isset($_POST['category'])){
                $category = trim_data($_POST['category']);
            }
            else{
                $category="";
            }

            $img_path="";
            if(isset($_POST['img_path_old'])){
                $img_path = $_POST['img_path_old'];
            }
            else{
                $img_path="";
            }

            if(isset($_POST['quotes_id'])){
                $quotes_id = $_POST['quotes_id'];
            }
            if(isset($_POST['bot_robot'])){
            $bot_robot = ($_POST['bot_robot']);
            }
            $bot_robot_value="";
            if(!empty($bot_robot)){
                $bot_robot_value  = implode(", ",$bot_robot);            
            }
            else{
                $bot_robot_value = "0";
            }
            if(isset($_POST['max_snippet'])){
                $max_snippet = $_POST['max_snippet'];
            }
            else{
                 $max_snippet = "max-snippet:";
            }
            if(isset($_POST['max_video'])){
            $max_video =($_POST['max_video']);
            }
            else{
                $max_video = "max-video:";
            }

            if(isset($_POST['max_image'])){
            $max_image=$_POST['max_image'];
            }
            else{
                $max_image="max-image:";
            }
                $max_snippet_value =$_POST['max_snippet_value'];   
                $concat_snippet = $max_snippet.$max_snippet_value;
                $max_video_value =$_POST['max_video_value'];
                $concat_video = $max_video.$max_video_value;    
                $max_image_value =$_POST['max_image_value'];
                $concat_image = $max_image.$max_image_value;
                $advance_bot = $bot_robot_value.", ".$concat_snippet.", ".$concat_video.", ".$concat_image;
              
              
                $draft=0;
                if(isset($_POST['draft'])){
                    $draft = $_POST['draft'];
                }
                else{
                    $draft = 0;
                }
                $message="";
                if(isset($_POST['message'])){
                    $message = trim_data($_POST['message']);
                }
                else{
                    $message="";
                }
                $img_alt="";
                if(isset($_POST['img_alt'])){
                    $img_alt = trim_data($_POST['img_alt']);
                }
                else{
                    $img_alt="";
                }
                $img_title="";
                if(isset($_POST['img_title'])){
                    $img_title = trim_data($_POST['img_title']);
                }
                else{
                    $img_title="";
                }
                $old_img_path="";
                if(isset($_FILES["img"]["name"])){    
                    $old_img_path = $_FILES["img"]["name"];
                    $tempname = $_FILES["img"]["tmp_name"];
                   }
                   else
                   {
                    $old_img_path="";
                   }

                   if(empty($old_img_path)){
                       $old_img_path = $img_path;
                   }
                   else
                   {
                       $folder = "../assets/upload/quotes/".$old_img_path;
                          if (move_uploaded_file($tempname, $folder))
                          {
                               $msg = "Image uploaded successfully";
                          }
                      
                   }
            $sql ="UPDATE `quotes` SET `title`='$title',`cat_id`='$category',`content`='$content',`image`='$old_img_path',`seo_title`='$seo_title',`slug`='$slug',`focus_keyword`='$focus_key',
            `meta_desc`='$meta_desc',`img_alt`='$img_alt',`img_title`='$img_title',`rank_math_bot`='$advance_bot',`quotes_desc`='$message',`status`='0' WHERE `id`='$quotes_id'";

                    $stmt_quotes = $conn->prepare($sql);
                    if($stmt_quotes->execute())
                    {
                        echo "updated";
                    }
         
    }


// add author here
    if($_POST['btn']=="addAuthor")
    {
        $fname="";
        if(isset($_POST['fname'])){
            $fname = trim_data($_POST['fname']);
        }
        $lname="";
        if(isset($_POST['lname'])){
            $lname = trim_data($_POST['lname']);
        }
        $username="";
        if(isset($_POST['username'])){
            $username = trim_data($_POST['username']);
        }
        $pass="";
        if(isset($_POST['pass'])){
            $pass = trim_data($_POST['pass']);
        }
        $filename="";
        if(isset($_FILES["img"]["name"])){
            $filename = $_FILES["img"]["name"];
            $tempname = $_FILES["img"]["tmp_name"];
        }
        $qualification="";
        if(isset($_POST['qualification'])){
            $qualification = trim_data($_POST['qualification']);
        }
        $title="";
        if(isset($_POST['title'])){
            $title = trim_data($_POST['title']);
        }
        $slug="";
        if(isset($_POST['slug'])){
            $slug = trim_data($_POST['slug']);
        }
        $img_title="";
        if(isset($_POST['img_title'])){
            $img_title = trim_data($_POST['img_title']);
        }
        $img_alt="";
        if(isset($_POST['img_alt'])){
            $img_alt = trim_data($_POST['img_alt']);
        }
        $meta_title="";
        if(isset($_POST['meta_title'])){
            $meta_title = trim_data($_POST['meta_title']);
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        $position="";
        if(isset($_POST['position'])){
            $position = trim_data($_POST['position']);
        }
        $message="";
        if(isset($_POST['text'])){
            $message = trim_data($_POST['text']);
        }
        $highlights="";
        if(isset($_POST['highlights'])){
            $highlights = $_POST['highlights'];
        }
        $experience="";
        if(isset($_POST['experience'])){
            $experience = $_POST['experience'];
        }


            // file move to image folder
            $folder = "../assets/upload/authorProfile/".$filename;
            if (move_uploaded_file($tempname, $folder))
            {
                //$msg = "Image uploaded successfully";
            }
            else{
                //$msg = "Failed to upload image";
                }
            
                $sql = "INSERT INTO `author`(`author_first_name`, `author_last_name`, `author_position`, `author_username`, `author_password`, `qualification`, `title`, `slug`, `meta_title`, `meta_desc`, `highlights`, `experience`, `image`, `img_alt`, `img_title`, `message`, `status`)
                VALUES ('$fname','$lname','$position','$username','$pass','$qualification','$title','$slug','$meta_title','$meta_desc','$highlights','$experience','$filename','$img_title','$img_alt','$message',0)";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                echo "inserted";
            }    

    }

    // update author here
    if($_POST['btn']=="updateAuthorUser")
    {
        if(isset($_POST['author_id'])){
            $id = trim_data($_POST['author_id']);
        }
        $old_image="";
        if(isset($_POST['old_image'])){
            $old_image = $_POST['old_image'];
        }
        $fname="";
        if(isset($_POST['fname'])){
            $fname = trim_data($_POST['fname']);
        }
        $lname="";
        if(isset($_POST['lname'])){
            $lname = trim_data($_POST['lname']);
        }
        $username="";
        if(isset($_POST['username'])){
            $username = trim_data($_POST['username']);
        }
        $pass="";
        if(isset($_POST['pass'])){
            $pass = trim_data($_POST['pass']);
        }
        $qualification="";
        if(isset($_POST['qualification'])){
            $qualification = trim_data($_POST['qualification']);
        }
         $title="";
        if(isset($_POST['title'])){
            $title = trim_data($_POST['title']);
        }
        $slug="";
        if(isset($_POST['slug'])){
            $slug = trim_data($_POST['slug']);
        }
        $img_title="";
        if(isset($_POST['img_title'])){
            $img_title = trim_data($_POST['img_title']);
        }
        $img_alt="";
        if(isset($_POST['img_alt'])){
            $img_alt = trim_data($_POST['img_alt']);
        }
        $meta_title="";
        if(isset($_POST['meta_title'])){
            $meta_title = trim_data($_POST['meta_title']);
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        $position="";
        if(isset($_POST['position'])){
            $position = trim_data($_POST['position']);
        }
        $message="";
        if(isset($_POST['text'])){
            $message = trim_data($_POST['text']);
        }
        $highlights="";
        if(isset($_POST['highlights'])){
            $highlights = $_POST['highlights'];
        }
        $experience="";
        if(isset($_POST['experience'])){
            $experience = $_POST['experience'];
        }
        
        $filename="";
        if(isset($_FILES["img"]["name"])){
            $filename = $_FILES["img"]["name"];
            $tempname = $_FILES["img"]["tmp_name"];
        }
        else{
            $filename = $old_image;
        }

        if(empty($filename)){
            $filename = $old_image;
        }
        else
        {
                $folder = "../assets/upload/authorProfile/".$filename;
                if (move_uploaded_file($tempname, $folder))
                {
                    //$msg = "Image uploaded successfully";
                }
                           
        }
                 $sql = "UPDATE `author` SET `author_first_name`='$fname',`author_last_name`='$lname',`author_position`='$position',`author_username`='$username',`author_password`='$pass',
                `qualification`='$qualification',`title`='$title',`slug`='$slug',`meta_title`='$meta_title',`meta_desc`='$meta_desc',`highlights`='$highlights',`experience`='$experience',`image`='$filename',`img_alt`='$img_alt',`img_title`='$img_title',`message`='$message',`status`='0' WHERE `id`='$id'";
            
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                echo "updated";
            }    

    }
    // delete author data here 
    
    if($_POST['btn']=="deleteFunctionAuthor_id")
    {
        $deleteFunctionAuthor_id = $_POST['deleteFunctionAuthor_id'];
        $sql=$conn->prepare("UPDATE `contact_enquiry` SET `status`='1' WHERE `id`=?");  
        $sql->execute([$deleteFunctionAuthor_id]);
        echo "Trashed";
    }
    // user comment delete 
    
    if($_POST['btn']=="deleteuserComment_id")
    {
        $deleteuserComment_id = $_POST['deleteuserComment_id'];
        $sql=$conn->prepare("Delete FROM `tbl_comment` WHERE `comment_id`=?");  
        $sql->execute([$deleteuserComment_id]);
        echo "deleted";
    }
    
    if($_POST['btn']=="permanentdeleteFunctionAuthor_id")
    {
        $permanentdeleteFunctionAuthor_id = $_POST['permanentdeleteFunctionAuthor_id'];
        $sql=$conn->prepare("Delete FROM `contact_enquiry`WHERE `id`=?");  
        $sql->execute([$permanentdeleteFunctionAuthor_id]);
        echo "Deleted";
    }

        if($_POST['btn'] === "add_image_quote")
        {
            $old_imgPath = trim_data($_POST["quote_author_image"]);
            $author_image="";
            if(isset($_FILES["author_image"]["name"])){
                $author_image = $_FILES["author_image"]["name"];
                $author_image_temp = $_FILES["author_image"]["tmp_name"];
            }else
            {
                $author_image = $old_imgPath;
            }
            $img_alt="";
            if(isset($_POST["img_alt"])){
                $img_alt = trim_data($_POST["img_alt"]);    
            }
            else{
                $img_alt="";
            }
            
            $id = $_POST['quote_author_id'];
            
            if(!empty($author_image)){
            $folder = "../assets/upload/quotes/".$author_image;
            if (move_uploaded_file($author_image_temp, $folder))
                {
                    $msg = "Image uploaded successfully content";
                }
            }else{
                 $author_image = $old_imgPath;
            }
            
            $sql = "UPDATE `quotes_data` SET `author_image`='$author_image',`alt_image`='$img_alt' WHERE `id`='$id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                echo "updated";
            }
        }
    
        if($_POST['btn']=="quotes_author_content_id")
        {
                $quotes_author_content_id = $_POST['quotes_author_content_id'];
                $stmt = $conn->prepare("SELECT * FROM `quotes_data` WHERE id = '$quotes_author_content_id'");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);   
                if (!empty($data)) {
                    foreach ($data as $data)
                    {
                        echo"
                        <form id='update_author_data'>
                        <div class='mb-3'>
                        <label for='formmessage'>Author Name :</label>
                        <input type='text' class='form-control' name='author_name' value='" .$data['author_name']. "'>
                        </div>
                        <div class='mb-3'>
                        <label for='formmessage'>Author Content :</label>
                        <textarea class='form-control' name='author_content' rows='3'> ".$data['author_content']." </textarea>
                        </div>
                        <div class='submit-btns'>
                        <input type='hidden' value='update_author_quotes' name='btn'>
                        <input type='hidden'  value='". $data['id'] ."' name='quote_author_id'>
                        <input type='submit' name='add_image_quote' class='post-btn text-left' value='Save'> 
                        </div>
                        </form>";   
                    }
                }
        }

        if($_POST['btn']=="update_author_quotes")
        {
            $id = $_POST['quote_author_id'];
            $author_name = trim_data($_POST["author_name"]);
            $author_content = trim_data($_POST["author_content"]);

            $sql = "UPDATE `quotes_data` SET `author_name`='$author_name',`author_content`='$author_content' WHERE id='$id'";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                echo "updated";
                }
        }


        if($_POST['btn'] == "filter_blog_data")
        {
                    $author_name = "";
                    $category = "";
                    $date = "";
                    $error="";
                    if(!empty($_POST['author_name']))
                    {
                    echo $author_name = trim_data($_POST['author_name']);
                    }
                    else
                    {
                        $error = "required";
                    }
                    if(!empty($_POST['category_filter']))
                    {
                    echo $category = trim_data($_POST['category_filter']);
                    }
                    else
                    {
                        $error = "required";
                    }
                    if(!empty($_POST['lastPostDate']))
                    {
                        echo $date = trim_data($_POST['lastPostDate']);
                    }
                    else
                    {
                        $error = "required";
                    }
                    //echo $error;
                    if(!empty($author_name || $category || $date))
                    {
                        $sql = "SELECT * FROM `blog` WHERE post_author='$author_name' OR parent_category='$category' OR category='$category' OR publish_date='$date'";
                        $stmt_aut = $conn->prepare($sql);
                        $stmt_aut->execute();
                        $aut_data = $stmt_aut->fetchAll(PDO::FETCH_ASSOC);
                                echo '<table id="datatable" class="table table-bordered dt-responsive">
                                <thead>
                                    <tr role="row">
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Categories</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                if(!empty($aut_data))
                                {
                                    foreach($aut_data as $author_row)
                                    {   
                                        $category = $author_row['parent_category'];
                                        $sub_category = $author_row['category'];
                                        $cat_array = array($category,$sub_category);
                                        $title = $author_row['post_title'];
                                        $image = $author_row['featured_image'];
                                        
                                        $author = $author_row['post_author'];
                                        $exploded_array = explode(',',$author);
                                        
                                        $stmt_author = $conn->prepare("SELECT id, author_first_name FROM `author`");
                                        $stmt_author->execute();
                                        $author_data = $stmt_author->fetchAll(PDO::FETCH_ASSOC);
                                        if(!empty($author_data))
                                        {
                                            foreach ($author_data as $author_data_val)
                                            {
                                                    if(in_array($author_data_val['id'], $exploded_array))
                                                    {
                                                            $author =  $author_data_val['author_first_name'].",";
                                    
                                                        
                                                    }
                                            }
                                        }
                                        
                                        $cat="";
                                        $stmt_cat = $conn->prepare("SELECT * FROM `categories`");
                                        $stmt_cat->execute();
                                        $cat_data = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);
                                        if (!empty($cat_data))
                                        {
                                                foreach ($cat_data as $cat_data_val)
                                                {
                                                    if(in_array($cat_data_val['cat_id'], $cat_array))
                                                    {
                                                        $cat = $cat_data_val['cat_name'].",";
                                
                                                       
                                                    }
                                                
                                                }
                                        }
                                        echo "<tr>";
                                        echo "<td class='sorting_1 dtr-control' tabindex='0'><img src='../assets/upload/" .$image. "'/></td>";
                                        echo "<td>" .$title. "</td>";
                                        echo "<td>" . $author . "</td>";
                                        echo "<td>" .$cat. "</td>";
                                        echo "<td><a href='update_blog.php?id=".$author_row["id"]."' class='btn btn-success'><i class='fas fa-edit'></i></td>";
                                        echo "<td><a href='javascript:void(0)' class='btn btn-danger' onclick='blogTrashRows(".$author_row['id'].")'><i class='fas fa-trash-alt'></i></td>";
                                        echo "</tr>";
                                    }
                                }
                                else
                                {
                                    echo "<tr>No Data Found</tr>";
                                }
                                    echo "</table>";
                    }
            }

// quotes filter data here 

if($_POST['btn'] == "filter_Quotesdata")
{
            $category = "";
            $date = "";
            $error="";
            if(!empty($_POST['category_filter']))
            {
            echo $category = trim_data($_POST['category_filter']);
            }
           
            if(!empty($_POST['date']))
            {
                echo $date = trim_data($_POST['date']);
            }
          
            //echo $error;
            if(!empty($category || $date))
            {
                $sql = "SELECT * FROM `quotes` WHERE `cat_id`='$category' OR `date`='$date'";
                $stmt_quo = $conn->prepare($sql);
                $stmt_quo->execute();
                $quo_data = $stmt_quo->fetchAll(PDO::FETCH_ASSOC);
                        echo '<table id="datatable" class="table table-bordered dt-responsive">
                        <thead>
                            <tr role="row">
                                <th>Image</th>
                                <th>Title</th>
                                <th>Categories</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>';
                        if(!empty($quo_data))
                        {
                            foreach($quo_data as $quo_data_val)
                            {   
                                $category = $quo_data_val['cat_id'];
                                echo "<tr>";
                                echo "<td><img src='upload/quotes/" . $quo_data_val['image'] . "' class='product_img_data'/></td>";
                                echo "<td>" . $quo_data_val['title'] . "</td>";
                                $stmt1 = $conn->prepare("SELECT * FROM `quotescat` WHERE id='$category'");
                                $stmt1->execute();
                                
                                $data_cat = $stmt1->fetchAll(PDO::FETCH_ASSOC);	
                                foreach ($data_cat as $data_cat_val)
                                {	
                                    echo "<td>" .$data_cat_val['categoryName']. "</td>";
                                }
                                
                                echo "<td><a href='updateQuote.php?id=".$quo_data_val["id"]."' class='btn btn-success'><i class='fas fa-edit'></i></td>";
                                echo "<td><a href='javascript:void(0)' class='btn btn-danger' onclick='quotesTrashRows(".$quo_data_val['id'].")'><i class='fas fa-trash-alt'></i></td>";
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            echo "<tr>No Data Found</tr>";
                        }
                            echo "</table>";
            }
            else
            {

            }
    }

    if($_POST['btn'] == "add_page")
    {
        $title = trim_data($_POST['i1']);
        $seo_title = trim_data($_POST['i2']);
        $slug = trim_data($_POST['i3']);
        
        if(isset($_POST['author_name']))
        {
    
        $author_name = ($_POST['author_name']);
        }
        $author_values="";
        if(!empty($author_name))
        {
            $author_values  = implode(",",$author_name);            
        }
        else
        {
            echo $author_values = "1";
        }
        
    
        if(isset($_POST['review']))
        {
        $review = ($_POST['review']);
        }
        $review_value="";
        if(!empty($review))
        {
            $review_value  = implode(",",$review);            
        }
        else
        {
            echo $review_value = "1";
        }
    
        if(isset($_POST['bot_robot']))
        {
        $bot_robot = ($_POST['bot_robot']);
        }
        $bot_robot_value="";
        if(!empty($bot_robot))
        {
            $bot_robot_value  = implode(", ",$bot_robot);            
        }
        else
        {
            echo $bot_robot_value = "0";
        }
    
        if(isset($_POST['max_snippet']))
        {
            $max_snippet = $_POST['max_snippet'];
        }
        else
        {
            echo $max_snippet = "max-snippet:";
        }
        if(isset($_POST['max_video']))
        {
        $max_video =($_POST['max_video']);
        }
        else
        {
            echo $max_video = "max-video:";
        }
    
        if(isset($_POST['max_image']))
        {
        $max_image=$_POST['max_image'];
        }
        else
        {
            echo $max_image="max-image:";
        }
            $max_snippet_value =$_POST['max_snippet_value'];   
            $concat_snippet = $max_snippet.$max_snippet_value;
            $max_video_value =$_POST['max_video_value'];
            $concat_video = $max_video.$max_video_value;    
            $max_image_value =$_POST['max_image_value'];
            $concat_image = $max_image.$max_image_value;
            
            echo $advance_bot = $bot_robot_value.", ".$concat_snippet.", ".$concat_video.", ".$concat_image;
    
            $content=trim_data($_POST['content']);
            $focus_key=trim_data($_POST['focus_keyword']);
            $date_publish=trim_data($_POST['date_publish']);
            $category = trim_data($_POST['category']);
            //$sub_category = trim_data($_POST['sub_category']);
    
            if(isset($_POST['sub_category']))
            {
            $sub_category = $_POST['sub_category'];
            }
            $sub_category_value="";
            if(!empty($sub_category))
            {
                $sub_category_value  = implode(",",$sub_category);            
            }
            else
            {
                echo $sub_category_value = "no";
            }
    
    
            $message = trim_data($_POST['message']);
            $date_publish = $_POST['date_publish'];
            $date_modified = $_POST['date_modified'];
            $filename = trim_data($_FILES["img"]["name"]);
            $tempname = $_FILES["img"]["tmp_name"];
            $date = date("Y-m-d");    
            // file move to image folder
            $folder = "upload/".$filename;
            if (move_uploaded_file($tempname, $folder))
            {
                $msg = "Image uploaded successfully";
            }
            else{
                $msg = "Failed to upload image";
                }
            
                echo $sql = "INSERT INTO `page`(`post_author`, `post_review`, `post_content`, `post_title`, `post_name`, `parent_category`, `category`, `description`, `permalink`, `featured_image`, `publish_date`, `modified_date`, `title_slug`, `bot_meta_data`, `canonical_url`, `status`)
                VALUES ('$author_values','$review_value','$content','$title','$title','$category','$sub_category_value','$message','','$filename','$date_publish','$date_modified','$slug','$advance_bot','',0)";
                $stmt6 = $conn->prepare($sql);
                if($stmt6->execute()){
                    echo "inserted page";    
                }
             
    }

            function trim_data($text) {
               // $text = trim($data); //<-- LINE 31
                if(is_array($text)) {
                    return array_map('trim_data', $text);
                }

                $text = preg_replace("/(\r\n|\n|\r)/", "\n", $text); // cross-platform newlines
                $text = preg_replace("/\n\n\n\n+/", "\n", $text); // take care of duplicates 
               
                $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $text = stripslashes($text);
               
                $text = str_replace ( "\n", " ", $text );
                $text = str_replace ( "\t", " ", $text );
               
                return $text;
            }
    