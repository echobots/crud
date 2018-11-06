<?php 
$conn = mysqli_connect("localhost","root","","crud");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Belajar CRUD modal Bootstrap | Sederhana</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div class="wrapper">
   <br>
   <br>
   &nbsp &nbsp<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambahData">Tambah</button>
   <!-- Modal Tambah Data -->
   <div class="modal fade bs-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel">
	  <div class="modal-dialog  modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="tambahDataLabel">Tambah mahasiswa</h4>
	      </div>
	      <div class="modal-body">
	       	<form class="form-horizontal" action="" method="POST">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Nim</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputEmail3" name="nim" placeholder="Nim">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputPassword3" name="nama" placeholder="Nama">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
			    <div class="col-sm-10">
			      <textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Fakultas</label>
			    <div class="col-sm-10">
			      <select class="form-control" name="fakultas">
			      	<option>Pilih Fakultas</option>
			      	<option value="FT">Fakultas Teknik</option>
			      	<option value="FMIPA">Fakultas Ilmu Matematika</option>
			      	<option value="FAI">Fakultas Agama Islam</option>
			      	<option value="FIA">Faklutas Ilmu Administrasi</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Prodi</label>
			    <div class="col-sm-10">
			      <select class="form-control" name="prodi">
			      	<option>Pilih Prodi</option>
			      	<option value="SI">Sistem Informasi</option>
			      	<option value="TI">Teknik Informatika</option>
			      	<option value="PAI">Pendidikan Agama Islam</option>
			      	<option value="AB">Administrasi Bisnis</option>
			      </select>
			    </div>
			  </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
	        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
	       </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- Akhir modal tambah data -->
   <br>
   <br>
   <!-- Aksi Insert Data dalam DB -->
	<?php 
	if (isset($_REQUEST['simpan'])) {
		$nim = $_REQUEST['nim'];
		$nama = $_REQUEST['nama'];
		$alamat = $_REQUEST['alamat'];
		$fakultas = $_REQUEST['fakultas'];
		$prodi   = $_REQUEST['prodi'];

		$result = mysqli_query($conn,"INSERT INTO mahasiswa (nim,nama,alamat,fakultas,prodi) 
									  values ('$nim','$nama','$alamat','$fakultas','$prodi')");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Perhatian !!</strong> Data berhasil disimpan</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Perhatian !!</strong> Data gagal disimpan</div>";
		}
	}
  
    // Script update data
	if (isset($_REQUEST['update'])) {
		$id_mahasiswa = $_REQUEST['id_mahasiswa'];
		$nim = $_REQUEST['nim'];
		$nama = $_REQUEST['nama'];
		$alamat = $_REQUEST['alamat'];
		$fakultas = $_REQUEST['fakultas'];
		$prodi   = $_REQUEST['prodi'];

		$result = mysqli_query($conn,"UPDATE mahasiswa SET 
									  nim='$nim', 
									  nama='$nama', 
									  alamat='$alamat', 
									  fakultas='$fakultas', 
									  prodi='$prodi' 
									  WHERE id_mahasiswa='$id_mahasiswa'");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Perhatian !!</strong> Data berhasil diedit</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Perhatian !!</strong> Data gagal disimpan</div>";
		}
	}
	// Akhir update data

	if (isset($_REQUEST['hapus'])) {
		$id_mahasiswa=$_REQUEST['id_mahasiswa'];

		$result = mysqli_query($conn,"DELETE FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Perhatian !!</strong> Data berhasil dihapus</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Perhatian !!</strong> Data gagal dihapus</div>";
		}
	}
	?>
