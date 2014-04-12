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
        <!-- โพสแบบ Jquery -->
    <script>
       $().ready(function(){
       $('form#v0').submit(function(){
           data=$('form#v0').serialize();
           $.post('<?=base_url()?>member/auth' ,data ,function(response){ //โพสไปที่คลาส member method auth
               if(response === "TRUE")
               {
                   location.reload();
               }
               else
               {
                   $( "div#status1" ).html(response);
               }
           });
           return false;
       });
   });   
   $().ready(function(){
       $('form#vx').submit(function(){
           data=$('form#vx').serialize();
           $.post('<?=base_url()?>member/register' ,data ,function(response){ //โพสไปที่คลาส member method register
               if(response === "TRUE")
               {
                   location.reload();
               }
               else
               {
                   $( "div#status2" ).html(response);
               }
           });
           return false;
       });
   });   
    </script>
    <!-- โพสแบบ Jquery -->
    </head>
    <body>
        <!-- WEll -->
        <div class="well">
            <div class="container">
                <h1><?=$row->server_name?></h1>
            </div>
        </div>
        <!-- WEll -->

    