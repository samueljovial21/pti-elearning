  
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
	<?php 
	print_r(base_url());
	die();
	?>
    <body>
       <script>
    Object.defineProperty(window.navigator, 'userAgent', {
      get: function () { return 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/80.0.3987.163 Chrome/80.0.3987.163 Safari/537.36'; }
    });
  </script>
        <div id="meet"></div>
        <script src="<?=base_url();?>liveclassdemo/external_api.js"></script>
        <script>
            var domain = "meet.jit.si";
            var options = {
                roomName: "mfgbk896uhogmob,mg[po5609",
                width: "100%",
                height: "100%",
                parentNode: document.querySelector("#meet"),
                configOverwrite: {
                    filmStripOnly: true,
                    desktopSharingChromeDisabled: false
                },
                interfaceConfigOverwrite: { DEFAULT_BACKGROUND: '#ffffff',TOOLBAR_BUTTONS:[
        'microphone', 'camera', 'closedcaptions',  
        'fodeviceselection', 'hangup', 'profile', 'chat',
        , 'etherpad',  'settings', 'raisehand',
        'videoquality', 'filmstrip', 'stats',
        'tileview'
    ] },

            }
            var api = new JitsiMeetExternalAPI(domain, options);
            api.executeCommand('displayName', 'student');
            api.executeCommand('subject', 'Maths');
            api.on('readyToClose', () => {
                window.location.href = "<?=base_url();?>liveclassdemo/";
            });
            
  
        </script>
    </body>
</html>
