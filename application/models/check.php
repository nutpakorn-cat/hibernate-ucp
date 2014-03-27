<?php
/*
 * ระบบเช็ค User password ของปลั๊กอิน Authme
 */
class check extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    function check_password_db($nickname,$password) {
          $a=mysql_query("SELECT password FROM authme where username = '$nickname'");
          if(@mysql_num_rows($a) == 1 ) {
             $password_info=mysql_fetch_array($a);
             $sha_info = explode("$",$password_info[0]);
           } else return false;
          if( $sha_info[1] === "SHA" ) {
                $salt = $sha_info[2];
                $sha256_password = hash('sha256', $password);
                $sha256_password .= $sha_info[2];;
                if( strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password) ) == 0 ) return true;
                else return false;
          }
    }
}