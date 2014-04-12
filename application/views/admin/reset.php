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
                    <h3 class="panel-title">เปลี่ยนรหัสผ่าน</h3>
                </div>
                <div class="panel-body">
                    <p>Reset รหัสผ่านใหม่</p>
                    <?php
                    echo form_open("admin/reset");
                    echo form_input(array(
                        "name" => "v1",
                        "class" => "form-control",
                        "placeholder" => "Username ใหม่",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_password(array(
                        "name" => "v2",
                        "class" => "form-control",
                        "placeholder" => "Password ใหม่",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_password(array(
                        "name" => "v3",
                        "class" => "form-control",
                        "placeholder" => "ยินยัน Password",
                        "required" => ""
                    ));
                    echo "<p></p>";
                    echo form_submit(array(
                        "name" => "v4",
                        "class" => "btn btn-lg btn-block btn-success",
                        "value" => "เปลี่ยนรหัสผ่าน"
                    ));
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view("theme/admin/footer");