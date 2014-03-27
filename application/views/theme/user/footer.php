    <div class="container">
        <hr>
        <p>Powered By Codeigniter HibernateUCP opensource : <strong><a href="https://github.com/nutterrocker/HibernateUCP" class="text-muted">Github</a></strong> | Main dev : <strong><a class="text-muted" href="https://www.facebook.com/pages/Twiceworld-PHP-Thailand-%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B9%80%E0%B8%82%E0%B8%B5%E0%B8%A2%E0%B8%99-php-%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A%E0%B9%84%E0%B8%8B%E0%B8%95%E0%B9%8C/573397832751167">Twiceworld PHP Minecraft</a></strong></p>
    </div>
    <script src="<?=base_url()?>assets/main.js"></script>
    <script>
    $( "div#register" ).hide(); //ซ่อน well register
    $( "div#login" ).hide(); //ซ่อน well login
    $( "p#check" ).hide(); //ซ่อน error
    $( "input#v7" ).hide(); //ซ่อนปุ่ม
    $( "p#ches" ).hide(); //ซ่อน error
    function showlogin() //โชว์ well login
    {
        $( "div#login" ).toggle( "fast" );
        $( "div#register" ).hide();
    }
    function showregister() //โชว์ well register
    {
        $( "div#register" ).toggle( "fast" );
        $( "div#login" ).hide();
    }
    $("input#v6").change(function() {
        if ($("input#v5").val() === $("input#v6").val()){
                $( "p#ches" ).hide();
            $( "p#check" ).hide("slow");
            $("input#v7").show("slow");
            $("p#che").hide("slow"); 
        } else {
            $("input#v7").hide();
            $( "p#check" ).show("slow");

        }
    });
    </script>
</body>
</html>
