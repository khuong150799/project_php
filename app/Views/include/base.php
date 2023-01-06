<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c9dc1e884c.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <title><?php echo $this->renderSection('title'); ?></title>
</head>

<body>

    <?php echo $this->renderSection("base"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            <?php if (session()->getFlashData('status')) { ?>
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: '<?= session()->getFlashData('status') ?>',
                    showConfirmButton: false,
                    timer: 1500
                })
            <?php } ?>
        });
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTableStudent').DataTable({
                order: [
                    [0, 'desc']
                ],
                searching: false,
                "language": {
                    "info": "Đang hiển thị trang _PAGE_ trên _PAGES_ trang",
                    "infoEmpty": "Không tìm thấy kết quả!",
                    'lengthMenu': "Hiển thị _MENU_ kết quả",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Tới",
                        "previous": "Lùi"
                    },
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.deleteItem').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest('tr').find('.item_id').val();
                Swal.fire({
                    title: 'Bạn có chắc chắn xóa không?',
                    text: "Thao tác không thể quay lại!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Khoan đã!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK, Xóa nó!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        try {
                            $.ajax({
                                type: "GET",
                                url: `delete/${delete_id}`,
                                success: (response) => (
                                    Swal.fire(
                                        'Đã xóa!',
                                        'Dữ liệu đã được xóa.',
                                        'success'
                                    ).then((ok) => {
                                        if (ok) {
                                            location.reload()
                                        }
                                    })
                                )
                            })
                        } catch (error) {
                            console.log("error", error);
                        }

                    }
                })
            })
        });
    </script>
</body>

</html>