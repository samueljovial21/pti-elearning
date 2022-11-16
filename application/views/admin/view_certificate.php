<!DOCTYPE html>
<html <?php if($this->common->language_name=='arabic'){echo 'lang="ar" dir="rtl"';}else if($this->common->language_name=='french'){echo 'lang="fr" dir="ltr"';}else if($this->common->language_name=='english'){echo 'lang="en" dir="ltr"';} ?> >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
    <style>
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
    background: url("<?php echo base_url('assets/images/certificate_bg.png'); ?>");
    width: 1203px;
    height: 871px;
    margin: auto;
    position: relative;
    
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
    margin-top: 100px;
}
.certificate_discrip {
    font-size: 18px;
    text-align: center;
    padding: 0 12%;
    line-height: 28px;
}
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
/*for rtl css*/
.rtl .edu_certifiate_heading {
    padding: 140px 180px 0 0;
}
.rtl .certifiate_main_logo {
    right: auto;
    left: 132px;
}
.rtl .title2 {
    padding-left: 0;
    padding-right: 264px;
}
.rtl .title2:after {
    left: auto;
    right: -162px;
}
.rtl .certifiate_date {
    left: auto;
    right: 233px;
}
.rtl .certifiate_sign {
    right: auto;
    left: 171px;
}
.rtl .edu_certifiate_wrapper {
    background: url("<?php echo base_url('assets/images/rtl/rtlcertificate_bg.png'); ?>");
}
    </style>
  </head>
<body class="form <?php if($this->common->language_name=='arabic'){ echo 'rtl';}?>">
    
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
                <h2 class="name_title"> <?php echo $student_name['name'];?></h2>
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
      <div class="certificate_btn_wrap"><input class="certificate_btn " data-pdfu="<?php echo $uid ; ?>" data-pdfb="<?php echo $batch_id ; ?>"  data-pdf_url="<?php echo $baseurl ; ?>" type="button" id="dwl_create_pdf" value="Download"> </div> 
    <?php  }else{
    echo "<p style='text-align: center;' >You will get your Certification after finishing the course</p>";
    
    } ?>
</body>
</html>