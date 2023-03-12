<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head") ?>

<body class="nav-fixed">
    <?php $this->load->view("_partials/navbar") ?>
    <div id="layoutSidenav">
        <?php $this->load->view("_partials/sidebar") ?>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="smartphone"></i></div>
                                        Data Versi Aplikasi
                                    </h1>
                                    <div class="page-header-subtitle">Jember Kota Pintar</div>
                                </div>
                            </div>
                        </div>
                        <div id="alert"><?php echo $this->session->flashdata('message') ?></div>
                    </div>
                </header>
                <div class="container mt-n10">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="card shadow-none card-header-actions mx-auto mb-4">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm shadow-sm" href="<?= base_url("menu_informasi/VersiAplikasi/tambah") ?>">
                                    Tambah Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="30px">No</th>
                                                <th>Versi Aplikasi</th>
                                                <th>Deskripsi</th>
                                                <th width="100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark" id="target">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            <?php $this->load->view("_partials/footer") ?>
        </div>
    </div>
    <?php $this->load->view("_partials/js") ?>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin untuk menghapus data?</div>
                <div class="modal-footer">
                    <a class="btn btn-danger" id="delete_link" type="button" href="">Hapus</a>
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function confirm_modal(delete_url) {
        document.getElementById('delete_link').setAttribute('href', delete_url);
        $('#hapusModal').modal('show', {
            backdrop: 'static'
        });
    }

    var timeout = 3000;
    $('#alert').delay(timeout).fadeOut(300);
    getData();

    function getData() {
        $.ajax({
            url: "<?php echo base_url() . "menu_informasi/VersiAplikasi/getAllData" ?>",
            dataType: "json",
            beforeSend: function() {
                console.log("Please Wait....");
                document.getElementById("myNav").style.height = "100%";
            },
            success: function(data) {
                document.getElementById("myNav").style.height = "0%";
                console.log(data);
                var baris = '';
                var no = 1;
                for (var i = 0; i < data.length; i++) {
                    baris += '<tr>' +
                        '<td>' + (no + i) + '</td>' +
                        '<td>' + data[i].versi_aplikasi + '</td>' +
                        '<td>' + data[i].deskripsi + '</td>' +
                        '<td> <a href="VersiAplikasi/edit/' + data[i].id_versi + '" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-pencil-alt"></i></a> <a class="delete btn btn-datatable btn-icon btn-transparent-dark" data-id="' + data[i].id_versi + '" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>'
                    '</tr>'
                }
                $('#dataTable').dataTable().fnDestroy();
                $('#target').html(baris);
                $("#dataTable").dataTable({
                    "paging": true,
                    "searching": true
                });
            },
        });
    }

    $(document).ready(function() {
        $('#target').on('click', '.delete', function(event) {
            var el = this;
            var deleteid = $(this).data('id');
            $('#modalDelete').modal('show');
            console.log(deleteid);
            $('#delete_link').click(function(e) {
                $('#modalDelete').modal('hide');
                $.ajax({
                    url: '<?= base_url('menu_informasi/VersiAplikasi/delete') ?>',
                    type: 'POST',
                    data: {
                        id: deleteid
                    },
                    beforeSend: function() {
                        console.log("Please Wait....");
                        document.getElementById("myNav").style.height = "100%";
                    },
                    success: function(response) {
                        document.getElementById("myNav").style.height = "0%";
                        console.log(response);
                        $(el).closest('tr').fadeOut(800, function() {
                            $(this).remove();
                        });
                    }
                });
            });
        });
    });
</script>

</html>