<?php
class PrintAppointment extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function print_appointment_data($data = [])
    {

        ob_start();
?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Royal Threading Center</title>
        </head>
        <body>
            <table width="80%" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF" style="border:1px #ccc solid; border-collapse:collapse;">
                <thead>
                    <tr>
                        <td colspan="2">
                            <img src="https://envisioncarpentryllc.net/assets/images/resources/logo-1.png" align="center" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Appointment Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><?php echo isset($data['name']) ? $data['name'] : '' ?></td>
                        <th>Email</th>
                        <td><?php echo isset($data['email']) ? $data['email'] : '' ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo isset($data['phone']) ? $data['phone'] : '' ?></td>
                        <th>Appoint. Date</th>
                        <td><?php echo isset($data['date']) ? $data['date'] : '' ?></td>
                    </tr>
                    <tr>
                        <th>Appoint. Time</th>
                        <td><?php echo isset($data['time']) ? $data['time'] : '' ?></td>
                        <th>Service</th>
                        <td colspan="4"><?php echo isset($data['service']) ? $data['service'] : '' ?></td>
                    </tr>
                </tbody>
            </table>
        </body>

        </html>
<?php
        $php_output = ob_get_contents();
        ob_end_clean();
        //echo $php_output;die();
        return $php_output;
    }
}
