<?php 
	include "header.php";
	
	$result = $client->call('get_all_sewa');

	if (isset($_POST['delete'])) {
		$id_sewa = $_POST['id'];
		try{
			$client->call('delete_sewa', array('id_sewa' => $id_sewa));
			header('location:index.php');
			}
		catch(SoapFault $error){
				var_dump($error);
			}
	}

	if (isset($_POST['submit'])) {
		$data = array('id_pel' => $_POST["id_pel"],
	        	  'tgl_kembali' =>$_POST["tgl_kembali"],
	        	  'id_buku' => $_POST['id_buku']
	        	  );

		$client->call('insert_sewa', $data);
		header('location:index.php');
	}

	function active(){
		return "sewa";
	}

 ?>
	<div class="container">
		<div class="col-md-12" align="center">
            <div class="col-md-3 boxcollider" align="center">
                <p style="font-size:18px; font-weight:500;"><span>Total Penyewaan</span></p>
                <h2 style="font-size: 28px;font-weight: 600;">231,809</h2>
            </div>
            <div class="col-md-3 boxcollider" align="center">
                <p style="font-size:18px; font-weight:500;"><span>Total Pelanggan</span></p>
                <h2 style="font-size: 28px;font-weight: 600;">433,223</h2>
            </div>
            <div class="col-md-3 boxcollider" align="center">
                <p style="font-size:18px; font-weight:500;"><span>Total Buku</span></p>
                <h2 style="font-size: 28px;font-weight: 600;">635,233</h2>
            </div>
            <div class="col-md-3 boxcollider" align="center">
                <p style="font-size:18px; font-weight:500;"><span>Total Keuntungan</span></p>
                <h2 style="font-size: 28px;font-weight: 600;">Rp. 1,234,623</h2>
            </div>
		</div>
		<div>
			<div class="col-xs-6 col-md-4">
				<div style="background:#339966; padding:10px;">
					<form method="POST">
						<div align="middle"><h3 style="color:white"><b>SEWA BUKU</b></h3></div>
						<div class="form-group">
							<label>ID Pelanggan :</label>
							<input type="text" name="id_pel" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Nama :</label>
							<input type="text" name="nama" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Tanggal Kembali :</label>
							<input type="text" name="tgl_kembali" class="form-control" placeholder="yyyy-mm-dd"/>
						</div>
						<div class="form-group">
							<label>ID Buku :</label>
							<input type="text" name="id_buku" class="form-control"/>
						</div>
						<div id="databuku"></div>
						<div align="right">
							<input type="submit" name="submit" value="Daftar" class="btn btn-success">
						</div>
						<!-- <div align="right">
							<input type="text" id="jmlh" style="width:30px;">
							<button class="btn btn-success" id="tambah">Tambah</button>
							<input type="submit" value="Daftar" class="btn btn-success">
						</div> -->
					</form>
				</div>
			</div>
			<div class="col-md-8 col-xs-6" align="right">
				<form class="form-inline">
				  <div class="form-group has-feedback">
				    <input type="text" class="form-control" id="search" placeholder="search">
				    <span class="glyphicon glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				  </div>
				</form>
			</div>
			<div class="col-xs-12 col-md-8">
				<table class="table table-bordered" style="margin-top:20px">
					<thead>
						<tr>
							<td width="5%">No.</td>
							<td width="8%">ID</td>
							<td width="15%">Nama Pelanggan</td>
							<td width="15%">Kode Penyewaan</td>
							<td width="10%">Tgl sewa</td>
							<td width="10%">Tgl Kembali</td>
							<td width="12%">Option</td>
						</tr>
					</thead>
					<tbody>
				<?php
					$i=1;
					$data = json_decode($result,true);
					foreach ($data as $key) { ?>
				<tr>
					<td align="middle"><?php echo $i; ?></td>
					<td align="middle"><?php echo $key[0]; ?></td>
					<td><?php echo $key[1]; ?></td>
					<td align="middle"><?php echo "<a href='detailsewa.php?id=$key[2]'>".$key[2]."</a>"; ?></td>
					<td><?php echo $key[3]; ?></td>
					<td><?php echo $key[4]; ?></td>
					<td>
						<div class="btn-group btn-group-justified">
							<form method="POST">
								<div align="middle">
									<input type="hidden" name="id" value="<?php echo $key[2] ?>"/>
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
	<script type="text/javascript">
		$('#tambah').on('click',function(form){
			form.preventDefault();
			var jmlh = document.getElementById("jmlh").value;
			var content = "";
			for (var i = 1; i <= jmlh; i++) {
				content += "<div class='form-group'><input type='text' name='id_buku"+i+"' class='form-control'/></div>";	
			};
			databuku.innerHTML = content;
		});
	</script>
<?php include 'footer.php' ?>