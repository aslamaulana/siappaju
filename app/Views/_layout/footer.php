<footer class="main-footer">
	<strong>Copyright &copy; 2022 <a href=""></a>.</strong>
	SETDA Kabpaten Pangandaran.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 1.0.5
	</div>
	<script>
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>

	<script src="<?= base_url('/toping/plugins/jquery/jquery.min.js') ?>"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<script src="<?= base_url('/toping/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('/toping/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
	<script src="<?= base_url('/toping/dist/js/adminlte.js') ?>"></script>
	<?= $this->renderSection('Javascript'); ?>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>