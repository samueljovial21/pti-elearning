  
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <body>
       
        <div id="meet"></div>
        <script src="<?=base_url();?>liveclassdemo/external_api.js"></script>
        <script>
    Object.defineProperty(window.navigator, 'userAgent', {
      get: function () { return 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/80.0.3987.163 Chrome/80.0.3987.163 Safari/537.36'; }
    });
  </script>
        <script>
            var domain = "meet.jit.si";
            var options = {
                roomName: "mfgbk896uhogmob,mg[po5609",
                width: "100%",
                height: "100%",
                parentNode: document.querySelector("#meet"),
                noSSL:true,
                configOverwrite: {  },
                interfaceConfigOverwrite: {  },
                // jwt: 'https://jwt.io/#debugger-io?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJtYXRocyIsIm5hbWUiOiJ0ZWFjaGVyIiwiaWF0IjoyNTgzNjkxNDd9.Nhk8lylUMpcmhhZjEp6fULQ073oGv9gQTzLti-UOkzc',
            }
            var api = new JitsiMeetExternalAPI(domain, options);
            api.executeCommand('displayName', 'teacher');
            api.executeCommand('subject', 'Maths');
            api.on('readyToClose', () => {
                window.location.href = "<?=base_url();?>liveclassdemo/";
            });
            api.addEventListener('participantRoleChanged', function(event) {
                console.log(event);
                if (event.role === "moderator") {
                    api.executeCommand('password', '123');
                }
            });
        </script>
    </body>
</html>
