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
                                        <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                        Data Kategori Fasilitas Umum
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
                        <div class="card shadow-none mb-4">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm shadow-sm" href="<?= base_url("menu_informasi/KategoriFasilitasUmum/tambah") ?>">
                                    Tambah Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px;">No</th>
                                                <th>Nama Kategori Fasilitas Umum</th>
                                                <th style="width: 100px;">Aksi</th>
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
    <!-- <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('menu_informasi/KategoriFasilitasUmum/tambah') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori Fasilitas Umum Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="small mb-1" for="nama_kategori">Nama Kategori Fasilitas Umum</label>
                            <input class="form-control" id="nama_kategori" name="nama_kategori" type="text" placeholder="Masukkan nama kategori fasilitas umum" required maxlength="32" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('menu_informasi/KategoriFasilitasUmum/edit') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit Kategori Fasilitas Umum</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_kategori" name="id_kategori">
                        <div class="form-group">
                            <label class="small mb-1" for="nama_kategori">Nama Kategori Fasilitas Umum</label>
                            <input class="form-control" id="nama_kategori" name="nama_kategori" type="text" placeholder="Masukkan nama kategori fasilitas umum" required maxlength="128" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
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
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" id="delete_link" type="button" href="">Hapus</a>
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
            url: "<?php echo base_url() . "menu_informasi/KategoriFasilitasUmum/getAllData" ?>",
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
                        '<td>' + data[i].nama_kategori + '</td>' +
                        '<td> <a href="KategoriFasilitasUmum/edit/' + data[i].id_kategori + '" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-pencil-alt"></i></a> <a class="delete btn btn-datatable btn-icon btn-transparent-dark" data-id="' + data[i].id_kategori + '" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>'

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
        $('#modalEdit').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget)
            var modal = $(this)
            modal.find('#id_kategori').attr("value", div.data('id_kategori'));
            modal.find('#nama_kategori').attr("value", div.data('nama_kategori'));
        });
    });

    $(document).ready(function() {
        $('#target').on('click', '.delete', function(event) {
            var el = this;
            var deleteid = $(this).data('id');
            $('#modalDelete').modal('show');
            console.log(deleteid);
            $('#delete_link').click(function(e) {
                $('#modalDelete').modal('hide');
                $.ajax({
                    url: '<?= base_url('menu_informasi/KategoriFasilitasUmum/delete') ?>',
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