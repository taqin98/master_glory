

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

	<div class="position-fixed top end-0 p-3" style="z-index: 11">
		<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#15de21"></rect></svg>
				<strong class="me-auto">Notifikasi</strong>
				<small>Baru Saja</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">
				Hello, world! This is a toast message.
			</div>
		</div>
	</div>



	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?= $title_page ?></h1>

	</div>
	<?php
	date_default_timezone_set("Asia/Jakarta");
	$nomor = date('His') . '/GLORY/'. date('m') .'/' . date('Y');
	?>
	<div class="container">
		<form class="needs-validation" novalidate>
			<div class="row g-3">
				<div class="col-sm-6">
					<label for="nomorPengajuan" class="form-label">Nomor Pengajuan</label>
					<input type="text" class="form-control" id="nomorPengajuan" placeholder="" readonly value="<?= $nomor ?>" required style="background-color: #f8f9fa;">
					<div class="invalid-feedback">
						Nomor Pengajuan Wajib di isi.
					</div>
				</div>

				<div class="col-sm-6">
					<label for="namaLengkap" class="form-label">Nama Lengkap</label>
					<input type="text" class="form-control" id="namaLengkap" placeholder="" value="" required>
					<div class="invalid-feedback">
						Nama Lengkap Wajib di isi.
					</div>
				</div>

				<div class="col-sm-3">
					<label for="nik" class="form-label">NIK</label>
					<input type="number" class="form-control" id="nik" placeholder="" value="" required>
					<div class="invalid-feedback">
						NIK Wajib di isi.
					</div>
				</div>

				<div class="col-sm-3">
					<label for="bagian" class="form-label">Bagian</label>
					<input type="text" class="form-control" id="bagian" placeholder="" value="" required>
					<div class="invalid-feedback">
						Bagian Wajib di isi.
					</div>
				</div>

				<div class="col-sm-6">
					<label for="tanggalPengajuan" class="form-label">Tanggal</label>
					<input type="date" class="form-control" id="tanggalPengajuan" placeholder="" value="" required>
					<div class="invalid-feedback">
						Tanggal Wajib di isi.
					</div>
				</div>
			</div>

			<hr class="my-4">

			
			<div class="row g-3">
				<div class="my-3 col-sm-6">
					<h4 class="mb-3">Keperluan</h4>

					<div class="form-check">
						<input id="sakit" name="keperluanRadio" type="radio" value="1" class="form-check-input" checked required onchange="checkKeperluan(this)">
						<label class="form-check-label" for="sakit">Sakit</label>
					</div>
					<div class="form-check">
						<input id="urusanKeluarga" name="keperluanRadio" type="radio" value="2" class="form-check-input" required onchange="checkKeperluan(this)">
						<label class="form-check-label" for="urusanKeluarga">Urusan Keluarga</label>
					</div>
					<div class="form-check">
						<input id="Lainlain" name="keperluanRadio" type="radio" value="9" class="form-check-input" required onchange="checkKeperluan(this)">
						<label class="form-check-label" for="Lainlain">Lain-lain</label>
					</div>
				</div>
				<div class="my-3 col-sm-6">
					<h4 class="mb-3">Keterangan</h4>

					<div class="my-3">
						<div class="form-check">
							<input id="kembali" name="ketRadio" type="radio" value="1" class="form-check-input" checked required>
							<label class="form-check-label" for="kembali">Kembali</label>
						</div>
						<div class="form-check">
							<input id="tidakKembali" name="ketRadio" type="radio" value="0" class="form-check-input" required>
							<label class="form-check-label" for="tidakKembali">Tidak Kembali</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row mb-3" id="container-lainlain">
			</div>


			<div class="my-3 d-flex align-items-center">
				<h4 class="me-3">Tanda Tangan</h4>
				<div class="form-check me-3">
					<input id="manual" name="ttdRadio" type="radio" value="0" class="form-check-input" checked required onchange="checkStatusTtd(this)">
					<label class="form-check-label" for="manual">Manual</label>
				</div>
				<div class="form-check me-3">
					<input id="otomatis" name="ttdRadio" type="radio" value="1" class="form-check-input" required onchange="checkStatusTtd(this)">
					<label class="form-check-label" for="otomatis">Otomatis (Upload)</label>
				</div>
			</div>

			<div class="row gy-3" id="container-ttd">
				
			</div>

			<hr class="my-4">

			<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>

		</form>
	</div>
</main>


