<?php 
	include "header.php";

	$result = $client->call('get_all_pelanggan');

	if (isset($_POST["nama"])){
		if ($_POST["nama"] != "") {
			$data = array('nama' => $_POST["nama"],
	        	  'alamat' => $_POST["alamat"],
	        	  'no_tlp' =>$_POST["no_tlp"]
	        	  );

			$client->call('insert_pelanggan', $data);
			header('location:pelanggan.php');
		}
	}

	if (isset($_POST['delete'])) {
		$id_pelanggan = $_POST['id'];
		try{
			$client->call('delete_pelanggan', array('id_pelanggan' => $id_pelanggan));
			header('location:pelanggan.php');
			}
		catch(SoapFault $error){
				var_dump($error);
			}
	}

	if(isset($_POST['edit'])){
		$data = $_POST['id'];
		header("location:editpelanggan.php?id=".$data);
	}

	function active(){
		return "pelanggan";
	}
 ?>
	<div class="container">
		<div>
			<div class="col-md-8 col-xs-12"></div>
			<div class="col-md-4 col-xs-6" align="right">
				<form class="form-inline">
				  <div class="form-group has-feedback">
				    <input type="text" class="form-control" id="search" placeholder="search">
				    <span class="glyphicon glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				  </div>
				</form>
			</div>
		</div>
		<div>
			<div class="col-xs-6 col-md-4">
				<div style="background:#205f40; padding:10px;">
					<form method="POST">
						<div align="middle"><h3 style="color:white"><b>Daftar Baru</b></h3></div>
						<div class="form-group">
							<label>Nama :</label>
							<input type="text" name="nama" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Alamat :</label>
							<input type="text" name="alamat" class="form-control"/>
						</div>
						<div class="form-group">
							<label>No Telepon :</label>
							<input type="text" name="no_tlp" class="form-control"/>
						</div>
						<div align="right">
							<input type="submit" value="Daftar" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-md-8">
				<table class="table table-bordered" style="margin-top:20px">
					<thead>
						<tr>
							<td width="5%">No.</td>
							<td width="10%">ID</td>
							<td width="25%">NAMA</td>
							<td width="25%">ALAMAT</td>
							<td width="20%">No. Tlp</td>
							<td width="25%">Options</td>
						</tr>
					</thead>
					<tbody>
					<?php
						$i=1;
						$data = json_decode($result,true);
						foreach ($data as $key) { ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $key[0]; ?></td>
						<td><?php echo $key[1]; ?></td>
						<td><?php echo $key[2]; ?></td>
						<td><?php echo $key[3]; ?></td>
						<td>
							<div class="btn-group btn-group-justified">
								<form method="POST">
									<div align="middle">
										<input type="hidden" name="id" value="<?php echo $key[0] ?>"/>
										<button class="btn btn-primary btn-xs" name="edit">Edit</button>
										<button class="btn btn-primary btn-xs" name="delete">Delete</button>
									</div>
								</form>
							</div>
						</td>
					</tr>
					<?php $i++;} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php include 'footer.php' ?>