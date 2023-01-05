<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="excel mt-5">
<div class="container">
  <div class="row">
  <a href="<?= site_url("download")?>" class="btn btn-sm btn-primary mr-2">Export Excel</a>
  <a href="<?= site_url("upload")?>" class="btn btn-sm btn-success  mr-2">Import Excel</a>
  <!-- <a href="<?= site_url("add")?>" class="btn btn-sm btn-success  mr-2 float-right">Add Data</a> -->
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Tên</th>
      <th scope="col">Điện thoại</th>
      <th scope="col">email</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">Mã Zip</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">Quê quán</th>
      <!-- <th scope="col">Hành động</th> -->
    </tr>
  </thead>
  <tbody>
    <?php
    if(!empty($tableData)) {
        foreach($tableData as $row) {
            ?>

        <tr>
        <th scope="row"><?= $row->id?></th>
        <td><?= $row->name?></td>
        <td><?= $row->phone?></td>
        <td><?= $row->email?></td>
        <td><?= $row->address?></td>
        <td><?= $row->postalZip?></td>
        <td><?= $row->region?></td>
        <td><?= $row->country?></td>
        <!-- <td><a href="<?= base_url('delete/'.$row->id)?>" class="btn btn-danger">Xóa</a></td> -->
        </tr>
            <?php
        }
    }
    ?>
  
   
  </tbody>
</table>
  </div>
</div>
</div>




  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

<!-- consolog array -->
<!--

echo "<pre>";
    print_r(
        $tableData
    );
  -->
