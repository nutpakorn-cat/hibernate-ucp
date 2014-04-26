<?php 
$this->load->helper("status_server/stat");
$res = $this->db->get_where("tb_setting",array(
    "server_id" => "1"
));
$row_res = $res->row();
$ip = $row_res->server_ip;
$status = new MinecraftServerStatus();
$response = $status->getStatus($ip); 

 ?>
<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">สถานะเซิฟเวอร์</h3>
                </div>
                <div class="panel-body">
                    <?php if($response == TRUE) { $status2 = "<strong class='text-success'>เปิด</strong>"; }else{ $status2 = "<strong class='text-danger'>ปิด</strong>";  } ?>
                    <p>IP เซิฟเวอร์ : <?=$ip?></p>
                    <p>สถานะเซิฟเวอร์ : <?=$status2?></p><?php
?>
<span class="style2"><p>จำนวนผู้เล่น : <?php echo $response['players']; ?> / <?php echo $response['maxplayers']; ?></p>

    <input class="btn-block" type="submit" name="submitAdd" value="โหลดสถานะเซิฟเวอร์ใหม่" onclick="window.location.reload();">
                </div>
</div>
