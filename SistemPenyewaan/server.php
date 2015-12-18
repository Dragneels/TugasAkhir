<?php
	//call library
	require_once('nusoap/lib/nusoap.php');
	require_once('adodb/adodb.inc.php');
	include 'library.php';
	
	$server = new nusoap_server;
	$server->configureWSDL('server', 'urn:server');
	$server->wsdl->schemaTargetNamespace = 'urn:server';	
	
	//register a function that works on server
	$server->register('login',
		array('username' => 'xsd:string',
			  'password'=>'xsd:string'), //parameters
		array('return' => 'xsd: string'), //output
		'urn:server', //namespace
		'urn:server#loginServer', //soapaction
		'rpc',
		'encoded',
		'login ke dalam aplikasi'
	);

	$server->register('get_all_pelanggan',
        array(),
        array('return' => 'xsd:string'),
        'urn:server',
		'urn:server#GetAllPelanggan',
		'rpc',
		'encoded',
		'Get All Pelanggan'
    );

  $server->register('get_all_sewa',
    array(),
    array('return' => 'xsd:string'),
    'urn:server',
    'urn:server#GetAllSewa',
    'rpc',
    'encoded',
    'Get All Sewa'
    );

    $server->register('get_all_buku',
        array(),
        array('return' => 'xsd:string'),
        'urn:server',
		'urn:server#GetAllBuku',
		'rpc',
		'encoded',
		'Get All Buku'
    );

    $server->register('insert_pelanggan',
    	array('nama' => 'xsd:string',
    		  'alamat' => 'xsd:string',
    		  'no_tlp' => 'xsd:string'
    		),
    	array('return' => 'xsd:string'),
    	'urn:server',
    	'urn:server#InsertPelanggan',
    	'rpc',
    	'encoded',
    	'Insert Data Pelanggan'
    );

    $server->register('insert_sewa',
      array('id_pel' => 'xsd:int',
          'tgl_kembali' => 'xsd:string',
          'id_buku' => 'xsd:int'
        ),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#InsertPelanggan',
      'rpc',
      'encoded',
      'Insert Data Pelanggan'
    );

    $server->register('delete_pelanggan',
    	array('id_pelanggan' => 'xsd:int'),
    	array('return' => 'xsd:string'),
    	'urn:server',
    	'urn:server#DeletePelanggan',
    	'rpc',
    	'encoded',
    	'Delete Data Pelanggan'
    );

    $server->register('delete_buku',
    	array('id_buku' => 'xsd:int'),
    	array('return' => 'xsd:string'),
    	'urn:server',
    	'urn:server#DeleteBuku',
    	'rpc',
    	'encoded',
    	'Delete Data Buku'
    );

    $server->register('delete_sewa',
      array('id_sewa' => 'xsd:int'),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#DeleteSewa',
      'rpc',
      'encoded',
      'Delete Data Sewa'
    );

    $server->register('insert_buku',
    	array('judul' => 'xsd:string',
    		  'vol' => 'xsd:int',
    		  'penulis' => 'xsd:string'
    		),
    	array('return' => 'xsd:string'),
    	'urn:server',
    	'urn:server#InsertBuku',
    	'rpc',
    	'encoded',
    	'Insert Data Buku'
    );

    $server->register('get_data_pelanggan',
      array('id_pel' => 'xsd:int'),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#GetDataPelanggan',
      'rpc',
      'encoded',
      'Get Data Pelanggan'
    );

    $server->register('get_data_buku',
      array('id_buku' => 'xsd:int'),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#GetDataBuku',
      'rpc',
      'encoded',
      'Get Data Buku'
    );

    $server->register('get_detail_sewa',
      array('id_sewa' => 'xsd:int'),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#GetDetailSewa',
      'rpc',
      'encoded',
      'Get Detail Sewa'
    );

    $server->register('update_pelanggan',
      array('nama' => 'xsd:string',
            'alamat' => 'xsd:string',
            'no_tlp' => 'xsd:string',
            'id_pel' => 'xsd:int'),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#UpdatePelanggan',
      'rpc',
      'encoded',
      'Update Data Pelanggan'
    );

    $server->register('update_buku',
      array('judul' => 'xsd:string',
            'vol' => 'xsd:int',
            'penulis' => 'xsd:string',
            'id_buku' => 'xsd:int'),
      array('return' => 'xsd:string'),
      'urn:server',
      'urn:server#UpdateBuku',
      'rpc',
      'encoded',
      'Update Data Buku'
    );
	
  	function login ($username, $password){
  		$lib = new ClassLibrary();
  		$result = $lib->login($username, $password);
  		return $result;		
  	}

	  function get_all_pelanggan(){
  		$lib = new ClassLibrary();
  		$result = $lib->get_all_pelanggan();
  		return $result;	
  	}

  	function delete_pelanggan($id_pelanggan){
  		$lib = new ClassLibrary();
  		$result = $lib->delete_pelanggan($id_pelanggan);
  	}
	
	  function get_all_buku(){
  		$lib = new ClassLibrary();
  		$result = $lib->get_all_buku();
  		return $result;	
  	}

  	function insert_pelanggan($nama,$alamat,$no_tlp){
  		$lib = new ClassLibrary();
  		$result = $lib->insert_pelanggan($nama,$alamat,$no_tlp);
  	}

  	function insert_buku($judul,$vol,$penulis){
  		$lib = new ClassLibrary();
  		$result = $lib->insert_buku($judul,$vol,$penulis);
  	}

    function insert_sewa($id_pel,$tgl_kembali, $id_buku){
      $lib = new ClassLibrary();
      $result = $lib->insert_sewa($id_pel,$tgl_kembali, $id_buku);
    }

  	function delete_buku($id_buku){
  		$lib = new ClassLibrary();
  		$result = $lib->delete_buku($id_buku);
  	}

    function delete_sewa($id_sewa){
      $lib = new ClassLibrary();
      $result = $lib->delete_sewa($id_sewa);
    }

    function get_all_sewa(){
      $lib = new ClassLibrary();
      $result = $lib->get_all_sewa();
      return $result; 
    }

    function get_data_pelanggan($id_pel){
      $lib = new ClassLibrary();
      $result = $lib->get_data_pelanggan($id_pel);
      return $result; 
    }

    function get_data_buku($id_buku){
      $lib = new ClassLibrary();
      $result = $lib->get_data_buku($id_buku);
      return $result; 
    }

    function get_detail_sewa($id_sewa){
      $lib = new ClassLibrary();
      $result = $lib->get_detail_sewa($id_sewa);
      return $result; 
    }

    function update_pelanggan($nama, $alamat, $no_tlp, $id_pel){
      $lib = new ClassLibrary();
      $result = $lib->update_pelanggan($nama, $alamat, $no_tlp, $id_pel);
    }

    function update_buku($judul, $vol, $penulis, $id_buku){
      $lib = new ClassLibrary();
      $result = $lib->update_buku($judul, $vol, $penulis, $id_buku);
    }

	//create HTTP listener
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>