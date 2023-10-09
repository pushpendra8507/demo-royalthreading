<?php
class MV_Blog extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_limit($limit = '')
    {
        if (!empty($limit)) {
            $stmt = $this->connection->prepare("select * from tbl_blogs order by id asc" . $limit);
        } else {
            $stmt = $this->connection->prepare("select * from tbl_blogs order by id asc");
        }
        if ($stmt->execute()) {
            return $rtmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function site_index($limit = '')
    {
        if ($limit) {
            $stmt = $this->connection->prepare("SELECT * FROM `tbl_blogs` where `status` = 1 order by id LIMIT $limit");
            if ($stmt->execute()) {
                return $rtmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                die(print_r($stmt->errorInfo(), true));
            }
        }


        $stmt = $this->connection->prepare("SELECT * FROM `tbl_blogs` where status = 1 order by id ");
        if ($stmt->execute()) {
            return $rtmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function store($data = array())
    {
        $stmt = $this->connection->prepare("INSERT INTO `tbl_blogs` ( `seo_title`,`title`,`seo_description`,`seo_keyword`,`seo_h1`,`seo_h2`,`tags`,`description`,`date`,`link`,`alias`, `created_at`, `updated_at`, `status`,`name`) VALUES (?,?,?,?,?,?,?,?,?,?,?, now(), now(), 1,?)");

        $stmt->bindParam(1, $data['seo_title']);
        $stmt->bindParam(2, $data['title']);
        $stmt->bindParam(3, $data['seo_description']);
        $stmt->bindParam(4, $data['seo_keyword']);
        $stmt->bindParam(5, $data['seo_h1']);
        $stmt->bindParam(6, $data['seo_h2']);
        $stmt->bindParam(7, $data['tags']);
        $stmt->bindParam(8, $data['description']);
        $stmt->bindParam(9, $data['date']);
        $stmt->bindParam(10, $data['link']);
        $stmt->bindParam(11, $data['alias']);
        $stmt->bindParam(12, $data['name']);
        if ($stmt->execute()) {
            $last_insert_id = $this->connection->lastInsertId();
            return (isset($last_insert_id) && !empty($last_insert_id)) ? $last_insert_id : die(print_r($stmt->errorInfo(), true));;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function update($id, $data = array())
    {
        $stmt = $this->connection->prepare("UPDATE `tbl_blogs` SET `seo_title`=?,`title`=?,`seo_description`=?, `seo_keyword`=?, `seo_h1`=?,`seo_h2`=?, `tags`=?, `description`=?,`date`=?, `link`=?,`alias`=?, `name`=? where id=?");

        $stmt->bindParam(1, $data['seo_title']);
        $stmt->bindParam(2, $data['title']);
        $stmt->bindParam(3, $data['seo_description']);
        $stmt->bindParam(4, $data['seo_keyword']);
        $stmt->bindParam(5, $data['seo_h1']);
        $stmt->bindParam(6, $data['seo_h2']);
        $stmt->bindParam(7, $data['tags']);
        $stmt->bindParam(8, $data['description']);
        $stmt->bindParam(9, $data['date']);
        $stmt->bindParam(10, $data['link']);
        $stmt->bindParam(11, $data['alias']);
        $stmt->bindParam(12, $data['name']);
        $stmt->bindParam(13, $id);
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


        $stmt = $this->connection->prepare("DELETE FROM `tbl_blogs` WHERE id = ?");
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return $id;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }


    public function get_details_by_alias($alias)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `tbl_blogs` WHERE `alias`=?");
        $stmt->bindParam(1, $alias);
        if ($stmt->execute()) {
            return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }



    public function get_details($id)
    {
        $stmt = $this->connection->prepare("select * from tbl_blogs where id=?");
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->connection->prepare("UPDATE `tbl_blogs` SET `status`=? where id=?");
        if ($status == 0) {
            $updatedsts = 1;
        } else if ($status == 1) {
            $updatedsts = 0;
        }

        $stmt->bindParam(1, $updatedsts);
        $stmt->bindParam(2, $id);

        if ($stmt->execute()) {
            return $id;
        } else {
            die(print_r($stmt->errorInfo(), true));
        }
    }
}
