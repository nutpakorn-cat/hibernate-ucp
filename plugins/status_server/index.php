<?php
class index {
    public function hbn_get_controllers()
    {
        return array();
    }
    public function hbn_get_views()
    {
        return array("status.php");
    }
    public function hbn_get_models()
    {
        return array();
    }
    public function hbn_get_helpers()
    {
        return array("stat_helper.php");
    }
    /*
     * ฟังก์ชั่นแสดงคำสั่ง
     */
    public function hbn_query_all()
    {
        return array(
            "panel_left" => "\$this->load->view('status_server/status');",
            "panel_right" => "",
            "panel_left_admin" => "",
            "panel_right_admin" => "",
            "btn" => "",
            "info" => "",
            "info_admin" => "",
        );
    }
}