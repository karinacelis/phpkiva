<?php
require 'ApiConnector.php';
interface Loans{
	/**
	 * 
	 * @param $params Array of optional parameters : 'page' [since there is one parameter, a string having it also works]
	 * @return Recent Loans on Kiva
	 */
	public function getRecentLoans($params=null);
	
	/**
	 * 
	 * @param $ids(required) array of ids((upto 10 supported by Kiva Api)) to fetch info for.
	 * @return Detailed information for loans
	 */
	public function getLoansInfo($ids);
	
	/**
	 * @param $id(required) id of the loan for which lender information is required.
	 * @param $params Array of optional parameters : 'page' [since there is one parameter, a string having it also works]
	 * @return lender information for a loan
	 */
	public function getLenders($id,$params=null);

	/**
	 * 
	 * @param $id(required) The identification number for a loan 
	 * @param $params - Array of optional parameters : 'page','include_bulk'
	 * @return Journal Entries
	 */
	public function getJournalEntries($id,$params=null);

	/**
	 * 
	 * @param $id(required)
	 * @return Returns all status updates for a loan ordered by newest first
	 */
	public function getStatusUpdates($id);

	/**
	 * 
	 * @param $params Array of optional parameters : 'page','status','gender','sector','region','country_code','partner','q'
	 * To provide a list of 'sector','region' construct an array within the main array at these keys
	 * @return loans
	 */
	public function searchLoans($params=null);

	const baseUrl = "http://api.kivaws.org/v1/loans/";
}

class KivaLoan extends ApiConnector implements Loans{

	/**
	 * (non-PHPdoc)
	 * @see Loans#getRecentLoans()
	 *
	 */
	public function getRecentLoans($params=null){
		$request = Loans::baseUrl . 'newest.' . $this->getReturnType();
		return $this->getResponse($request,$params);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Loans#getLoansInfo()
	 */
	public function getLoansInfo($ids){
		if(!isset($ids) || !is_array($ids)){
			$response = 'No Id Array provided';
		}
		else{
			$request = Loans::baseUrl . implode(',',$ids) .'.' .$this->getReturnType();
			$response = $this->getResponse($request,null);
		}
		return $response;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Loans#getLenders()
	 */
	public function getLenders($id,$params=null){
		if ( !isset($id) ){
			$response = "Id not set";
		}
		else{
			$request = Loans::baseUrl . $id . '/lenders.' .$this->getReturnType();
			$response = $this->getResponse($request,$params);
		}
		return $response;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Loans#getJournalEntries()
	 */
	public function getJournalEntries($id,$params=null){
		if ( !isset($id)){
			$response = "Id not set";
		}
		else{
			$request = Loans::baseUrl . $id . '/journal_entries.' . $this->getReturnType();
			$response = $this->getResponse($request,$params);
		}
		return $response;
	}

	/**
	 * (non-PHPdoc)
	 * @see Loans#getStatusUpdates()
	 */
	public function getStatusUpdates($id){
		if ( !isset($id)){
			$response = "Id not set";
		}
		else{
			$request = Loans::baseUrl . $id . '/updates.' . $this->getReturnType();
			$response = $this->getResponse($request,$params);
		}
		return $response;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Loans#searchLoans()
	 */
	public function searchLoans($params=null){
		$request = Loans::baseUrl . 'search.' .$this->getReturnType();
		$response = $this->getResponse($request,$params);
		return $response;
	}
	 
	
}
?>