<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		$data['zenders'] = $this -> zenders();
		$data['volume'] = $this -> get_volume();
		$data['current'] = $this -> get_current();
		$this -> load -> view('view_dashboard', $data);
	}

	function zenders() {
		$this -> load -> model('Radio');
		$zenders = $this -> Radio -> get_radio_zenders();
		return $zenders;
	}

	function start_radio() {
		$this -> del_radio();
		$url = $this -> input -> post("url");
		$command = escapeshellcmd('mpc add ' . $url);
		exec($command);
		$command = escapeshellcmd('mpc play');
		exec($command);
		$this -> index();
	}

	function del_radio() {
		$command = escapeshellcmd('mpc clear');
		exec($command);
	}

	function change_volume() {
		$volume= $this->input->post('volume');
		$command = escapeshellcmd('mpc volume ' . $volume);
		print_r($command);
		$output = exec($command);
	}

	function get_numerics($str) {
		preg_match_all('/\d+/', $str, $matches);
		return $matches[0];
	}

	function get_volume() {
		$command = escapeshellcmd('mpc volume');
		$output = exec($command);
		$volume = $this -> get_numerics($output);
		return $volume[0];
	}
	
	function get_current() {
		$command = escapeshellcmd('mpc current');
		$output = exec($command);
		return $output;
	}
	
	function play() {
		$command = escapeshellcmd('mpc play');
		$output = exec($command);
	}
	
	function pause() {
		$command = escapeshellcmd('mpc pause');
		$output = exec($command);
	}
	
	function stop() {
		$command = escapeshellcmd('mpc stop');
		$output = exec($command);
	}
	
	function poweroff() {
		$command = escapeshellcmd('sudo /sbin/halt');
		$output = exec($command);
	}
	
	function delete_zender() {
		$this -> load -> model('Radio');
		$naam = $this -> input -> post("naam");
		$query = $this -> Radio -> delete_radio_zender($naam);
		$this -> index();
	}
	
	function add_zender() {
		$this -> load -> model('Radio');
		$naam = $this -> input -> post("naam");
		$url = $this -> input -> post("url");
		$query = $this -> Radio -> insert_radio_zender($naam, $url);
		$this -> index();
	}
}
