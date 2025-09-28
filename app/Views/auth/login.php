<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
	<div class="col-md-4">
		<h3 class="mb-3">Login</h3>
		<?php if (session()->getFlashdata('error')): ?>
			<div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
		<?php endif; ?>
		<form method="post" action="<?= site_url('login') ?>">
			<?= csrf_field() ?>
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input type="text" class="form-control" name="username" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="password" required>
			</div>
			<button type="submit" class="btn btn-primary w-100">Login</button>
		</form>
	</div>
</div>
<?= $this->endSection() ?>




