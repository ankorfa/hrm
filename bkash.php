<?php
// include snoopy library
require('Snoopy.class.php');
// initialize snoopy object
$snoopy = new Snoopy;


//4FI282K5L4 another trnsaction id
$USER = 'PRIDELIMITED';
$PASS = 'pR!d31imIt3d';
$MSISDN = '01990409336'; //Farwah Apu's Merchant Bkash No
$TX_ID = '4FI981401Z';

$url = 'https://www.bkashcluster.com:9081/dreamwave/merchant/trxcheck/sendmsg'
        . '?user=' . $USER
        . '&pass=' . $PASS
        . '&msisdn=' . $MSISDN
        . '&trxid=' . $TX_ID;

echo "API LINK: <a href='" . $url . "' target='_blank'>" . $url . "</a>";

$url = "http://t.qq.com";

// read webpage content
$snoopy->fetch($url);
// save it to $lines_string
$lines_string = $snoopy->results;
//output, you can also save it locally on the server
echo "===>>>>> ".$lines_string;
?>