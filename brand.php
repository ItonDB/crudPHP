<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกประเภทสินค้า</title>
</head>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<body>
    <!-- nav start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">หน้าแรก</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            บันทึกข้อมูล
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="type.php">บันทึกข้อมูลประเภท</a></li>
            <li><a class="dropdown-item" href="brand.php">บันทึกข้อมูลยี่ห้อ</a></li>
            <li><a class="dropdown-item" href="product.php">บันทึกสินค้า</a></li>
            <li><a class="dropdown-item" href="sale.php">บันทึกการขาย</a></li>
            <li><a class="dropdown-item" href="employee.php">บันทึกพนักงาน</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            แสดงข้อมูล
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="views/V_type.php">แสดงข้อมูลประเภท</a></li>
            <li><a class="dropdown-item" href="views/V_brand.php">แสดงข้อมูลยี่ห้อ</a></li>
            <li><a class="dropdown-item" href="views/V_product.php">แสดงข้อมูลสินค้า</a></li>
            <li><a class="dropdown-item" href="views/V_sale.php">แสดงข้อมูลการขาย</a></li>
            <li><a class="dropdown-item" href="views/V_employee.php">แสดงข้อมูลพนักงาน</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            แก้ไขข้อมูล
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="update/Up_type.php">แก้ไขข้อมูลประเภท</a></li>
            <li><a class="dropdown-item" href="update/Up_brand.php">แก้ไขข้อมูลยี่ห้อ</a></li>
            <li><a class="dropdown-item" href="update/Up_product.php">แก้ไขข้อมูลสินค้า</a></li>
            <li><a class="dropdown-item" href="update/Up_sale.php">แก้ไขข้อมูลการขาย</a></li>
            <li><a class="dropdown-item" href="update/Up_employee.php">แก้ไขข้อมูลพนักงาน</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- nav end -->

<!-- form start -->
<div class="form-container">
        <div class="form-box">
            <h2 class="text-center">บันทึกยี่ห้อสินค้า</h2>
            <form action="backend/save_brand.php" method="post" name="form1" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">ชื่อยี่ห้อสินค้า</label>
                    <input type="text" class="form-control" id="b_name" name="b_name" aria-describedby="emailHelp" maxlength="100" require>
                    <div id="emailHelp" class="form-text">กรุณาพิมพ์ชื่อยี่ห้อสินค้าลงในช่องว่าง</div>
                </div>
                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
            </form>
        </div>
    </div>
    <!-- form end -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>