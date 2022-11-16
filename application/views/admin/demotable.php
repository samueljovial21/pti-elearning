<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
    <style>
body {
    background: #f7f7fb;
    font-weight: 400;
    font-size: 16px;
    line-height: 26px;
    color: #888888;
    font-family: 'Poppins', sans-serif;
    }
.edu_certifiate_heading {
    padding: 140px 0 0 181px;
    }
.edu_certifiate_wrapper {
    background: url(<?=base_url().'assets/images/certificate_bg.png';?>);
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
    font-size: 74px;
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
    padding: 0 270px;
    line-height: 28px;
}
.certifiate_main_logo {
    position: absolute;
    top: 140px;
    right: 129px;
    width: 185px;
    height: 186px;
}
.certifiate_date {
    position: absolute;
    bottom: 160px;
    left: 243px;
}
.certifiate_sign {
    position: absolute;
    right: 190px;
    bottom: 160px;
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

    </style>
  </head>
<body >
    <div class="conatiner_certificate">
        <div class="edu_certifiate_wrapper">
            <div class="edu_certifiate_inner">
               <div class="edu_certifiate_heading">
                    <h1 class="title1">certificate</h1>
                    <h4 class="title2"> of apreciation</h4>
                </div> 
                <div class="certifiate_prodly_wrap">
                    <h2 class="certificate_Proudly"> Proudly Presented to</h2>
                </div> 
                 
                <div class="certifiate_name_wrap">
                    <h2 class="name_title"> Name Surname</h2>
                </div>
               <p class="certificate_discrip">Lorem Ipsum is simply dummy as printing and typesetting industry
                Ipsum has been the industry's standard dummy text ever.</p>
                
            </div>
            <div class="certifiate_date">
                <p>11-02-2020</p>
            </div>
            <div class="certifiate_sign">
                <p>signature</p>
            </div>
             <div class="certifiate_main_logo">
                <img src="<?=base_url();?>assets/images/cirtificate_mainlogo.png" class="certificate_logo" alt="Logo">
            </div>
        </div>
    </div>
</body>
</html>







