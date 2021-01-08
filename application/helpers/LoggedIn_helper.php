<?php

	function is_logged_in()
	{
		$ci = get_instance();
		if (!$ci->session->userdata('email') or !$ci->session->userdata('id')) {
			$ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu!</div>');
			redirect('Login');
		}
		// else{
		// 	$role_id = $ci->session->userdata('role_id');
		// 	$menu = $ci->uri->segment(1);

		// 	$queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
		// 	$menu_id = $queryMenu['id'];

		// 	$userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

		// 	if ($userAccess->num_rows() < 1) {
		// 		redirect('auth/blocked');
		// 	}
		// }
	}

?>