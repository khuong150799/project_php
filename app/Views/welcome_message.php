<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file</title>
    <link rel="stylesheet" href="http://localhost:9999/style.css">
    <script src="https://use.fontawesome.com/c9dc1e884c.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
        integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class='d-flex-column'>
        <form action="">
            <div class="input-group">
                <h3 class="mb-0 mt-2">
                    <a href="/" class="mt-3 me-3">
                        <i class="fa fa-repeat"></i>
                    </a>
                </h3>
                <input type="text" class="form-control" placeholder="Tìm sinh viên..." name="q" value=""
                    aria-describedby="button-addon2">
                <button class="btn btn-primary" type="Submit" id="button-addon2">Tìm</button>
            </div>
        </form>
        <table class='table'>
            <thead>
                <tr class="t-row">
                    <th class='table-title'>fullname</th>
                    <th class='table-title'>email</th>
                    <th class='table-title'>phone</th>
                    <th class='table-title'>address</th>
                    <th class='table-title'>image</th>
                    <th class='table-title'><a href="http://localhost:9999/user/form-add">add</a></th>
                    <th class='table-title'><a href="http://localhost:9999/crud">Huy</a></th>
                    <th class='table-title'><a href="http://localhost:9999/search">Nghĩa</a></th>
                    <th class='table-title'><a href="http://localhost:9999/import">Kiên</a></th>
                    <th class='table-title'><a href="http://localhost:9999/report">Huy export excel</a></th>
                </tr>
            </thead>
            <tbody id='table-search'>
                <?php foreach($data_index as $values){ ?>
                <tr>
                    <th class='table-title'><?= $values->fullname ?></th>
                    <th class='table-title'><?= $values->email ?></th>
                    <th class='table-title'><?= $values->phone ?></th>
                    <th class='table-title'><?= $values->address ?></th>
                    <th class='table-title'><img class="img"
                            src='http://localhost:9999/<?= $path_thumb.'/'.$values->thumb ?>' alt="gái xinh"></th>
                    <th class='table-title'><a href="http://localhost:9999/user/update/<?= $values->id ?>">edit</a></th>
                    <th class='table-title'><a href="http://localhost:9999/user/delete/<?= $values->id ?>">delete</a>
                    </th>
                    <th class='table-title'></th>

                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

</body>

</html>
<script>
const button = document.getElementById('button-addon2');
const valueSearch = document.querySelector("input[name=q]");

button.onclick = (e) => {
    e.preventDefault()
    const valueInp = valueSearch.value
    axios({
            mehtod: 'get',
            url: 'http://localhost:9999',
            params: {
                search: valueInp,
                orderBy: 'DESC',
                offset: '0',
                limit: '2',
            }
        })
        .then(data => {
            const table = document.getElementById('table-search');
            table.innerHTML = data.data
            console.log(data);
        })
        .catch(err => {
            console.log(err);
        })


}

</script>
<?php
// echo "<pre>";
print_r(
    isset($data_index)?$data_index:null
);