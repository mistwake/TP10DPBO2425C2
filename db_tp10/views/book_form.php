<!DOCTYPE html>
<html>
<head><title>Form Buku</title></head>
<body>
    <h3><?= isset($data['book']) ? 'Edit Buku' : 'Tambah Buku' ?></h3>

    <?php 
        $action_url = isset($data['book']) ? 'index.php?action=book_update' : 'index.php?action=book_store';
    ?>

    <form action="<?= $action_url ?>" method="POST">
        <?php if(isset($data['book'])): ?>
            <input type="hidden" name="id" value="<?= $data['book']->id ?>">
        <?php endif; ?>

        <label>Judul Buku:</label><br>
        <input type="text" name="title" required 
               value="<?= isset($data['book']) ? $data['book']->title : '' ?>"><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="author" required 
               value="<?= isset($data['book']) ? $data['book']->author : '' ?>"><br><br>

        <label>Kategori:</label><br>
        <select name="category_id" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach($data['categories'] as $cat): ?>
                <option value="<?= $cat['id'] ?>" 
                    <?php 
                        // Logic untuk auto-select saat Edit
                        if(isset($data['book']) && $data['book']->category_id == $cat['id']) {
                            echo 'selected';
                        }
                    ?>>
                    <?= $cat['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit">Simpan</button> 
        <a href="index.php?page=books">Batal</a>
    </form>
</body>
</html>