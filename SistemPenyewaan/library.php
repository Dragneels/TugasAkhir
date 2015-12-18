<?php
include 'adodb/adodb.inc.php';	
/**
* class library
*/
class ClassLibrary
{
	var $db;
	
	function __construct()
	{
		$this->db = NewADOConnection('mysqli');
		$this->db->connect('localhost','root','','');	
	}


    public function get_data_pelanggan($id_pel)
    {
      $sql = $this->db->Execute('select * from tbl_pelanggan where id_pel='.$id_pel);
      return json_encode($sql->GetArray());
    }

    public function get_all_pelanggan()
    {
      $sql = $this->db->Execute('select * from tbl_pelanggan');
      return json_encode($sql->GetArray());
    }

    public function insert_pelanggan($nama,$alamat,$no_tlp)
    {
      $insert = $this->db->Execute("insert into tbl_pelanggan (nama,alamat,no_tlp) value ('$nama','$alamat','$no_tlp')");
    }

    public function update_pelanggan($nama, $alamat, $no_tlp, $id_pel)
    {
      $update = $this->db->Execute("update tbl_pelanggan set nama = '$nama', alamat = '$alamat', no_tlp = '$no_tlp' where id_pel = $id_pel");
    }

    public function delete_pelanggan($id_pelanggan)
    {
      $this->db->Execute("delete from tbl_pelanggan where id_pel =", $id_pelanggan);
    }

    public function get_data_buku($id_buku)
    {
      $sql = $this->db->Execute('select * from tbl_buku where id_buku='.$id_buku);
      return json_encode($sql->GetArray());
    }

    public function get_all_buku()
    {
      $sql = $this->db->Execute('select * from tbl_buku');
      return json_encode($sql->GetArray());
    }

    public function update_buku($judul, $vol, $penulis, $id_buku)
    {
      $update = $this->db->Execute("update tbl_buku set judul = '$judul', vol = $vol, penulis= '$penulis' where id_buku = $id_buku");
    }

    public function insert_buku($judul,$vol,$penulis)
    {
      $insert = $this->db->Execute("insert into tbl_buku (judul,vol,penulis) value ('$judul',$vol,'$penulis')");
    }

    public function delete_buku($id_buku)
    {
      $this->db->Execute("delete from tbl_buku where id_buku =", $id_buku);
    }

    public function get_detail_sewa($id_sewa)
    {
      $sql = $this->db->Execute('select tbl_penyewaan.id_sewa, tbl_buku.judul, tbl_buku.vol from tbl_penyewaan, tbl_buku where tbl_penyewaan.id_buku = tbl_buku.id_buku and tbl_penyewaan.id_sewa='.$id_sewa);
      return json_encode($sql->GetArray());
    }

    public function get_all_sewa()
    {
      $sql = $this->db->Execute('select tbl_pelanggan.id_pel, tbl_pelanggan.nama, tbl_penyewaan.id_sewa, tbl_penyewaan.tgl_pinjam, tbl_penyewaan.tgl_kembali from tbl_penyewaan, tbl_pelanggan where tbl_penyewaan.id_pel = tbl_pelanggan.id_pel');
      return json_encode($sql->GetArray());
    }

    public function insert_sewa($id_pel,$tgl_kembali,$id_buku)
    {
      $insert = $this->db->Execute("insert into tbl_penyewaan (id_pel,id_buku,tgl_pinjam,tgl_kembali) value ($id_pel,$id_buku,'".date('Y-m-d')."','$tgl_kembali')");
    }

    public function delete_sewa($id_sewa)
    {
      $this->db->Execute("delete from tbl_penyewaan where id_sewa =", $id_sewa);
    }

  	public function login ($username, $password)
  	{
		$password = md5($password);
		$sql = $this->db->Execute("select * from user where username ='$username' and password = '$password'");
		if($sql->RecordCount() >= 1){
			return "Login Berhasil";
		}else{
			return "login gagal";
		}
		
	}

}
?>