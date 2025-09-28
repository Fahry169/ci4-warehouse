<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2 text-primary mb-0">
                    <i class="fas fa-box me-2"></i><?= esc($title) ?>
                </h1>
                <a href="/barangs" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Detail
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Kode Barang</label>
                            <div class="p-2 bg-light rounded">
                                <span class="badge bg-dark fs-6"><?= esc($barang['kode_barang']) ?></span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Kategori</label>
                            <div class="p-2 bg-light rounded">
                                <span class="badge bg-info fs-6"><?= esc($barang['kategori']) ?></span>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold text-muted">Nama Barang</label>
                            <div class="p-3 bg-light rounded">
                                <h5 class="mb-0 text-dark"><?= esc($barang['nama']) ?></h5>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Jumlah & Satuan</label>
                            <div class="p-2 bg-light rounded">
                                <span class="fs-5 fw-bold text-success">
                                    <?= esc($barang['jumlah']) ?> <?= esc($barang['satuan']) ?>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Lokasi</label>
                            <div class="p-2 bg-light rounded">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                <?= esc($barang['lokasi']) ?>
                            </div>
                        </div>

                        <?php if (!empty($barang['keterangan'])): ?>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold text-muted">Keterangan</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0"><?= esc($barang['keterangan']) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <?php if (!empty($barang['gambar'])): ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-image me-2"></i>Foto Barang
                        </h5>
                    </div>
                    <div class="card-body text-center p-2">
                        <img src="<?= base_url('writable/uploads/' . esc($barang['gambar'])) ?>" class="img-fluid rounded shadow-sm"
                            alt="<?= esc($barang['nama']) ?>" style="max-height: 300px; object-fit: cover;">
                    </div>
                </div>
            <?php else: ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-image me-2"></i>Foto Barang
                        </h5>
                    </div>
                    <div class="card-body text-center p-5">
                        <i class="fas fa-image fa-5x text-muted mb-3"></i>
                        <p class="text-muted">Tidak ada gambar</p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card shadow-sm mt-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Aksi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="/barangs/edit/<?= $barang['id'] ?? '' ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <button class="btn btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                        <a href="/barangs/pdf/<?= $barang['id'] ?? '' ?>" class="btn btn-success">
                            <i class="fas fa-print me-2"></i>Print PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-left-primary shadow">
                <div class="card-body py-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Status Stok
                            </div>
                            <?php
                            $jumlah = (int) $barang['jumlah'];
                            $statusClass = $jumlah > 10 ? 'success' : ($jumlah > 0 ? 'warning' : 'danger');
                            $statusText = $jumlah > 10 ? 'Stok Aman' : ($jumlah > 0 ? 'Stok Terbatas' : 'Stok Habis');
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-<?= $statusClass ?>">
                                <?= $statusText ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-<?= $statusClass ?>"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
]
<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
            window.location.href = '/barangs/delete/<?= $barang['id'] ?? '' ?>';
        }
    }
</script>

<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
</style>

<?= $this->endSection() ?>