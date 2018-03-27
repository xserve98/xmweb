<?php
$objSoapClient = new SoapClient("http://ag2.jieshuiwt.com/AGLineService.asmx?WSDL");
$out = $objSoapClient->UserHostIp();
$data = $out->UserHostIpResult;
echo $data;
?>