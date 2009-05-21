<?php
require 'ApiConnector.php';
interface JournalEntries{
	/**
	 * @params $id (required) id of the journal entry
	 * @param $params Array of optional parameters : 'page' [since there is one parameter, a string having it also works]
	 * @return comments
	 */
	public function getComments($id,$params=null);
	/**
	 * 
	 * @param $params Array of optional parameters : 'page','partner','q','sort_by','media'
	 * @return Journal Entries
	 */
	public function searchJournalEntries($params=null);
	const baseUrl = 'http://api.kivaws.org/v1/journal_entries/';
}

class KivaJournalEntry extends ApiConnector implements JournalEntries {
	
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
	 * @see JournalEntries#getComments()
	 */
	public function getComments($id,$params=null){
		if ( !isset($id) ){
			$response = "Id not set";
		}
		else{
			$request = JournalEntries::baseUrl . $id . '/comments.' .$this->getReturnType();
			$response = $this->getResponse($request,$params);
		}
		return $response;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see JournalEntries#searchJournalEntries()
	 */
	public function searchJournalEntries($params=null){
		$request = JournalEntries::baseUrl . 'search.' .$this->getReturnType();
		$response = $this->getResponse($request,$params);
		return $response;
	}
} 
?>