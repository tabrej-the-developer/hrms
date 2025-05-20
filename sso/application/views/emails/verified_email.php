<!DOCTYPE html>
<html lang="en">
<head>
    <?php $url = base_url(); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todquest Email Account Verfication</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap');
        html{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        body{
            font-family: 'Poppins', sans-serif;
            font-weight:300;
        }
        @media screen and (max-width:600px){
            table[class="responsive-table"]{
                width: 100%!important;
            }
            image[class="responsive-image"]{
                max-width: 100%!important;
                height: auto!important;
            }
            .partition-table-2,.partition-table-1{
                width: 100%!important;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- FULL WIDTH CONTAINER -->
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <!-- 600px container -->
                <table width="600" cellspacing="0" cellpadding="0" border="0" class="responsive-table">
                    <tr>
                        <td align="center">
                            <img src="<?= $url ?>assets/images/todquest_logo.png" alt="" width="160" height="60" class="responsive-image">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size:14px;">
                            <h1 style="margin:0;padding:0;">Account Activated</h1>
                            <small>Thank you, your email has been verified. Your account is now active.<br>Please use the link below to login to your account</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><a href="" style="width:50%;background:green;color:white;cursor: pointer;text-decoration: none;border-radius: 10px;padding:5px;display: block;margin: 2%;">LOGIN TO YOUR ACCOUNT</a></center>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <small>Questions? Email us at <a href="mailto:feedback@todquest.com">feedback@todquest.com</a></small>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>