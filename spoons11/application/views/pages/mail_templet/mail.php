<?php 
$session_userdata=$this->session->userdata('user_data');
$session_orderdata=$this->session->userdata('order_data');
$session_cartdata=$this->session->userdata('cart_data');
?>

<div style="width:100%;height:100%;margin:10px auto;padding:0;background-color:#ffffff;font-family:Arial,Tahoma,Verdana,sans-serif;font-weight:299px;font-size:13px;text-align:center" bgcolor="#ffffff">
   <table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px"> 
    <tbody>
      <tr> 
        <td valign="middle" align="left" height="50" style="height:60px;background-color:#cd0c27;padding:0;margin:0;color: #fff">
            <a style="margin-left: 10px; text-decoration:none;outline:none;color:#ffffff;font-size:13px;font-size: 26px;font-weight: 600;font-family: serif;" href="" target="_blank">
                <img src="<?php echo base_url() ?>assets/images/logo.png">
            </a>
            <span >Mobile : <?php echo $session_userdata[0]['mobile']; ?>, Email: <?php echo $session_userdata[0]['email']; ?></span>
        </td>            
    </tr> 
</tbody>
</table> 

<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>
        <tr>
            <td align="left" valign="top" style="color:#2c2c2c;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f9f9f9;padding:20px" bgcolor="#F9F9F9">
                <p style="padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px"> Hi <?php if (!empty($session_userdata[0]['name'])) {
                    echo $session_userdata[0]['name'].",";
                }else{
                    echo "Customer,";
                } ?> </p><br> 
                <p style="padding:0;margin:0;color:#565656;font-size:13px"> Your order has been successfully placed!</p><br>
                <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> Delivery is on track and we will keep you updated as your order is being packed,shipped and delivered. Meanwhile, you can check the status of your order on  
                    <a alt="" style="text-decoration:none" href="" target="_blank" >
                        <span style="color:#666;font-size:13px"><span class="il">www.spoons11</span>.com</span>
                    </a>
                </p>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>
        <tr>
            <td align="left" valign="top" style="background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:20px 20px 0 20px" bgcolor="">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin:0">
                    <tbody>
                        <tr>
                            <td colspan="4" width="100%" align="left" valign="top">
                                <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px">
                                    Please find below, the summary of your order number
                                    <a style="text-decoration:underline" href="" target="_blank">
                                        <span style="color:#565656;font-size:13px"><?php echo $session_orderdata['order_no'] ?></span>
                                    </a>
                                </p><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="left" valign="top">
                                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td valign="middle" align="left" rowspan="2" style="white-space:nowrap;padding-right:5px;font-size:13px">Products</td>
                                            <td valign="middle" align="left" style="border-bottom:solid 2px #565656;width:90%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td valign="middle" align="left">&nbsp;
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>   
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>


        <tr>
            <td valign="top" align="center" width="250" style="background-color:#ffffff">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6;">
                    <tbody>
                        <tr>

                            <td width="60%" align="" valign="top" style="padding:12px 15px 0 10px;margin:0;vertical-align:top;min-width:100px">

                            </td>    
                            
                            <td width="20%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center">
                                <p style="padding:0;margin:0;color:#848484;font-size:12px">Qty</p>
                            </td>
                            <td width="20%" valign="top" align="center" style="padding:12px 20px 0 10px;margin:0;text-align:center">
                                <p style="white-space:nowrap;padding:0;margin:0;color:#848484;font-size:12px">Subtotal </p>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </td>
        </tr> 

        <!-- ------------------------- Product Loop Start Here --------------------------- -->
        <?php foreach ($session_cartdata as $key) { ?>

        <?php
         // $condition="id='".$key['id']."' and  restaurant_id='$restaurant_id' and status=1";
         //    $this->db->select('id,menu_name');
         //    $this->db->from('restaurant_item');
         //    $this->db->where($condition);
         //    $result = $this->db->get()->result_array();
         //    $menu=$this->db->select('*')->from('menu')->where('id',$result[0]['menu_name'])->where('status',1)->get()->result_array();

        $menu_id= $this->db->from('restaurant_item')->where('id',$key['id'])->where('restaurant_id',$key['name'])->where('status',1)->get()->result_array();
        $menu=$sql = $this->db->select('*')->from('menu')->where('id',$menu_id[0]['menu_name'])->where('status',1)->get()->result_array();
        ?>

        <tr>
            <td valign="top" align="center" width="250" style="background-color:#ffffff">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>

                            <td width="60%" align="" valign="top" style="padding:17px 15px 0 10px;margin:0;vertical-align:top;min-width:100px">
                                <p style="padding:0;margin:0">
                                    <a style="text-decoration:none;color:#565656" href="">
                                        <span style="color:#565656;font-size:13px"><?php echo $menu[0]['menu_name'] ?></span>
                                    </a>
                                </p>  
                            </td>    

                            <td width="20%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center">
                                <p style="padding:7px 0 0 0;margin:0;color:#565656;font-size:13px"><?php echo $key['qty'] ?></p>
                            </td>
                            <td width="20%" valign="top" align="center" style="padding:12px 20px 0 10px;margin:0;text-align:center">
                                <p style="white-space:nowrap;padding:7px 0 0 0;margin:0;color:#565656;font-size:13px">&#x20b9;<?php echo $key['subtotal']; ?> </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p style="border-bottom: 1px solid;margin: 10px 20px 8px 34px;"></p>
            </td>
        </tr>
        <?php } ?> 
        <!-- ------------------------- Product Loop End Here --------------------------- -->  
    </tbody>
