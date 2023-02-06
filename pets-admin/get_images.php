<?php include('include/config.php');?>
 <div class="container" id="getall_images">
    <div class="row">
      <div class="col-sm-8">
        <div class="row m-auto mt-5">
        <?php 
        $images=$conn->prepare("SELECT * FROM images WHERE status=?");
        $images->execute([1]);
        $total_images = $images->rowCount();
        if ($total_images > 0) {
            while ($row = $images->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <div class="col">
            <div class="img_div">
            <img src="<?php echo $row['path']; ?>" alt="<?php echo $row['alt']; ?>" class="img-rounded custome_images" onclick="imageChahge(<?php echo $row['id']; ?>,'<?php echo $row['path']; ?>')">
            </div>
          </div>
          <?php } }else{ ?>
            <p class="alert alert-danger text-center mx-auto my-5">No Images Found</p>
            <?php }?>
        </div>

      </div>
      <div class="col-sm-4">
    <div class="card mt-3" id="for_dynamicImage"> 

        </div>

      </div>
    </div>
  </div>