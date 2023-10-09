<?php
class AdminCoreFunctions extends Database{
	public function __construct()
	{
		parent::__construct();
	}
	public function validate_login($username, $password) {
		$password = md5(md5($password));
		$stmt = $this->connection->prepare("Select * from tbl_admin where BINARY  username=? and BINARY password=? And activatedstatus=1");
		$stmt->bindParam(1, $username);
		$stmt->bindParam(2, $password);
		$stmt->execute();
		if ($stmt->rowcount() == 0) {
			return '0';
		} else {
			return '1';
		}
	}
	public function get_admin_details($username,$password){
		$password = md5(md5($password));
		$stmt = $this->connection->prepare("Select * from tbl_admin where BINARY  username=? and BINARY password=? And activatedstatus=1");
		$stmt->bindParam(1, $username);
		$stmt->bindParam(2, $password);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function change_password($old_pass, $new_pass) {
		$old_pass = md5(md5($old_pass));
		$new_pass = md5(md5($new_pass));
		$stmt = $this->connection->prepare("select * from tbl_admin where username=? and BINARY password=?");
		$stmt->bindParam(1, $_SESSION[ADMIN_SESSION_EMAIL]);
		$stmt->bindParam(2, $old_pass);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			$stm = $this->connection->prepare("Update tbl_admin set password=? where aid=?");
			$stm->bindParam(1, $new_pass);
			$stm->bindParam(2, $_SESSION[ADMIN_SESSION]);
			$stm->execute();
        	return '1'; // valid user
	    } else {
	        return '0'; //invalid user
	    }
	}

	public function change_email($email) {
		$stmt = $this->connection->prepare("select email from tbl_admin where username=? and activatedstatus = 1");
		$stmt->bindParam(1, $_SESSION[ADMIN_SESSION_EMAIL]);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$stm = $this->connection->prepare("Update tbl_admin set email=? where aid=?");
			$stm->bindParam(1, $email);
			$stm->bindParam(2, $_SESSION[ADMIN_SESSION]);
			$stm->execute();
        	return '1'; // valid user
        } else {
	        return '0'; //invalid user
	    }
	}

	public function get_admin_email() {
		$stmt = $this->connection->prepare("select email from tbl_admin where username=? and activatedstatus = 1");
		$stmt->bindParam(1, $_SESSION[ADMIN_SESSION_EMAIL]);
		$stmt->execute();
        $rtmt = $stmt->fetch();
        return $rtmt['email'];
	}

	public function forgot_password($email) {
		$stmt = $this->connection->prepare("select * from tbl_admin where email=? and activatedstatus = 1");
		$stmt->bindParam(1, $email);
		if($stmt->execute()){
			return $rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		else{
			die(print_r($stmt->errorInfo(), true));
		}
	}
	public function generate_seo_url($title){
		$title = str_replace(' ','-',$title);
		return $title;
	}

	public function update_sales_tax($sales_tax) {
		$stmt = $this->connection->prepare("select sales_tax from tbl_sales_tax where status = 1");
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$stm = $this->connection->prepare("Update tbl_sales_tax set sales_tax=? where id=1");
			$stm->bindParam(1, $sales_tax);
			$stm->execute();
        	return '1'; // valid user
        } else {
	        return '0'; //invalid user
	    }
	}

	public function check_admin_email($email)
	{
	    $stmt = $this->connection->prepare("Select * from tbl_admin where BINARY  email=? And activatedstatus=1");
		$stmt->bindParam(1, $email);
		$stmt->execute();
        
		return $stmt->rowCount();
	}
	public function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-=+.?/][{}';
        $randstring = '';
        for ($i = 0; $i < 18; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
    public function setNewPassword($id, $password)
    {
        $password = md5(md5($password));
        $stm = $this->connection->prepare("Update tbl_admin set password=?  ");
		$stm->bindParam(1, $password);
		$stm->execute();
    }
}
