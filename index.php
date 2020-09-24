<?php 
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
// instantiate and use the dompdf class
$options = new Options();
$options->set('defaultFont', 'Courier');
$options->set('isRemoteEnabled', TRUE);
$options->set('debugKeepTemp', TRUE);
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

// Dengan menggunakan output buffer
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>enjoycom</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        @font-face {
            font-family: FontPoppins;
            src: url(http://localhost/ticket-dompdf/assets/fonts/Poppins-Regular.ttf) format("truetype");
        }
        @font-face {
            font-family: FontPoppinsBold;
            src: url(http://localhost/ticket-dompdf/assets/fonts/Poppins-Bold.ttf) format("truetype");
        }
        body {
            margin: 0cm;
            padding: 0cm;
        }
        * {
            margin: 0cm;
            padding: 0cm;
            font-family: FontPoppins, Verdana, Tahoma;
            letter-spacing: 0.05em;
        }
        .bolderfont{
            font-family: FontPoppinsBold, Verdana, Tahoma;
            letter-spacing: 0.05em;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        header{
            margin: 0.5cm;
            margin-bottom: 0cm;
        }
        header .logo{
            margin-top: 0.5cm;
        }
        .light-color{
            color: #006161;
        }
        .dark-color{
            color: #003333;
        }
        .image-container{
            position: relative;
            width: 100%;
        }
        main{
            padding: 0cm 1cm;
        }
        .nama-tempat{
            font-family: FontPoppins, Verdana, Tahoma;
            font-size: 20px;
        }
    </style>

</head>
<body>

<header>
    <table width="100%">
        <tr>
            <td class="logo" align="left" style="width: 50%;">
                <img src="http://localhost/ticket-dompdf/assets/pic/enjoycom.png" alt="Logo" width="164" class="logo"/>
                <p class="dark-color bolderfont" style="padding-top: 0.2cm; font-size: 16px; ">Voucher Hotel</p>
            </td>
            <td align="right" style="width: 50%;">
                <table width="100%" style="margin-top:0.4cm">
                    <tr>
                        <td align="left" style="width: 20%;"></td>
                        <td align="center" style="width: 80%;">
                            <p class="dark-color" style="padding-bottom: 0.2cm;">Kode Perjalanan Anda</p>
                            <div class="img-container">
                                <img src="http://localhost/ticket-dompdf/assets/pic/enjoycom-id.png" alt="Logo" width="260"/>
                                <p class="bolderfont" style="position: absolute; top: 54px; right: 40px; width: 100%; color:white; font-size: 20px;letter-spacing: 0.08em;">24092020</p>
                            </div>
                        </td>
                    </tr>
                </table>
                <p class="light-color">Dipesan dan dibayarkan oleh Enjoy.com : 08111999</p>
            </td>
        </tr>
    </table>
</header>

<hr class="dark-color" style="height: 0.1px; margin: 0.1cm 0cm; opacity: 0.5;"/>

<main>
    <p class="nama-tempat">Sunway Pyramid Hotel</p>
    <table width="100%">
        <tr>
            <td style="border: 1px solid black" width="50%">
                <table width="100%">
                    <tr>
                        <td style="border: 1px solid black" width="10%" align="center">
                        <img src="http://localhost/ticket-dompdf/assets/pic/enjoycom-loc.png" alt="Logo" width="20" class="logo"/>
                        </td>
                        <td style="border: 1px solid black" width="50%">
                        hello
                        </td>
                    </tr>
                </table>
            </td>
            <td style="border: 1px solid black" width="50%">
                hello
            </td>
        </tr>
    </table>
</main>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Company Slogan
            </td>
        </tr>

    </table>
</div>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('your-ticket.pdf', Array('Attachment' => 0));
?>