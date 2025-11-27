<?php
require_once 'models/Loan.php';
require_once 'models/Book.php';
require_once 'models/Member.php';
require_once 'config/db.php';

class LoanViewModel {
    private $loanModel;
    private $bookModel;
    private $memberModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->loanModel = new Loan($db);
        $this->bookModel = new Book($db);
        $this->memberModel = new Member($db);
    }

    public function showList() {
        return $this->loanModel->read()->fetchAll(PDO::FETCH_ASSOC);
    }

    // Siapkan data untuk Form (Butuh daftar Buku & Anggota)
    public function showForm($id = null) {
        $books = $this->bookModel->read()->fetchAll(PDO::FETCH_ASSOC);
        $members = $this->memberModel->read()->fetchAll(PDO::FETCH_ASSOC);
        
        $loan = null;
        if ($id) {
            $this->loanModel->id = $id;
            $this->loanModel->readOne();
            $loan = $this->loanModel;
        }

        return [
            'books' => $books,
            'members' => $members,
            'loan' => $loan
        ];
    }

    public function store($data) {
        $this->loanModel->book_id = $data['book_id'];
        $this->loanModel->member_id = $data['member_id'];
        $this->loanModel->loan_date = date('Y-m-d'); // Default hari ini
        
        if($this->loanModel->create()) header("Location: index.php?page=loans");
    }

    public function update($data) {
        $this->loanModel->id = $data['id'];
        $this->loanModel->book_id = $data['book_id'];
        $this->loanModel->member_id = $data['member_id'];
        $this->loanModel->loan_date = $data['loan_date'];
        
        // Cek jika status diubah jadi returned, isi tanggal kembali
        if($data['status'] == 'returned' && empty($data['return_date'])) {
             $this->loanModel->return_date = date('Y-m-d');
        } else {
             $this->loanModel->return_date = $data['return_date'];
        }
        
        $this->loanModel->status = $data['status'];

        if($this->loanModel->update()) header("Location: index.php?page=loans");
    }

    // Fitur khusus: Kembalikan Buku (Shortcut)
    public function returnBook($id) {
        $this->loanModel->id = $id;
        $this->loanModel->readOne(); // Load data lama dulu
        $this->loanModel->status = 'returned';
        $this->loanModel->return_date = date('Y-m-d');
        
        if($this->loanModel->update()) header("Location: index.php?page=loans");
    }

    public function delete($id) {
        $this->loanModel->id = $id;
        if($this->loanModel->delete()) header("Location: index.php?page=loans");
    }
}
?>