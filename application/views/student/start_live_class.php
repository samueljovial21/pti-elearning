<!DOCTYPE html>
<head>
    <title> <?php echo html_escape($this->common->siteTitle).((isset($title) && !empty($title)) ? ' | '.$title:'');?></title>
    <meta charset="utf-8" />
    <!-- <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.8/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.8/css/react-select.css" /> -->
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.5/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.5/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo html_escape($this->common->siteFavicon); ?>" />
</head>
<body>
    	
        <div class="container">
            <div id="navbar" class="websdktest">
                <form class="navbar-form navbar-right" id="meeting_form">
                    <div class="form-group">
                        <input type="hidden" name="display_name" id="display_name" value="<?php if(!empty($display_name)){ echo $display_name; }?>" maxLength="100"
                            placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_name'));?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="meeting_number" id="meeting_number" value="<?php if(!empty($meeting_number)){ echo $meeting_number; }?>" maxLength="11"
                            style="width:150px" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_meeting_number'));?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="meeting_pwd" id="meeting_pwd" value="<?php if(!empty($password)){ echo $password; }?>" style="width:150px"
                            maxLength="32" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_meeting_password'));?>" class="form-control" >
                    </div>
                </form>
            </div>
           
        </div>
    

    <input type="hidden" value="<?php echo base_url();?>student/dashboard" id="leaveurl" >
    <input type="hidden" value="<?php if(!empty($signature)){echo $signature; }?>" id="signature" >
    <input type="hidden" value="<?php if(!empty($api_key)){ echo $api_key; }?>" id="api_key" >
    <div id="show-test-tool">
    </div>
<!--     <script src="https://source.zoom.us/1.7.10/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.7.10/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.7.10/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.7.10/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.10/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.7.10/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.7.10.min.js"></script> -->

    <script src="https://source.zoom.us/1.8.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.8.5.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/zoom/tool.js"></script>
    <script src="<?php echo base_url();?>assets/js/zoom/index.js"></script>
    
</body>

</html>