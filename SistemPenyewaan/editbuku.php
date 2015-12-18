<?php 
	include "header.php";

	if (isset($_GET['id'])) {
		$id_buku = $_GET['id'];
		$result = $client->call('get_data_buku',array('id_buku' => $id_buku));
	}

	$request = json_decode($result,true);

	function active(){
		return "buku";
	}

	if (isset($_POST['save'])) {

		if ($_POST['judul'] == "") {
			$judul = $request[0][1];
		}else{
			$judul = $_POST['judul'];
		}

		if ($_POST['vol'] == "") {
			$vol = $request[0][2];
		}else{
			$vol = $_POST['vol'];
		}

		if ($_POST['penulis'] == "") {
			$penulis = $request[0][3];
		}else{
			$penulis = $_POST['penulis'];
		}

		$data = array('judul' => $judul,
			'vol' => $vol,
			'penulis' => $penulis, 
			'id_buku' => $id_buku
			);

		$client->call('update_buku',$data);
		header('location:buku.php');
	}

	
	foreach ($request as $key) {
 ?>
<div class="col-md-12">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="background:#205f40; padding:10px; width:30%; margin-bottom:150px;">
		<form method="POST">
			<div align="middle"><h3 style="color:white"><b>Edit Pelanggan</b></h3></div>
			<div class="form-group">
				<label style="color:white;">Judul :</label>
				<input type="text" name="judul" class="form-control" placeholder= "<?php echo $key[1]; ?>" />
			</div>
			<div class="form-group">
				<label style="color:white;">Vol :</label>
				<input type="text" name="vol" class="form-control" placeholder= "<?php echo $key[2]; ?>" />
			</div>
			<div class="form-group">
				<label style="color:white;">Penulis :</label>
				<input type="text" name="penulis" class="form-control" placeholder= "<?php echo $key[3]; }?>" />
			</div>
			<div align="right">
				<input type="submit" value="Save" class="btn btn-success" style="width:130px" name="save">
			</div>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
<?php include "footer.php"; ?>