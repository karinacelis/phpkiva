<?php
require 'ApiConnector.php';
interface Lenders{

	/**
	 * 
	 * @param $ids(required) array of ids((upto 10 supported by Kiva Api)) to fetch info for.
	 * @return lenders detail
	 */
	public function getLendersInfo($ids);
	
	/**
	 * 
	 * @param $id(required) The lender ID of a kiva lender 
	 * @param $params Array of optional parameters : 'sort_by','page'
	 * @return loans
	 */
	public function getLenderLoans($id,$params=null);
	
	/**
	 * 
	 * @param $params Array of optional parameters : 'page' [since there is one parameter, a string having it also works]
	 * @return lenders
	 */
	public function getRecentLenders($params=null);
	
	/**
	 * 
	 * @param $params Array of optional parameters : 'page','sort_by','occupation','country_code','q'
	 * @return lenders 
	 */
	public function searchLenders($params=null);
	const baseUrl = 'http://api.kivaws.org/v1/lenders/';
}

class KivaLender extends ApiConnector implements Lenders{
	
	/**
	 * (non-PHPdoc)
	 * @see Lenders#getLendersInfo()
	 */
	public function getLendersInfo($ids){
		if(!isset($ids) || !is_array($ids)){
			$response = 'ids not provided';
		}
		else{
			$request = Lenders::baseUrl . implode(',',$ids) .'.' .$this->getReturnType();
			$response = $this->getResponse($request,null);
		}
		return $response;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Lenders#getLenderLoans()
	 */
	public function getLenderLoans($id,$params=null){
		if ( !isset($id) ){
			$response = "Id not set";
		}
		else{
			$request = Lenders::baseUrl . $id . '/loans.' .$this->getReturnType();
			$response = $this->getResponse($request,$params);
		}
		return $response;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Lenders#getRecentLenders()
	 */
	public function getRecentLenders($params=null){
		$request = Lenders::baseUrl . 'newest.' . $this->getReturnType();
		return $this->getResponse($request,$params);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Lenders#searchLenders()
	 */
	public function searchLenders($params=null){
		$request = Lenders::baseUrl . 'search.' .$this->getReturnType();
		$response = $this->getResponse($request,$params);
		return $response;
	}
}
?>