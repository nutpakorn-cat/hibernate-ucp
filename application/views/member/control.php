<?php
$this->load->view("theme/member/header");
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view("theme/member/sidebar")?>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">จัดการ User</h3>
                </div>
                <div class="panel-body">
                    <?php
                    @$edit = $this->db->get_where("tb_plugins_data",array(
                        "key" => "edit_user"
                    ));
                    if(@$edit->num_rows() > 0)
                    {
                        foreach(@$edit->result() as $row_edit)
                        {
                            eval($row_edit->value); //รันคำสั่ง
                        }
                    }
                    else
                    {
                        echo "<p>ไม่มีปลั๊กอิน</p>";
                    }
                    ?>
                </div>
            </div>
            <?php
            @$panel_right = $this->db->get_where("tb_plugins_data",array(
                "key" => "panel_right"
            ));
            if(@$panel_right->num_rows() > 0)
            {
                foreach($panel_right->result() as $row_right)
                {
                    echo $row_right->value;
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
$this->load->view("theme/member/footer");