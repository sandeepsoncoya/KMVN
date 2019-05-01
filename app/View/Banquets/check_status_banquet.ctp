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
$data   .=  '</td><td align="right"><h4 style="font-size:15px;margin:0; line-height:0.8;">'.$banquetBook['Banquets']['title'].'</h4></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr>';
$data   .=  '<tr><td align="left"><p style="font-size:10px;margin:0;"><b>Invoice:</b> '.$banquetBook['BanquetBookings']['tracking_id'].'</p><p style="font-size:10px;margin:0;"><b>Date:</b> '.date('F d, Y',strtotime($banquetBook['BanquetBookings']['trans_date'])).'</p><p style="font-size:10px;margin:0;"><b>Booking Id:</b> '.$banquetBook['BanquetBookings']['booking_id'].'</p></td><td></td></tr>';
$data   .=  '<tr><td colspan="2" height="20px" style="line-height:0;"></td></tr><tr><td style="padding:0;" align="left"><h4 style="font-size:14px;margin:0;">Customer Information:</h4></td><td align="right" style="padding:0;"><h4 style="font-size:14px;margin:0">Payment Details:</h4></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td align="left"><p style="font-size:10px;margin:0 0 5px 0;"><b>Name:</b> '. $banquetBook['Banquets']['title'] .'</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Phone No:</b> '. $banquetBook['BanquetBookings']['phone'] .'</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Email Id:</b> '. $banquetBook['BanquetBookings']['email'] .'</p><p style="font-size:10px;margin:0 0 5px 0;"></td><td align="right"><p style="font-size:10px;margin:0 0 5px 0;"><b>Rate Per Day:</b> Rs. '. $banquetBook['Banquets']['per_day_price'] .'/-</p><p style="font-size:10px;margin:0 0 5px 0;"><b>Payment Mode:</b> '. $banquetBook['BanquetBookings']['payment_mode'] .'</p></td></tr>';

$data 	.='<tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td colspan="2"><table cellpadding="5" cellspacing="0" border="0" width="550px" style="font-size:12px">';

$data   .=  '<thead><tr><th width="100px" align="left" bgcolor="#3a3a3a"><font color="#ffffff">Sr No</font></th><th align="left" bgcolor="#3a3a3a"><font color="#ffffff">Banquet Title</font></th><th bgcolor="#3a3a3a"><font color="#ffffff">Number Of Day</font></th><th align="right" bgcolor="#3a3a3a"><font color="#ffffff">Amount</font></th><th align="right" bgcolor="#3a3a3a"><font color="#ffffff">Total</font></th></tr></thead><tbody>';

$sub_tot_day = $banquetBook['BanquetBookings']['number_of_day'] * $banquetBook['Banquets']['per_day_price'];

$data   .=  '<tr><td>1</td><td><p style="line-height:1">'. $banquetBook['Banquets']['title'] .'</p></td><td>'. $banquetBook['BanquetBookings']['number_of_day'] .'</td><td>'. $banquetBook['Banquets']['per_day_price'] .'</td><td align="right"><p style="font-size:10px;margin:0;">Rs. '. $sub_tot_day .'</p></td></tr>';


$tax = $sub_tot_day * $banquetBook['Banquets']['tax']/100; 


$data 	.= '<tr><td colspan="4" align="right"><p style="font-size:10px;margin:0;">Sub Total</p></td><td align="right"><p style="font-size:10px; margin:0;">Rs. '.$sub_tot_day.'</p></td></tr><tr><td colspan="4" align="right"><p style="font-size:10px;margin:0;">Tax '. $banquetBook['Banquets']['tax'] .'%</p></td><td align="right"><p style="font-size:10px; margin:0;">Rs. '. $tax . '</p></td></tr></tbody>';



$data   .=  '<tfoot><tr><td  bgcolor="#3a3a3a" align="right" colspan="4"><span style="font-size:10px;margin:0;"><font color="#ffffff"><b>Grand Total</b></font></span></td><td bgcolor="#3a3a3a" align="right"><font color="#ffffff"><span style="font-size:10px;margin:0;">Rs. '. $banquetBook['BanquetBookings']['total_price'] .'</span></font></td></tr></tfoot>';

$data   .=  '</table></td></tr><tr><td colspan="2" height="10px" style="line-height:0;"></td></tr><tr><td align="middle" colspan="2"><p style="font-size:10px;margin:0; text-align:center;">If you have any questions about this invoice please contact +919876543210</p></td></tr></tbody></table></td></tr></tbody></table>';

$html=$data;
//echo $html;exit;
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
$invoice_num = $banquetBook['BanquetBookings']['booking_id'].'_invoice';
// set default header data
$this->Pdf->core->SetHeaderData();

// output the HTML content
$this->Pdf->core->writeHTML($html, true, false, true, false, '');
$userInvoice = str_replace(' ', '_', $invoice_num).'_Report_'.date('Y_m_d');

$relativeUrl = Configure::read('RelativeUrl');
$siteUrlfront = Configure::read('siteUrlfront');

$this->Pdf->core->Output($relativeUrl.'banquet_invoices/'.$userInvoice.'.pdf', 'F');

header("Location:" . $siteUrlfront . "banquets/sendBanquetInvoice/" . $userInvoice.'/'.$banquetBook['BanquetBookings']['booking_id']);
exit;
?>
  