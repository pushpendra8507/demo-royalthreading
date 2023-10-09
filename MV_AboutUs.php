<?php
class MV_AboutUs extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt =  $this->connection->prepare("SELECT * FROM `tbl_aboutus` where status=1");
        $stmt->execute();

        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $title = isset($data['title']) ? $data['title'] : '';
        $description = isset($data['description']) ? $data['description'] : '';

        $stmt = $this->connection->prepare("UPDATE `tbl_aboutus` SET `title`=?,`description`=? WHERE id=1");

        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);



        return ($stmt->execute()) ? 1 : 0;
    }
}
