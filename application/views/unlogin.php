<?php
$this->load->view("theme/user/header");
?>
<!-- ROW -->
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center">
        <button onclick="showlogin()" class="text-center btn btn-success btn-lg">เข้าสู่ระบบ</button>
        <button onclick="showregister()" class="text-center btn btn-warning btn-lg">สมัครสมาชิก</button>
    </div>
</div>
<!-- ROW -->
<br>
<!-- ROW Hidden -->
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div id="login" class="well">
            <legend>เข้าสู่ระบบ</legend>
            <div id="status1"></div>
            <form id="v0" method="post">
            <?php
            echo form_input(array(
                "name" => "v1",
                "class" => "form-control",
                "placeholder" => "Username ในเกม",
                "required" => ""
            ));
            echo "<p></p>";
            echo form_password(array(
                "name" => "v2",
                "class" => "form-control",
                "placeholder" => "Password ในเกม",
                "required" => ""
            ));
            echo "<p></p>";
            echo form_submit(array(
                "name" => "v3",
                "class" => "btn btn-lg btn-success btn-block",
                "value" => "เข้าสู่ระบบ",
                "id" => "v3"
            ));
            echo form_close();
            ?>
        </div>
        <div id="register" class="well">
            <legend>สมัครสมาชิก</legend>
            <div id="status2"></div>
            <form id="vx" method="post">
            <?php
            echo form_input(array(
                "name" => "v4",
                "class" => "form-control",
                "placeholder" => "Username ในเกม",
                "required" => "",
                "id" => "v4"
            ));
            echo "<p></p>";
            echo form_password(array(
                "name" => "v5",
                "class" => "form-control",
                "placeholder" => "Password ในเกม",
                "required" => "",
                "id" => "v5"
            ));
            echo "<p></p>";
            echo form_password(array(
                "name" => "v6",
                "class" => "form-control",
                "placeholder" => "ยืนยัน Password",
                "required" => "",
                "id" => "v6"
            ));
            echo "<p class='text-danger' id='ches'>User ของคุณมีการใช้อักษรพิเศษ</p>";
            echo "<p class='text-danger' id='che'>กรอกข้อมูลให้ถูกต้องถึงจะมีปุ่มขึ้นมา</p>";
            echo "<p class='text-danger' id='check'>รหัสผ่านไม่ตรงกัน</p>";
            echo "<p></p>";
            echo form_submit(array(
                "name" => "v7",
                "class" => "btn btn-lg btn-block btn-success",
                "value" => "สมัครสมาชิก",
                "id" => "v7"
            ));
            echo form_close();
            ?>
        </div>
    </div>
</div>
<!-- ROW -->
<?php
$this->load->view("theme/user/footer");
