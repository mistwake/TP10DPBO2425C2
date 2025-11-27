<!DOCTYPE html>
<html>
<head><title>Daftar Anggota</title></head>
<body>
    <a href="index.php">Home</a> | <b>Anggota</b>
    <hr>
    <h3>Daftar Anggota</h3>
    <a href="index.php?page=member_create">+ Tambah Anggota</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>No HP</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php foreach($members as $row): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td>
                    <a href="index.php?page=member_edit&id=<?= $row['id'] ?>">Edit</a> |
                    <a href="index.php?action=member_delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>