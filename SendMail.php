<?php

class SendMail extends Database {

  private $order_details;

  public function __construct()

  {

    parent::__construct();



    $this->order_details = new RoyalGift_Order;

  }

  public function send_order_email($order_id){



    $mail_content =  $this->order_email_template($order_id);

        //echo $mail_content;die();

    $get_order_email = $this->order_details->get_order_email($order_id);

        //$to = ADMIN_EMAIL; // add additional mail receipient here

    if(!empty($get_order_email)){

      $to=$get_order_email;

    }



    $fromMail = FROM_EMAIL;

    $fromName = FROM_NAME;

    $subject = 'Booking Details';



    $headers = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From:' . $fromName . " " . '<' . $fromMail . '>' . "\r\n";

    $headers .= 'Bcc: '.ADMIN_EMAIL . "\r\n";
    $headers .= 'Bcc: info@wserve.com' . "\r\n";
    $headers .= 'Bcc:pushpendra639263@gmail.com' . "\r\n";

    $message = $mail_content;

        //echo $to;exit;

    $send_mail = mail($to, $subject, $message, $headers);

  }


  public function send_order_status_email($order_id, $subject){



    $mail_content =  $this->order_email_template($order_id);

        //echo $mail_content;die();

    $get_order_email = $this->order_details->get_order_email($order_id);

        //$to = ADMIN_EMAIL; // add additional mail receipient here

    if(!empty($get_order_email)){

      $to=$get_order_email;

    }

    $fromMail = FROM_EMAIL;

    $fromName = FROM_NAME;

    $subject = $subject;

    $headers = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From:' . $fromName . " " . '<' . $fromMail . '>' . "\r\n";

    //$headers .= 'Bcc: '.ADMIN_EMAIL . "\r\n";
    //$headers .= 'Bcc: info@wserve.com' . "\r\n";
    $headers .= 'Bcc:pushpendra639263@gmail.com' . "\r\n";

    $message = $mail_content;
    //echo $to;exit;

    $send_mail = mail($to, $subject, $message, $headers);

  }


