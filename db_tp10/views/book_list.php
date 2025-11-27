<!DOCTYPE html>
<html>
<head><title>Daftar Buku</title></head>
<body>
    <a href="index.php">Home</a> | <b>Buku</b>
    <hr>
    
    <h3>Daftar Buku</h3>
    <a href="index.php?page=book_create">+ Tambah Buku Baru</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($books)): ?>
                <tr><td colspan="4">Belum ada data buku.</td></tr>
            <?php else: ?>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['category_name'] ?></td> <td>
                        <a href="index.php?page=book_edit&id=<?= $book['id'] ?>">Edit</a> | 
                        <a href="index.php?action=book_delete&id=<?= $book['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>