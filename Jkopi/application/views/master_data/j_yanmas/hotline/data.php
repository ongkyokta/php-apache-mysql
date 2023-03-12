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
                                        Data Hotline OPD/Dinas
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
                                Data Hotline OPD/Dinas
                            </div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="30px">No</th>
                                                <th>Nama OPD/Dinas</th>
                                                <th>Nomor Telepon</th>
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
            url: "<?php echo base_url() . "master_data/j_yanmas/Hotline/getAllData" ?>",
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
                        '<td>' + data[i].nama_opd + '</td>' +
                        '<td>' + data[i].no_telp + '</td>' +
                        '<td> <a href="Hotline/edit/' + data[i].id_opd + '" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-pencil-alt"></i></a></td>'
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
</script>

</html>