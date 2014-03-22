<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Member Controller
 * 
 * HibernateUCP
 * 
 */
class member extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        redirect("welcome");
    }
    public function register()
    {
        if($this->session->userdata("login") == TRUE) //ถ้าล็อกอินอยู่แล้ว
        {
            redirect("member/control");
        }
        else if($this->input->post("v4",TRUE) != NULL && $this->input->post("v5",TRUE) != NULL && $this->input->post("v6",TRUE) != NULL) //ถ้าโพสข้อมูล
        {
            @$username = $this->input->post("v4",TRUE); //Username ชื่อผู้ใช้
            @$password = $this->input->post("v5",TRUE); //Password
            @$repassword = $this->input->post("v6",TRUE); //Repassword
            if(strlen($password) < 6) //ถ้าพาสเวิร์ดน้อยกว่า 6 ตัวอักษร
            {
                echo "<p class='text-danger'>Password ควรมากกว่า 6 ตัวอักษร</p>";
            }
            else 
            {
                if(preg_match ('/[^a-z-0-9]/i', $username))  //ถ้ามีตัวอักษารพิเศษ
                {
                    echo "<p class='text-danger'>Username ของคุณมีอักษรพิเศษ</p>";
                }
                $res = $this->db->get_where("authme",array(
                    "username" => "$username"
                ));
                if($res->num_rows() > 0) 
                {
                    echo "<p class='text-danger'>Username มีคนใช้แล้ว</p>";
                }
                else
                {
                    $this->load->helper("dbhelper");
                    $re = $this->db->get_where("tb_setting",array(
                        "server_id" => "1"
                    ));
                    $ro = $re->row();
                    $world = $ro->game_world; //World ในเกม
                    $salt = substr(md5(rand(1,100000)),0,16);
                    $a = hash("sha256",$password).$salt; //สร้างรหัสผ่าน
                    $b = hash("sha256",$a); 
                    $realpass = "\$SHA$$salt$$b"; 
                    $startpoint = $ro->start_money; //เงินเริ่มต้น
                    $this->db->insert("".table_authme()."",array(
                        "".col_username()."" => "$username",
                        "".  col_password()."" => "$realpass",
                        "ip" => "{$_SERVER['REMOTE_ADDR']}",
                                "world" => "$world"
                    ));
                    $this->db->insert("".table_iconomy()."",array(
                        "".col_username()."" => "$username",
                        "".col_balance()."" => "$startpoint",
                        "status" => "0"
                    ));
                    $rb = $this->db->get_where("".table_authme()."",array(
                        "".col_username()."" => "$username"
                    ));
                    $rbo = $rb->row();
                    $id_play = $rbo->id;
                    $this->session->set_userdata(array(
                        "username" => "$username",
                        "id" => "$id_play",
                        "login" => TRUE
                    ));
                    echo "TRUE";
                }
            }
        }
    }
}