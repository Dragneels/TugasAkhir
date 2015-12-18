<?php 
	include "header.php";
	
	$result = $client->call('get_all_buku');

	if (isset($_POST["judul"])){
		if ($_POST["judul"] != "") {
			$data = array('judul' => $_POST["judul"],
	        	  'vol' => $_POST["vol"],
	        	  'penulis' =>$_POST["author"]
	        	  );

			$client->call('insert_buku', $data);
			header('location:buku.php');
		}
	}


	if (isset($_POST['delete'])) {
		$id_buku = $_POST['id'];
		try{
			$client->call('delete_buku', array('id_buku' => $id_buku));
			header('location:buku.php');
			}
		catch(SoapFault $error){
				var_dump($error);
			}
	}

	if (isset($_POST['edit'])) {
		$id=$_POST['id'];
		header('location:editbuku.php?id='.$id);
	}

	function active(){
		return "buku";
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
							<label>Judul :</label>
							<input type="text" name="judul" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Volume :</label>
							<input type="text" name="vol" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Author :</label>
							<input type="text" name="author" class="form-control"/>
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
							<td width="30%">JUDUL</td>
							<td width="10%">VOLUME</td>
							<td width="30%">AUTHOR</td>
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