</table>
<?php 
$order_detail= $this->db->select('*')->from('order_new')->where('order_no',$session_orderdata['order_no'])->get()->result_array();

  // print_r($order_detail);


?>
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>
        <tr>
            <td valign="top" align="center" style="background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:5px 20px 0 20px" bgcolor="#fff">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin:0">
                    <tbody>
                        <tr>
                            <td colspan="4" align="center" valign="top" style="border-bottom:#ccc dashed 1px;padding:0 0 17px 0">  
                                <p style="padding:4px 5px;background-color:#fffed5;border:1px solid #f9e2b2;color:#565656;margin:10px 0 0 0;text-align:center;font-size:12px">  
                                    Will be delivered in <b><?php echo $order_detail[0]['delivery_address'] ?></b> 
                                </p>  
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>   
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>
        <tr>
            <td valign="top" align="right" bgcolor="" style="clear:both;display:block;margin:0 auto;padding:10px 20px 0 20px;background-color:#ffffff">
                <table cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>


                            <td valign="top" align="right" style="border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9">  
                                <p style="padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:21px">  
                                    Billed Amount <span style="font-size:21px">&#x20b9;<?php echo $this->session->userdata('item_ammount') ?> &nbsp;</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="right" style="border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9">  
                                <p style="padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:21px">  
                                 GST Ammount <span style="font-size:21px">&#x20b9;<?php echo $this->session->userdata('gst_ammount') ?> &nbsp;</span>
                             </p>
                         </td>
                     </tr>
                     <?php if (!empty($this->session->userdata('discount_amount'))) { ?>
                     <tr>
                        <td valign="top" align="right" style="border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9">  
                            <p style="padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:21px">  
                             Coupon Discounts <span style="font-size:21px">&#x20b9;<?php echo $this->session->userdata('discount_amount') ?> &nbsp;</span>
                         </p>
                     </td>
                 </tr>
                 <?php } ?>
                 <tr>
                    <td valign="top" align="right" style="border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9">  
                        <p style="padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:21px">  
                            Delivery Charges <span style="font-size:21px">&#x20b9;<?php echo $this->session->userdata('delivery_charges') ?> &nbsp;</span>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td valign="top" align="right" style="border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9">  
                        <p style="padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:21px">  
                            Total <span style="font-size:21px">&#x20b9;<?php echo $this->session->userdata('total_amount') ?> &nbsp;</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
</tbody>
</table> 
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>
        <tr>
            <td valign="top" align="left" style="background-color:#ffffff;color:#565656;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;padding:20px 20px 0 20px" bgcolor="#ffffff">
                <p style="line-height:22px;padding:0 0 20px 0;margin:0;color:#565656;border-bottom:#e6e6e6 solid 1px;font-size:13px">  
                    Outstanding Amount Payable on Delivery: <strong> &#x20b9;<?php echo $this->session->userdata('total_amount') ?> </strong>
                </p>  
            </td>
        </tr>
    </tbody>
</table>    
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
    <tbody>
        <tr>
            <td valign="top" align="left" style="background-color:#ffffff;color:#565656;display:block;font-weight:300;margin:0;padding:0;clear:both" bgcolor="#ffffff">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td valign="top" align="left" style="padding:20px 20px 0 20px;margin:0">
                                <p style="margin:0;padding:0;color:#565656;font-size:13px">  
                                    DELIVERY ADDRESS  
                                </p>
                                <p style="padding:0;margin:15px 0 10px 0;font-size:18px;color:#333333">  
                                    <?php echo $session_userdata[0]['name']." ".$orderData->ship_lname." (".$order_detail[0]['delivery_address'].")"; ?> 
                                </p>



                                <p style="line-height:18px;padding:0;margin:0;color:#565656;font-size:13px">
                                    <?php if(!empty($orderData->ship_flat)){ echo $orderData->ship_flat.", "; } if(!empty($orderData->ship_flor)){ echo $orderData->ship_flor." Floor, "; } if(!empty($orderData->ship_house_no)){ echo $orderData->ship_house_no." "; } if(!empty($orderData->ship_streetno)){ echo ",".$orderData->ship_streetno." "; }if(!empty($orderData->ship_block)){ echo ",".$orderData->ship_block.", "; } if(!empty($orderData->ship_sectorno)){ echo $orderData->ship_sectorno; }?>
                                    <br>
                                    <?php if(!empty($orderData->ship_landmark)){ echo "Lankmark ".$orderData->ship_landmark.", "; }?> 
                                    <br><?php if(!empty($orderData->ship_city)){ echo $orderData->ship_city; } if(!empty($orderData->ship_area)){ echo ", ".$orderData->ship_area; } if(!empty($orderData->ship_state)){ echo ", ".$orderData->ship_state; }?></p>
                                    <br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>  
    <table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border:solid 1px #e6e6e6;border-top:none">
        <tbody>
            <tr>
                <td valign="top" align="center" style="text-align:center;background-color:#ececeb;display:block;margin:0 auto;clear:both;padding:15px 40px" bgcolor="#F9F9F9">
                    <p style="padding:0;margin:0 0 7px 0">
                        <a style="text-decoration:none;color:#565656" href="">
                            <span style="color:#565656;font-size:13px">
                                <span class="il">Spoon11</span>.in
                            </span>
                        </a>
                    </p>
                    <p style="padding:10px 0 0 0;margin:0;border-top:solid 1px #cccccc;font-size:11px;color:#565656">  
                        © 2017 -2018 Spoon11 ALL RIGHTS RESERVED.  
                    </p>
                </td>
            </tr>
        </tbody>
    </table> 
</div> 