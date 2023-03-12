<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("_partials/head") ?>

<body class="bg-white">
    <div id="layoutError">
        <main>
            <div class="card-body align-text-justify">
                <p class="lead mb-4"><?= $KebijakanPrivasi->deskripsi ?></p>
            </div>
        </main>
    </div>
    <?php $this->load->view("_partials/js") ?>
</body>

</html>