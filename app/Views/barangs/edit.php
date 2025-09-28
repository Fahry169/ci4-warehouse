<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2 text-warning mb-0">
                    <i class="fas fa-edit me-2"></i>Edit Data Barang
                </h1>
                <a href="/barangs" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Terjadi kesalahan!</strong> Mohon perbaiki data berikut:
            <hr>
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="fas fa-pen me-2"></i>Form Edit Barang
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="/barangs/update/<?= $barang['id'] ?>" method="post" enctype="multipart/form-data"
                id="formBarang">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label fw-bold">Kode Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang" class="form-control form-control-lg"
                                value="<?= old('kode_barang', $barang['kode_barang']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Barang</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-lg"
                                value="<?= old('nama', $barang['nama']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik" <?= old('kategori', $barang['kategori']) == 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
                                <option value="Furniture" <?= old('kategori', $barang['kategori']) == 'Furniture' ? 'selected' : '' ?>>Furniture</option>
                                <option value="Alat Tulis" <?= old('kategori', $barang['kategori']) == 'Alat Tulis' ? 'selected' : '' ?>>Alat Tulis</option>
                                <option value="Peralatan" <?= old('kategori', $barang['kategori']) == 'Peralatan' ? 'selected' : '' ?>>Peralatan</option>
                                <option value="Lainnya" <?= old('kategori', $barang['kategori']) == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-lg"
                                        value="<?= old('jumlah', $barang['jumlah']) ?>" min="0" step="1" required>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="satuan" class="form-label fw-bold">Satuan</label>
                                    <select name="satuan" id="satuan" class="form-select form-select-lg" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Pcs" <?= old('satuan', $barang['satuan']) == 'Pcs' ? 'selected' : '' ?>>Pcs</option>
                                        <option value="Unit" <?= old('satuan', $barang['satuan']) == 'Unit' ? 'selected' : '' ?>>Unit</option>
                                        <option value="Set" <?= old('satuan', $barang['satuan']) == 'Set' ? 'selected' : '' ?>>Set</option>
                                        <option value="Pack" <?= old('satuan', $barang['satuan']) == 'Pack' ? 'selected' : '' ?>>Pack</option>
                                        <option value="Box" <?= old('satuan', $barang['satuan']) == 'Box' ? 'selected' : '' ?>>Box</option>
                                        <option value="Kg" <?= old('satuan', $barang['satuan']) == 'Kg' ? 'selected' : '' ?>>Kg</option>
                                        <option value="Liter" <?= old('satuan', $barang['satuan']) == 'Liter' ? 'selected' : '' ?>>Liter</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lokasi" class="form-label fw-bold">Lokasi Penyimpanan</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control form-control-lg"
                                value="<?= old('lokasi', $barang['lokasi']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"
                                rows="4"><?= old('keterangan', $barang['keterangan']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-bold">Upload Gambar (Opsional)</label>
                            <input type="file" name="gambar" id="gambar" class="form-control form-control-lg"
                                accept="image/*">
                            <?php if (!empty($barang['gambar'])): ?>
                                <div class="mt-3">
                                    <p>Gambar Saat Ini:</p>
                                    <img src="/uploads/<?= esc($barang['gambar']) ?>" alt="Gambar Barang"
                                        class="img-fluid rounded" style="max-height:150px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Field bertanda <span class="text-danger">*</span> wajib diisi</small>
                    <div>
                        <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-warning btn-lg">
                            <i class="fas fa-save me-2"></i>Update Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>