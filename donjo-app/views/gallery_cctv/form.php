<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Playlist</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('gallery') ?>"><i class="fa fa-dashboard"></i> Playlist</a></li>
			<li class="active">Form CCTV</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div id="umum-sidebar" class="col-md-3">
					<?php $this->load->view('gallery_cctv/menu') ?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("gallery_cctv") ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali
							</a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="control-label col-sm-4" for="nama">Nama CCTV</label>
								<div class="col-sm-6">
									<input name="nama" class="form-control input-sm" maxlength="100" type="text" value="<?= $gallery['nama'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="link">URL CCTV</label>
								<div class="col-sm-6">
									<div class="box-body text-center border">
										<iframe width="250" height="160" src="<?= $gallery["link"]; ?>" frameborder="0" allowfullscreen></iframe>
									</div>
									<input name="link" class="form-control input-sm" maxlength="100" type="text" value="<?= $gallery['link'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="deskripsi">Deskripsi</label>
								<div class="col-sm-6">
									<textarea class="textarea" name="deskripsi" placeholder="Deskripsi video" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" value="<?= $gallery['deskripsi'] ?>"><?= $gallery['deskripsi'] ?></textarea>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
								<button type='reset' class='btn btn-social btn-box btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
								<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>