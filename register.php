<?php require_once('includes/init.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tempat_lahir = $_POST["tempat_lahir"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    $nomor_telepon = $_POST["nomor_telepon"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Data orang tua (jika diisi)
    if (isset($_POST["nama_ayah"])) {
        $nama_ayah = $_POST["nama_ayah"];
        $pekerjaan_ayah = $_POST["pekerjaan_ayah"];
        $nama_ibu = $_POST["nama_ibu"];
        $pekerjaan_ibu = $_POST["pekerjaan_ibu"];
        $nama_wali = isset($_POST["nama_wali"]) ? $_POST["nama_wali"] : null;
        $pekerjaan_wali = isset($_POST["pekerjaan_wali"]) ? $_POST["pekerjaan_wali"] : null;
    }

    // Tangkap dokumen tambahan (jika diisi)
    if (isset($_FILES["akta_kelahiran"]["name"])) {
        if (isset($_FILES["akta_kelahiran"]["name"])) {
            $akta_kelahiran = $_POST['nama'] . "-akta-kelahiran-" . uniqid() . ".pdf";
            $target_dir = "uploads/akta_kelahiran/";  // Direktori tempat menyimpan file
            $target_file = $target_dir . $akta_kelahiran;
            move_uploaded_file($_FILES["akta_kelahiran"]["tmp_name"], $target_file);
        }
        if (isset($_FILES["kartu_keluarga"]["name"])) {
            $kartu_keluarga = $_POST['nama'] . "-kartu-keluarga-" . uniqid() . ".pdf";
            $target_dir = "uploads/kartu_keluarga/";  // Direktori tempat menyimpan file
            $target_file = $target_dir . $kartu_keluarga;
            move_uploaded_file($_FILES["kartu_keluarga"]["tmp_name"], $target_file);
        }
        if (isset($_FILES["foto"]["name"])) {
            $foto = $_POST['nama'] . "-foto-" . uniqid() . ".pdf";
            $target_dir = "uploads/foto/";  // Direktori tempat menyimpan file
            $target_file = $target_dir . $foto;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        }
        if (isset($_FILES["laporan_pendidikan"]["name"])) {
            $laporan_pendidikan = $_POST['nama'] . "-laporan-pendidikan-" . uniqid() . ".pdf";
            $target_dir = "uploads/laporan_pendidikan/";  // Direktori tempat menyimpan file
            $target_file = $target_dir . $laporan_pendidikan;
            move_uploaded_file($_FILES["laporan_pendidikan"]["tmp_name"], $target_file);
        }
        if (isset($_FILES["ijasah"]["name"])) {
            $ijasah = $_POST['nama'] . "-ijasah-" . uniqid() . ".pdf";
            $target_dir = "uploads/ijasah/";  // Direktori tempat menyimpan file
            $target_file = $target_dir . $ijasah;
            move_uploaded_file($_FILES["ijasah"]["tmp_name"], $target_file);
        }

        $username = "calonsiswa-" . uniqid();
        $password = password_hash($username, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, role, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, nomor_telepon, latitude, longitude, nama_ayah, pekerjaan_ayah, nama_ibu, pekerjaan_ibu, nama_wali, pekerjaan_wali, akta_kelahiran, kartu_keluarga, foto, laporan_pendidikan, ijasah) 
        VALUES ('$username', '$password', 2, '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$latitude', '$longitude', '$nama_ayah', '$pekerjaan_ayah', '$nama_ibu', '$pekerjaan_ibu', '$nama_wali', '$pekerjaan_wali', '$akta_kelahiran', '$kartu_keluarga', '$foto', '$laporan_pendidikan', '$ijasah')";


        if (mysqli_query(DB_CONN, $sql)) {
            echo "<script>alert('Berhasil terdaftar');window.location.href='" . BASEURL . "';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= APP_NAME; ?></title>
    <script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body class="bg-gradient-danger">
    <nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-lg pb-3 pt-3 font-weight-bold">
        <div class="container">
            <a class="navbar-brand text-danger" style="font-weight: 900;" href="login.php"> <i class="fa fa-database mr-2 rotate-n-15"></i> <?= APP_NAME; ?></a>
        </div>
    </nav>

    <div class="container">
        <!-- Outer Row -->
        <div class="row d-plex justify-content-between">
            <div class="col-12 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Formulir Pendaftaran</h1>
                                </div>
                                <ul>
                                    <li><span class="text-danger">*</span> Wajib diisi</li>
                                </ul>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="font-weight-bold">DATA DIRI:</p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="nama"><span class="text-danger">*</span>Nama Lengkap:</label>
                                        <input type="text" class="form-control rounded rounded-pill text-uppercase" id="nama" name="nama" value="<?= @$_POST['nama']; ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="jenis_kelamin"><span class="text-danger">*</span>Jenis Kelamin:</label>
                                        <select class="form-control rounded rounded-pill text-uppercase" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value=""></option>
                                            <option <?= @$_POST['jenis_kelamin'] == 'L' ? 'selected' : ''; ?> value="L">Laki-laki</option>
                                            <option <?= @$_POST['jenis_kelamin'] == 'P' ? 'selected' : ''; ?> value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="tempat_lahir"><span class="text-danger">*</span>Tempat Lahir:</label>
                                        <input type="text" class="form-control rounded rounded-pill text-uppercase" id="tempat_lahir" name="tempat_lahir" value="<?= @$_POST['tempat_lahir']; ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="tanggal_lahir"><span class="text-danger">*</span>Tanggal Lahir:</label>
                                        <input type="date" class="form-control rounded rounded-pill text-uppercase" id="tanggal_lahir" name="tanggal_lahir" value="<?= @$_POST['tanggal_lahir']; ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="alamat"><span class="text-danger">*</span>Alamat:</label>
                                        <textarea class="form-control text-uppercase" id="alamat" name="alamat" required><?= @$_POST['alamat']; ?></textarea>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="nomor_telepon"><span class="text-danger">*</span>Nomor Telepon:</label>
                                        <input type="tel" class="form-control rounded rounded-pill text-uppercase" id="nomor_telepon" name="nomor_telepon" value="<?= @$_POST['nomor_telepon']; ?>" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="latitude"><span class="text-danger">*</span>Latitude:</label>
                                        <input class="form-control" type="text" name="latitude" id="latitude">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="longitude"><span class="text-danger">*</span>Longitude:</label>
                                        <input class="form-control" type="text" name="longitude" id="longitude">
                                    </div>
                                    <div class="col-12">
                                        <div id="map" style="width: 100%; height: 400px;"></div>
                                    </div>


                                    <?php if (@$_POST['nomor_telepon']) : ?>
                                        <div class="col-12 mt-4">
                                            <p class="font-weight-bold">DATA ORANG TUA:</p>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="nama_ayah"><span class="text-danger">*</span>Nama Ayah:</label>
                                            <input type="text" class="form-control rounded rounded-pill text-uppercase" id="nama_ayah" name="nama_ayah" value="<?= @$_POST['nama_ayah']; ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="pekerjaan_ayah"><span class="text-danger">*</span>Pekerjaan Ayah:</label>
                                            <select class="form-control rounded rounded-pill text-uppercase" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?= @$_POST['pekerjaan_ayah']; ?>" required>
                                                <option value=""></option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'pns' ? 'selected' : ''; ?> value="pns">PNS</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'wirausaha' ? 'selected' : ''; ?> value="wirausaha">Wirausaha</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'karyawan_swasta' ? 'selected' : ''; ?> value="karyawan_swasta">Karyawan Swasta</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'petani' ? 'selected' : ''; ?> value="petani">Petani</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'pensiunan' ? 'selected' : ''; ?> value="pensiunan">Pensiunan</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'polisi' ? 'selected' : ''; ?> value="polisi">Polisi</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'guru' ? 'selected' : ''; ?> value="guru">Guru</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'dokter' ? 'selected' : ''; ?> value="dokter">Dokter</option>
                                                <option <?= @$_POST['pekerjaan_ayah'] == 'lainnya' ? 'selected' : ''; ?> value="lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="nama_ibu"><span class="text-danger">*</span>Nama Ibu:</label>
                                            <input type="text" class="form-control rounded rounded-pill text-uppercase" id="nama_ibu" name="nama_ibu" value="<?= @$_POST['nama_ibu']; ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="pekerjaan_ibu"><span class="text-danger">*</span>Pekerjaan Ibu:</label>
                                            <select class="form-control rounded rounded-pill text-uppercase" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?= @$_POST['pekerjaan_ibu']; ?>" required>
                                                <option value=""></option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="pns">PNS</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="wirausaha">Wirausaha</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="karyawan_swasta">Karyawan Swasta</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="petani">Petani</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="pensiunan">Pensiunan</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="polisi">Polisi</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="guru">Guru</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="dokter">Dokter</option>
                                                <option <?= @$_POST['pekerjaan_ibu'] == 'lainnya' ? 'selected' : ''; ?> value="lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="nama_wali">Nama Wali:</label>
                                            <input type="text" class="form-control rounded rounded-pill text-uppercase" id="nama_wali" name="nama_wali" value="<?= @$_POST['nama_wali']; ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="pekerjaan_wali">Pekerjaan Wali:</label>
                                            <select class="form-control rounded rounded-pill text-uppercase" id="pekerjaan_wali" name="pekerjaan_wali" value="<?= @$_POST['pekerjaan_wali']; ?>">
                                                <option value=""></option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="pns">PNS</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="wirausaha">Wirausaha</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="karyawan_swasta">Karyawan Swasta</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="petani">Petani</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="pensiunan">Pensiunan</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="polisi">Polisi</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="guru">Guru</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="dokter">Dokter</option>
                                                <option <?= @$_POST['pekerjaan_wali'] == 'lainnya' ? 'selected' : ''; ?> value="lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    <?php endif; ?>


                                    <?php if (@$_POST['nama_ayah']) : ?>
                                        <div class="col-12 mt-4">
                                            <p class="font-weight-bold">Dokumen Tambahan:</p>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="akta_kelahiran"><span class="text-danger">*</span>Akta Kelahiran:</label>
                                            <input type="file" class="form-control rounded rounded-pill text-uppercase" id="akta_kelahiran" name="akta_kelahiran" accept=".pdf" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="kartu_keluarga"><span class="text-danger">*</span>Kartu Keluarga:</label>
                                            <input type="file" class="form-control rounded rounded-pill text-uppercase" id="kartu_keluarga" name="kartu_keluarga" accept=".pdf" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="foto"><span class="text-danger">*</span>Pas Foto Terbaru:</label>
                                            <input type="file" class="form-control rounded rounded-pill text-uppercase" id="foto" name="foto" accept=".pdf" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="laporan_pendidikan"><span class="text-danger">*</span>Laporan Pendidikan Terakhir:</label>
                                            <input type="file" class="form-control rounded rounded-pill text-uppercase" id="laporan_pendidikan" name="laporan_pendidikan" accept=".pdf" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="ijasah"><span class="text-danger">*</span>Ijasah Terakhir:</label>
                                            <input type="file" class="form-control rounded rounded-pill text-uppercase" id="ijasah" name="ijasah" accept=".pdf" required>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-12 text-right">
                                        <?php if (@$_POST['nama_ayah']) : ?>
                                            <button onclick="return confirm('Apakah anda yakin data anda sudah benar?\nJika sudah selahkan lanjutkan!')" class="btn btn-danger"><i class="fa fa-angle-right"></i> Kirim</button>
                                        <?php else : ?>
                                            <button class="btn btn-danger"><i class="fa fa-angle-right"></i> Selanjutnya</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const map = L.map('map').setView([-2.926630229100335, 128.93736288758728], 11);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        map.setMaxBounds([
            [-10, 123],
            [1, 135]
        ]);
        map.setMinZoom(6);

        map.on('drag', function() {
            map.panInsideBounds([
                [-10, 123],
                [1, 135]
            ], {
                animate: false
            });
        });



        var marker = L.marker([-2.92320500163098, 128.93530480717607]).addTo(map);
        $('#latitude').val('-3.695');
        $('#longitude').val('128.181');


        $('#latitude').on('input', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([$('#latitude').val(), $('#longitude').val()], {
                draggable: true
            }).addTo(map);

            marker.on('drag', function(e) {
                $('#latitude').val(e.latlng.lat);
                $('#longitude').val(e.latlng.lng);
            });
        });

        $('#longitude').on('input', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([$('#latitude').val(), $('#longitude').val()], {
                draggable: true
            }).addTo(map);

            marker.on('drag', function(e) {
                $('#latitude').val(e.latlng.lat);
                $('#longitude').val(e.latlng.lng);
            });
        });

        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker(e.latlng, {
                draggable: true
            }).addTo(map);

            marker.on('drag', function(e) {
                $('#latitude').val(e.latlng.lat);
                $('#longitude').val(e.latlng.lng);
            });

            $('#latitude').val(e.latlng.lat);
            $('#longitude').val(e.latlng.lng);
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>