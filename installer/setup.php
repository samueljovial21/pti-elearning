 <?php
    // ini_set('display_errors', 0);
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    if( $protocol == 'http://' ) {
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' ;
    }
    $cur_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $cur_url_arr=explode('/installer',$cur_url);
    $basepath = $cur_url_arr[0].'/';
    /*** Checking STARTS ***/
    $ckText = file_get_contents('check_install.txt');
    if( trim($ckText) != 'no' ) {
        echo '<script>window.location="'.$basepath.'"</script>';
    }
   
    $path=dirname(__FILE__);
    $abs_path=explode('installer',$path);


    if(isset($_POST['db_submit'])) {
        if($_POST['db_name'] != '' && $_POST['db_uname'] != '' && $_POST['db_host'] != '') {

            $pathToDBfile = $abs_path[0].'application/config/';

            /***** Check DB Details STARTS ******/

            $testConnection = mysqli_connect($_POST['db_host'], $_POST['db_uname'], $_POST['db_pwd'],$_POST['db_name']);


            /***** Check DB Details ENDS ******/

            if ($testConnection) {


			/*** DB config STARTS ***/
			$dummyDB = file_get_contents('db_dummy.txt');

			$final_db_text = str_replace('{DB_UNAME}',$_POST['db_uname'],$dummyDB);
			$final_db_text = str_replace('{DB_NAME}',$_POST['db_name'],$final_db_text);
			$final_db_text = str_replace('{DB_PASSWORD}',$_POST['db_pwd'],$final_db_text);
			$final_db_text = str_replace('{DB_HOST}',$_POST['db_host'],$final_db_text);

			file_put_contents($pathToDBfile.'database.php',$final_db_text);
			/*** DB config ENDS ***/

				$dummyConfig = file_get_contents('config_dummy.txt');

				$final_config_text = str_replace('{BASE_URL}',$basepath,$dummyConfig);
				file_put_contents($pathToDBfile.'config.php',$final_config_text);
			

				file_put_contents('check_install.txt','yes');

				$default_sqlfile = 'default.sql';
			 
				// Temporary variable, used to store current query
				$templine = '';
				// Read in entire file
				$lines = file($default_sqlfile);

				// Loop through each line
				foreach ($lines as $line)
				{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;

					// Add this line to the current segment
					$templine .= $line;
					// If it has a semicolon at the end, it's the end of the query
					if (substr(trim($line), -1, 1) == ';')
					{
						// Perform the query
						mysqli_set_charset($testConnection,'utf8');
						mysqli_query($testConnection,$templine);
						// Reset temp variable to empty
						$templine = '';
					}
				}
				if(isset($_POST['admin_email'])){
                    mysqli_query($testConnection,"UPDATE `users` SET `email`='".$_POST['admin_email']."' WHERE id=1");
                }
			   echo '<script>window.location="'.$basepath.'login"</script>';
                
            }else {
                $message = '<span style="color:red;">Database connection failed.</span>';
				
            }
        }else {
            $message = '<span style="color:red;">Fields can not be empty.</span>';
			
        }
		
    }

     $laterForm="";
    // if( $laterForm != '' ) {
        file_put_contents($abs_path[0].'/application/config/verify.txt','yes');
    // }
?>
 <!DOCTYPE html>

<html lang="en">
 
<head>
<meta charset="utf-8" />
<title> SSF E-Learning - Installer Page</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="author"  content="SSF"/>

