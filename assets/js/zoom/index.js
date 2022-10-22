(function(){
    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();
    
    /*testTool = window.testTool;
    window.addEventListener('load', function(e){
        e.preventDefault();
        
       var API_KEY = document.getElementById('api_key').value;
        var meetConfig = {
            apiKey: API_KEY,
            meetingNumber: parseInt(document.getElementById('meeting_number').value),
            userName: document.getElementById('display_name').value,
            passWord: document.getElementById('meeting_pwd').value,
            leaveUrl: document.getElementById('leaveurl').value,
          
        };
        ZoomMtg.init({
            leaveUrl: meetConfig.leaveUrl,
            success: function () {
                ZoomMtg.join(
                    {
                        meetingNumber: meetConfig.meetingNumber,
                        userName: meetConfig.userName,
                        signature: document.getElementById('signature').value,
                        apiKey: meetConfig.apiKey,
                        passWord: meetConfig.passWord,
                        success: function(res){
                            $('#nav-tool').hide();
                           
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    }
                );
            },
            error: function(res) {
                console.log(res);
            }
        });

    });*/

  //   function beginJoin() {
  //       var API_KEY = document.getElementById('api_key').value;
  //       var meetingNumber= parseInt(document.getElementById('meeting_number').value);
  //       var userName= document.getElementById('display_name').value;
  //       var passWord= document.getElementById('meeting_pwd').value;
  //       var leaveUrl= document.getElementById('leaveurl').value;
  //       var signature= document.getElementById('signature').value;
  //   ZoomMtg.init({
  //     leaveUrl: leaveUrl,
  //     webEndpoint: undefined,
  //     success: function () {
  //       $.i18n.reload("en-US");
  //       ZoomMtg.join({
  //         meetingNumber: meetingNumber,
  //         userName: userName,
  //         signature:signature,
  //         apiKey: API_KEY,
  //         userEmail:"",
  //         passWord: passWord,
  //         success: function (res) {
  //           console.log("join meeting success");
  //           console.log("get attendeelist");
  //           ZoomMtg.getAttendeeslist({});
  //           ZoomMtg.getCurrentUser({
  //             success: function (res) {
  //               console.log("success getCurrentUser", res.result.currentUser);
  //             },
  //           });
  //         },
  //         error: function (res) {
  //           console.log(res);
  //         },
  //       });
  //     },
  //     error: function (res) {
  //       console.log(res);
  //     },
  //   });
  // }
   function beginJoin() {
     var API_KEY = document.getElementById('api_key').value;
        var meetingNumber= parseInt(document.getElementById('meeting_number').value);
        var userName= document.getElementById('display_name').value;
        var passWord= document.getElementById('meeting_pwd').value;
        var leaveUrl= document.getElementById('leaveurl').value;
        var signature= document.getElementById('signature').value;
    ZoomMtg.init({
      leaveUrl:leaveUrl,
      success: function () {
        
        ZoomMtg.i18n.load("en-US");
        ZoomMtg.i18n.reload("en-US");
        ZoomMtg.join({
          meetingNumber: meetingNumber,
          userName:userName,
          signature: signature,
          apiKey: API_KEY,
          
          passWord: passWord,
          success: function (res) {
            // console.log("join meeting success");
            // console.log("get attendeelist");
            ZoomMtg.getAttendeeslist({});
            ZoomMtg.getCurrentUser({
              success: function (res) {
                console.log("success getCurrentUser", res.result.currentUser);
              },
            });
          },
          error: function (res) {
            // console.log(res);
          },
        });
      },
      error: function (res) {
        // console.log(res);
      },
    });

    ZoomMtg.inMeetingServiceListener('onUserJoin', function (data) {
      // console.log('inMeetingServiceListener onUserJoin', data);
    });
  
    ZoomMtg.inMeetingServiceListener('onUserLeave', function (data) {
      // console.log('inMeetingServiceListener onUserLeave', data);
    });
  
    ZoomMtg.inMeetingServiceListener('onUserIsInWaitingRoom', function (data) {
      // console.log('inMeetingServiceListener onUserIsInWaitingRoom', data);
    });
  
    ZoomMtg.inMeetingServiceListener('onMeetingStatus', function (data) {
      // console.log('inMeetingServiceListener onMeetingStatus', data);
    });
  }
beginJoin();
})();
