<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<form action="<?= base_url('/admin/user/users/users_create'); ?>" method="POST">
	<div class="card-body">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= kunci($users_id); ?>">
		<input type="hidden" name="akses" value="<?= $opd_id; ?>">
		<div class="col-md">
			<!--  -->
			<div class="form-group">
				<label>Nama Pengguna</label>
				<input type="text" name="nm" class="form-control" placeholder=" Nama Pengguna" maxlength="255" required>
				<div class="invalid-feedback">
					<?= $validation->getError('nm'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder=" Username" maxlength="255" required>
				<div class="invalid-feedback">
					<?= $validation->getError('username'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
				<div class="invalid-feedback">
					<?= $validation->getError('password'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Ulangi Password</label>
				<input type="password" name="password_k" class="form-control <?= ($validation->hasError('password_k')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
				<div class="invalid-feedback">
					<?= $validation->getError('password_k'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" maxlength="255" require>
				<div class="invalid-feedback">
					<?= $validation->getError('email'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Aktive</label>
				<div class="form-check">
					<input name="active" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
				</div>
			</div>

		</div>
		<!-- /.card-body -->
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</div>
</form>
<?= $this->endSection(); ?>