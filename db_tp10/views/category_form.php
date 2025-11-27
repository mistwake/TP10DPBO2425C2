<!DOCTYPE html>
<html>
<head><title>Form Kategori</title></head>
<body>
    <h3><?= isset($category) ? 'Edit Kategori' : 'Tambah Kategori' ?></h3>
    
    <?php $action = isset($category) ? 'index.php?action=category_update' : 'index.php?action=category_store'; ?>

    <form action="<?= $action ?>" method="POST">
        <?php if(isset($category)): ?>
            <input type="hidden" name="id" value="<?= $category->id ?>">
        <?php endif; ?>

        <label>Nama Kategori:</label><br>
        <input type="text" name="name" required value="<?= isset($category) ? $category->name : '' ?>">
        <br><br>
        <button type="submit">Simpan</button>
        <a href="index.php?page=categories">Batal</a>
    </form>
</body>
</html>