<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../config/Database.php';
include_once '../model/Mahasiswa.php';
include_once '../config/config.php';

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

if (isset($_GET['action'])) {
    try {
        if ($_GET['action'] == 'create') {
            $mahasiswa->nim = validateInput($_POST['nim']);
            $mahasiswa->nama = validateInput($_POST['nama']);
            $mahasiswa->jurusan = validateInput($_POST['jurusan']);
            $mahasiswa->create();

            // Set flash message success
            $_SESSION['flash_message'] = "Data berhasil ditambahkan!";
            header("Location: ../model/index.php?msg=1");
            exit;
        } elseif ($_GET['action'] == 'delete') {
            $mahasiswa->id = $_GET['id'];
            $mahasiswa->delete();

            // Set flash message success
            $_SESSION['flash_message'] = "Data berhasil dihapus!";
            header("Location: ../model/index.php?msg=1");
            exit;
        } elseif ($_GET['action'] == 'update') {
            // Update data mahasiswa
            $mahasiswa->id = $_POST['id'];
            $mahasiswa->nim = $_POST['nim'];
            $mahasiswa->nama = $_POST['nama'];
            $mahasiswa->jurusan = $_POST['jurusan'];
            $mahasiswa->update();

            // Set flash message success
            $_SESSION['flash_message'] = "Data berhasil diperbarui!";
            header("Location: ../model/index.php?msg=1");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['flash_message'] = $e->getMessage();
        header("Location: ../model/index.php?msg=0");
        exit;
    }
}

// Fungsi untuk membersihkan input
function validateInput($data) {
    return htmlspecialchars(strip_tags($data));
}
?>
