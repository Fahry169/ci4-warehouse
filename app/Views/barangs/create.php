<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2 text-primary mb-0">
                    <i class="fas fa-plus-circle me-2"></i><?= esc($title) ?>
                </h1>
                <a href="/barangs" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <hr class="mt-3">
        </div>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan!</strong> Mohon perbaiki data berikut:
                    <hr>
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Form Input Data Barang
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="/barangs/store" method="post" enctype="multipart/form-data" id="formBarang">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label fw-bold">
                                        <i class="fas fa-barcode me-1"></i>Kode Barang
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="kode_barang" id="kode_barang"
                                        class="form-control form-control-lg" value="<?= old('kode_barang') ?>"
                                        placeholder="Masukkan kode barang" required>
                                    <div class="form-text">Format: BRG001, BRG002, dst.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label fw-bold">
                                        <i class="fas fa-tag me-1"></i>Nama Barang
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama" id="nama" class="form-control form-control-lg"
                                        value="<?= old('nama') ?>" placeholder="Masukkan nama barang" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label fw-bold">
                                        <i class="fas fa-list me-1"></i>Kategori
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="kategori" id="kategori" class="form-select form-select-lg" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Elektronik" <?= old('kategori') == 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
                                        <option value="Furniture" <?= old('kategori') == 'Furniture' ? 'selected' : '' ?>>
                                            Furniture</option>
                                        <option value="Alat Tulis" <?= old('kategori') == 'Alat Tulis' ? 'selected' : '' ?>>Alat Tulis</option>
                                        <option value="Peralatan" <?= old('kategori') == 'Peralatan' ? 'selected' : '' ?>>
                                            Peralatan</option>
                                        <option value="Lainnya" <?= old('kategori') == 'Lainnya' ? 'selected' : '' ?>>
                                            Lainnya</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="jumlah" class="form-label fw-bold">
                                                <i class="fas fa-calculator me-1"></i>Jumlah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="jumlah" id="jumlah"
                                                class="form-control form-control-lg" value="<?= old('jumlah', 1) ?>"
                                                min="0" step="1" required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mb-3">
                                            <label for="satuan" class="form-label fw-bold">
                                                <i class="fas fa-balance-scale me-1"></i>Satuan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="satuan" id="satuan" class="form-select form-select-lg"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Pcs" <?= old('satuan') == 'Pcs' ? 'selected' : '' ?>>Pcs
                                                </option>
                                                <option value="Unit" <?= old('satuan') == 'Unit' ? 'selected' : '' ?>>Unit
                                                </option>
                                                <option value="Set" <?= old('satuan') == 'Set' ? 'selected' : '' ?>>Set
                                                </option>
                                                <option value="Pack" <?= old('satuan') == 'Pack' ? 'selected' : '' ?>>Pack
                                                </option>
                                                <option value="Box" <?= old('satuan') == 'Box' ? 'selected' : '' ?>>Box
                                                </option>
                                                <option value="Kg" <?= old('satuan') == 'Kg' ? 'selected' : '' ?>>Kg
                                                </option>
                                                <option value="Liter" <?= old('satuan') == 'Liter' ? 'selected' : '' ?>>
                                                    Liter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt me-1"></i>Lokasi Penyimpanan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="lokasi" id="lokasi" class="form-control form-control-lg"
                                        value="<?= old('lokasi') ?>" placeholder="Contoh: Gudang A, Rak 1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label fw-bold">
                                        <i class="fas fa-comment me-1"></i>Keterangan
                                    </label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="4"
                                        placeholder="Tambahkan deskripsi atau keterangan tambahan..."><?= old('keterangan') ?></textarea>
                                    <div class="form-text">Opsional - Deskripsi detail tentang barang</div>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label fw-bold">
                                        <i class="fas fa-image me-1"></i>Upload Gambar
                                    </label>
                                    <input type="file" name="gambar" id="gambar" class="form-control form-control-lg"
                                        accept="image/*" onchange="previewImage(this)">
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Format: JPG, JPEG, PNG. Maksimal 2MB
                                    </div>

                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <div class="card">
                                            <div class="card-body text-center p-2">
                                                <img id="preview" src="#" alt="Preview" class="img-fluid rounded"
                                                    style="max-height: 150px;">
                                                <div class="mt-2">
                                                    <small class="text-muted">Preview Gambar</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <small>Field bertanda <span class="text-danger">*</span> wajib diisi</small>
                                    </div>
                                    <div>
                                        <button type="reset" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-undo me-1"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="fas fa-save me-2"></i>Simpan Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    }

    document.getElementById('kategori').addEventListener('change', function () {
        const kategori = this.value;
        const kodeInput = document.getElementById('kode_barang');

        if (kategori && !kodeInput.value) {
            let prefix = '';
            switch (kategori) {
                case 'Elektronik': prefix = 'ELK'; break;
                case 'Furniture': prefix = 'FUR'; break;
                case 'Alat Tulis': prefix = 'ATK'; break;
                case 'Peralatan': prefix = 'PER'; break;
                default: prefix = 'BRG'; break;
            }

            const randomNum = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            kodeInput.value = prefix + randomNum;
        }
    });

    document.getElementById('formBarang').addEventListener('submit', function (e) {
        const requiredFields = ['kode_barang', 'nama', 'kategori', 'jumlah', 'satuan', 'lokasi'];
        let isValid = true;

        requiredFields.forEach(field => {
            const input = document.getElementById(field);
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
        }
    });
</script>

<style>
    .form-control:focus,
    .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .is-invalid {
        border-color: #e74a3b !important;
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .form-control-lg,
    .form-select-lg {
        border-radius: 8px;
    }
</style>

<?= $this->endSection() ?>