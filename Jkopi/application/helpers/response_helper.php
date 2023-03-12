<?php
function custom_response($response, $message)
{
	if ($response == 200) {
		$data['code'] = 200;
		$data['status'] = true;
		$data['message'] = $message;
	} else {
		$data['code'] = 500;
		$data['status'] = false;
		$data['message'] = $message;
	}
	return $data;
}
