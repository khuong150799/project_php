<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file</title>
    <link rel="stylesheet" href="http://localhost:9999/style.css">
</head>

<body>

    <table class='table'>
        <thead>
            <tr class="t-row">
                <th class='table-title'>fullname</th>
                <th class='table-title'>email</th>
                <th class='table-title'>phone</th>
                <th class='table-title'>address</th>
                <th class='table-title'>image</th>
                <th class='table-title'></th>
                <th class='table-title'></th>
                <th class='table-title'></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data_index as $values){ ?>
                
            <tr>
                <th class='table-title'><?= $values->fullname ?></th>
                <th class='table-title'><?= $values->email ?></th>
                <th class='table-title'><?= $values->phone ?></th>
                <th class='table-title'><?= $values->address ?></th>
                <th class='table-title'><img class="img"
                        src='http://localhost:9999/<?= $path_thumb.'/'.$values->thumb ?>'
                        alt="gái xinh"></th>
                <th class='table-title'><a href="http://localhost:9999/user/form-add">add</a></th>
                <th class='table-title'><a href="http://localhost:9999/user/update/<?= $values->id ?>">edit</a></th>
                <th class='table-title'><button type='button'>Delete</button></th>
            </tr>
            <?php }?>
        </tbody>
    </table>

</body>

</html>
<?php
echo "<pre>";
print_r(
    $data_index
);