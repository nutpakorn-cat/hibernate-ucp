<?php
$row = $result->row();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$row->server_name?></title>
        <link rel="stylesheet" href="<?=base_url()?>assets/main.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/fonts.css">
    </head>
    <body>
        <!-- WEll -->
        <div class="well">
            <div class="container">
                <h1><?=$row->server_name?></h1>
            </div>
        </div>
        <!-- WEll -->

    