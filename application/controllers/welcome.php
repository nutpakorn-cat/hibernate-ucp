<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Filename: welcome.php
// Part of nutterrocker's HibernateUCP.
// Copyright (C) 2014 nutterrocker. Any rights allowed except change product name.
class Welcome extends CI_Controller {
    public function index()
    {
        if($this->session->userdata("login") == TRUE) //ถ้าล็อกอินอยู่แล้ว
        {
            redirect("member/control");
        }
        else //ถ้ายังไม่ได้ล็อกอิน
        {
            $data['result'] = $this->db->get_where("tb_setting",array(
                "server_id" => "1"
            ));
            $this->load->view("unlogin",$data);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */