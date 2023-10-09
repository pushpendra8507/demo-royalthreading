<?php
class Appointments extends Database
{
    public $print_appointment;
	public function __construct()
	{
		parent::__construct();
		$this->print_appointment = new PrintAppointment;
		
	}

	public function create_appointment($data = array())
	{
		$stmt = $this->connection->prepare("INSERT INTO `tbl_appointments` (`name`, `email`, `phone`, `service`, `date`, `time`, `status`) VALUES(?,?,?,?,?,?,1)");
		$stmt->bindParam(1, $data['name']);
		$stmt->bindParam(2, $data['email']);
		$stmt->bindParam(3, $data['phone']);
		$stmt->bindParam(4, $data['service']);
		$stmt->bindParam(5, $data['date']);
		$stmt->bindParam(6, $data['time']);

		if($stmt->execute())
		{
			$last_insert_id = $this->connection->lastInsertId();
			return (isset($last_insert_id) && !empty($last_insert_id))?$last_insert_id:die(print_r($stmt->errorInfo(), true));;
			
		}
		else{
            die(print_r($stmt->errorInfo(), true));
        }
	}
	
	
	public function getAppointmentList($filter_data=[],$limit='')
	{
	    if(!empty($limit))
	    {
	        if(isset($filter_data['from_date']) && !empty($filter_data['from_date']) && isset($filter_data['to_date']) && !empty($filter_data['to_date']))
	        {
	            $from_date = date('Y-m-d 00:00', strtotime($filter_data['from_date']));
	            $to_date = date('Y-m-d 23:59', strtotime($filter_data['to_date']));
	            $stmt = $this->connection->prepare("SELECT * FROM `tbl_appointments` WHERE `created_at` BETWEEN ? AND ? AND  `status`=1 ORDER BY `id` DESC ".$limit);
	            $stmt->bindParam(1,$from_date);
	            $stmt->bindParam(2,$to_date);
	        }
	        else
	        {
	            $stmt = $this->connection->prepare("SELECT * FROM `tbl_appointments` WHERE `status`=1 ORDER BY `id` DESC ".$limit);
	        }
	        
	    }
	    else
	    {
	        if(isset($filter_data['from_date']) && !empty($filter_data['from_date']) && isset($filter_data['to_date']) && !empty($filter_data['to_date']))
	        {
	            $from_date = date('Y-m-d 00:00', strtotime($filter_data['from_date']));
	            $to_date = date('Y-m-d 23:59', strtotime($filter_data['to_date']));
	            $stmt = $this->connection->prepare("SELECT * FROM `tbl_appointments` WHERE `created_at` BETWEEN ? AND ? AND  `status`=1 ORDER BY `id` DESC ");
	            $stmt->bindParam(1,$from_date);
	            $stmt->bindParam(2,$to_date);
	        }
	        else
	        {
	            $stmt = $this->connection->prepare("SELECT * FROM `tbl_appointments` WHERE `status`=1 ORDER BY `id` DESC");
	        }
	    }
		
		if($stmt->execute())
		{
		    return $rtmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
		    	die(print_r($stmt->errorInfo(), true));
		}
		
	}

	public function getAppointment($appointment_id)
	{

		$stmt = $this->connection->prepare("SELECT * FROM `tbl_appointments` WHERE `id`=?");
		$stmt->bindParam(1,$appointment_id);
		$stmt->execute();
		$rtmt = $stmt->fetch(PDO::FETCH_ASSOC);

		// $stm = $this->connection->prepare("SELECT tas.`appointment_id`,tpl.`title`,tpl.`max_price`,tpla.`title` as parent_name FROM  `tbl_appointment_services` tas  
		// 	LEFT JOIN `tbl_price_list` tpl ON tas.`service_id`=tpl.`id`
		// 	LEFT JOIN `tbl_price_list` tpla ON tpl.`parent_id` = tpla.`id` WHERE tas.`appointment_id`=?");
		// $stm->bindParam(1,$appointment_id);
		// $stm->execute();
		// $rtm = $stm->fetchAll(PDO::FETCH_ASSOC);

		// if(!empty($rtmt))
		// {
		// 	$details = [];
		// 	foreach($rtm as $item)
		// 	{
		// 		$details[$item['parent_name']][] = $item;
		// 	}
		// }
		// $rtmt['details'] = $details;
		//echo '<pre>';print_r($rtmt);die();
		return $rtmt;
	}

	public function deleteAppointment($appointment_id)
	{
		$stmt = $this->connection->prepare("DELETE FROM `tbl_appointment_services` WHERE `appointment_id`=?");
		$stmt->bindParam(1,$appointment_id);
		$stmt->execute();

		$stm = $this->connection->prepare("DELETE FROM `tbl_appointments` WHERE `id`=?");
		$stm->bindParam(1,$appointment_id);
		$stm->execute();

		return true;
	}
	
	public function updateAndSendEmail($appointment_id,$appointment_time)
	{
	    $stmt = $this->connection->prepare("UPDATE `tbl_appointment_services` SET `booking_date`=? WHERE `appointment_id`=?");
	    $stmt->bindParam(1,$appointment_time);
	    $stmt->bindParam(2,$appointment_id);
		$stmt->execute();
		
		if($this->sendBookingConfirmationEmail($appointment_id))
		{
		    return true;
		}
		
	}
	
	public function sendBookingConfirmationEmail($appointment_id)
	{
	    $stmt = $this->connection->prepare("SELECT * FROM `tbl_appointments` WHERE `id`=?");
		$stmt->bindParam(1,$appointment_id);
		$stmt->execute();
		$rtmt = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$message = '<!DOCTYPE html>
                    <html>
                    <head>
                    	<meta charset="utf-8">
                    	<meta name="viewport" content="width=device-width, initial-scale=1">
                    	<title>Royal Threading Center</title>
                    </head>
                    <body>
                    	<p>Hi '.$rtmt["name"].',<br> Your booking at Royal Threading Center has been scheduled for '.date("m-d-Y H:i:s", strtotime($rtmt["booking_date"])).'.<br><br> Thanks & Regards<br> Royal Threading Center </p>
                    </body>
                    </html>';
        $to = isset($rtmt['email'])?$rtmt['email']:'';
        $to='ravi@agpt.in';
        $fromMail = FROM_EMAIL;
        $fromName = MAIL_TITLE;
        $subject = MAIL_TITLE.' - Appointment Confirmation';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= 'From:'.$fromName." ".'<'.$fromMail.'>'."\r\n";
        $message = str_replace("\'", "'", $message);
        if($send_mail = mail($to, $subject, $message, $headers))
        {
            return true;
        }
	}
	
	public function print_appointment($id)
	{
	    $data   = $this->getAppointment($id);
	    $result = $this->print_appointment->print_appointment_data($data);
	    return $result;
	}
}