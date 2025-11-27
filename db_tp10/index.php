<?php
// VIEW MODEL
require_once 'viewmodels/BookViewModel.php';
require_once 'viewmodels/CategoryViewModel.php';
require_once 'viewmodels/MemberViewModel.php';
require_once 'viewmodels/LoanViewModel.php';

// Ambil parameter page dan action
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// LOGIC ACTION
// Bagian ini tidak menampilkan HTML, hanya memproses data lalu redirect.
if (!empty($action)) {
    
    // BOOK ACTIONS
    if ($action == 'book_store') { (new BookViewModel())->store($_POST); }
    elseif ($action == 'book_update') { (new BookViewModel())->update($_POST); }
    elseif ($action == 'book_delete') { (new BookViewModel())->delete($_GET['id']); }

    // CATEGORY ACTIONS
    elseif ($action == 'category_store') { (new CategoryViewModel())->store($_POST); }
    elseif ($action == 'category_update') { (new CategoryViewModel())->update($_POST); }
    elseif ($action == 'category_delete') { (new CategoryViewModel())->delete($_GET['id']); }

    // MEMBER ACTIONS
    elseif ($action == 'member_store') { (new MemberViewModel())->store($_POST); }
    elseif ($action == 'member_update') { (new MemberViewModel())->update($_POST); }
    elseif ($action == 'member_delete') { (new MemberViewModel())->delete($_GET['id']); }

    // LOAN ACTIONS
    elseif ($action == 'loan_store') { (new LoanViewModel())->store($_POST); }
    elseif ($action == 'loan_update') { (new LoanViewModel())->update($_POST); }
    elseif ($action == 'loan_delete') { (new LoanViewModel())->delete($_GET['id']); }
    elseif ($action == 'loan_return') { (new LoanViewModel())->returnBook($_GET['id']); }
    
    exit(); // Stop script setelah redirect
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan MVVM</title>
    <style>
        /* CSS SEDERHANA UNTUK TAMPILAN */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f4f9; color: #333; }
        
        /* Navbar Style */
        .navbar { background-color: #2c3e50; overflow: hidden; padding: 0 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .navbar a { float: left; display: block; color: white; text-align: center; padding: 14px 20px; text-decoration: none; font-weight: bold; }
        .navbar a:hover { background-color: #34495e; }
        .navbar a.active { background-color: #e74c3c; }
        .navbar .brand { float: right; color: #ecf0f1; padding: 14px 20px; font-style: italic; }

        /* Container */
        .container { padding: 20px; max-width: 1000px; margin: auto; background: white; min-height: 80vh; box-shadow: 0 0 10px rgba(0,0,0,0.05); }

        /* Styling Table (Agar tabel di semua view rapi) */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        tr:hover { background-color: #ddd; }

        /* Styling Button & Links */
        a.btn, button { background-color: #2980b9; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; display: inline-block; }
        a.btn:hover, button:hover { background-color: #1abc9c; }
        a.btn-danger { background-color: #c0392b; }
        a.btn-danger:hover { background-color: #e74c3c; }

        /* Landing Page Grid */
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 40px; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; transition: transform 0.2s; border-top: 5px solid #2980b9; }
        .card:hover { transform: translateY(-5px); }
        .card h3 { margin-top: 0; color: #2c3e50; }
        .card p { color: #7f8c8d; }
        .welcome-hero { text-align: center; padding: 40px 20px; background-color: #ecf0f1; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php?page=home" class="<?= $page == 'home' ? 'active' : '' ?>">Home</a>
        <a href="index.php?page=books" class="<?= $page == 'books' ? 'active' : '' ?>">Data Buku</a>
        <a href="index.php?page=categories" class="<?= $page == 'categories' ? 'active' : '' ?>">Kategori</a>
        <a href="index.php?page=members" class="<?= $page == 'members' ? 'active' : '' ?>">Anggota</a>
        <a href="index.php?page=loans" class="<?= $page == 'loans' ? 'active' : '' ?>">Peminjaman</a>
        <span class="brand">Perpustakaan Digital</span>
    </div>

    <div class="container">
        <?php
        switch ($page) {
            
            // --- LANDING PAGE (HOME) ---
            case 'home':
                ?>
                <div class="welcome-hero">
                    <h1>Selamat Datang di Sistem Perpustakaan</h1>
                    <p>Kelola data buku, anggota, dan sirkulasi peminjaman dengan mudah dan efisien.</p>
                </div>
                
                <div class="dashboard-grid">
                    <div class="card" style="border-top-color: #e67e22;">
                        <h3>Buku</h3>
                        <p>Kelola koleksi buku perpustakaan.</p>
                        <a href="index.php?page=books" class="btn">Lihat Buku</a>
                    </div>
                    <div class="card" style="border-top-color: #27ae60;">
                        <h3>Kategori</h3>
                        <p>Atur kategori dan klasifikasi buku.</p>
                        <a href="index.php?page=categories" class="btn">Lihat Kategori</a>
                    </div>
                    <div class="card" style="border-top-color: #8e44ad;">
                        <h3>Anggota</h3>
                        <p>Data anggota perpustakaan aktif.</p>
                        <a href="index.php?page=members" class="btn">Lihat Anggota</a>
                    </div>
                    <div class="card" style="border-top-color: #c0392b;">
                        <h3>Peminjaman</h3>
                        <p>Transaksi peminjaman & pengembalian.</p>
                        <a href="index.php?page=loans" class="btn">Kelola Sirkulasi</a>
                    </div>
                </div>
                <?php
                break;

            // --- BOOK VIEWS ---
            case 'books': 
                $books = (new BookViewModel())->showList(); 
                include 'views/book_list.php'; 
                break;
            case 'book_create': 
                $data = (new BookViewModel())->showCreateForm(); 
                include 'views/book_form.php'; 
                break;
            case 'book_edit': 
                $data = (new BookViewModel())->showEditForm($_GET['id']); 
                include 'views/book_form.php'; 
                break;

            // --- CATEGORY VIEWS ---
            case 'categories': 
                $categories = (new CategoryViewModel())->showList(); 
                include 'views/category_list.php'; 
                break;
            case 'category_create': 
                include 'views/category_form.php'; 
                break;
            case 'category_edit': 
                $category = (new CategoryViewModel())->showEditForm($_GET['id']); 
                include 'views/category_form.php'; 
                break;

            // --- MEMBER VIEWS ---
            case 'members': 
                $members = (new MemberViewModel())->showList(); 
                include 'views/member_list.php'; 
                break;
            case 'member_create': 
                include 'views/member_form.php'; 
                break;
            case 'member_edit': 
                $member = (new MemberViewModel())->showEditForm($_GET['id']); 
                include 'views/member_form.php'; 
                break;

            // --- LOAN VIEWS ---
            case 'loans': 
                $loans = (new LoanViewModel())->showList(); 
                include 'views/loan_list.php'; 
                break;
            case 'loan_create': 
                $data = (new LoanViewModel())->showForm(); 
                include 'views/loan_form.php'; 
                break;
            case 'loan_edit': 
                $data = (new LoanViewModel())->showForm($_GET['id']); 
                include 'views/loan_form.php'; 
                break;

            default:
                echo "<div style='text-align:center; padding:50px;'>";
                echo "<h1>404</h1><p>Halaman tidak ditemukan.</p>";
                echo "<a href='index.php?page=home' class='btn'>Kembali ke Home</a>";
                echo "</div>";
                break;
        }
        ?>
    </div>

</body>
</html>