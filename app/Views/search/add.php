<form class="w-75 mx-auto" method="post" action="">
    <div class="form-group">
        <label for="exampleInputEmail1">FullName</label>
        <input type="text" class="form-control" id="fullname" name="data_cr[fullname]" placeholder="Nhập tên" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" class="form-control" id="email" name="data_cr[email]" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Điện thoại</label>
        <input type="number" class="form-control" id="phone" name="data_cr[phone]" placeholder="phone" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="data_cr[address]" placeholder="address" required>
    </div>
    <button type="submit" class="btn btn-primary" id="save">Lưu</button>
    <a type="submit" class="btn btn-info" href="/search/index">Quay về</a>
</form>