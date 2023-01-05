    <div class="w-75 mx-auto">
        <div class="input-group my-4 d-flex">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Tìm kiếm</span>
            </div>
            <input type="text" class="w-75 form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="searchBar">
            <a type="button" class="ml-3 btn btn-primary" href="/search/add">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>
        </div>

        <table class="table table-striped overflow-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Adress</th>
                    <th scope="col">Tùy Chỉnh</th>
                </tr>
            </thead>
            <tbody id="data">
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            renderData();
            
            $('#searchBar').keyup(function(){
                setTimeout(() => {
                    renderData($('#searchBar').val().trim())
                }, 500);
            })

            function renderData(query = ''){
                $.post(`http://localhost:9999/search/ajax/getquery`, {query: query}, function(res){
                    $('#data').html(res);
                })
            }

            // session add data in add page return to
            var success = '<?= (session()->getFlashdata('success'))? true : false ?>';

            if(success == 1) Swal.fire('Thao Tác Thành Công!','<?= session()->getFlashdata('success') ?>!','success')

        })
    </script>