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



$data   =   '<table cellpadding="0" cellspacing="0" border="0"><tbody>';
$data   .=  '<tr><td align="center">';
$data   .=  '<table bgcolor="#ffffff" cellspacing="0" cellpadding="0" border="0" width="550px"><tbody><tr><td align="left">';
$data   .=  '<img src="'.$logo.'" width="150" height="55" alt="KMVN Logo" />';
$data   .=  '</td><td align="right"><h4 style="font-size:20px;margin:0;">Hotel Name</h4><p style="font-size:12px;color:#6a6a6a;margin:8px 0 0 0;">Hotel Slogan</p></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr>';
$data   .=  '<tr><td align="left"><p style="font-size:10px;margin:0;"><b>Invoice:</b> KMBA2343</p><p style="font-size:10px;margin:0;"><b>Date:</b> April 10, 2019</p><p style="font-size:10px;margin:0;"><b>Customer Id:</b> 20011213</p></td><td></td></tr>';
$data   .=  '<tr><td colspan="2" height="20px" style="line-height:0;"></td></tr><tr><td style="padding:0;" align="left"><h4 style="font-size:14px;margin:0;">Customer Information:</h4></td><td align="right" style="padding:0;"><h4 style="font-size:14px;margin:0">Payment Details:</h4></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td align="left"><p style="font-size:10px;margin:0 0 5px 0;"><b>Name:</b> Lalit Jangir</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Phone No:</b> +91 9352723631</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Email Id:</b> lalit.jangir@soncoya.in</p></td><td align="right"><p style="font-size:10px;margin:0 0 5px 0;"><b>Rate Per Day:</b> Rs. 999/-</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Rate Per Person:</b> Rs. 999/-</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Payment Mode:</b> Credit Card</p></td></tr><tr><td colspan="2" height="20px" style="line-height:0;"></td></tr><tr><td align="left" colspan="2"><h4 style="font-size:12px;margin:0 0 5px 0;">Stay Details:</h4></td></tr><tr><td align="left" height="10px" colspan="2"></td></tr>';
$data   .=  '<tr><td align="left"><p style="font-size:10px;margin:0 0 5px 0;"><b>Arrival Date:</b> April 16, 2019</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Departure Date:</b> April 17, 2019</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Total No. of Days:</b> 01</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Rate per day or room:</b> Rs. 999/-</p></td><td align="right" valign="top"><p style="font-size:10px;margin:0 0 5px 0;"><b>Rate Per Day:</b> Rs. 999/-</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Rate Per Person:</b> Rs. 999/-</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Payment Mode:</b> Credit Card</p></td></tr>';
$data   .=  '<tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td colspan="2"><table cellpadding="5" cellspacing="0" border="0" width="550px" style="font-size:12px"><thead><tr><th width="100px" align="left" bgcolor="#3a3a3a"><font color="#ffffff">Date</font></th><th align="left" bgcolor="#3a3a3a"><font color="#ffffff">Services</font></th><th bgcolor="#3a3a3a"><font color="#ffffff">Quantity</font></th><th align="right" bgcolor="#3a3a3a"><font color="#ffffff">Amount</font></th><th align="right" bgcolor="#3a3a3a"><font color="#ffffff">Total</font></th></tr></thead>';
$data   .=  '<tbody><tr><td></td><td></td><td></td><td></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr><tr><td></td><td></td><td></td><td></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr><tr><td></td><td></td><td></td><td></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr><tr><td></td><td></td><td></td><td></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr><tr><td></td><td></td><td></td><td></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr><tr><td></td><td></td><td></td><td></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr><tr><td colspan="4" align="right"><p style="font-size:10px;margin:0;">Sub Total</p></td><td align="right"><p style="font-size:10px; margin:0;">Rs. 0.00</p></td></tr><tr><td colspan="4" align="right"><p style="font-size:10px;margin:0;">Tax 15%</p></td><td align="right"><p style="font-size:10px; margin:0;">Rs. 0.00</p></td></tr><tr><td colspan="4" align="right"><p style="font-size:10px; margin:0;">Discount 5%</p></td><td align="right"><p style="font-size:10px;margin:0;">Rs. 0.00</p></td></tr></tbody>';
$data   .=  '<tfoot><tr><td  bgcolor="#3a3a3a" align="right" colspan="4"><span style="font-size:10px;margin:0;"><font color="#ffffff"><b>Grand Total</b></font></span></td><td bgcolor="#3a3a3a" align="right"><font color="#ffffff"><span style="font-size:10px;margin:0;">Rs. 0.00</span></font></td></tr></tfoot>';
$data   .=  '</table></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td align="middle" colspan="2"><p style="font-size:10px;margin:0; text-align:center;">If you have any questions about this invoice please contact +919876543210</p></td></tr></tbody></table></td></tr></tbody></table>';

$html=$data;
//echo $html;exit;


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

header("Location:" . $siteUrlfront . "booking/sendInvoice/" . $userInvoice.'/'.$order_id);
exit;
?>
  