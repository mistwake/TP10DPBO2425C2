<!DOCTYPE html>
<html>
<head><title>Form Peminjaman</title></head>
<body>
    <h3><?= isset($data['loan']) ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?></h3>

    <?php $action = isset($data['loan']) ? 'index.php?action=loan_update' : 'index.php?action=loan_store'; ?>

    <form action="<?= $action ?>" method="POST">
        <?php if(isset($data['loan'])): ?>
            <input type="hidden" name="id" value="<?= $data['loan']->id ?>">
        <?php endif; ?>

        <label>Nama Peminjam:</label><br>
        <select name="member_id" required>
            <option value="">-- Pilih Anggota --</option>
            <?php foreach($data['members'] as $m): ?>
                <option value="<?= $m['id'] ?>" 
                    <?= (isset($data['loan']) && $data['loan']->member_id == $m['id']) ? 'selected' : '' ?>>
                    <?= $m['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Buku yg Dipinjam:</label><br>
        <select name="book_id" required>
            <option value="">-- Pilih Buku --</option>
            <?php foreach($data['books'] as $b): ?>
                <option value="<?= $b['id'] ?>" 
                    <?= (isset($data['loan']) && $data['loan']->book_id == $b['id']) ? 'selected' : '' ?>>
                    <?= $b['title'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <?php if(isset($data['loan'])): ?>
            <label>Tanggal Pinjam:</label><br>
            <input type="date" name="loan_date" value="<?= $data['loan']->loan_date ?>"><br><br>
            
            <label>Status:</label><br>
            <select name="status">
                <option value="borrowed" <?= $data['loan']->status == 'borrowed' ? 'selected' : '' ?>>Dipinjam</option>
                <option value="returned" <?= $data['loan']->status == 'returned' ? 'selected' : '' ?>>Dikembalikan</option>
            </select><br><br>
            
            <label>Tanggal Kembali (Manual):</label><br>
            <input type="date" name="return_date" value="<?= $data['loan']->return_date ?>"><br><br>
        <?php endif; ?>

        <button type="submit">Simpan</button>
        <a href="index.php?page=loans">Batal</a>
    </form>
</body>
</html>