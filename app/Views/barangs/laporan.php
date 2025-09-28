<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Kategori</th>
      <th>Total Barang</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($laporan as $row): ?>
      <tr>
        <td><?= esc($row['kategori']) ?></td>
        <td><?= esc($row['total']) ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?= $this->endSection() ?>
