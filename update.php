<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST['id']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $kebutuhan = htmlspecialchars($_POST['kebutuhan']);
    $kuantitas = htmlspecialchars($_POST['kuantitas']);
    $biaya = htmlspecialchars($_POST['biaya']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    $query = "UPDATE data_kebutuhan SET 
              tanggal='$tanggal', 
              kebutuhan='$kebutuhan', 
              kuantitas=$kuantitas, 
              biaya=$biaya, 
              keterangan='$keterangan'";

    // Check if a new file is uploaded
    if (isset($_FILES['invoice']) && $_FILES['invoice']['error'] == 0) {
        $invoice = addslashes(file_get_contents($_FILES['invoice']['tmp_name']));
        $query .= ", invoice='$invoice'";
    }

    $query .= " WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>
