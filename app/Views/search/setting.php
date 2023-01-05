<?php foreach($datas as $d){ ?>
<form class="w-75 mx-auto" method="post" action="">
    <div class="form-group">
        <label for="exampleInputEmail1">FullName</label>
        <input type="text" class="form-control" id="fullname" name="data_up[fullname]" placeholder="Nhập tên" value="<?= $d->fullname ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" class="form-control" id="email" name="data_up[email]" placeholder="Email" value="<?= $d->email ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Điện thoại</label>
        <input type="number" class="form-control" id="phone" name="data_up[phone]" placeholder="phone" value="<?= $d->phone ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="data_up[address]" placeholder="address" value="<?= $d->address ?>">
    </div>
    <button type="submit" class="btn btn-primary" id="save">Lưu</button>
    <a type="submit" class="btn btn-info" href="/<?= $control ?>/index">Quay về</a>
</form>
<?php } ?>