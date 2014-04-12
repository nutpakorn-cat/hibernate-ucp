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
                    echo form_close();
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">จัดการ IP,Port,Rcon,Rcon Port</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $row_result = $result->row();
                    echo form_open("admin/edit");
                    echo form_input(array(
                        "name" => "v1",
                        "class" => "form-control",
                        "value" => "$row_result->server_ip",
                        "placeholder" => "IP เซิฟเวอร์",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_input(array(
                        "name" => "v2",
                        "class" => "form-control",
                        "value" => "$row_result->server_port",
                        "placeholder" => "PORT เซิฟเวอร์",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_input(array(
                        "name" => "v3",
                        "class" => "form-control",
                        "value" => "$row_result->server_rcon",
                        "placeholder" => "Rcon Password",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_input(array(
                        "name" => "v4",
                        "class" => "form-control",
                        "value" => "$row_result->server_rcon_port",
                        "placeholder" => "Rcon Port เซิฟเวอร์",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_submit(array(
                        "name" => "v5",
                        "class" => "btn btn-lg btn-block btn-danger",
                        "value" => "เปลี่ยน IP,PORT,RCON,RCON PORT"
                    ));
                    echo form_close();
                    ?>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">แก้ไขชื่อเว็บไซต์</h3>
                </div>
                <div class="panel-body">
                    <?php
                    echo form_open("admin/edit");
                    echo form_input(array(
                        "name" => "v6",
                        "class" => "form-control",
                        "placeholder" => "ชื่อเว็บไซต์",
                        "value" => "$row_result->server_name",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_submit(array(
                        "name" => "v7",
                        "class" => "btn btn-lg btn-block btn-warning",
                        "value" => "เปลี่ยนชื่อเว็บไซต์"
                    ));
                    echo form_close();
                    ?>
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