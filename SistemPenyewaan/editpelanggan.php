<?php 
	include "header.php";

	if (isset($_GET['id'])) {
		$id_pel = $_GET['id'];
		$result = $client->call('get_data_pelanggan',array('id_pel' => $id_pel));
	}

	$request = json_decode($result,true);

	function active(){
		return "pelanggan";
	}

	if (isset($_POST['save'])) {

		if ($_POST['nama'] == "") {
			$nama = $request[0][1];
		}else{
			$nama = $_POST['nama'];
		}

		if ($_POST['alamat'] == "") {
			$alamat = $request[0][2];
		}else{
			$alamat = $_POST['alamat'];
		}

		if ($_POST['no_tlp'] == "") {
			$no_tlp = $request[0][3];
		}else{
			$no_tlp = $_POST['no_tlp'];
		}

		$data = array('nama' => $nama,
			'alamat' => $alamat,
			'no_tlp' => $no_tlp, 
			'id_pel' => $id_pel
			);

		$client->call('update_pelanggan',$data);
		header('location:pelanggan.php');
	}

	
	foreach ($request as $key) {
 ?>
<div class="col-md-12">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="background:#205f40; padding:10px; width:30%; margin-bottom:150px;">
		<form method="POST">
			<div align="middle"><h3 style="color:white"><b>Edit Pelanggan</b></h3></div>
			<div class="form-group">
				<label style="color:white;">Nama :</label>
				<input type="text" name="nama" class="form-control" placeholder= "<?php echo $key[1]; ?>" />
			</div>
			<div class="form-group">
				<label style="color:white;">Alamat :</label>
				<input type="text" name="alamat" class="form-control" placeholder= "<?php echo $key[2]; ?>" />
			</div>
			<div class="form-group">
				<label style="color:white;">No Telepon :</label>
				<input type="text" name="no_tlp" class="form-control" placeholder= "<?php echo $key[3]; }?>" />
			</div>
			<div align="right">
				<input type="submit" value="Save" class="btn btn-success" style="width:130px" name="save">
			</div>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
<?php include "footer.php"; ?>