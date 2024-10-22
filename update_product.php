<?php
     include('conn.php');

     if(isset($_GET['id'])){
        $p_id = $_GET['id'];
     
        $query = "SELECT * FROM `product` WHERE `p_id` = '$p_id' ";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("query failed".mysqli_error($conn));
        }else{
            $row = mysqli_fetch_assoc($result);
        }
    }

     if(isset($_POST['update'])){

        $p_name = $_POST['p_name'];
        $p_price = $_POST['p_price'];

        $query = "UPDATE `product` SET `p_name` = '$p_name', `p_price` = '$p_price' WHERE `p_id`=$p_id";

        $result = mysqli_query($conn,$query);
        if(!$result){
            die("query failed".mysqli_error($conn));
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขสำเร็จ');";
            echo "window.location = 'edit.php';";
            echo "</script>";
        exit();
        }
     }
?>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="from.css"/>
  <link rel="stylesheet" href="table.css"/>
  <div class="form-container">
    <h2>แก้ไขสินค้า</h2>
    <<form action="update_product.php?id=<?php echo $p_id; ?>" method="POST">
      <div class="form-group">
        <label for="name">ชื่อสินค้า</label>
        <input type="text" id="p_name" name="p_name" placeholder="กรอกชื่อสินค้า" value="<?php echo $row['p_name']?>">
      </div>

      <div class="form-group">
        <label for="email">ราคา</label>
        <input type="text" id="p_price" name="p_price" placeholder="กรอกราคา" value="<?php echo $row['p_price']?>">
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-success" name="update" value="ยืนยัน">
      </div>
    </form>