<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item">
			<select class="form-control" onchange="location = this.value;">
				<!-- <option <?= $_SESSION['tahun'] == '2022' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2022') ?>">2022</option> -->
				<!-- <option <?= $_SESSION['tahun'] == '2023' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2023') ?>">2024</option> -->
				<!-- <option <?= $_SESSION['tahun'] == '2024' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2024') ?>">2024</option> -->
				<!-- <option <?= $_SESSION['tahun'] == '2025' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2025') ?>">2025</option> -->
				<option <?= $_SESSION['tahun'] == '2026' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2026') ?>">2026</option>
			</select>
		</li>
		<!-- <li class="nav-item d-none d-sm-inline-block">
			<a href="<?= base_url(); ?>" class="nav-link">Home</a>
		</li> -->
		<li class="nav-item d-none d-sm-inline-block">
			<a style="pointer-events: none" class="nav-link"><?= opd()->name; ?></a>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<!-- <li class="nav-item d-none d-md-inline-block" style="font-size: larger;">
			<a style="pointer-events: none" class="nav-link">
				<p id="timer"></p>
			</a>
		</li> -->
		<?php if (menu('hspk')->timer_a == 'aktif' || menu('ssh')->timer_a == 'aktif' || menu('asb')->timer_a == 'aktif') { ?>
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i id="area" class="fa fa-stopwatch fa-2x" style="color:red;"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">Timer</span>
					<?php if (menu('ssh')->timer_a == 'aktif') { ?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item">
							SSH/SBU <i class="fa mr-2" id="timer_ssh"></i>
						</a>
					<?php } ?>
					<?php if (menu('hspk')->timer_a == 'aktif') { ?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item">
							HSPK <i class="fa mr-2" id="timer_hspk"></i>
						</a>
					<?php } ?>
					<?php if (menu('asb')->timer_a == 'aktif') { ?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item">
							ASB <i class="fa mr-2" id="timer_asb"></i>
						</a>
					<?php } ?>
				</div>
			</li>
		<?php } ?>
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<div class="image">
					<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-size-32 mr-3 img-circle" alt="User Image">
				</div>
				<span class="badge badge-success navbar-badge">&nbsp;&nbsp;</span>
			</a>
			<div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
				<a class="dropdown-item text-center">
					<p><?= user()->full_name; ?><br>
						Nip: <?= user()->nip; ?></p>
				</a>
				<span class="dropdown-item dropdown-header"></span>
				<div class="dropdown-divider"></div>
				<?php if (has_permission('Admin')) : ?>
					<a href="<?= base_url('/admin/user/users/ubah_password'); ?>" class="dropdown-item">
						<i class="fa fa-key mr-2"></i> Ubah Password
					</a>
				<?php else : ?>
					<a href="<?= base_url('/user/user/users/ubah_password'); ?>" class="dropdown-item">
						<i class="fa fa-key mr-2"></i> Ubah Password
					</a>
				<?php endif ?>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('/logout'); ?>" class="dropdown-item">
					<i class="fa fa-reply mr-2"></i> LogOut
				</a>
			</div>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li> -->
		<!-- <li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				<i class="fas fa-th-large"></i>
			</a>
		</li> -->
	</ul>
</nav>

<?php if (menu('hspk')->timer_a == 'aktif') { ?>
	<script>
		// Mengatur waktu akhir perhitungan mundur
		var countDownDateHspk = new Date("<?= menu('hspk')->timer; ?>").getTime();

		// Memperbarui hitungan mundur setiap 1 detik
		var x = setInterval(function() {
			// Untuk mendapatkan tanggal dan waktu hari ini
			var nowHspk = new Date().getTime();
			// Temukan jarak antara sekarang dan tanggal hitung mundur
			var distanceHspk = countDownDateHspk - nowHspk;
			// Perhitungan waktu untuk hari, jam, menit dan detik
			var daysHspk = Math.floor(distanceHspk / (1000 * 60 * 60 * 24));
			var hoursHspk = Math.floor((distanceHspk % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutesHspk = Math.floor((distanceHspk % (1000 * 60 * 60)) / (1000 * 60));
			var secondsHspk = Math.floor((distanceHspk % (1000 * 60)) / 1000);
			// Keluarkan hasil dalam elemen dengan id = "demo"
			document.getElementById("timer_hspk").innerHTML = daysHspk + "d " + hoursHspk + "h " +
				minutesHspk + "m " + secondsHspk + "s ";
			// Jika hitungan mundur selesai, tulis beberapa teks 
			if (distanceHspk < 0) {
				clearInterval(x);
				document.getElementById("timer_hspk").innerHTML = "EXPIRED";
				window.location.href = "<?php echo base_url('/admin/menu/menu/set/' . menu('hspk')->id_menu); ?>";
			}
		}, 1000);
	</script>
<?php }	?>
<?php if (menu('ssh')->timer_a == 'aktif') { ?>
	<script>
		// Mengatur waktu akhir perhitungan mundur
		var countDownDateSsh = new Date("<?= menu('ssh')->timer; ?>").getTime();

		// Memperbarui hitungan mundur setiap 1 detik
		var x = setInterval(function() {
			// Untuk mendapatkan tanggal dan waktu hari ini
			var nowSsh = new Date().getTime();
			// Temukan jarak antara sekarang dan tanggal hitung mundur
			var distanceSsh = countDownDateSsh - nowSsh;
			// Perhitungan waktu untuk hari, jam, menit dan detik
			var daysSsh = Math.floor(distanceSsh / (1000 * 60 * 60 * 24));
			var hoursSsh = Math.floor((distanceSsh % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutesSsh = Math.floor((distanceSsh % (1000 * 60 * 60)) / (1000 * 60));
			var secondsSsh = Math.floor((distanceSsh % (1000 * 60)) / 1000);
			// Keluarkan hasil dalam elemen dengan id = "demo"
			document.getElementById("timer_ssh").innerHTML = daysSsh + "d " + hoursSsh + "h " +
				minutesSsh + "m " + secondsSsh + "s ";
			// Jika hitungan mundur selesai, tulis beberapa teks 
			if (distanceSsh < 0) {
				clearInterval(x);
				document.getElementById("timer_ssh").innerHTML = "EXPIRED";
				window.location.href = "<?php echo base_url('/admin/menu/menu/set/' . menu('ssh')->id_menu); ?>";
			}
		}, 1000);
	</script>
<?php }	?>
<?php if (menu('asb')->timer_a == 'aktif') { ?>
	<script>
		// Mengatur waktu akhir perhitungan mundur
		var countDownDate = new Date("<?= menu('asb')->timer; ?>").getTime();

		// Memperbarui hitungan mundur setiap 1 detik
		var x = setInterval(function() {
			// Untuk mendapatkan tanggal dan waktu hari ini
			var now = new Date().getTime();
			// Temukan jarak antara sekarang dan tanggal hitung mundur
			var distance = countDownDate - now;
			// Perhitungan waktu untuk hari, jam, menit dan detik
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			// Keluarkan hasil dalam elemen dengan id = "demo"
			document.getElementById("timer_asb").innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";
			// Jika hitungan mundur selesai, tulis beberapa teks 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("timer_asb").innerHTML = "EXPIRED";
				window.location.href = "<?php echo base_url('/admin/menu/menu/set/' . menu('asb')->id_menu); ?>";
			}
		}, 1000);
	</script>
<?php }	?>
<script>
	setInterval(() => {
		document.querySelector("#area").classList.toggle("isVisible");
	}, 2000);
</script>