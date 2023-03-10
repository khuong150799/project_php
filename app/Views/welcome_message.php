<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file</title>
    <link rel="stylesheet" href="http://localhost:9999/style.css">
    <script src="https://use.fontawesome.com/c9dc1e884c.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js" integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class='d-flex-column' id='table-search'>
        <form action="">
            <div class="input-group">
                <h3 class="mb-0 mt-2">
                    <a href="/user" class="mt-3 me-3">
                        <i class="fa fa-repeat"></i>
                    </a>
                </h3>
                <input type="text" class="form-control" placeholder="Tìm sinh viên..." id='search-inp' value="<?= isset($value_search) ? $value_search : '' ?>" aria-describedby="button-addon2">
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
                    <th class='table-title'></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (isset($data_index) ? $data_index : null as $values) { ?>
                    <tr>
                        <th class='table-title'><?= $values->fullname ?></th>
                        <th class='table-title'><?= $values->email ?></th>
                        <th class='table-title'><?= $values->phone ?></th>
                        <th class='table-title'><?= $values->address ?></th>
                        <th class='table-title'><img class="img" src='http://localhost:9999/<?= $path_thumb . '/' . $values->thumb ?>' alt="gái xinh"></th>
                        <th class='table-title'><a href="http://localhost:9999/user/update/<?= $values->id ?>">edit</a></th>
                        <th class='table-title'><a href="http://localhost:9999/user/delete/<?= $values->id ?>">delete</a>
                        </th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
           <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                <button onclick="panagition(event)" class='paganation'><?= $i ?></button>
            <?php  } ?>
        </div>
    </div>

</body>

</html>
<script>
    const button = document.getElementById('button-addon2');
    const panigations = document.querySelectorAll(".paganation");
    const valueSearch = document.getElementById("search-inp");
    
    function handelClick(e,page = 1){
        e.preventDefault()
        let limit = 1
        let offset = (page - 1) * limit
        // limit.toString
        // console.log('offset',offset);
        // location.href = "http://localhost:9999/user";
        const valueInp = valueSearch.value
        // console.log('valueInp',valueInp);
        axios({
                mehtod: 'get',
                url: 'http://localhost:9999/user',
                params: {
                    search: valueInp,
                    orderBy: 'DESC',
                    offset,
                    limit
                }
            })
            .then(data => {
                const table = document.getElementById('table-search');

                //lấy nội dung cần lấy trong file html do gọi api trả về
                let parser = new DOMParser();
                let doc = parser.parseFromString(data.data, "text/html");
                let tableSearchElement = doc.getElementById("table-search");
                let content = tableSearchElement.innerHTML;
                table.innerHTML = content
                // console.log(content);
            })
            .catch(err => {
                console.log(err);
            })


    }
    button.addEventListener('click',handelClick)
    function panagition(e){
        handelClick(e,e.target.innerText)
        // console.log(e.target.innerText);
    }
  
</script>