<?php
class Models extends CI_Model
{
	public function getData($tb)
	{
		return $query = $this->db->query("SELECT * FROM $tb")->result_array();
	}

	public function hapus($id, $column, $tb)
	{
		$this->load->database();
		$this->db->where($column, $id);
		return $this->db->delete($tb);
	}
	public function insert($tabel, $arr)
	{
		$cek = $this->db->insert($tabel, $arr);
		return $cek;
	}

	public function update($data = array(), $id, $column, $tb)
	{
		$this->load->database();
		$this->db->where($column, $id);
		return $this->db->update($tb, $data);
	}

	public function randomkode($maxlength)
	{
		$chary = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
			"0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
			"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"
		);
		$return_str = "";
		for ($x = 0; $x < $maxlength; $x++) {
			$return_str .= $chary[rand(0, count($chary) - 1)];
		}
		return $return_str;
	}
	public function insertLog($id_pengguna, $id_content, $log_content, $os, $device_info, $browser, $ip, $url)
	{
		$arr = [
			'id_pengguna' => $id_pengguna,
			'id_content' => $id_content,
			'log_content' => $log_content,
			'device_info' => $device_info,
			'os' => $os,
			'browser' => $browser,
			'ip' => $ip,
			'url' => $url,
			'created_at' => date('Y-m-d H:i:s')
		];
		$cek = $this->db->insert('log', $arr);
		return $cek;
	}
}
