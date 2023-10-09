<?php
class MV_Testimonials extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt =  $this->connection->prepare("SELECT * FROM `tbl_testimonials` ORDER BY id DESC");
        $stmt->execute();

        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function index_front()
    {
        $stmt =  $this->connection->prepare("SELECT * FROM `tbl_testimonials` where `status`=1 ORDER BY id DESC");
        $stmt->execute();

        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data = array())
    {
        $stmt = $this->connection->prepare("INSERT INTO `tbl_testimonials`( `name`,`description`,`email`,`rating`, `status`) VALUES (?,?,?,?, 1)");

        $stmt->bindParam(1, $data['name']);
        $stmt->bindParam(2, $data['description']);
        $stmt->bindParam(3, $data['email']);
        $stmt->bindParam(4, $data['rating']);
        if ($stmt->execute()) {
            $last_insert_id = $this->connection->lastInsertId();
            return (isset($last_insert_id) && !empty($last_insert_id)) ? $last_insert_id : die(print_r($stmt->errorInfo(), true));;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }
    public function store_front($data = array())
    {
        $stmt = $this->connection->prepare("INSERT INTO `tbl_testimonials`( `name`,`description`,`email`,`rating`, `status`) VALUES (?,?,?,?, 0)");

        $stmt->bindParam(1, $data['name']);
        $stmt->bindParam(2, $data['description']);
        $stmt->bindParam(3, $data['email']);
        $stmt->bindParam(4, $data['rating']);
        if ($stmt->execute()) {
            $last_insert_id = $this->connection->lastInsertId();
            return (isset($last_insert_id) && !empty($last_insert_id)) ? $last_insert_id : die(print_r($stmt->errorInfo(), true));;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function update($id, $data = array())
    {
        $stmt = $this->connection->prepare("UPDATE `tbl_testimonials` SET `name`=?, `description`=?,`email`=?,`rating`=? where id=?");

        $stmt->bindParam(1, $data['name']);
        $stmt->bindParam(2, $data['description']);
        $stmt->bindParam(3, $data['email']);
        $stmt->bindParam(4, $data['rating']);
        $stmt->bindParam(5, $id);

        if ($stmt->execute()) {
            return $id;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function delete($id)
    {
        $photoid = $this->get_details($id);
        if (!empty($photoid['photourl'])) {
            unlink('../' . $photoid['photourl']);
        }

        $stmt = $this->connection->prepare("DELETE FROM `tbl_testimonials` WHERE id = ?");
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return $id;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function get_details($id)
    {
        $stmt = $this->connection->prepare("select * from tbl_testimonials where id=?");
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function updateStatus($status, $id)
    {
        $st = ($status == 'correct') ? 1 : 0;
        $stmt = $this->connection->prepare("UPDATE `tbl_testimonials` SET `status`=? where `id`=?");
        $stmt->bindParam(1, $st);
        $stmt->bindParam(2, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }
}
