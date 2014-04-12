<?php
// Filename: admin.php
// Part of nutterrocker's HibernateUCP.
// Copyright (C) 2014 nutterrocker. Any rights allowed except change product name.
class admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function control()
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            $data['result'] = $this->db->get_where("tb_setting",array(
                "server_id" => "1"
            ));
            $this->load->view("admin/control",$data);
        }
        else
        {
            redirect("admin");
        }
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
    public function edit()
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            if($this->input->post("v1",TRUE) != NULL && $this->input->post("v2",TRUE) != NULL && $this->input->post("v3",TRUE) != NULL && $this->input->post("v4",TRUE) != NULL && $this->input->post("v5",TRUE) != NULL)
            {
                $ip = $this->input->post("v1",TRUE);
                $port = $this->input->post("v2",TRUE);
                $rcon = $this->input->post("v3",TRUE);
                $rcon_port = $this->input->post("v4",TRUE);
                $this->db->where(array(
                    "server_id" => "1"
                ));
                $this->db->update("tb_setting",array(
                    "server_ip" => "{$this->input->post("v1",TRUE)}",
                    "server_port" => "{$this->input->post("v2",TRUE)}",
                    "server_rcon" => "{$this->input->post("v3",TRUE)}",
                    "server_rcon_port" => "{$this->input->post("v4",TRUE)}"
                ));
                redirect("admin");
            }
            else if($this->input->post("v6",TRUE) != NULL && $this->input->post("v7",TRUE) != NULL)
            {
                $this->db->where(array(
                    "server_id" => "1"
                ));
                $this->db->update("tb_setting",array(
                    "server_name" => "{$this->input->post("v6",TRUE)}"
                ));
                redirect("admin");
            }
            else
            {
                redirect("admin");
            }
        }
        else
        {
            redirect("welcome");
        }
    }
    public function reset()
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            if($this->input->post("v1",TRUE) != NULL && $this->input->post("v2",TRUE) != NULL && $this->input->post("v3",TRUE) != NULL && $this->input->post("v4",TRUE) != NULL && $this->input->post("v2",TRUE) == $this->input->post("v3",TRUE))
            {
                $username = $this->input->post("v1",TRUE);
                $password = $this->input->post("v2",TRUE); 
                $salt = substr(md5(rand(0,10000)),0,16);
                $realpassword = $salt . md5($salt . $password);
                $this->db->where(array(
                    "server_id" => "1"
                ));
                
                $this->db->update("tb_setting",array(
                    "server_admin" => "$username",
                    "server_pass" => "$realpassword"
                ));
                $this->session->set_userdata(array(
                    "username_admin" => "$username"
                ));
                redirect("admin");
            }
            else
            {
                $data['result'] = $this->db->get_where("tb_setting",array(
                    "server_id" => "1"
                ));
                $this->load->view("admin/reset",$data);
            }
        }
        else 
        {
            redirect("welcome");
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
    public function logout()
    {
        if($this->session->userdata("login_admin") != TRUE)
        {
            redirect("welcome");
        }
        else
        {
            $this->session->unset_userdata(array(
                "login_admin" => FALSE,
                "username_admin" => ""
            ));
            redirect("welcome");
        }
    }
}