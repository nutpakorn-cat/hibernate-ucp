<?php
$result = $this->db->get_where("tb_setting",array(
    "server_id" => "1"
));
$row = $result->row();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$row->server_name?></title>
        <link rel="stylesheet" href="<?=base_url()?>assets/main.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/fonts.css">
        <script src="<?=base_url()?>assets/jquery.js"></script>
    </head>
    <body>
        <div class="well">
            <div class="container">
                <h1><?=$row->server_name?></h1>
            </div>
        </div>
        