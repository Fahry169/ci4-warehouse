<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1 class="mb-3"><?= esc($title) ?></h1>

<a href="/barangs/create" class="btn btn-primary mb-3">Tambah</a>

<table id="barangTable" class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        $('#barangTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/barangs/ajaxList',
                type: 'POST'
            }
        });

    });
</script>
<?= $this->endSection() ?>