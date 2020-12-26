<?= $this->extend('layout/layout_front/template') ?>
<?= $this->section('content') ?>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1 class="display-4">PT. Perdana Semesta Perkasa</h1>
		<p class="lead">Jasa Pengurusan Transportasi</p>
	</div>
</div>
<div class="container">
	<!-- info panel -->
	<div class="row justify-content-center">
		<div class="col-11 info-panel">
			<div class="row">
				<div class="col-lg">
					<img src="<?= base_url(''); ?>/assets_front/img/employee.png" class="float-left">
					<h4>Pelayanan</h4>
					<p>Jam pelayanan 08:30 sd 16:30</p>
				</div>
				<div class="col-lg">
					<img src="<?= base_url(''); ?>/assets_front/img/hires.png" class="float-left">
					<h4>Report</h4>
					<p>Memberikan report kepada Customer</p>
				</div>
				<div class="col-lg">
					<img src="<?= base_url(''); ?>/assets_front/img/security.png" class="float-left">
					<h4>Aman</h4>
					<p>Pengiriman aman</p>
				</div>
			</div>
		</div>
	</div>
	<!-- akhir info panel -->
</div>

<?= $this->endsection() ?>