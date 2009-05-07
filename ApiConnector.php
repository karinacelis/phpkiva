<?php
abstract class ApiConnector{

	/**
	 * Getter function for returntype
	 * @return string $returntype the response format
	 */
	public function getReturnType(){
		return $this->returntype;
	}

	/**
	 * Setter function for returntype
	 * @param $returntype the response format
	 * @return null
	 */
	public function setReturnType($returntype){
		if($returntype ==="html" || $returntype ==="xml" || $returntype==="json"){
			$this->returntype = $returntype;
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 *
	 * @param string $request the request uri
	 * @param $params
	 * @return string $response the response from Kiva
	 */
	public function getResponse($request,$params){
		if (isset($params) && count($params) != 0){
			$request = $request . '?';
			$queryString = $this->buildQueryString($params);
			
			$request = $request . $queryString;
		}
		$response = $this->fetchRequest($request);
		return $response;
	}

	private function buildQueryString($params){
		if(is_array($params)){
			$arr = array(); 
			foreach ($params as $key => $val){
				if(!is_array($val))
		         	$arr[] = $key . '=' .$val;
		        else
		        	$arr[] = $key . '=' . implode(',',$val);
			}
			return implode('&',$arr);
		}
		else{
			return $params;
		}		
	}
	/**
	 * curl implementation for making the request
	 * @param $request
	 * @return string $response response from Kiva
	 */
	public function fetchRequest($request){
		$response = "";
		$session = curl_init($request);
		if($session === false)
		die("curl_init failed");
		else{
			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($session,CURLOPT_FRESH_CONNECT,true);
			$response = curl_exec($session);
			if($response === false)
			die("Error fetching response");
			curl_close($session);
		}
		return $response;
	}
}
?>