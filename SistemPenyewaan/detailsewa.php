<?php 
	include "header.php";

	function active(){
		return "sewa";
	}

	if (isset($_GET['id'])) {
		$id_sewa = $_GET['id'];
		$result = $client->call('get_detail_sewa',array('id_sewa' => $id_sewa));
	}

	$request = json_decode($result,true);
	foreach ($request as $key) {
?>
<div class="col-md-12" style="margin-bottom:300px">
<div class="col-md-4"></div>
<div class="col-md-4">
	<table class="table table-bordered" style="margin-top:20px">
		<tr>
			<td>ID Penyewaan</td>
			<td><?php echo $key[0]; ?></td>
		</tr>
		<tr>
			<td>Judul</td>
			<td><?php echo $key[1]; ?></td>
		</tr>
		<tr>
			<td>Vol</td>
			<td><?php echo $key[2]; }?></td>
		</tr>
	</table>
</div>
</div>

<?php include "footer.php"; ?>