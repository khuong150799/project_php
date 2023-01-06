<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    if(isset($create)){
        $action= 'create';
    }else{
        $action = 'update/'.$data->id;
    }
    ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <a href="<?= base_url('/') ?>" class="btn btn-danger btn-sm rounded">Back</a>
                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="container-fluid">
                                <form action=<?= 'http://localhost:9999/user/'.$action ?> method="post"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="agent_name" class="form-label">Fullname <span
                                                        class="text-danger">
                                                        *</span>
                                                </label>
                                                <input type="text" id="agent_name" name="data-post[fullname]"
                                                    class="form-control" value="<?= isset($data->fullname)?$data->fullname:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="agent_email" class="form-label">Email<span
                                                        class="text-danger"> *</span></label>
                                                <input type="text" id="agent_email" name="data-post[email]"
                                                    class="form-control" value="<?= isset($data->email)?$data->email:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="agent_phone" class="form-label">Phone<span
                                                        class="text-danger"> *</span></label>
                                                <input type="text" id="agent_phone" name="data-post[phone]"
                                                    class="form-control" value="<?= isset($data->phone)?$data->phone:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="agent_course" class="form-label">Address<span
                                                        class="text-danger"> *</span></label>
                                                <input type="text" id="agent_course" name="data-post[address]"
                                                    class="form-control" value="<?= isset($data->address)?$data->address:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">

                                            <label for="agent_course" class="form-label">Image<span class="text-danger">
                                                    *</span></label>
                                            <input type="file" id="agent_course" name="image"
                                                class="form-control" value="" required>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-info text-white w-50">Submit</button>
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
</body>

</html>
<?php
echo "<pre>";
print_r(
    isset($create)?'create':'update/'.$data->id
);