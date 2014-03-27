<?php
$this->load->view("theme/server/header");
?>
<div class="container">
    <h1>ข้อความจากเซิฟเวอร์</h1>
    <hr>
    <p><?=$msg?></p>
    <br>
    <button onclick="backpage()" class="btn btn-lg btn-block btn-success">ย้อนกลับ</button>
</div>
<script>
function backpage()
{
    window.history.back();
}
</script>
<?php
$this->load->view("theme/server/footer");