<meta name="MobileOptimized" content="320">
<!--srart theme style -->
<link href="<?php echo $basepath;?>adminassets/css/admin_main.css" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<!-- end theme style -->
<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $basepath;?>assets\images/favicon.png" />
<style>
   <style>
    * {
        outline: 0 !important;
    }
    body{
        font-family: 'Roboto', sans-serif;
        margin: 0;
        font-size: 16px;
        color: #a6a7bc;
    }
    h1,h2,h3,h4,h5,h6{
        font-family: 'Montserrat', sans-serif;
    }
    .edu-auth-panel img {
        max-width: 100%;
    }
    .edu-auth-panel {
        background-color: #4267C8;
        height: 100%;
        position: fixed;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        overflow-y: auto;
        padding: 30px 0;
        background-image: url(<?php echo $basepath;?>assets/images/login1.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    .edu-auth-container {
        max-width: 600px;
        width: 100%;
        padding: 0 20px;
        display: flex;
        flex-wrap: wrap;
    }
    .edu-auth-row {
        width: 100%;
        background: #ffffff;
        border: none;
        border-radius: 20px;
        padding: 50px 100px 50px;
        position: relative;
        box-shadow: 0 0 20px rgb(165 72 67 / 30%);
    }
    .edu-auth-logo img {
        max-height: 40px;
    }
    .edu-auth-head {
        text-transform: capitalize;
    }
    .text-center {
        text-align: center;
    }
    .edu-auth-head h5 {
        color: #ff534a;
        font-size: 18px;
        font-weight: 500;
        margin: 0 0 10px;
    }
    .edu-auth-logo {
        margin: 0 0 42px;
    }
    .edu-auth-head h4 {
        color: #ff534a;
        font-size: 20px;
        font-weight: 700;
        margin: 12px 0 20px;
    }
    .edu-auth-panel p {
        margin: 0;
    }
    .edu-auth-head a {
        display: inline-block;
        text-decoration: none;
        color: #ff534a;
        font-weight: 500;
    }
    .edu-auth-head a:hover, .edu-auth-head a:focus, .edu-auth-head a:visited {
        color: #ff534a;
    }
    .edu-field-holder {
        display: flex;
        flex-wrap: wrap;
        margin: 0 0 27px;
    }
    .edu-field-holder label {
        color: #3f4557;
        display: inline-block;
        width: 100%;
        font-size: 16px;
        font-weight: 500;
        margin: 0 0 10px;
    }
    .edu-field-holder input {
        width: 100%;
        border: 1px solid #e4e4e4;
        padding: 0 20px;
        height: 50px;
        border-radius: 6px;
    }
    .edu-field-holder input:focus, 
    .edu-field-holder input:hover {
        border-color: #e4e4e4;
    }
    .edu-auth-btn {
        margin: 3px 0 0;
        display: inline-block;
        width: 100%;
    }
    /**  Button CSS **/
    .edu-btn {
        background: #4267C8 none repeat scroll 0 0;
        border: none;
        border-radius: 3px;
        color: #ffffff;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        height: 50px;
        line-height: 50px;
        padding: 0 15px;
        min-width: 170px;
        position: relative;
        -webkit-transform: perspective(1px) translateZ(0px);
        -moz-transform: perspective(1px) translateZ(0px);
        -ms-transform: perspective(1px) translateZ(0px);
        -o-transform: perspective(1px) translateZ(0px);
        transform: perspective(1px) translateZ(0px);
        transition: color 0.3s ease 0s;
        vertical-align: middle;
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        width: 100%;
    }
    .edu-btn::before {
        background: #222222 none repeat scroll 0 0;
        bottom: 0;
        content: "";
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        -webkit-transform: scaleY(0);
        -moz-transform: scaleY(0);
        -ms-transform: scaleY(0);
        -o-transform: scaleY(0);
        transform: scaleY(0);
        transform-origin: 50% 0 0;
        transition-duration: 0.3s;
        transition-property: transform;
        transition-timing-function: ease-out;
        z-index: -1;
        border-radius:3px;
    }
    .edu-btn:hover::before {
        transform: scaley(1);
    }
    .edu-btn:hover {
        color: #ffffff;
    }
    .edu-field-holder input::-webkit-input-placeholder {
        color: #e6e2eb;
    }
    .edu-field-holder input:-ms-input-placeholder {
        color: #e6e2eb;
    }
    .edu-field-holder input::placeholder {
        color: #e6e2eb;
    }
    .edu-auth-row:before, .edu-auth-row:after {
        content: "";
        position: absolute;
        height: 120px;
        width: 120px;
    }
    .edu-auth-row:before {
        top: 0;
        left: 0;
        background-image: url(<?php echo $basepath;?>assets/images/auth-left.svg);
        background-repeat: no-repeat;
    }
    .edu-auth-row:after {
        bottom: 0;
        right: 0;
        background-image: url(<?php echo $basepath;?>assets/images/auth-right.svg);
        background-repeat: no-repeat;
        background-position: bottom right;
    }
    .edu-auth-head p:first-of-type {
        margin: 0 0 30px;
    }
    @media (max-width: 575.98px) { 
        .edu-auth-row {
            padding: 50px 50px 50px;
        }
    }
</style>
</head>
  <!-- Body Start -->
<body>
<!-- Auth wrapper start -->
<div class="edu-auth-panel">
    <div class="edu-auth-container">
        <div class="edu-auth-row">
            <div class="edu-auth-logo text-center">
                <a href="javascript:void(0);">
                    <img src="<?php echo $basepath;?>assets/images/e-logo.png" alt="Themeportal">
                </a>
            </div>
            <div class="edu-auth-head text-center">
                <h5 id="errText"> <?php echo isset($message) ? $message : 'Welcome to E Academy' ;?> </h5>
                <p id="reidrect">Please register your purchase code <a target="_blank" href="https://pixelnx.com/verify_envato_purchase/">Here</a></p>
                <p>After registering your Purchase Code fill out the below details to</p>
                <h4>Verify your purchase</h4>
            </div>
            <!-- Form Var -->
            <?php if($laterForm == '') { ?>
                <div id="domaincheck">
                    <div class="edu-auth-form">
                        <div class="edu-field-holder">
                            <label>Purchase Code</label>
                            <input type="text" id="purchase_code" placeholder="Enter Your Code" />
                        </div>
                        <div class="edu-field-holder">
                            <label>Contact Email</label>
                            <input type="text" id="purchase_email" placeholder="example@gmail.com" />
                        </div>
                        <input type="hidden" value="<?php echo $basepath;?>" id="cust_domain" />
                        <div class="edu-auth-btn">
                            <!-- <input type="button" class="edu-btn" onclick="verify_purchase_code(this)" value="Verfiy" /> -->

                            <button type="button" class="edu-btn" onclick="verify_purchase_code(this)" value="Verfiy">
                                Verfiy
                            </button>
                        </div>                       
                    </div>
                </div>
            <?php } ?>
            
            <!-- Var Calling -->
            <form action="" method="post" id="installerform">
                <?php echo $laterForm; ?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $basepath;?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>assets/js/creatorjs.js"></script>
</body>
</html>
