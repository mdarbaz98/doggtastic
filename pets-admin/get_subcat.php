<?php 
include('include/config.php');
	
	if (isset($_POST['cat_id'])) {
		# code...
	 $cat_id = $_POST['cat_id'];

    $sql = "SELECT * FROM `categories` WHERE parent_cat = '$cat_id' ORDER BY id DESC";   
    $stmt= $conn->prepare($sql);                               
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($result)){
    foreach($result as $row_cat)
    {
			?>	
            <option value="<?php echo $row_cat["id"]; ?>"><?php echo $row_cat["cat_name"]; ?></option>
			<?php	
		}	
    }
	else
	{?> 		
    <option value="none">Sub Category Not Found</option> 
	<?php 	
	}
}
	?>