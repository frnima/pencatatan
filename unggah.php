<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["invoice"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Memeriksa apakah file adalah tipe file yang valid
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf" ) {
    echo "Maaf, hanya file JPG, JPEG, PNG & PDF yang diperbolehkan.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Maaf, file Anda tidak berhasil diunggah.";
} else {
    if (move_uploaded_file($_FILES["invoice"]["tmp_name"], $target_file)) {
        // Menyimpan data form lainnya ke database
        $tanggal = $_POST['tanggal'];
        $kebutuhan = $_POST['kebutuhan'];
        $kuantitas = $_POST['kuantitas'];
        $biaya = $_POST['biaya'];
        $keterangan = $_POST['keterangan'];

        // Asumsikan Anda memiliki koneksi database yang sudah diatur sebagai $conn
        $sql = "INSERT INTO invoice (tanggal, kebutuhan, kuantitas, biaya, keterangan, invoice_path) 
                VALUES ('$tanggal', '$kebutuhan', '$kuantitas', '$biaya', '$keterangan', '$target_file')";

        if (mysqli_query($conn, $sql)) {
            echo "File ". htmlspecialchars(basename($_FILES["invoice"]["name"])). " berhasil diunggah.";
        } else {
            echo "Kesalahan: " . $sql . "<br>" . mysqli_error($conn);
        }

    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
    }
}
?>
