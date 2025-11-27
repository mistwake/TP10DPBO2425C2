<?php
require_once 'models/Category.php';
require_once 'config/db.php';

class CategoryViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $this->model = new Category($database->getConnection());
    }

    public function showList() {
        return $this->model->read()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showEditForm($id) {
        $this->model->id = $id;
        $this->model->readOne();
        return $this->model; // Mengembalikan object model yang sudah terisi
    }

    public function store($data) {
        $this->model->name = $data['name'];
        if($this->model->create()) header("Location: index.php?page=categories");
    }

    public function update($data) {
        $this->model->id = $data['id'];
        $this->model->name = $data['name'];
        if($this->model->update()) header("Location: index.php?page=categories");
    }

    public function delete($id) {
        $this->model->id = $id;
        if($this->model->delete()) header("Location: index.php?page=categories");
    }
}
?>