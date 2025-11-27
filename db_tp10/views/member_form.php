<!DOCTYPE html>
<html>
<head><title>Form Anggota</title></head>
<body>
    <h3><?= isset($member) ? 'Edit Anggota' : 'Tambah Anggota' ?></h3>
    
    <?php $action = isset($member) ? 'index.php?action=member_update' : 'index.php?action=member_store'; ?>

    <form action="<?= $action ?>" method="POST">
        <?php if(isset($member)): ?>
            <input type="hidden" name="id" value="<?= $member->id ?>">
        <?php endif; ?>

        <label>Nama:</label><br>
        <input type="text" name="name" required value="<?= isset($member) ? $member->name : '' ?>"><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required value="<?= isset($member) ? $member->email : '' ?>"><br><br>
        
        <label>No HP:</label><br>
        <input type="text" name="phone" value="<?= isset($member) ? $member->phone : '' ?>"><br><br>

        <button type="submit">Simpan</button>
        <a href="index.php?page=members">Batal</a>
    </form>
</body>
</html>