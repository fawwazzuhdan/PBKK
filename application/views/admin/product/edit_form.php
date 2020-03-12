<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>

				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('admin/products/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url(" admin/product/edit") ?>" method="post" enctype="multipart/form-data">

							<input type="hidden" name="id" value="<?php echo $jasa->idservice ?>" />

							<div class="form-group">
								<label for="namaservice">Nama service*</label>
								<input class="form-control <?php echo form_error('namaservice') ? 'is-invalid' : '' ?>" type="text" name="namaservice" placeholder="Product name" value="<?php echo $jasa->namaservice ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('namaservice') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="harga">Harga</label>
								<input class="form-control <?php echo form_error('harga') ? 'is-invalid' : '' ?>" type="number" name="harga" min="0" placeholder="Product price" value="<?php echo $jasa->harga ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('harga') ?>
								</div>
							</div>


							<div class="form-group">
								<label for="gambar">Photo</label>
								<input class="form-control-file <?php echo form_error('gambar') ? 'is-invalid' : '' ?>" type="file" name="gambar" />
								<input type="hidden" name="old_image" value="<?php echo $jasa->gambar ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('gambar') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="deskripsi">Deskripsi*</label>
								<textarea class="form-control <?php echo form_error('deskripsi') ? 'is-invalid' : '' ?>" name="deskripsi" placeholder="Product description..."><?php echo $jasa->deskripsi ?></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('deskripsi') ?>
								</div>
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>