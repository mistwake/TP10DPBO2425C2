<!DOCTYPE html>
<html>
<head><title>Daftar Peminjaman</title></head>
<body>
    <a href="index.php">Home</a> | <b>Peminjaman</b>
    <hr>
    <h3>Daftar Peminjaman Buku</h3>
    <a href="index.php?page=loan_create">+ Pinjam Buku Baru</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($loans as $row): ?>
            <tr>
                <td><?= $row['member_name'] ?></td>
                <td><?= $row['book_title'] ?></td>
                <td><?= $row['loan_date'] ?></td>
                <td><?= $row['return_date'] ? $row['return_date'] : '-' ?></td>
                <td>
                    <?php if($row['status'] == 'borrowed'): ?>
                        <span style="color:red; font-weight:bold;">Dipinjam</span>
                    <?php else: ?>
                        <span style="color:green; font-weight:bold;">Dikembalikan</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($row['status'] == 'borrowed'): ?>
                        <a href="index.php?action=loan_return&id=<?= $row['id'] ?>">Kembalikan</a> | 
                    <?php endif; ?>
                    <a href="index.php?page=loan_edit&id=<?= $row['id'] ?>">Edit</a> |
                    <a href="index.php?action=loan_delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>