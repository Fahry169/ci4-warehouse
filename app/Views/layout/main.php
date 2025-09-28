<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= esc($title ?? 'Gudang') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS with Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url('/') ?>">Gudang</a>
    <div class="navbar-nav ms-auto">
      <?php if (session()->get('user_id')): ?>
        <span class="navbar-text me-3">
          Welcome, <?= esc(session()->get('username')) ?>
        </span>
        <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-light btn-sm" href="<?= site_url('/login') ?>">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <?= $this->renderSection('content') ?>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<?= $this->renderSection('scripts') ?>
</body>
</html>
