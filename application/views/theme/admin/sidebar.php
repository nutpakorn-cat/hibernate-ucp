<!-- [Info]  -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">รายละเอียดแอดมิน</h3>
    </div>
    <div class="panel-body">
        <p>Admin User : <?=  htmlentities($this->session->userdata("username_admin"))?></p>
        <?php
        @$info = $this->db->get_where("tb_plugins_data",array(
            "key" => "info_admin"
        ));
        if(@$info->num_rows() > 0)
        {
            foreach(@$info->result() as $row_info)
            {
                eval($row_info->value);
            }
        }
        ?>
    </div>
    <div class="panel-footer">
        <?php
        echo anchor("admin/logout","ออกจากระบบแอดมิน",array(
            "class" => "btn btn-lg btn-danger"
        ));
        echo " | ";
        echo anchor("admin/reset","เปลี่ยนรหัสผ่าน",array(
            "class" => "btn btn-lg btn-primary"
        ));
        ?>
    </div>
</div>
<?php
@$panel_left = $this->db->get_where("tb_plugins_data",array(
    "key" => "panel_left_admin"
));
if(@$panel_left->num_rows() > 0)
{
    foreach(@$panel_left->result() as $row_left)
    {
        eval(@$row_left->value);
    }
}
