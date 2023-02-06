<?php include('include/config.php');
session_start();
session_regenerate_id();
date_default_timezone_set('Asia/Kolkata');
if($_POST['btn']=='loginUser'){
    $username = trim_data($_POST['username']);
    $pass = trim_data($_POST['password']);
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE username=?");
    $stmt->execute([$username]);
    $userCount=$stmt->rowCount();
    if($userCount > 0){
      while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
        $email = $user_data['username'];
        $password = $user_data['password'];
        //if (password_verify($pass, $password)) {
          $_SESSION['admin_is_login'] = $user_data['username'];
          $_SESSION['admin_is_login_id'] = $user_data['id'];
          $_SESSION['admin_is_login_id'] = true;
          echo "done";            
        //}

      }
    }
  }
if($_POST['btn']=='image_update'){
  $id = $_POST['img_id'];
  $alt = $_POST['alt'];
  $title = $_POST['title'];
  $stmt = $conn->prepare("UPDATE images SET alt=?, title=? WHERE id=?");
  if($stmt->execute([$alt, $title, $id])){
    echo "updated";
  }
}

if($_POST['btn']=='addCategory'){
  $cat_name = $_POST['cat_name'];
  $title = $_POST['cat_title'];
  $slug = $_POST['cat_slug'];
  $desc = $_POST['cat_description'];
  $img_id = $_POST['img_id'];
  $stmt = $conn->prepare("INSERT INTO categories(img_id, cat_name, cat_slug, cat_desc, cat_title, status) VALUES(?,?,?,?,?,?)");
  if($stmt->execute([$img_id, $cat_name, $slug, $desc, $title, 1])){
    echo "inserted";
  }
}
if($_POST['btn']=='updateCategory'){
  $cat_id = $_POST['cat_id'];
  $cat_name = $_POST['cat_name'];
  $title = $_POST['cat_title'];
  $slug = $_POST['cat_slug'];
  $desc = $_POST['cat_description'];
  if(empty($_POST['img_id'])){
    $img_id = $_POST['old_img_id'];
  }else{
    $img_id = $_POST['img_id'];
  }
  $stmt = $conn->prepare("UPDATE categories SET img_id=?, cat_name=?, cat_slug=?, cat_desc=?, cat_title=? WHERE id=?");
  if($stmt->execute([$img_id, $cat_name, $slug, $desc, $title, $cat_id])){
    echo "updated";
  }

}
if($_POST['btn']=='deleteCategory_id'){
    $update = $conn->prepare('DELETE FROM categories WHERE id=?');
    $update->execute([$_POST['deleteCategory_id']]);
    echo 'deleted';
    }

//product
    if($_POST['btn']=='addProduct'){
    $name=$_POST['pro_name'];
    $prc = $_POST['prc'];
    $slug = $_POST['slug'];
    $cat = $_POST['category'];
    $description = $_POST['description']; 
    $image_link = $_POST['image_link'];
    $PostDate = date("Y-m-d H:i");
    $stmt = $conn->prepare("INSERT INTO product(image, name, slug, category, price, description, date) VALUES(?,?,?,?,?,?,?)");
    if($stmt->execute([$image_link, $name, $slug, $cat, $prc, $description, $PostDate])){
        $last_pro_id = $conn->lastInsertId();
        echo "inserted".$last_pro_id;
    }
  }

  if($_POST['btn']=='updateProduct'){
    $product_id=$_POST['product_id'];
    $name = $_POST['pro_name'];
    $prc = $_POST['prc'];
    $slug = $_POST['slug'];
    $cat = $_POST['category'];   
    $image_link = $_POST['image_link'];
    $desc = $_POST['discription'];
    $stmt = $conn->prepare("UPDATE product SET image=?, name=?, slug=?, category=?, price=?, description=? WHERE id=?");
    if($stmt->execute([$image_link, $name, $slug, $cat, $prc, $desc, $product_id])){
      echo "updated";
    }
  }
//   upload product
if($_POST['btn']=='uploadProduct_id'){
    $update = $conn->prepare('UPDATE product SET status=1 WHERE id=?');
    $update->execute([$_POST['uploadProduct_id']]);
    echo 'uploaded';
    }
  // Trash product
  if($_POST['btn']=='trashProduct_id'){
    $update = $conn->prepare('DELETE FROM product WHERE id=?');
    $update->execute([$_POST['trashProduct_id']]);
    echo 'trashed';
    }

    // Permanent delete product
    if($_POST['btn']=='deleteProduct_id'){
        $update = $conn->prepare('DELETE FROM product WHERE id=?');
        $update->execute([$_POST['deleteProduct_id']]);
        echo 'deleted';
        }
//   product ends here
//user
if($_POST['btn']=='addUser'){
    $name = trim_data($_POST['name']);
    $username = trim_data($_POST['username']);
    $pwd = trim_data($_POST['pwd']);
    $options = ['cost' => 12];  
    $password_hash = password_hash($pwd, PASSWORD_DEFAULT, $options);
    $stmt = $conn->prepare("INSERT INTO user(name ,username,password,status) VALUES(?,?,?,?)");
    if($stmt->execute([$name, $username, $password_hash, 1])){
      echo "inserted";
    }
  }
//   UPDATE
  if($_POST['btn']=='updateUser'){
    $user_id=$_POST['user_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];  
    $stmt = $conn->prepare("UPDATE user SET name=?, username=?, password=?, status=? WHERE id=?");
    if($stmt->execute([$name, $username,  $pwd, 1, $user_id])){
      echo "updated";
    }
  }


//   DELETE
  if($_POST['btn']=='deleteUser_id'){
    $update = $conn->prepare('DELETE FROM user WHERE id=?');
    $update->execute([$_POST['deleteUser_id']]);
    echo 'deleted';
    }
//   user ends here


 // post start here
// delete post
if($_POST['btn']=='delete_pro_id'){
    $update = $conn->prepare('DELETE FROM images WHERE id=?');
    $update->execute([$_POST['pro_id']]);
    echo 'deleted';
    }
 //   upload post
if($_POST['btn']=='uploadPost_id'){
    $update = $conn->prepare('UPDATE post SET status=1 WHERE id=?');
    $update->execute([$_POST['uploadPost_id']]);
    echo 'uploaded';
    }

   
// trash post
if($_POST['btn']=='trashPost_id'){
    $update = $conn->prepare('UPDATE post SET status=0 WHERE id=?');
    $update->execute([$_POST['trashPost_id']]);
    echo 'trashed';
    }
    function trim_data($text) {
       $text = trim($text); //<-- LINE 31
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
?>