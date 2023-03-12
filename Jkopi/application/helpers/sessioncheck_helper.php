<?php
function notLogin()
{
	$check = get_instance();
	if (!$check->session->userdata('id_admin')) {
		redirect("Login");
	}
}
