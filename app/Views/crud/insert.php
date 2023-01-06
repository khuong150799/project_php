<?php echo $this->extend('include/base'); ?>

<?php echo  $this->section('title'); ?>
<?php echo  $title ?>
<?php echo  $this->endSection(); ?>

<?php echo  $this->section('base'); ?>

<?php $validation = \Config\Services::validation();


if (!empty($editRecord)) {
    $editFullname = $editRecord->fullname;
    $editEmail = $editRecord->email;
    $editPhone = $editRecord->phone;
    $editCourse = $editRecord->course;
    $editCategory = $editRecord->category;
    $action = base_url('crud/update/' . $editRecord->id);
    $buttonText = 'Sửa dữ liệu';
} else {
    $buttonText = 'Thêm dữ liệu';
    $action = base_url('crud/insert');
}
?>
<div class="container my-5">
    <h1><?= $buttonText ?></h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <a href="/crud" class="btn btn-danger btn-sm rounded">Trở lại</a>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="container-fluid">
                            <form action="<?= $action ?>" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Họ và tên <span class="text-danger">
                                                    *</span>
                                            </label>
                                            <input type="text" id="name" name="name" class="form-control <?= $validation->getError('name') ? 'is-invalid' : '' ?>" value="<?php echo set_value('name', $editFullname ?? '') ?>" />
                                            <?php if ($validation->getError('name')) { ?>
                                                <div class="invalid-feedback">
                                                    <?php echo $validation->getError('name'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email<span class="text-danger">
                                                    *</span></label>
                                            <input type="email" id="email" name="email" class="form-control <?= $validation->getError('email') ? 'is-invalid' : '' ?>" value="<?php echo set_value('email', $editEmail ?? '') ?>" />
                                            <?php if ($validation->getError('email')) { ?>
                                                <div class="invalid-feedback">
                                                    <?php echo $validation->getError('email'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Điện thoại<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" id="phone" name="phone" class="form-control <?= $validation->getError('phone') ? 'is-invalid' : '' ?>" value="<?php echo set_value('phone', $editPhone ?? "") ?>" />
                                            <?php if ($validation->getError('phone')) { ?>
                                                <div class="invalid-feedback">
                                                    <?php echo $validation->getError('phone'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="course" class="form-label">Khóa học<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" id="course" name="course" class="form-control <?= $validation->getError('course') ? 'is-invalid' : '' ?>" value="<?php echo set_value('course', $editCourse ?? '') ?>" />
                                            <?php if ($validation->getError('course')) { ?>
                                                <div class="invalid-feedback">
                                                    <?php echo $validation->getError('course'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Xếp loại
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="category" class="form-select <?= $validation->getError('category') ? 'is-invalid' : '' ?>" value="<?php echo set_value('category', $editCategory ?? '') ?>">
                                                <option value="1">--Chọn--</option>
                                                <?php foreach ($dataCate as  $row) { ?>
                                                    <option value="<?= $row['category_id'] ?>">
                                                        <?= $row['category_title'] ?>
                                                    </option>
                                                <?php }
                                                ?>
                                            </select>
                                            <?php if ($validation->getError('category')) { ?>
                                                <div class="invalid-feedback">
                                                    <?php echo $validation->getError('category'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-info text-white w-50"><?= $buttonText ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo  $this->endSection(); ?>