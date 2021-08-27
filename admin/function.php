<?php 
//koneksi ke database
$conn = mysqli_connect("localhost","root","","tokoluffi");


function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}

	return $rows;
}


function registrasi($data){
	global $conn;

	$username = $data['username'];
	$password = $data['password'];
	$password2 = $data['password2'];
	$nama_lengkap = $data['nama_lengkap'];

	$result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

	if(mysqli_fetch_assoc($result)){
		echo "<script>
				alert('Username Sudah Terdaftar');
		</script>";
		return false;
	}

	if($password !== $password2){
		echo "<script>
			alert('Konfirmasi Password Tidak Sesuai');
		</script>";
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO admin VALUES('','$username', '$password', '$nama_lengkap')");

	return mysqli_affected_rows($conn);
}



 ?>