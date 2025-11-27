<?php
class Book {
    private $conn;
    private $table_name = "books";

    public $id;
    public $title;
    public $author;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // --- READ (Ambil Semua Data) ---
    public function read() {
        // Menggunakan JOIN agar nama kategori muncul, bukan cuma ID-nya
        $query = "SELECT b.id, b.title, b.author, b.category_id, c.name as category_name 
                  FROM " . $this->table_name . " b
                  LEFT JOIN categories c ON b.category_id = c.id
                  ORDER BY b.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // --- READ SINGLE (Ambil 1 Data untuk Edit) ---
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->title = $row['title'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            return true;
        }
        return false;
    }

    // --- CREATE (Tambah Data) ---
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, author=:author, category_id=:category_id";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);

        return $stmt->execute();
    }

    // --- UPDATE (Ubah Data) ---
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title=:title, author=:author, category_id=:category_id 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // --- DELETE (Hapus Data) ---
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>