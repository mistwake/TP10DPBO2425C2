<?php
require_once 'models/Member.php';
require_once 'config/db.php';

class MemberViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $this->model = new Member($database->getConnection());
    }

    public function showList() {
        return $this->model->read()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showEditForm($id) {
        $this->model->id = $id;
        $this->model->readOne();
        return $this->model;
    }

    public function store($data) {
        $this->model->name = $data['name'];
        $this->model->email = $data['email'];
        $this->model->phone = $data['phone'];
        if($this->model->create()) header("Location: index.php?page=members");
    }

    public function update($data) {
        $this->model->id = $data['id'];
        $this->model->name = $data['name'];
        $this->model->email = $data['email'];
        $this->model->phone = $data['phone'];
        if($this->model->update()) header("Location: index.php?page=members");
    }

    public function delete($id) {
        $this->model->id = $id;
        if($this->model->delete()) header("Location: index.php?page=members");
    }
}
?>