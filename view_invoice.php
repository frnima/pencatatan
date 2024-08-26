<?php
// Asumsikan Anda memiliki koneksi database yang sudah diatur sebagai $conn
$sql = "SELECT * FROM invoice";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Tanggal</th><th>Kebutuhan</th><th>Kuantitas</th><th>Biaya</th><th>Keterangan</th><th>invoice</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["tanggal"]."</td><td>".$row["kebutuhan"]."</td><td>".$row["kuantitas"]."</td><td>".$row["biaya"]."</td><td>".$row["keterangan"]."</td><td><a href='".$row["invoice_path"]."' target='_blank'>Lihat invoice</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "invoice tidak ditemukan.";
}
?>