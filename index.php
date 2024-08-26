<?php
include 'koneksi.php';

// Proses penghapusan data
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $sql = "DELETE FROM data_kebutuhan WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses menambahkan atau mengupdate data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $tanggal = $_POST['tanggal'];
    $kebutuhan = $_POST['kebutuhan'];
    $kuantitas = $_POST['kuantitas'];
    $biaya = $_POST['biaya'];
    $keterangan = $_POST['keterangan'];
    $invoice = $_POST['invoice'];

    if ($id) {
        // Update data
        $sql = "UPDATE data_kebutuhan SET tanggal='$tanggal', kebutuhan='$kebutuhan', kuantitas='$kuantitas', biaya='$biaya', keterangan='$keterangan', invoice='$invoice' WHERE id=$id";
    } else {
        // Tambah data baru
        $sql = "INSERT INTO data_kebutuhan (tanggal, kebutuhan, kuantitas, biaya, keterangan, invoice) 
                VALUES ('$tanggal', '$kebutuhan', '$kuantitas', '$biaya', '$keterangan', '$invoice')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mengambil data dari database
$whereClause = "";
if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_akhir'])) {
    $tanggal_mulai = $_GET['tanggal_mulai'];
    $tanggal_akhir = $_GET['tanggal_akhir'];
    
    if (!empty($tanggal_mulai) && !empty($tanggal_akhir)) {
        $whereClause = " WHERE tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'";
    }
}

$sql = "SELECT * FROM data_kebutuhan" . $whereClause;
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kebutuhan</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script>
        function toggleForm(id = null) {
            var formElement = document.getElementById("addForm").querySelector("form");
            var formTitle = document.getElementById("formTitle");
            var formButton = formElement.querySelector("button[type='submit']");

            if (id) {
                formTitle.textContent = "Edit Data";
                formButton.textContent = "Update Data";

                // Ambil data dari tabel untuk diisi di form
                var row = document.querySelector(`tr[data-id='${id}']`);
                document.getElementById("id").value = id;
                document.getElementById("tanggal").value = row.querySelector(".tanggal").textContent;
                document.getElementById("kebutuhan").value = row.querySelector(".kebutuhan").textContent;
                document.getElementById("kuantitas").value = row.querySelector(".kuantitas").textContent;
                document.getElementById("biaya").value = row.querySelector(".biaya").textContent.replace(/,/g, '');
                document.getElementById("keterangan").value = row.querySelector(".keterangan").textContent;
            } else {
                formTitle.textContent = "Tambah Data";
                formButton.textContent = "Tambah Data";

                // Reset form
                formElement.reset();  
                document.getElementById("id").value = '';
            }

            document.getElementById("addForm").style.display = "block";
        }

        function closeForm() {
            var formElement = document.getElementById("addForm").querySelector("form");
            formElement.reset(); 
            document.getElementById("addForm").style.display = "none";
        }

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "index.php?delete_id=" + id;
            }
        }

        function printData() {
            var divToPrint = document.getElementById("printTable");
            var newWin = window.open("");
            newWin.document.write("<html><head><title>Cetak Data</title>");
            newWin.document.write("<link rel='stylesheet' href='style.css'>");
            newWin.document.write("</head><body >");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.write("</body></html>");
            newWin.print();
            newWin.close();
        }
    </script>
</head>
<body>

<div class="button-container">
    <button onclick="toggleForm()" class="button tambah">Tambah data</button>
    <button onclick="printData()" class="button print">Cetak Data</button>
    <a href="logout.php" class="button_keluar">Keluar</a>
    
    <form method="get" action="index.php" style="display: flex;">
        <label for="tanggal_mulai">Dari Tanggal:</label>
        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : ''; ?>" required>
        
        <label for="tanggal_akhir">Sampai Tanggal:</label>
        <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="<?php echo isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : ''; ?>" required>
        
        <button type="submit" class="button">Filter</button>
    </form>
</div>

<div id="overlay"></div>

<div id="addForm" style="display: none;">
    <h3 id="formTitle">Tambah Data</h3>
    <form action="index.php" method="post">
        <input type="hidden" id="id" name="id">
        
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required>
        
        <label for="kebutuhan">Kebutuhan:</label>
        <input type="text" id="kebutuhan" name="kebutuhan" required>
        
        <label for="kuantitas">Kuantitas:</label>
        <input type="number" id="kuantitas" name="kuantitas" required>
        
        <label for="biaya">Biaya:</label>
        <input type="number" id="biaya" name="biaya" required>
        
        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan" required></textarea>

        <label for="invoice">Unggah invoice:</label>
  <input type="file" id="invoice" name="invoice"><br><br>

        <button type="submit" class="button tambah">Tambah Data</button>
        <button type="button" class="button keluar" onclick="closeForm()">Keluar</button>
    </form>
</div>

<div id="printTable">
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kebutuhan</th>
                <th>Kuantitas</th>
                <th>Biaya</th>
                <th>Keterangan</th> 
                <th>Invoice</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td class="tanggal"><?php echo $row['tanggal']; ?></td>
                        <td class="kebutuhan"><?php echo $row['kebutuhan']; ?></td>
                        <td class="kuantitas"><?php echo $row['kuantitas']; ?></td>
                        <td class="biaya"><?php echo number_format($row['biaya'], 2); ?></td>
                        <td class="keterangan"><?php echo $row['keterangan']; ?></td>
                        <td>
                            <?php 
                            if ($row['invoice']) {
                                echo '<a href="data:application/pdf;base64,' . base64_encode($row['invoice']) . '" target="_blank">View</a>';
                            } else {
                                echo 'Invoice tidak ada';
                            }
                            ?>
                        </td>
                        <td>
                            <button class='button edit-btn' onclick="toggleForm(<?php echo $row['id']; ?>)">
                                <i class='bx bx-edit'></i> 
                            </button>
                            <button class='button delete-btn' onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No data found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $conn->close(); ?>


</body>
</html>
