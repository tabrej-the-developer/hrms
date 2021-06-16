<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>HRMS : Landing Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.min.css">
        <link href="<?php echo base_url(); ?>assets/css/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header clearfix"  data-aos="fade-down">
            <div class="container">
                <div class="logo">
                    <a href="index.html">
                        <img src="<?php echo base_url(); ?>assets/images/landing/logo.png">
                    </a>
                </div>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="<?php echo base_url('welcome/login'); ?>">Sign Up</a></li>
                </ul>
            </div>
        </div>
        <div class="bannerBg clearfix">
        <div class="container">
            
        <div class="social" data-aos="fade-up">
            Follow us on : <a class="facebook" href="#"><span></span></a> <a class="twitter" href="#"><span></span></a>
        </div>
            <h1 data-aos="fade-up">Let us take care of your HRMS101</h1>
            <h6 data-aos="fade-up">With HRMS101 management of your administrative roles in an organization becomes easy to manage. Our team makes your company’s HR services tech-friendly. It’s your key to success!</h6>
            <a class="button" data-aos="fade-up" href="<?php echo base_url('welcome/login'); ?>">Get Started Now</a>
            <img class="laptop" data-aos="zoom-in" src="<?php echo base_url(); ?>assets/images/landing/laptop.png">
        </div>
        </div>

        <div id="features" class="features clearfix">
            <div class="container">
                <div class="featuresText">
                    <h2>Know more about HRMS features</h2>
                    <p>HRMS101 features innovating your world. HRMS101 provide features that make greater motivation and a greater human resources approach to management</p>
                    <ul>
                        <li data-aos="fade-up">
                            <img src="<?php echo base_url(); ?>assets/images/landing/feature1.png">
                            <h3>Roster</h3>
                            <p>The Roster module assists you in forming rosters for your employees. You can set a date and time for each employee, the admin can check and formulate changes in rosters of all centres. This helps you in checking and maintaining the record.</p>
                        </li>
                        <li data-aos="fade-up">
                            <img src="<?php echo base_url(); ?>assets/images/landing/feature2.png">
                            <h3>Time sheet</h3>
                            <p>The Timesheet module with a quick yet comprehensive view for employees to fill their activities, duration, visits.  It lets them focus on their real job rather than filling time and its layout will not let them miss any small detail.</p>
                        </li>
                        <li data-aos="fade-up">
                            <img src="<?php echo base_url(); ?>assets/images/landing/feature3.png">
                            <h3>Leave module</h3>
                            <p>The Leave module features your leave. It includes everything required in an application for leave from reason to applied date and it’s status. Exerting long procedure of communication with HR. </p>
                        </li>
                        <li data-aos="fade-up">
                            <img src="<?php echo base_url(); ?>assets/images/landing/feature4.png">
                            <h3>Payroll</h3>
                            <p>The Payroll option holds an updated sheet of employees with their name, taxes, mode of payment. This option is not just beneficial to the company but for the employee to track their paycheck avoiding future payment conflicts. </p>
                        </li>
                        <li data-aos="fade-up">
                            <img src="<?php echo base_url(); ?>assets/images/landing/feature5.png">
                            <h3>Chat Module</h3>
                            <p>The Chat101 module where you can interact with your office employees giving rise to easier and safer communication.  This helps in icebreaking among employees and focusing on a harmonious and unity among workplace. </p>
                        </li>
                        <li data-aos="fade-up">
                            <img src="<?php echo base_url(); ?>assets/images/landing/feature6.png">
                            <h3>Minutes of meeting</h3>
                            <p>Formulating an event in the HRMS101 app allows you to decide the agenda of the meeting to be discussed. Minutes of meeting shows you the number of people and their text. We can also mention the summary of the meeting as well. </p>
                        </li>
             
                    </ul>
                    <!-- <a class="button" href="#">Read More</a> -->
                </div>
                <!-- <div class="featurePoint ">
                    <div class="featurePointDiv rightDiv firstArrow" data-aos="fade-right">
                        <img src="<?php // echo base_url(); ?>assets/images/landing/mic.png">
                        <span>
                            <h5>Market research</h5>
                            <p>loremipsumdolor sit amet</p>
                        </span>
                    </div>
                    <div class="featurePointDiv" data-aos="fade-left">
                        <img src="<?php // echo base_url(); ?>assets/images/landing/chess.png">
                        <span>
                            <h5>Stategy & Direction</h5>
                            <p>loremipsumdolor sit amet</p>
                        </span>
                    </div>
                    <div class="featurePointDiv rightDiv lastArrow" data-aos="fade-right">
                        <img src="<?php // echo base_url(); ?>assets/images/landing/one.png">
                        <span>
                            <h5>Brand Marketing</h5>
                            <p>loremipsumdolor sit amet</p>
                        </span>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="seeHowWeWork clearfix">
            <video autoplay muted loop id="myVideo">
                <source src="<?php echo base_url(); ?>assets/images/landing/video.mp4" type="video/mp4">
            </video>
            <div class="container">
                <h2>See How We Work</h2>
                <p>Everything you need to increase your company’s efficiency in one platform HRMS101.</p>
                <a class="Play" data-aos="flip-left" href="#">Play</a>
            </div>
        </div>

        <div class="popUp" style="display: none;">
            <span class="cross"></span>
            <video autoplay muted loop id="myVideo" controls>
                <source src="<?php echo base_url(); ?>assets/images/landing/video.mp4" type="video/mp4">
            </video>
        </div>

        <div class="sliderSection">
            <div class="container">
                <h2>One platform for <br>Roster, Timesheet, Payroll, <br>Leave, Chat, And Notice</h2>

                <div class="owl-carousel">
                    <div data-aos="flip-left">
                        <img src="<?php echo base_url(); ?>assets/images/landing/slider1.png">
                    </div>
                    <div data-aos="flip-left">
                        <img src="<?php echo base_url(); ?>assets/images/landing/slider2.png">
                    </div>
                    <div data-aos="flip-left">
                        <img src="<?php echo base_url(); ?>assets/images/landing/slider3.png">
                    </div>
                    <div data-aos="flip-left">
                        <img src="<?php echo base_url(); ?>assets/images/landing/slider4.png">
                    </div>
                    <div data-aos="flip-left">
                        <img src="<?php echo base_url(); ?>assets/images/landing/slider5.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <ul class="footerMenu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="<?php base_url('welcom/login'); ?>">Sign Up</a></li>
                </ul>
                <p>Copyright © 2021. All rights Reserved.</p>
            </div>
        </div>


        
        
        <script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/aos.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
        
        <script>
            AOS.init({
                easing: 'ease-in-out-sine'
            });
        </script>
    </body>
</html>
