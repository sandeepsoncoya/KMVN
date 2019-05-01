<?php
   // set document information
   $this->Pdf->core->SetCreator(PDF_CREATOR);
   $this->Pdf->core->SetAuthor('Autoringen');
   $this->Pdf->core->SetTitle('Ownership');
   
   // remove default header/footer
   $this->Pdf->core->setPrintHeader(false);
   $this->Pdf->core->setPrintFooter(false);
   
   
   $this->Pdf->core->addPage('', 'USLETTER');
   //$this->Pdf->core->setFont('helvetica', '', 8);
   $this->Pdf->core->setCellHeightRatio(0.7);
   //pr($HotelData);
   $check_in_date =  date('d-m-Y',strtotime($HotelData['userInputData']['check_in']));
   $check_out_date =  date('d-m-Y',strtotime($HotelData['userInputData']['check_out']));
   $email = $HotelData['travellersDetails']['email_id'];
   $date1 = new DateTime($check_in_date);
   $date2 = new DateTime($check_out_date);
   $numberOfNights= $date2->diff($date1)->format("%a"); 
   $data   =   '<table cellpadding="0" cellspacing="0" border="0"><tbody>';
   $data   .=  '<tr><td align="center">';
   $data   .=  '<table bgcolor="#ffffff" cellspacing="0" cellpadding="0" border="0" width="550px"><tbody><tr><td align="left">';
   $data   .=  '<img src="'.$logo.'" width="150" height="55" alt="KMVN Logo" />';
   $data   .=  '</td><td align="right"><h4 style="font-size:20px;margin:0;">'.$hotel_name.'</h4><p style="font-size:12px;color:#6a6a6a;margin:8px 0 0 0;"></p></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr>';
   $data   .=  '<tr><td align="left"><p style="font-size:10px;margin:0;"><b>Booking Id:</b> '.$order_id.'</p><p style="font-size:10px;margin:0;"><b>Date:</b> '.$trans_date.'</p></td><td></td></tr>';
   $data   .=  '<tr><td colspan="2" height="20px" style="line-height:0;"></td></tr><tr><td style="padding:0;" align="left"><h4 style="font-size:14px;margin:0;">Customer Information:</h4></td><td align="right" style="padding:0;"><h4 style="font-size:14px;margin:0">Payment Details:</h4></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td align="left"><p style="font-size:10px;margin:0 0 5px 0;"><b>Name:</b> '.$delivery_name.'</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Phone No:</b>'.$delivery_tel.'</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Email Id:</b> '.$email.'</p></td><td align="right"><p style="font-size:10px;margin:0 0 5px 0;"><b>Payment Mode:</b> '.$payment_mode.'</p></td></tr><tr><td colspan="2" height="20px" style="line-height:0;"></td></tr><tr><td align="left" colspan="2"><h4 style="font-size:12px;margin:0 0 5px 0;">Stay Details:</h4></td></tr><tr><td align="left" height="10px" colspan="2"></td></tr>';
   $data   .=  '<tr><td align="left"><p style="font-size:10px;margin:0 0 5px 0;"><b>Arrival Date:</b>'.$check_in_date.'</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Departure Date:</b> '.$check_out_date.'</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Total No. of Days:</b> '.$numberOfNights.'</p></td><td align="right" valign="top"></td></tr>';
   
   $data   .=  '<tr><td colspan="2" height="10px" style="line-height:0;"></td></tr>';
   if(!empty($HotelData['RoomSelected'])):
   $subTotal = 0;
   $serverTaxTtl = 0;
   $serviceTtl = 0 ;
   $gTtl = 0;
   $ttls = 0;
   foreach($HotelData['RoomSelected'] as $datas):
      $roomTitle =  ucwords($datas['room_type']).' ( '.$datas['bed_type_title'].' )';
      $adult =  $datas['adult'];
      $no_of_rooms =  $datas['no_of_rooms'];
      $child =  $datas['child'];
      $extraBed =  isset($datas['extraBed']) ? $datas['extraBed'] : 0;
      $extraBedCharge =  isset($datas['extraBedCharge']) ? $datas['extraBedCharge'] : 0;
      $totalExtraBedChnage =  isset($datas['totalExtraBedChnage']) ? $datas['totalExtraBedChnage'] : 0;
      $roomRate = $datas['RoomRates']['RoomRates']['adult_one_rate'];
      $roomTax = $datas['RoomRates']['RoomRates']['tax'];
      $roomTaxAmount = ($roomRate/100)*$roomTax;
      $roomTaxAmount =  $roomTaxAmount * $no_of_rooms;
      $totalRoomAmount = $roomRate * $numberOfNights * $no_of_rooms ;  
      $totalTaxAmount = $roomTaxAmount * $numberOfNights ; 
     
   $data .= '<tr><td colspan="2" align="left"><table cellpadding="0" cellspacing="0" border="0" width="550px" style="font-size:12px">
       <thead>
         <tr><th align="left" bgcolor="#3a3a3a" height="5"></th></tr>
         <tr><th align="left" bgcolor="#3a3a3a"><font color="#ffffff">&nbsp;&nbsp;'.$roomTitle.'</font></th></tr>
         <tr><th align="left" bgcolor="#3a3a3a" height="5"></th></tr>
       </thead>
       <tbody>
         <tr>
           <td>
             <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:10px">
               <tbody>
                   <tr><td height="5" colspan="3"></td></tr>
                   <tr><td align="left"><b>Adult:</b>'.$adult.'</td><td align="center"><b>Child:</b>'.$child.'</td>';
                   if($extraBed  == 1):
                       $data .='<td align="right"><b>Extra Bed:</b>Yes</td>';
                   endif;
                   $data .='</tr>
                   <tr><td height="5" colspan="3"></td></tr>
               </tbody>
             </table>
           </td>
         </tr>
         <tr>
           <td>
             <table
               width="540px" cellpadding="5" cellspacing="0" border="0" style="font-size:10px;" >
               <tbody>
               <tr><td style="border-bottom:1px solid #f6f6f6;" align="left">Particular</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Rate</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Days</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Rooms</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Amount</td>
               </tr>';
               $data .='<tr>
                   <td align="left">Room</td>
                   <td align="right">'.$roomRate.'</td>
                   <td align="right">'.$numberOfNights.'</td>
                   <td align="right">'.$no_of_rooms.'</td>
                   <td align="right">'.$totalRoomAmount.'</td>
                 </tr>';
               if($extraBed == 1){
                   $data .='<tr>
                   <td align="left">Extra Bed</td>
                   <td align="right">'.$extraBedCharge.'</td>
                   <td align="right">'.$numberOfNights.'</td>
                   <td align="right">'.$no_of_rooms.'</td>
                   <td align="right">'.$totalExtraBedChnage.'</td>
                   </tr>';
               }
               
               $ttl =  $totalExtraBedChnage + $serviceTtl +  $totalRoomAmount  + $serverTaxTtl +$totalTaxAmount;
               
               $gTtl = $gTtl+  $ttl;
               $data .='<tr>
                   <td align="left" colspan="4">Tax (Room '.$roomTax.'%)</td>
                   <td align="right">'.$totalTaxAmount.'</td>
                 </tr>
               </tbody>
               <tfoot>
                 <tr>
                   <td
                     style="border-top:1px solid #f6f6f6;"
                     colspan="5"
                     align="right">
                     <font color="#000000"
                       ><b>Subtotal</b> '.$ttl.'</font>
                   </td>
                 </tr>
               </tfoot>
             </table>
           </td>
         </tr>
       </tbody>
     </table>
   </td>
   </tr>';
   endforeach;
   endif; 
   
   
   $gTtls = 0;
   if(!empty($HotelData['userServices'])):
   $data .= '<tr><td colspan="2" align="left"><table cellpadding="0" cellspacing="0" border="0" width="550px" style="font-size:12px">
       <thead>
         <tr><th align="left" bgcolor="#3a3a3a" height="5"></th></tr>
         <tr><th align="left" bgcolor="#3a3a3a"><font color="#ffffff">&nbsp;&nbsp;Services</font></th></tr>
         <tr><th align="left" bgcolor="#3a3a3a" height="5"></th></tr>
       </thead>
       <tbody>
       
         <tr>
           <td>
             <table
               width="540px" cellpadding="5" cellspacing="0" border="0" style="font-size:10px;" >
               <tbody>
               <tr><td style="border-bottom:1px solid #f6f6f6;" align="left">Service Name</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Rate</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Tax</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Qty</td>
                   <td style="border-bottom:1px solid #f6f6f6;" align="right">Amount</td>
               </tr>';
   
   
   foreach($HotelData['userServices'] as $service):
       $serviceName =  ucwords($service['Services']['title']);
                       $servicePrice =  $service['Services']['price'];
                       $total_price =  $service['Services']['total_price'];
                       $serviceTax =    $service['Services']['tax'];
                       $qty =    $service['Services']['qty'];
                       $serviceTotal =  number_format(($servicePrice+$serviceTax)*$numberOfNights*$qty);
   
               $data .='<tr>
                   <td align="left">'.$serviceName.'</td>
                   <td align="right">'.$servicePrice.'</td>
                   <td align="right">'.$serviceTax.'</td>
                   <td align="right">'.$qty.'</td>
                   <td align="right">'.$serviceTotal.'</td>
                 </tr>';
    
               
               $ttls += (int) $serviceTotal;
             
               endforeach;
                 $data .= '
                 <tr>
                   <td
                     style="border-top:1px solid #f6f6f6;"
                     colspan="5"
                     align="right"
                   >
                     <font color="#000000"
                       ><b>Subtotal</b> '.$ttls.'</font
                     >
                   </td>
                 </tr>
               ';
               endif;
             $gtp =   $ttls + $gTtl;
   
   
   $data .='<tr>
                     <td colspan="5" align="right">
                       <p style="font-size:14px;margin:0;">
                         <font color="#000000"><b>Grand Total</b> Rs. '.$gtp.'</font>
                       </p>
                     </td>
                   </tr>';
   
   $data   .=  '<tr><td colspan="5" height="20px" style="line-height:0;"></td></tr><tr><td align="middle" colspan="2"><p style="font-size:10px;margin:0; text-align:center;">If you have any questions about this invoice please contact '.$sitephone.'</p></td></tr></tbody></table></td></tr></tbody></table>';
             '</table>
           </td>
         </tr>
       </tbody>
     </table>
   </td>
   </tr>';

   $data .= ' </td>
   </tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';
    
   
   $html=$data;
   function sanitize_output($html) {
   
       $search = array(
           '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
           '/[^\S ]+\</s',     // strip whitespaces before tags, except space
           '/(\s)+/s',         // shorten multiple whitespace sequences
           '/<!--(.|\s)*?-->/' // Remove HTML comments
       );
   
       $replace = array(
           '>',
           '<',
           '\\1',
           ''
       );
   
       $html = preg_replace($search, $replace, $html);
   
       return $html;
   }
   ob_start('sanitize_output');
   
   //$invoice_num= rand(10000,99999).'_invoice';
   $invoice_num = $order_id.'_invoice';
   // set default header data
   $this->Pdf->core->SetHeaderData();
   
   // output the HTML content
   $this->Pdf->core->writeHTML($html, true, false, true, false, '');
   $userInvoice = str_replace(' ', '_', $invoice_num).'_Report_'.date('Y_m_d');
   
   $relativeUrl = Configure::read('RelativeUrl');
   $siteUrlfront = Configure::read('siteUrlfront');
   
   $this->Pdf->core->Output($relativeUrl.'invoices/'.$userInvoice.'.pdf', 'F');
   
   header("Location:".$siteUrlfront."booking/sendInvoice/".$userInvoice.'/'.$order_id);
   exit;
   ?>