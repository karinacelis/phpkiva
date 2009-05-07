<?php
require 'ApiConnector.php';
interface Partners{
	/**
	 * 
	 * @param $params Array of optional parameters : 'page' [since there is one parameter, a string having it also works]
	 * @return List of partners
	 */
	public function getPartners($params);
	const baseUrl = 'http://api.kivaws.org/v1/partners';
}

class KivaPartner extends ApiConnector implements Partners {
	
	/**
	 * Just constructor
	 * @param string $returntype the response format(xml{default},json,html) from Kiva
	 * @return null
	 */
	function __construct($returntype='xml') {
		$this->returntype = $returntype;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Partners#getPartners()
	 */
	public function getPartners($params){
		$request = Partners::baseUrl . $this->getReturnType();
		$response = $this->getResponse($request,$params);
		return $response;
	}
} 
?>