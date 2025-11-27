<!DOCTYPE html>
<html>
<head><title>Daftar Kategori</title></head>
<body>
    <a href="index.php">Home</a> | <b>Kategori</b>
    <hr>
    <h3>Daftar Kategori</h3>
    <a href="index.php?page=category_create">+ Tambah Kategori</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Nama Kategori</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php foreach($categories as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td>
                    <a href="index.php?page=category_edit&id=<?= $row['id'] ?>">Edit</a> |
                    <a href="index.php?action=category_delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>