  public function order_email_template($order_id){

    $details = $this->order_details->get_order_data($order_id);



    $biling_details = json_decode($details['order_details'], true);

    $product_details =  $this->order_details->get_order_product_data($order_id);

    ob_start();

    ?>

    <section class="body user-select-text focusable" tabindex="-1" style="min-height: 1970px;">

     <div class="mail-detail-content noI18n colorQuoted" style="min-height: 1970px;">

      <div id="ox-a15edad751">

       <table width="80%" style="padding: 10px; margin: auto;">

         <tbody>

          <tr>



          </tr>

          <tr>

           <td style="font-size: 30px; text-align: center; margin-bottom: 10px;"> Any Season Gift</td>

         </tr>

       </tbody>

     </table>

     <table width="80%" style="padding: 10px; margin: 15px auto;">

       <tbody>

        <tr>

         <td colspan="2" align="center" style="font-size: 20px;"><strong>My Order Details</strong></td>

       </tr>

     </tbody>

   </table>

   <table width="80%" style="border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 13px; margin: auto;" border="1" cellspacing="0" cellpadding="0">

     <tbody>

      <tr style="background: #f85438; padding: 10px; height: 40px; color: #fff; font-size: 18px;">

        <td colspan="4" align="center" style="padding: 0px;"><strong>Billing Information</strong></td>

      </tr>

      <tr>
        <td colspan="3" style="padding: 5px;"><strong>Delivery Options:</strong> <?php echo isset($biling_details['delivery_options'])?$biling_details['delivery_options']:'' ?> </td>

      </tr>

      <tr>

       <td style="padding: 5px;"><strong>First Name:</strong> <?php echo isset($biling_details['bill_first_name'])?$biling_details['bill_first_name']:'' ?> </td>

       <td style="padding: 5px;"><strong>Last Name:</strong> <?php echo isset($biling_details['bill_last_name'])?$biling_details['bill_last_name']:'' ?></td>

       <td style="padding: 5px;"><strong>E-mail Address:</strong> <?php echo isset($biling_details['bill_email'])?$biling_details['bill_email']:'' ?> </td>

       <td style="padding: 5px;"><strong>Address:</strong> <?php echo isset($biling_details['bill_address'])?$biling_details['bill_address']:'' ?> </td>

     </tr>

     <tr>

       <td style="padding: 5px;"><strong>Town/City:</strong> <?php echo isset($biling_details['bill_city'])?$biling_details['bill_city']:'' ?> </td>

       <td style="padding: 5px;"><strong>State/Country:</strong> <?php echo isset($biling_details['bill_state'])?$biling_details['bill_state']:'' ?></td>

       <td style="padding: 5px;"><strong>Zipcode:</strong> <?php echo isset($biling_details['bill_zipcode'])?$biling_details['bill_zipcode']:'' ?> </td>

       <td style="padding: 5px;"><strong>Phone:</strong> <?php echo isset($biling_details['bill_phone'])?$biling_details['bill_phone']:'' ?> </td>

     </tr>



   </tbody>

 </table>





 <table width="80%" style="border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 13px; margin: auto;" border="1" cellspacing="0" cellpadding="0">

   <tbody>

    <tr style="background: #f85438; padding: 10px; height: 40px; color: #fff; font-size: 18px;">

     <td colspan="4" align="center" style="padding: 0px;"><strong>Shipping Information</strong></td>

   </tr>

   <tr>

     <td style="padding: 5px;"><strong>First Name:</strong> <?php echo isset($biling_details['ship_first_name'])?$biling_details['ship_first_name']:'' ?> </td>

     <td style="padding: 5px;"><strong>Last Name:</strong> <?php echo isset($biling_details['ship_last_name'])?$biling_details['ship_last_name']:'' ?></td>

     <td style="padding: 5px;"><strong>E-mail Address:</strong> <?php echo isset($biling_details['ship_email'])?$biling_details['ship_email']:'' ?> </td>

     <td style="padding: 5px;"><strong>Address:</strong> <?php echo isset($biling_details['ship_address'])?$biling_details['ship_address']:'' ?> </td>

   </tr>

   <tr>

     <td style="padding: 5px;"><strong>Town/City:</strong> <?php echo isset($biling_details['ship_city'])?$biling_details['ship_city']:'' ?> </td>

     <td style="padding: 5px;"><strong>State/Country:</strong> <?php echo isset($biling_details['ship_state'])?$biling_details['ship_state']:'' ?></td>

     <td style="padding: 5px;"><strong>Zipcode:</strong> <?php echo isset($biling_details['ship_zipcode'])?$biling_details['ship_zipcode']:'' ?> </td>

     <td style="padding: 5px;"><strong>Phone:</strong> <?php echo isset($biling_details['ship_phone'])?$biling_details['ship_phone']:'' ?> </td>

   </tr>



 </tbody>

</table>



<table width="80%" style="border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 13px; margin: 10px auto;" border="1" cellspacing="0" cellpadding="0">

 <tbody>

  <tr style="background: #f85438; padding: 10px; height: 40px; color: #fff; font-size: 18px;">

   <td colspan="4" align="center" style="padding: 0px;"><strong>Your Order</strong></td>

 </tr>

 <tr>

  <th>Product Name</th>

  <th>Quantity</th>

  <th>Price</th>

  <th>Subtotal</th>

</tr>

<?php

foreach($product_details as $product_detail){

  ?>

  <tr>

   <td style="padding: 5px;"><?php echo $product_detail['product_name'] ?> </td>

   <td style="padding: 5px;"><?php echo $product_detail['quantity'] ?> </td>

   <td style="padding: 5px;"><?php echo $product_detail['offer_price'] ?> </td>

   <td style="padding: 5px;"><?php echo ($product_detail['offer_price']*$product_detail['quantity']) ?> </td>

 </tr>

 <?php

}

?>
<tr>
  <td colspan="3">Shipping Charges</td>
  <td><?php echo isset($details['shipping_charge'])?$details['shipping_charge']:0 ?></td>
</tr>
<tr>
  <td colspan="3">Sales Tax</td>
  <td><?php echo isset($details['tax'])?$details['tax']:0 ?></td>
</tr>
<tr>
  <td colspan="3">Total</td>
  <td><?php echo ($details['tax']+$details['shipping_charge']+$details['order_amount']) ?></td>
</tr>


</tbody>

</table>





</div>

</div>

</section>

<?php

$php_output = ob_get_contents();

ob_end_clean();
return $php_output;

}

}

