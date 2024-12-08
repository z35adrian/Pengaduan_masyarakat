<head>
	<title>Website Pengaduan Masyarakat</title>
	<link rel="shortcut icon" href="https://cepatpilih.com/image/logo.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

</head>
<body style="background: url(img/bg.jpg); background-size: cover;"></body>
    <div class="container">
        <div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 10%;">
        <h3 style="text-align: center;" class="orange-text">Daftar!</h3>
        <center><h4>Laporan Masyarakat</h4></center>

  <form method="POST">
                <div class="input_field">
                    <label for="nik">NIK</label>
                    <input id="nik" type="text" name="nik" maxlength="16" required>
                </div>
                <div class="input_field">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" name="nama" maxlength="35" required>
                </div>
                <div class="input_field">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" maxlength="25" required>
                </div>
                <div class="input_field">
                    <label for="telp">No Telepon</label>
                    <input id="telp" type="text" name="telp" maxlength="13" required>
                </div>
                <div class="input_field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <input type="submit" name="register" value="Daftar" class="btn orange" style="width: 100%;">
            </form>
            <p>Sudah punya akun? <a href="index.php">Log In Disini</a></p>
        </div>
    </div>

    <?php 
$koneksi = new mysqli("localhost", "root", "", "pengaduan_masyarakat");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $nik = $koneksi->real_escape_string($_POST['nik']);
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $username = $koneksi->real_escape_string($_POST['username']);
    $telp = $koneksi->real_escape_string($_POST['telp']);
    $password = md5($_POST['password']); 

    $cek_user = $koneksi->query("SELECT * FROM masyarakat WHERE username='$username' OR nik='$nik'");
    if ($cek_user->num_rows > 0) {
        echo "<script>alert('NIK atau Username sudah terdaftar!');</script>";
    } else {
        $sql = "INSERT INTO masyarakat (nik, nama, username, password, telp) 
                VALUES ('$nik', '$nama', '$username', '$password', '$telp')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script>alert('Registrasi berhasil! Silakan login.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $koneksi->error . "');</script>";
        }
    }
}
$koneksi->close();
?>
</body>