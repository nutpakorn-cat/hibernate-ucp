<?php
class plugin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        redirect("welcome");
    }
    public function delete($id = "")
    {
        
    }
    public function reload()
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            //รีโหลดการทำงานทั้งหมด
            @$plugins = $this->db->get("tb_plugins");
            if(@$plugins->num_rows() > 0)
            {
                foreach(@$plugins->result() as $row_plugins)
                {
                    //================== [Reload หน้า index.php] ==================
                    $text = file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/index.php');
                    $data = "";
                    foreach($text as $value){
                        $data .= $value;
                    }
                    eval(@$data);
                    //=========================================================
                    //================== [Reload หน้า info.php] ==================
                    $text = file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/info.php');
                    $info = "";
                    foreach($text as $value){
                        $info .= $value;
                    }
                    eval(@$info);
                    //Controller
                    @$count = count($info_controller);
                    if($count != 0)
                    {
                        for($i = 0;$i != $count;$i++)
                        {
                            if(@file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Controllers/'.$info_controller[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Controllers]ไม่พบไฟล์ ".$info_controller[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Controllers/'.$info_controller[$i]);
                                @$info = "";
                                foreach($text as $value){
                                    $info .= $value;
                                }
                                @mkdir("application/controllers/$row_plugins->plugins_name", 0777);
                                $path = "application/controllers/$row_plugins->plugins_name/".$info_controller[$i];
                                if(@$open = fopen($path, 'w'))
                                {
                                    @$datsa['msg'] .= "<strong class='text-success'>[Controllers]สร้างไฟล์ ".$info_controller[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Controllers]ไม่สามารถสร้างไฟล์ ".$info_controller[$i]." ที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                if(@fwrite($open, "$info"))
                                {
                                    fclose($open);
                                    @$datsa['msg'] .= "<strong class='text-success'>[Controllers]เขียนข้อมูลลงไฟล์ ".$info_controller[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Controllers]ไม่สามารถเขียนข้อมูลลงที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                            }
                        }
                    }
                    //========================================================
                    //Views
                    @$count = count($info_view);
                    if($count != 0)
                    {
                        for($i = 0;$i != $count;$i++)
                        {
                            if(@file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Views/'.$info_view[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Views]ไม่พบไฟล์ ".$info_view[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Views/'.$info_view[$i]);
                                @$info = "";
                                foreach($text as $value){
                                    $info .= $value;
                                }
                                @mkdir("application/views/$row_plugins->plugins_name", 0777);
                                $path = "application/views/$row_plugins->plugins_name/".$info_view[$i];
                                if(@$open = fopen($path, 'w'))
                                {
                                    @$datsa['msg'] .= "<strong class='text-success'>[Views]สร้างไฟล์ ".$info_view[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Views]ไม่สามารถสร้างไฟล์ ".$info_view[$i]." ที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                if(@fwrite($open, "$info"))
                                {
                                    fclose($open);
                                    @$datsa['msg'] .= "<strong class='text-success'>[Views]เขียนข้อมูลลงไฟล์ ".$info_view[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Views]ไม่สามารถเขียนข้อมูลลงที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                            }
                        }
                    }
                    //========================================================
                    //Models
                    @$count = count($info_model);
                    if($count != 0)
                    {
                        for($i = 0;$i != $count;$i++)
                        {
                            if(@file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Models/'.$info_model[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Models]ไม่พบไฟล์ ".$info_model[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Models/'.$info_model[$i]);
                                @$info = "";
                                foreach($text as $value){
                                    $info .= $value;
                                }
                                @mkdir("application/models/$row_plugins->plugins_name", 0777);
                                $path = "application/models/$row_plugins->plugins_name/".$info_model[$i];
                                if(@$open = fopen($path, 'w'))
                                {
                                    @$datsa['msg'] .= "<strong class='text-success'>[Models]สร้างไฟล์ ".$info_model[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Models]ไม่สามารถสร้างไฟล์ ".$info_model[$i]." ที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                if(@fwrite($open, "$info"))
                                {
                                    fclose($open);
                                    @$datsa['msg'] .= "<strong class='text-success'>[Models]เขียนข้อมูลลงไฟล์ ".$info_model[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Models]ไม่สามารถเขียนข้อมูลลงที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                            }
                        }
                    }
                    //========================================================
                    //Helper
                    @$count = count($info_helper);
                    if($count != 0)
                    {
                        for($i = 0;$i != $count;$i++)
                        {
                            if(@file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Helpers/'.$info_helper[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Models]ไม่พบไฟล์ ".$info_helper[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(base_url() . 'plugins/'.$row_plugins->plugins_name.'/Helpers/'.$info_helper[$i]);
                                @$info = "";
                                foreach($text as $value){
                                    $info .= $value;
                                }
                                @mkdir("application/helpers/$row_plugins->plugins_name", 0777);
                                $path = "application/helpers/$row_plugins->plugins_name/".$info_model[$i];
                                if(@$open = fopen($path, 'w'))
                                {
                                    @$datsa['msg'] .= "<strong class='text-success'>[Helpers]สร้างไฟล์ ".$info_helper[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Helpers]ไม่สามารถสร้างไฟล์ ".$info_helper[$i]." ที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                if(@fwrite($open, "$info"))
                                {
                                    fclose($open);
                                    @$datsa['msg'] .= "<strong class='text-success'>[Helpers]เขียนข้อมูลลงไฟล์ ".$info_helper[$i]." เสร็จสมบูรณ์ ที่ตำแหน่ง ".base_url() . $path." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                                else
                                {
                                    @$datsa['msg'] .= "<strong class='text-danger'>[Helpers]ไม่สามารถเขียนข้อมูลลงที่ตำแหน่ง ".base_url() . $path." ได้ โปรดตรวจสอบ Plugin ".$row_plugins->plugins_name."</strong><br>";
                                }
                            }
                        }
                    }
                    //========================================================
                    
                }
                $datsa['msg'] .= "โหลดข้อมูลเสร็จเรียบร้อย ใช้เวลาทั้งสิ้น <strong>{elapsed_time}</strong> วินาที";
                $this->load->view("server",$datsa);
            }
            else
            {
                $data['msg'] = "คุณยังไม่ได้เพิ่มรายชื่อปลั๊กอิน";
                $this->load->view("server",$data);
            }
        }
        else
        {
            redirect("welcome");
        }
    }
}