<!-- Akhir insert data -->
 <!-- Menampilkan data  -->
	<table class="table table-bordered">
		<tr>
			<th>NIM</th>
			<th>NAMA</th>
			<th>ALAMAT</th>
			<th>FAKULTAS</th>
			<th>PRODI</th>
			<th>AKSI</th>
		</tr>
		<?php 
		  $query = mysqli_query($conn,"SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
		  while ($data=mysqli_fetch_array($query)) {
		?>
		<tr>
			<td><?php echo $data['nim']; ?></td>
			<td><?php echo $data['nama']; ?></td>
			<td><?php echo $data['alamat']; ?></td>
			<td><?php echo $data['fakultas']; ?></td>
			<td><?php echo $data['prodi']; ?></td>
			<td>
			    <!-- Edit Data -->
				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data['id_mahasiswa']; ?>">edit</a>

				<div class="modal fade bs-example-modal-lg" id="edit<?php echo $data['id_mahasiswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog  modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Edit Data Mahasiswa</h4>
				      </div>
				      <div class="modal-body">
				        <form class="form-horizontal" action="" method="POST">
				          <input type="hidden" name="id_mahasiswa" value="<?php echo $data['id_mahasiswa']; ?>">
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Nim</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="inputEmail3" name="nim" placeholder="Nim" value="<?php echo $data['nim']; ?>">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="inputPassword3" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
						    <div class="col-sm-10">
						      <textarea class="form-control" placeholder="Alamat" name="alamat" value="<?php echo $data['alamat']; ?>"><?php echo $data['alamat']; ?></textarea>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Fakultas</label>
						    <div class="col-sm-10">
						      <select class="form-control" name="fakultas">
						      	<option>Pilih Fakultas</option>
						      	<option value="FT" <?php if($data['fakultas']=="FT"){echo "selected";} ?>>Fakultas Teknik</option>
						      	<option value="FMIPA" <?php if($data['fakultas']=="FMIPA"){echo "selected";} ?>>Fakultas Ilmu Matematika</option>
						      	<option value="FAI" <?php if($data['fakultas']=="FAI"){echo "selected";} ?>>Fakultas Agama Islam</option>
						      	<option value="FIA" <?php if($data['fakultas']=="FIA"){echo "selected";} ?>>Faklutas Ilmu Administrasi</option>
						      </select>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Prodi</label>
						    <div class="col-sm-10">
						      <select class="form-control" name="prodi">
						      	<option>Pilih Prodi</option>
						      	<option value="SI" <?php if($data['prodi']=="SI"){echo "selected";} ?>>Sistem Informasi</option>
						      	<option value="TI" <?php if($data['prodi']=="TI"){echo "selected";} ?>>Teknik Informatika</option>
						      	<option value="PAI" <?php if($data['prodi']=="PAI"){echo "selected";} ?>>Pendidikan Agama Islam</option>
						      	<option value="AB" <?php if($data['prodi']=="AB"){echo "selected";} ?>>Administrasi Bisnis</option>
						      </select>
						    </div>
						  </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
				        <button type="submit" class="btn btn-primary" name="update">Simpan</button>
				       </form>
				      </div>
				    </div>
				  </div>
				</div>
                <!-- Akhir edit data -->
                <!-- Hapus data -->
				<a href="#" class="btn btn-danger btn-sm" data-target=".bs-example-modal-lg<?php echo $data['id_mahasiswa']; ?>" data-toggle="modal">delete</a>

				<div class="modal fade bs-example-modal-lg<?php echo $data['id_mahasiswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus data</h4>
				      </div>
				      <div class="modal-body">
				        <h4>Apakah anda benar-benar ingin menghapus data ini ?</h4>
				        <form action="" method="POST">
				        <input type="hidden" name="id_mahasiswa" value="<?php echo $data['id_mahasiswa']; ?>">
				      </div>
				       <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
				        <button type="submit" class="btn btn-primary" name="hapus">Hapus</button>
				       </form>
				      </div>
				    </div>
				  </div>
				</div>

				<!-- Akhir hapus data -->
			</td>
		</tr>
		<?php } ?>
	</table>
<!-- Menampilkan Data -->
</div>


<script src="jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>