<?php
/*
 * คลาส Admin
 */
class admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        if($this->session->userdata("login_admin") == TRUE) //ถ้าแอดมินเข้าสู่ระบบอยู่แล้ว
        {
            redirect("admin/control");
        }
        else
        {
            $data['result'] = $this->db->get_where("tb_setting",array(
                "server_id" => "1"
            ));
            $this->load->view("admin/auth",$data);
        }
    }
    public function auth()
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            redirect("admin/control");
        }
        else
        {
            if($this->input->post("username") != NULL && $this->input->post("password") != NULL && $this->input->post("submit") != NULL)
            {
                $username = $this->input->post("username",TRUE);
                $password = $this->input->post("password",TRUE); 
                $res = $this->db->get_where("tb_setting",array(
                    "server_id" => "1"
                ));
                $row = $res->row();
                $salt = substr($row->server_pass,0,16); //Salt 
                $realpassword = $salt . md5($salt . $password);
                $res = $this->db->get_where("tb_setting",array(
                    "server_id" => "1",
                    "server_admin" => "$username",
                    "server_pass" => "$realpassword"
                ));
                if($res->num_rows() == 1)
                {
                    $this->session->set_userdata(array(
                        "username_admin" => "$username",
                        "login_admin" => TRUE
                    ));
                    redirect("admin/control");
                }
                else
                {
                    $data['msg'] = "ข้อผิดพลาด : Password หรือ Username แอดมินไม่ถูกต้อง";
                    $this->load->view("server",$data);
                }
            }
            else
            {
                redirect("admin");
            }
        }
    }
}