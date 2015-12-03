<?php
class fungsi{
	
	public function idanggota_to_username($uid){
	
	$sql = "select * from tbanggota where username = '$uid'";
	$data = mysql_query($sql);
	$parseuser = mysql_fetch_assoc($data);
	
	return $parseuser;
	}

	public function validasiinput($properti)
	{
		$validasiinput = $error = null;
		
		//properti validasi input kosong
		if(isset($properti['kosong']))
		{
			if($properti['kosong'] == false)
			{
				if($properti['nilai'] == "" OR strlen($properti['nilai'])>0 AND strlen(trim($properti['nilai'])) == 0)
				{
					$error[] = sprintf('<i><b>%s</b></i> Kosong atau Tidak Mengandung Karakter Apapun (ev701)',
										$properti['judul']);
				}
			}
			else
			{
				
			}
		}//akhir validasi jika kosong
		
		//properti validasi jika input kurang atau lebih banyak
		if(isset($properti['min-max']))
		{
			$minmax = explode('-', $properti['min-max']) ; //nilai dari min-max dipecah menjadi min dan max
			if(strlen($properti['nilai']) <= $minmax[0] AND strlen($properti['nilai']) <= $minmax[1])
			{
				$error[] = sprintf('<i><b>%s</b></i> harus berisi karakter minimal %d karakter dan maksimal %d karakter (ev702)'
									,$properti['judul'],$minmax[0],$minmax[1] );
			}
			
		}
		
		
		if(!empty($error))
		{
			foreach ($error as $pesan)
			{
				$validasiinput .=  '<li>'.$pesan.'</li>';
			}
		}
		
		return $validasiinput;			
	}//akhir validasiinput
	
	


}
$fungsi = new fungsi();
?>