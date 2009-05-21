<?php
//sample file to test API functions

/*
require 'JournalEntry.php';
$loanObj = new KivaJournalEntry();
if($loanObj->setReturnType('html')){
	$params = Array("partner" => 23,"page" => 3);
	$response = $loanObj->searchJournalEntries($params);
	echo $response;
}
*/
/*
require 'loan.php';
$loanObj = new KivaLoan();
if($loanObj->setReturnType('html')){;
	$params = Array("page" => 3,"include_bulk" => "true");
	$ids = Array(100,106846);
	$response = $loanObj->getLoansInfo($ids);
	//$response = $loanObj->getLenders(106846);
	//$response = $loanObj->getRecentLoans("page=2");
	//$response = $loanObj->getJournalEntries(100,'page=1');
	//$response = $loanObj->searchLoans($params);
	echo $response;
}
*/
/*
require 'lender.php';
$lenderObj = new KivaLender();
if($lenderObj->setReturnType("html")){
	//$response = $lenderObj->getRecentLenders("page=2");
	$response = $lenderObj->getLenderLoans('torbin6204');
	//$arr = array('torbin6204','matthew65585139');
	//$response = $lenderObj->getLendersInfo($arr);
	echo $response;
}*/
?>