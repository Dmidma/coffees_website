
<link rel="stylesheet" type="text/css" href="../public/css/style3.css" />
<link rel="stylesheet" type="text/css" href="../public/css/animate-custom.css" />
<link rel="stylesheet" type="text/css" href="../public/css/lock.css">
<div id="container_demo">
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <?php
                            	require("../templates/login.php");
                            ?>
                        </div>

                        <div id="register" class="animate form">
                            <?php
                                require("../templates/signup.php");
                            ?>
                        </div>
						
                    </div>
                </div>