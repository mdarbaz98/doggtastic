<?php include('./include/header.php')?>

    <div class="content-wrapper">
  <form action="payment.php" method="POST" autocomplete="off">
    <div class="form-content">
      <h1>Credit Card Info</h1>
      <label>Card Number</label>
      <input type="text" name="card" value="4111111111111111"/>

      <label>Expiration Month</label>
      <select name="card_exp_month"class="select">
        <option value="01">01 Jan</option>
        <option value="02">02 Feb</option>
        <option value="03">03 Mar</option>
        <option value="04">04 Apr</option>
        <option value="05">05 May</option>
        <option value="06">06 Jun</option>
        <option value="07">07 Jul</option>
        <option value="08">08 Aug</option>
        <option value="09">09 Sep</option>
        <option value="10">10 Oct</option>
        <option value="11">11 Nov</option>
        <option value="12" selected>12 Dec</option>
      </select>

      <label>Expiration Year</label>
      <select name="card_exp_year" class="select">
      <?php
      echo $firstYear = (int)date('Y');
      $lastYear = $firstYear + 10;
      for($i=$firstYear;$i<=$lastYear;$i++)
      {
          echo '<option value='.$i.'>'.$i.'</option>';
      }
      ?>
    </select>

    <label>CVV</label>
    <input type="text" name="cvv" value="186"/>

    <input type="submit" name="submit" class="submit" value="PAY NOW">

    </div>
  </form>
  </div>

<?php include('./include/footer.php') ?>