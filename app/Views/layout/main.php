<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title><?= esc($title ?? 'Gudang') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS with Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
    }

    .navbar-brand:hover {
      transform: scale(1.05);
      transition: transform 0.2s ease;
    }

    .user-info {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 8px 15px;
      margin-right: 15px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-logout {
      border-radius: 20px;
      font-weight: 500;
      padding: 8px 20px;
      transition: all 0.3s ease;
    }

    .btn-logout:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-login {
      border-radius: 20px;
      font-weight: 500;
      padding: 8px 25px;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .navbar {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      background: linear-gradient(135deg, #343a40 0%, #495057 100%) !important;
    }

    @media (max-width: 768px) {
      .user-info {
        margin-right: 0;
        margin-bottom: 10px;
        text-align: center;
      }

      .navbar-nav {
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
        <i class="bi bi-boxes me-2"></i>
        Gudang
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
        </ul>

        <div class="navbar-nav ms-auto d-flex align-items-center">
          <?php if (session()->get('user_id')): ?>
            <div class="user-info d-flex align-items-center">
              <i class="bi bi-person-circle me-2"></i>
              <span class="text-light">
                <?= esc(session()->get('username')) ?>
              </span>
            </div>

            <a class="btn btn-outline-light btn-logout d-flex align-items-center" href="<?= site_url('/logout') ?>">
              <i class="bi bi-box-arrow-right me-2"></i>
              Logout
            </a>
          <?php else: ?>
            <a class="btn btn-outline-light btn-login d-flex align-items-center" href="<?= site_url('/login') ?>">
              <i class="bi bi-box-arrow-in-right me-2"></i>
              Login
            </a>
          <?php endif; ?>
        </div>
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