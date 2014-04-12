<?php
/*
 * หน้า Plugins โดย Twiceworld PHP
 */
class plugin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        redirect("welcome");
    }
    public function add()
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            if($this->input->post("name") != NULL && $this->input->post("submit") != NULL)
            {
                $name = $this->input->post("name",TRUE);
                @$result = $this->db->get_where("tb_plugins",array(
                    "plugins_name" => "$name"
                ));
                if(@$result->num_rows() > 0)
                {
                    $data['msg'] = "ข้อผิดพลาด : Plugin นี้มีอยู่ในระบบแล้ว";
                    $this->load->view("server",$data);
                }
                else
                {
                    $this->db->insert("tb_plugins",array(
                        "plugins_name" => "$name"
                    ));
                    $data['msg'] = "เพิ่ม Plugin เรียบร้อย <strong>Plugin จะไม่มีผลหากคุณไม่ Reload Plugin</strong> " . anchor("plugin/reload","รีโหลดตอนนี้",array("class" => "text-muted"));
                    $this->load->view("server",$data);
                }
            }
        }
        else
        {
            redirect("admin");
        }
    }
    public function delete($id = "")
    {
        if($this->session->userdata("login_admin") == TRUE)
        {
            if($id == "")
            {
                $data['msg'] = "ข้อผิดพลาด กรุณาระบุ Id";
                $this->load->view("server",$data);
            }
            else
            {
                @$result = $this->db->get_where("tb_plugins",array(
                    "plugins_id" => "$id"
                ));
                if(@$result->num_rows() > 0)
                {
                    //Controllers
                    foreach(@$result->result() as $row)
                    {
                        $dir = "application/controllers/$row->plugins_name";
                        foreach (@scandir($dir) as $item) {
                            if ($item == '.' || $item == '..') continue;
                            @unlink(@$dir.DIRECTORY_SEPARATOR.$item);
                        }
                        @rmdir(@$dir);
                        $dir = "application/views/$row->plugins_name";
                        foreach (@scandir($dir) as $item) {
                            if ($item == '.' || $item == '..') continue;
                            @unlink(@$dir.DIRECTORY_SEPARATOR.$item);
                        }
                        @rmdir(@$dir);
                        $dir = "application/models/$row->plugins_name";
                        foreach (@scandir($dir) as $item) {
                            if ($item == '.' || $item == '..') continue;
                            @unlink(@$dir.DIRECTORY_SEPARATOR.$item);
                        }
                        @rmdir(@$dir);
                        $dir = "application/helpers/$row->plugins_name";
                        foreach (@scandir($dir) as $item) {
                            if ($item == '.' || $item == '..') continue;
                            @unlink(@$dir.DIRECTORY_SEPARATOR.$item);
                        }
                        @rmdir(@$dir);
                        if(@$this->db->delete("tb_plugins",array("plugins_id" => "$id")) && @$this->db->delete("tb_plugins_data",array("name" => "$row->plugins_name")))
                        {
                            @$msg['msg'] .= "<strong class='text-success'>ลบฐานข้อมูลของปลั๊กอิน $row->plugins_name เรียบร้อย</strong><br>";
                        }
                        else
                        {
                            @$msg['msg'] .= "<strong class='text-danger'>ไม่สามารถลบไฟล์ของปลั๊กอิน $row->plugins_name ได้</strong><br>";
                        }
                        @$msg['msg'] .= "<strong class='text-success'>ลบไฟล์ของปลั๊กอิน $row->plugins_name เรียบร้อย</strong><br>";
                        $this->load->view("server",$msg);
                    }
                }
                else
                {
                    $data['msg'] = "ข้อผิดพลาด : ไม่มีปลั๊กอินนี้อยู่ในระบบ";
                    $this->load->view("server",$data);
                }
            }
        }
        else
        {
            redirect("welcome");
        }
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
                    require_once FCPATH . 'plugins/'.$row_plugins->plugins_name.'/index.php';
                    @$query = @$query_all;
                    while ( ($query_data = current($query)) !== FALSE ) {
                        $result = $this->db->get_where("tb_plugins_data",array(
                            "name" => "$row_plugins->plugins_name",
                            "key" => key($query)
                        ));
                        if($result->num_rows() > 0)
                        {
                            $this->db->where(array(
                                "name" => "$row_plugins->plugins_name",
                                "key" => key($query)
                            ));
                            $this->db->update("tb_plugins_data",array(
                                "key" => key($query),
                                "name" => "$row_plugins->plugins_name",
                                "value" => $query[key($query)]
                            ));
                            next($query);
                        }
                        else
                        {
                            $this->db->insert("tb_plugins_data",array(
                                "key" => key($query),
                                "name" => "$row_plugins->plugins_name",
                                "value" => $query[key($query)]
                            ));
                            next($query);
                        }
                    }   
                    //=========================================================
                    //================== [Reload ข้อมูล] ==================
                    //Controller
                    @$count = count($info_controller);
                    if($count != 0)
                    {
                        for($i = 0;$i != $count;$i++)
                        {
                            if(@file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Controllers/'.$info_controller[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Controllers]ไม่พบไฟล์ ".$info_controller[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Controllers/'.$info_controller[$i]);
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
                    //Viewsc
                    @$count = count($info_view);
                    if($count != 0)
                    {
                        for($i = 0;$i != $count;$i++)
                        {
                            if(@file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Views/'.$info_view[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Views]ไม่พบไฟล์ ".$info_view[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Views/'.$info_view[$i]);
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
                            if(@file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Models/'.$info_model[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Models]ไม่พบไฟล์ ".$info_model[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Models/'.$info_model[$i]);
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
                            if(@file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Helpers/'.$info_helper[$i]) != TRUE)
                            {
                                @$datsa['msg'] .= "<strong class='text-danger'>[Helpers]ไม่พบไฟล์ ".$info_helper[$i]." ของ Plugin ".$row_plugins->plugins_name."</strong><br>";
                            }
                            else
                            {
                                @$text = file(FCPATH . 'plugins/'.$row_plugins->plugins_name.'/Helpers/'.$info_helper[$i]);
                                @$info = "";
                                foreach($text as $value){
                                    $info .= $value;
                                }
                                @mkdir("application/helpers/$row_plugins->plugins_name", 0777);
                                $path = "application/helpers/$row_plugins->plugins_name/".$info_helper[$i];
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