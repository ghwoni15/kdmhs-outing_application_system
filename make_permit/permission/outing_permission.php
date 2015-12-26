<?php
// Include the main TCPDF library (search for installation path).
session_start();
require_once('tcpdf_include.php');

if($_SESSION['GET_PERMIT']!==true) header('Location: ../../403.html');
else{
	include "../../include/auth.php";
	$_SESSION['GET_PERMIT']=false;
	$query = "SELECT m.Grade, m.Class, m.Num, m.Name, DATE_FORMAT(o.begin_time,'%m월 %d일 %H시 %i분'), DATE_FORMAT(o.end_time,'%H시 %i분'), o.note FROM out_apply o LEFT JOIN member m ON o.username = m.User WHERE o.id = ".$_GET['no'].";";
	$rs=mysqli_query($link, $query);
	if($rs===false){
		$errno=mysqli_errno($link);
		$errmsg = mysqli_error($link);
		die("</div>\n<script>location.href='../../error.php?errno=$errno&errmsg=$errmsg';</script>\n");
	}

	$rows=mysqli_num_rows($rs);
	if($rows !== 0) {
		$n = 0;
		while ($row = mysqli_fetch_array($rs, MYSQL_ASSOC)) {
			if ($n === 0) {
				foreach ($row as $key => $val)
					$table['fields'][$n++] = $key;
			}

			$table['records'][$n++] = $row;
		}
	}else header('Location: ../../403.html');

	mysqli_free_result($rs);
	mysqli_close($link);

	$result='';
	if(count($table['records']) === 1) {
		foreach($table['records'] as $row) {
			foreach($row as $field)
				$result.=$field."/";
		}
	}else header('Location: ../../404.html');

	list($grade, $class, $number, $name, $startTime, $endTime, $reason) = explode("/", $result);
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Korea Digital Media Highschool');
$pdf->SetTitle('한국디지털미디어고등학교 외출신청시스템');
$pdf->SetSubject('외출허가증[학생용]');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'No.'.$_GET['no']);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/kor.php')) {
	require_once(dirname(__FILE__).'/lang/kor.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('kopubdotumb', '', 5);

// add a page
$pdf->AddPage('P', array(80,100));


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

IMPORTANT:
If you are printing user-generated content, tcpdf tag can be unsafe.
You can disable this tag by setting to false the K_TCPDF_CALLS_IN_HTML
constant on TCPDF configuration file.

For security reasons, the parameters for the 'params' attribute of TCPDF
tag must be prepared as an array and encoded with the
serializeTCPDFtagParameters() method (see the example below).

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


$html = '<small style="font-size:30px; text-align:center;">외출허가증<small style="font-size:12px;"> (학생보관용)</small></small>
<h4 style="font-size:18px;text-align:justify;"><strong style="font-size:13px;">학생정보</strong> :<br/>'.$grade.'학년 '.$class.'반 '.$number.'번 '.$name.'</h4>
<h4 style="font-size:18px;text-align:justify;"><strong style="font-size:13px;">허가시간</strong> :<br/>'.$startTime.' ~ '.$endTime.'</h4>
<h4 style="font-size:18px;text-align:justify;"><strong style="font-size:13px;">외출사유</strong> :<br/>'.$reason.'</h4>
<hr/><small style="font-size:12px;text-align:center;">위와 같은 사유로 인하여 해당 학생의 외출을 허가합니다.</small>
<h2 style="font-size:18px;text-align:justify;margin-left:15px;">'.$grade.'학년 학년부장 : [직인생략]<br/>담임교사 : [직인생략]</h2><br/><hr/><br />
<h4 style="font-size:13px;text-align:center;margin-top:10px;">본 외출증은 외출 종료시까지 반드시 소지하고 있어야 하며, <br/>외출 시간 이후 그 효력은 소멸됨을 알려드립니다.</h4>';

$params = $pdf->serializeTCPDFtagParameters(array($_GET['no'], 'C39', '', '', 70, 8, 0.2, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'robotob_0', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
$html .= '&nbsp;<tcpdf method="write1DBarcode" params="'.$params.'" /><small style="font-size:11px;text-align:center;">:: 부정방지 바코드 ::</small>';

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0,'');

$pdf->AddPage('P', array(80,92));

$html = '<small style="font-size:30px; text-align:center;">외출허가증<small style="font-size:12px;"> (감독교사보관용)</small></small>
<h4 style="font-size:18px;text-align:justify;"><strong style="font-size:13px;">학생정보</strong> :<br/>'.$grade.'학년 '.$class.'반 '.$number.'번 '.$name.'</h4>
<h4 style="font-size:18px;text-align:justify;"><strong style="font-size:13px;">허가시간</strong> :<br/>'.$startTime.' ~ '.$endTime.'</h4>
<h4 style="font-size:18px;text-align:justify;"><strong style="font-size:13px;">외출사유</strong> :<br/>'.$reason.'</h4>
<hr/><small style="font-size:12px;text-align:center;">위와 같은 사유로 인하여 해당 학생의 외출을 허가합니다.</small>
<h2 style="font-size:18px;text-align:justify;margin-left:15px;">'.$grade.'학년 학년부장 : [직인생략]<br/>담임교사 : [직인생략]</h2><br/><hr/><br />';

$params = $pdf->serializeTCPDFtagParameters(array($_GET['no'], 'C39', '', '', 70, 8, 0.2, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'robotob_0', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
$html .= '&nbsp;<tcpdf method="write1DBarcode" params="'.$params.'" /><small style="font-size:11px;text-align:center;">:: 부정방지 바코드 ::</small>';

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
//$pdf->lastPage();

// ---------------------------------------------------------
$js = <<<EOD
app.alert('프린트시 기본설정에서 인쇄용지 사이즈를 60*70(mm)로 기본 설정 후 인쇄해주십시오. 미준수시 용지의 낭비가 발생할 수 있습니다.', 3, 0, ' ');
EOD;

// force print dialog
$js .= 'print(true);';
// set javascript
$pdf->IncludeJS($js);

//Close and output PDF document
$pdf->Output('DIMIGO_OUTING_PERMISSION_'.$_GET['no'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
