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

// file koneksi php
$server = "localhost";
$username = "root";
$password = "";
$database = "ticket-dompdf";
$koneksi= mysqli_connect($server,$username,$password,$database) or die("Koneksi gagal");
if(mysqli_connect_errno()){
    echo 'gagal terhubung';
}

// Dengan menggunakan output buffer
ob_start();  
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        function getDateText($date){
            $str = explode('-', $date, 3);
            $hasil = $str[2];
            switch($str[1]){
                case '01' : $hasil.=' Januari '; break;
                case '02' : $hasil.= ' Februari '; break;
                case '03' : $hasil.= ' Maret '; break;
                case '04' : $hasil.= ' April '; break;
                case '05' : $hasil.= ' Mei '; break;
                case '06' : $hasil.= ' Juni '; break;
                case '07' : $hasil.= ' Juli '; break;
                case '08' : $hasil.= ' Agustus '; break;
                case '09' : $hasil.= ' September '; break;
                case '10' : $hasil.= ' Oktober '; break;
                case '11' : $hasil.= ' November '; break;
                case '12' : $hasil.= ' Desember '; break;
                default : echo 'ERROR'; break;
            }
            $hasil .= $str[0];
            return $hasil;
        }
        
        // Kunci untuk mengganti data
        $customer_id = 1;

        // Lakukan query
        $sql = "SELECT *, h.name AS hotel_name, b.id AS booking_id FROM booking b LEFT JOIN hotel h ON b.hotel_id = h.id LEFT JOIN customer c ON ".$customer_id." = c.id WHERE b.customer_id = ".$customer_id;
        $query = mysqli_query($koneksi, $sql) or die(mysqli_error());
        while($hasil = mysqli_fetch_array($query)){
            $booking_id = $hasil['booking_id'];
            $hotel_name = $hasil['hotel_name'];
            $hotel_loc = $hasil['location'];
            $hotel_telp = '+'.$hasil['telp'];
            $emoney_id = $hasil['emoney_id'];
            $check_in = $hasil['check_in'];
            $check_out = $hasil['check_out'];
            $name = $hasil['name'];
            $room_type = $hasil['room_type'];
            $room_count = $hasil['room_count'];
            $guest_per_room_count = $hasil['guest_per_room_count'];
            $eating = $hasil['breakfast'];
            $promo = $hasil['promo'];
            $emoney_id = $hasil['emoney_id'];
            $image = $hasil['image'];
        }
        
        $check_in = getDateText($check_in);
        $check_out = getDateText($check_out);
    ?>

    <meta charset="UTF-8">
    <title><?php echo $booking_id.'_'.$name ?></title>

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
        .deskripsi{
            color: #353336;
        }
        .vl {
            border-left: 4px solid #006161;
            height: 1cm;
            margin-left: 0.5cm;
        }
        .br{
            display: block;
            margin-bottom: 0em;
        }
        footer{
            margin-top: 0.5cm;
            padding: 0cm 1cm;
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
                                    <p class="bolderfont" style="position: absolute; top: 54px; right: 40px; width: 100%; color:white; font-size: 20px;letter-spacing: 0.08em;"><?php echo $booking_id?></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <p class="light-color">Dipesan dan dibayarkan oleh Enjoy.com : <?php echo $emoney_id ?></p>
                </td>
            </tr>
        </table>
    </header>
    <hr class="dark-color" style="height: 0.1px; margin: 0.1cm 0cm; opacity: 0.5;"/>
    <main>
        <p class="nama-tempat"><?php echo $hotel_name ?></p>
        <table width="100%">
            <tr>
                <td  width="50%">
                    <table width="100%">
                        <tr>
                            <td  width="10%" align="center">
                                <img src="http://localhost/ticket-dompdf/assets/pic/enjoycom-loc.png" alt="Logo" width="20" class="logo" style="opacity: 0.6"/>
                            </td>
                            <td  width="50%">
                                <p class="deskripsi"><?php echo $hotel_loc ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td  width="10%" align="center">
                            <img src="http://localhost/ticket-dompdf/assets/pic/enjoycom-telp.png" alt="Logo" width="20" class="logo" style="opacity: 0.6"/>
                            </td>
                            <td  width="50%">
                                <p class="deskripsi"><?php echo $hotel_telp ?></p>
                            </td>
                        </tr>
                        <tr>
                        <table width="100%" style="padding-top:1cm;">
                            <tr>
                                <td  width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="20%" >
                                                <div class="vl"></div>
                                            </td>
                                            <td width="80%" >
                                                <p class="deskripsi">Check-In</p>
                                                <p style="font-size:14px; margin-top: -8px"><?php echo $check_in ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td  width="50%">
                                <table width="100%">
                                        <tr>
                                            <td width="20%" >
                                                <div class="vl"></div>
                                            </td>
                                            <td width="80%" >
                                                <p class="deskripsi">Check-Out</p>
                                                <p style="font-size:14px; margin-top: -8px"><?php echo $check_out ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        </tr>
                    </table>
                </td>
                <td  width="50%" align="right">
                    <img src=<?php echo "http://localhost/ticket-dompdf/assets/pic/".$image?> alt="Logo" width="300" class="logo"/>
                </td>
            </tr>
        </table>

        <table width="100%" cellpadding="0" border="0" align="center" cellspacing="0" style="margin-top: 1cm;">
            <tr bgcolor="#006161">
                <td><p style="border: 1px solid #006161; padding-left: 1cm;color: white;padding-bottom: 0.1cm" class="bolderfont">Detail Pemesanan</p></td>
            </tr>
            <tr>
                <td style="border: 1px solid #006161;">
                    <table width="100%" style="padding-left: 1cm;">
                        <tr>
                            <td width="24%" style="padding-top:0.4cm; padding-bottom: 0.1cm;"><p class="deskripsi">Tamu</p></td>
                            <td width="66%">: <?php echo $name ?></td>
                        </tr>
                        <tr>
                            <td width="24%" style="padding:0.1cm 0cm"><p class="deskripsi">Tipe Kamar</p></td>
                            <td width="66%">: <?php echo $room_type ?></td>
                        </tr>
                        <tr>
                            <td width="24%" style="padding:0.1cm 0cm"><p class="deskripsi">Jumlah Kamar</p></td>
                            <td width="66%">: <?php echo $room_count ?></td>
                        </tr>
                        <tr>
                            <td width="24%" style="padding:0.1cm 0cm"><p class="deskripsi">Tamu per Kamar</p></td>
                            <td width="66%">: <?php echo $guest_per_room_count ?></td>
                        </tr>
                        <tr>
                            <td width="24%" style="padding:0.1cm 0cm"><p class="deskripsi">Sarapan</p></td>
                            <td width="66%">: <?php echo $eating ?></td>
                        </tr>
                        <tr>
                            <td width="24%" style="padding-top:0.05cm; padding-bottom: 0.4cm;"><p class="deskripsi">Permintaan Khusus</p></td>
                            <td width="66%">: <?php echo $promo ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" cellpadding="0" border="0" align="center" cellspacing="0" style="margin-top: 0.5cm;">
            <tr bgcolor="#006161">
                <td><p style="border: 1px solid #006161; padding-left: 1cm;color: white;padding-bottom: 0.1cm" class="bolderfont">Hotel Deal : HARGA GELEDEK</p></td>
            </tr>
        </table>
    </main>
    <footer>
            <p class="light-color bolderfont" style="font-size: 14px;">
                Kebijakan Pembatalan
            </p>
            <p style="font-size: 10px;padding-left:1cm;">
                Pesanan ini tidak dapat dibatalkan atau diubah. Apabila tidak datang, pembayaran yang sudah diterima tidak dapat diuangkan kembali. 
            </p>
    </footer>

    <table width="100%">
        <tr valign="center">
            <td width="44%">
                <div style="border-bottom:1px dashed #006161; margin-top:0.5cm; opacity: 0.5"></div>
            </td>
            <td width="12%" align="center">
                <p style="color: #006161;opacity: 0.5">Potong Disini</p>
            </td>
            <td width="44%">
                <div style="border-bottom:1px dashed #006161; margin-top:0.5cm; opacity: 0.5"></div>
            </td>
        </tr>
    </table>
    
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
$dompdf->stream($booking_id.'_'.$name, Array('Attachment' => 0));
?>