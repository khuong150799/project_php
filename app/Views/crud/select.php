<?php echo $this->extend('include/base'); ?>
<?php echo  $this->section('title'); ?>
<?php echo  $title ?>
<?php echo  $this->endSection(); ?>
<?php echo  $this->section('base'); ?>

<div class="container my-5">

    <div class="row">
        <div class="col-12">
            <div class="my-3 text-center">
                <h4>CRUD Page
                    <hr class="text-denger">
                </h4>
            </div>
        </div>
        <div class="card rounded">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <a href="/crud/insert" class="btn btn-primary rounded mb-2">Thêm dữ liệu</a>
                        <a href="<?= site_url('export-excel') ?>" class="btn btn-success rounded mb-2">Xuất Excel</a>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-sm-end">
                            <form action="">
                                <div class="input-group">
                                    <h3 class="mb-0 mt-2">
                                        <a href="/crud" class="mt-3 me-3">
                                            <i class="fa fa-repeat"></i>
                                        </a>
                                    </h3>
                                    <input type="text" id="cta" class="form-control keySearch" placeholder="Tìm sinh viên..." name="q" value="" aria-describedby="button-addon2">
                                    <button onclick="joinMailingList()" class="btn btn-primary clickSearch" type="Submit" id="button-addon2">Tìm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0" id="myTableStudent">
                        <thead>
                            <tr>
                                <th style="min-width: 10px">STT</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Khóa học</th>
                                <th>Xếp loại</th>
                                <th>Ngày cập nhật</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($result)) {
                                $i = 1;
                                foreach ($result as $row) {
                            ?>
                                    <tr>
                                        <input type="hidden" class="item_id" value="<?= $row['id'] ?>" />
                                        <td><?= $i ?></td>
                                        <td><?php echo $row['fullname'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['course'] ?></td>
                                        <td><?php echo $row['category_title'] ? $row['category_title'] : 'Chưa xếp loại' ?></td>
                                        <td><?php echo $row['updated_date'] ?  date("d-m-Y H:i:s", substr($row['updated_date'], 0, 10)) : date("d-m-Y H:i:s", substr($row['creation_date'], 0, 10)) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('crud/update/' . $row['id']) ?>" class="btn btn-primary rounded mx-1">Sửa</a>
                                            <!-- <a href="<?= base_url('delete/' . $row['id']) ?>" class="btn btn-danger rounded mx-1 deleteItem">Xóa</a> -->
                                            <button class="btn btn-danger rounded mx-1 deleteItem">Xóa</button>
                                        </td>
                                    </tr>

                            <?php $i++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <a href="/" class=" mt-3">
            <i class="fa fa-arrow-left"></i>
            Quay về home
        </a>
    </div>
</div>
<?php
echo  $this->endSection();
?>