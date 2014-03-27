<?php
$this->load->view("theme/admin/header");
?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Admin Login</h3>
            </div>
            <div class="panel-body">
                <?php
                echo form_open("admin/auth");
                echo form_input(array(
                    "name" => "username",
                    "class" => "form-control",
                    "placeholder" => "Username แอดมิน",
                    "required" => ""
                ));
                echo "<p></p>";
                echo form_password(array(
                    "name" => "password",
                    "class" => "form-control",
                    "placeholder" => "Password แอดมิน",
                    "required" => ""
                ));
                echo "<p></p>";
                echo form_submit(array(
                    "name" => "submit",
                    "class" => "btn btn-lg btn-success btn-block",
                    "value" => "เข้าสู่ระบบ"
                ));
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view("theme/admin/footer");