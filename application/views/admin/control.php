<?php
$this->load->view("theme/admin/header");
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view("theme/admin/sidebar") ?>
        </div>
        <div class="col-md-8">
            <!-- [ Plugins Control ] -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">จัดการปลั๊กอินในเว็บ</h3>
                </div>
                <div class="panel-body">
                    <p>เพิ่ม Plugin</p>
                    <?php
                    echo form_open("plugin/add");
                    echo form_input(array(
                        "name" => "name",
                        "class" => "form-control",
                        "placeholder" => "ชื่อปลั๊กอิน ต้องเป็นชื่อเดียวกับโฟเดอร์ปลั๊กอิน",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_submit(array(
                        "name" => "submit",
                        "class" => "btn btn-lg btn-success btn-block",
                        "value" => "เพิ่ม"
                    ));
                    ?>
                    <hr>
                    <?=anchor("plugin/reload","โหลดการทำงานใหม่",array("class" => "btn btn-lg btn-block btn-primary"))?>
                    <table class="table table-striped table-hover ">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ชื่อปลั๊กอิน</th>
                          <th>การกระทำ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        @$plugins = $this->db->get("tb_plugins");
                        if(@$plugins->num_rows() > 0)
                        {
                            foreach(@$plugins->result() as $row_plugins)
                            {
                                echo '<tr>
                                  <th>'.$row_plugins->plugins_id.'</th>
                                  <th>'.$row_plugins->plugins_name.'</th>
                                  <th>'.anchor("plugin/delete/$row_plugins->plugins_id","ลบ",array("class" => "btn btn-sm btn-danger")).'</th>
                                </tr>';
                            }
                        }
                        else
                        {
                            echo '<tr><th>ไม่มีปลั๊กอิน</th><th>ไม่มีปลั๊กอิน</th><th>ไม่มีปลั๊กอิน</th></tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div>
            <!-- [ Plugins Control ] -->
            <?php
            @$panel_right = $this->db->get_where("tb_plugins_data",array(
                "key" => "panel_right_admin"
            ));
            if(@$panel_right->num_rows() > 0)
            {
                foreach($panel_right->result() as $row_right)
                {
                    eval($row_right->value);
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
$this->load->view("theme/admin/footer");