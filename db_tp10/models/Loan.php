<?php
class Loan {
    private $conn;
    private $table_name = "loans";

    public $id;
    public $book_id;
    public $member_id;
    public $loan_date;
    public $return_date;
    public $status; // 'borrowed' atau 'returned'

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ: Join ke tabel books dan members biar muncul namanya, bukan cuma ID
    public function read() {
        $query = "SELECT l.id, l.loan_date, l.return_date, l.status, 
                         b.title as book_title, m.name as member_name 
                  FROM " . $this->table_name . " l
                  LEFT JOIN books b ON l.book_id = b.id
                  LEFT JOIN members m ON l.member_id = m.id
                  ORDER BY l.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ ONE: Ambil 1 data untuk edit
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->book_id = $row['book_id'];
            $this->member_id = $row['member_id'];
            $this->loan_date = $row['loan_date'];
            $this->return_date = $row['return_date'];
            $this->status = $row['status'];
            return true;
        }
        return false;
    }

    // CREATE: Pinjam Buku
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET book_id=:book_id, member_id=:member_id, loan_date=:loan_date, status='borrowed'";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":book_id", $this->book_id);
        $stmt->bindParam(":member_id", $this->member_id);
        $stmt->bindParam(":loan_date", $this->loan_date);

        return $stmt->execute();
    }

    // UPDATE: Bisa untuk Edit data atau Pengembalian Buku
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET book_id=:book_id, member_id=:member_id, loan_date=:loan_date, 
                      return_date=:return_date, status=:status 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Jika return_date kosong, set NULL (biar rapi di database)
        $r_date = !empty($this->return_date) ? $this->return_date : NULL;

        $stmt->bindParam(":book_id", $this->book_id);
        $stmt->bindParam(":member_id", $this->member_id);
        $stmt->bindParam(":loan_date", $this->loan_date);
        $stmt->bindParam(":return_date", $r_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>