<?php
class Radio extends CI_Model {

	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	function get_radio_zenders() {
		$query = $this -> db -> get('zenders');
		$results = array();
		foreach ($query->result() as $row) {
			array_push($results, array($row -> naam, $row -> url));
		}
		return $results;
	}

	function insert_radio_zender($naam, $url) {
		$data = array('naam' => $naam, 'url' => $url);

		$this -> db -> insert('zenders', $data);
	}

	function delete_radio_zender($naam) {
		$this -> db -> delete('zenders', array('naam' => $naam));
	}

}
?>