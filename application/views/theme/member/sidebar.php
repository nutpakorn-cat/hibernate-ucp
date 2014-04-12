<!-- [Info]  -->
<?php
$this->load->helper("dbhelper");
@$member = $this->db->get_where("".  table_iconomy() ."",array(
    "".  col_username() ."" => "{$this->session->userdata("username")}"
)); //ดึงข้อมูลจาก iConomy
$row_member = $member->row();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">รายละเอียด</h3>
    </div>
    <div class="panel-body">
        <p>ชื่อในเกม : <?=htmlentities($this->session->userdata("username"))?></p>
        <p>เงินในเกม : <?=htmlentities($row_member->balance)?></p>
        <?php
        @$info = $this->db->get_where("tb_plugins_data",array(
            "key" => "info"
        )); //ดึงการประมวลผล PHP ออกมา
        if(@$info->num_rows() > 0)
        {
            foreach(@$info->result() as $row_info)
            {
                echo eval($row_info->value);
            }
        }
        ?>
    </div>
</div>
<!-- [Info]  -->
<!-- [Control] -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">ปุ่มควบคุม</h3>
    </div>
    <div class="panel-body">
        <?php
        @$btn = $this->db->get_where("tb_plugins_data",array(
            "key" => "btn"
        ));
        if(@$btn->num_rows() > 0)
        {
            foreach(@$btn->result() as $row_btn)
            {
                echo eval($row_btn->value);
            }
        }
        ?>
        <?= anchor("member/logout","ออกจากระบบ",array(
            "class" => "btn btn-lg btn-danger btn-block"
        )) ?>
    </div>
</div>
<!-- [Control] -->
<!-- [Plugins] -->
<?php
@$panel_left = $this->db->get_where("tb_plugins_data",array(
    "key" => "panel_left"
));
if(@$panel_left->num_rows() > 0)
{
    foreach($panel_left->result() as $row_left)
    {
        echo eval($row_left->value);
    }
}
?>
<!-- [Plugins] -->