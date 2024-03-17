<!doctype html>
<html class="fixed">

<head>
    <?php include "head.php";
    session_start();
        if(isset($_POST['submit']))
        {
            include "connect.php";
            // current time
            $time = date('h:i:s');
            $result=mysqli_query($conn, "update users set start_time=now() where pid='$_SESSION[pid]'");
            if($result) header("Location:dashboard.php");
        }
    ?>

</head>

<body>

    <!-- start: page -->
    <section class="body-sign body-locked">
        <div class="center-sign">
            <div class="panel card-sign">
                <div class="card-body">
                    <form action="#" method='post'>
                        <div class="current-user text-center">
                            <img src="img/full_logo.jpg" alt="BO HOUSIE" class="rounded-circle user-image" />
                            <h2 class="user-name text-dark m-0" style='font-size:24px;'>SPELL BEE FINAL ROUND</h2>
                            <p class="user-email m-0">Can we Start the Game</p>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group" >
                                <button type="submit" name="submit" class="btn btn-primary">START GAME</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- end: page -->

    <!-- Vendor -->
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="vendor/popper/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="vendor/jquery-placeholder/jquery-placeholder.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="js/theme.js"></script>

    <!-- Theme Custom -->
    <!-- Theme Initialization Files -->
    <script src="js/theme.init.js"></script>

    <script>
        setTimeout(function() {
            document.getElementById('foo').style.display = 'none';
        }, 5000);
    </script>

    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+919293940004", // WhatsApp number
                call_to_action: "WhatsApp for Help", // Call to action
                position: "left", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>



    <!-- /GetButton.io widget -->
</body>

</html>