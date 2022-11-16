<?php
if(empty($student_certificate)){
    echo '<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder"><section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">Certificate has not issued yet.</div>
                            </div>
                        </div>
                    </section></div> 
</section> ';
}else{
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
    <style >
   
body {
    background: #f7f7fb;
    font-weight: 400;
    font-size: 16px;
    line-height: 26px;
    color: #888888;
    font-family: 'Poppins', sans-serif;
    transform:scale(1);
    }
.edu_certifiate_heading {
    padding: 140px 0 0 181px;
    }
.edu_certifiate_wrapper {
    background-image: url(<?php echo base_url('/assets/images/certificate_bg.png');?>);
    width: 1210px;
    height: 850px;
    margin: auto;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
.title1 {
    font-size: 80px;
    text-transform: uppercase;
    color: #4267C8;
    margin-bottom: 37px;
}
.title2 {
    font-size: 30px;
    font-weight: 400;
    text-transform: uppercase;
    color: #f0c586;
    position: relative;
    display: inline-block;
    padding: 0;
    margin: 0;
    padding-left: 264px;
}
.certifiate_prodly_wrap {
    text-align: center;
}
.certificate_Proudly {
    font-size: 26px;
    color: #4d4784;
    font-weight: 500;
    margin-top: 40px;
}
.name_title {
    font-size: 45px;
    font-weight: 700;
    text-transform: capitalize;
    text-align: center;
    color: #242424;
    margin-bottom: 33px;
    margin-top: 50px;
}
.certificate_discrip {
    font-size: 18px;
    text-align: center;
    padding: 0 12%;
    line-height: 28px;
}
/*.certifiate_main_logo {*/
/*position: absolute;*/
/*    top: 140px;*/
/*    right: 140px;*/
/*    width: 160px;*/
/*    height: 186px;*/
/*    display: flex;*/
/*    justify-content: center;*/
/*    align-items: center;*/
/*}*/
.certifiate_main_logo {
    position: absolute;
    top: 140px;
    right: 132px;
    width: 180px;
    height: 180px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 100%;
    overflow: hidden;
}
.certificate_logo {
    width: 70%;
}
.certifiate_date {
    position: absolute;
    bottom: 160px;
    left: 233px;
    color: #4d4784;
    font-weight: 500;
    font-size: 20px;
}
.certifiate_sign {
    position: absolute;
    right: 171px;
    bottom: 173px;
    width: 100px;
    height: 50px;
}
.certifiate_sign > img {
    width: 100px;
    height: 50px;
    object-fit: contain;
}

.title2:after {
    content: "";
    position: absolute;
    left: -164px;
    width: 420px;
    top: 0;
    height: 23px;
    background: #fcd195;
    bottom: 0;
    margin: auto;
}
.certificate_btn {
    height: 45px;
    line-height: 45px;
    text-align: center;
    padding: 0 15px;
    background-color: #4267C8;
    display: inline-block;
    font-size: 14px;
    color: #ffffff;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    outline: none;
    min-width: 170px;
    position: relative;
    box-shadow: none;
    text-transform: uppercase;
}
.certificate_btn_wrap {
    text-align: center;
}

    </style>
  </head>
<body class="form">
    <?php if(!empty($student_certificate)){ ?>
<div class="conatiner_certificate">   
    <div class="edu_certifiate_wrapper">
        <div class="edu_certifiate_inner">
           <div class="edu_certifiate_heading">
                <h1 class="title1"><?php echo $certificate_details[0]['heading']?></h1>
                <h4 class="title2"> <?php echo $certificate_details[0]['sub_heading']?></h4>
            </div> 
            <div class="certifiate_prodly_wrap">
                <h2 class="certificate_Proudly"> <?php echo $certificate_details[0]['title']?></h2>
            </div> 
             
            <div class="certifiate_name_wrap">
                <h2 class="name_title"> <?php echo $this->session->userdata('name');?></h2>
            </div>
           <p class="certificate_discrip"><?php echo str_replace('{batch}','<b>'.$batchdata[0]['batch_name'].'</b>', $certificate_details[0]['description']);?></p>
            
        </div>
        <div class="certifiate_date">
            <p><?php echo date('d-m-Y',strtotime($student_certificate[0]['date']));?></p>
        </div>
        <div class="certifiate_sign">
            <img src="<?php echo base_url();?>uploads/site_data/<?php echo $certificate_details[0]['signature_image'];?>" alt="signature">
        </div>
        
    
         <div class="certifiate_main_logo">
             
            <img src="<?php echo base_url();?>uploads/site_data/<?php echo $certificate_details[0]['certificate_logo'];?>" class="certificate_logo" alt="Logo">
        </div>
    </div>
    // <div class="certificate_btn_wrap"><input class="certificate_btn " data-pdfu="<?php echo $uid ; ?>" data-pdfb="<?php echo $batch_id ; ?>"  data-pdf_url="<?php echo $baseurl ; ?>" type="button" id="dwl_create_pdf" value="Download"> </div> 
    <?php  }else{
    echo "<p style='text-align: center;' >You will get your Certification after finishing the course</p>";
    
    } ?>
</body>
</html>

    
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
   <script>  
    (function () {  
        var  
         form = $('.form'),  
         cache_width = form.width(),  
         a4 = [595.28, 841.89]; // for a4 size paper width and height  

        $('#create_pdf').on('click', function () {  
            $('body').scrollTop(0);  
            $(this).hide();
            createPDF();  
        });  
        //create pdf  
        function createPDF() {  
            getCanvas().then(function (canvas) {  
                var  
                 img = canvas.toDataURL("image/png"),  
                 doc = new jsPDF({  
                     unit: 'px',  
                     format: [545.28, 725],
                     orientation :'landscape'
                 });  
                 
                doc.addImage(img, 'JPEG', 20, 20);  
                doc.save('<?php echo $this->session->userdata('name');?>'+'.pdf');  
                form.width(cache_width);  
            });  
        }  

        // create canvas object  
        function getCanvas() {  
            form.width((a4[0] * 1)).css('max-width', 'none');  
            return html2canvas(form, {  
                imageTimeout: 2000,  
                removeContainer: true  
            });  
        }  

    }());  
</script>  
<script>  
    /* 
 * jQuery helper plugin for examples and tests 
 */  	
 
    $(document).on('click','#dwl_create_pdf',function(){
    
    var pdfu = $(this).attr('data-pdfu');
    var pdfb = $(this).attr('data-pdfb');
    var base_url = $(this).attr('data-pdf_url');
        if(pdfu){
        	$.ajax({
				method: "POST",
				url: base_url+'ajaxcall/certificate_pdf_view',
				data: {'pdfb':pdfb, 'pdfu':pdfu},
				success: function(resp){
					var resp = $.parseJSON(resp);
					if(resp['status'] == '1'){
					    var file_path = resp['filesUrl']+resp['fileName'];
                        var a = document.createElement('A');
                        a.href = file_path;
                        a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
					}else if(resp['status'] == '2'){
						console.log(resp['msg']);
					}else{
						console.log('Something went wrong, Please try again.');
					}
					$('.edu_preloader').fadeOut();
				},
				error:function(resp){
					console.log('Something went wrong, Please try again.');
					$('.edu_preloader').fadeOut();
				}
			});   
        }
    });
    (function ($) {  
        $.fn.html2canvas = function (options) {  
            var date = new Date(),  
            $message = null,  
            timeoutTimer = false,  
            timer = date.getTime();  
            html2canvas.logging = options && options.logging;  
            html2canvas.Preload(this[0], $.extend({  
                complete: function (images) {  
                    var queue = html2canvas.Parse(this[0], images, options),  
                    $canvas = $(html2canvas.Renderer(queue, options)),  
                    finishTime = new Date();  

                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);  
                    $canvas.siblings().toggle();  

                    $(window).click(function () {  
                        if (!$canvas.is(':visible')) {  
                            $canvas.toggle().siblings().toggle();  
                            throwMessage("Canvas Render visible");  
                        } else {  
                            $canvas.siblings().toggle();  
                            $canvas.toggle();  
                            throwMessage("Canvas Render hidden");  
                        }  
                    });  
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);  
                }  
            }, options));  

            function throwMessage(msg, duration) {  
                window.clearTimeout(timeoutTimer);  
                timeoutTimer = window.setTimeout(function () {  
                    $message.fadeOut(function () {  
                        $message.remove();  
                    });  
                }, duration || 2000);  
                if ($message)  
                    $message.remove();  
                $message = $('<div ></div>').html(msg).css({  
                    margin: 0,  
                    padding: 10,  
                    background: "#000",  
                    opacity: 0.7,  
                    position: "fixed",  
                    top: 10,  
                    right: 10,  
                    fontFamily: 'Tahoma',  
                    color: '#fff',  
                    fontSize: 12,  
                    borderRadius: 12,  
                    width: 'auto',  
                    height: 'auto',  
                    textAlign: 'center',  
                    textDecoration: 'none'  
                }).hide().fadeIn().appendTo('body');  
            }  
        };  
    })(jQuery);  

</script>   
<?php } ?>