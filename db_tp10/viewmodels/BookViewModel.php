<?php
require_once 'models/Book.php';
require_once 'models/Category.php'; // Kita butuh ini untuk dropdown di Form Buku
require_once 'config/db.php';

class BookViewModel {
    private $bookModel;
    private $categoryModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->bookModel = new Book($db);
        $this->categoryModel = new Category($db);
    }

    // Menyiapkan data untuk List Buku
    public function showList() {
        $stmt = $this->bookModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menyiapkan data untuk Form Tambah (Butuh List Kategori)
    public function showCreateForm() {
        $categories = $this->categoryModel->read()->fetchAll(PDO::FETCH_ASSOC);
        return ['categories' => $categories, 'book' => null];
    }

    // Menyiapkan data untuk Form Edit (Butuh Data Buku + List Kategori)
    public function showEditForm($id) {
        $this->bookModel->id = $id;
        $this->bookModel->readOne(); // Load data buku berdasarkan ID
        
        $categories = $this->categoryModel->read()->fetchAll(PDO::FETCH_ASSOC);
        
        // Return data buku saat ini & list kategori
        return [
            'categories' => $categories, 
            'book' => $this->bookModel // Objek model yang sudah terisi datanya
        ];
    }

    // Proses Simpan (Create)
    public function store($data) {
        $this->bookModel->title = $data['title'];
        $this->bookModel->author = $data['author'];
        $this->bookModel->category_id = $data['category_id'];
        
        if($this->bookModel->create()) {
            header("Location: index.php?page=books");
        }
    }

    // Proses Update
    public function update($data) {
        $this->bookModel->id = $data['id'];
        $this->bookModel->title = $data['title'];
        $this->bookModel->author = $data['author'];
        $this->bookModel->category_id = $data['category_id'];

        if($this->bookModel->update()) {
            header("Location: index.php?page=books");
        }
    }

    // Proses Hapus
    public function delete($id) {
        $this->bookModel->id = $id;
        if($this->bookModel->delete()) {
            header("Location: index.php?page=books");
        }
    }
}
?>