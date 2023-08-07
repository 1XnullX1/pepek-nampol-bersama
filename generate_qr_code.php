<?php
// Memanggil library PHP QR Code
include "phpqrcode/qrlib.php";

// Isi QR code yang ingin dibuat. Akan muncul saat discan
$isi = $_GET['value'];

// Menggunakan ob_start() untuk menangkap output dan menyimpannya dalam variabel
ob_start();
QRcode::png($isi, null, QR_ECLEVEL_L, 10, 2);
$gambarQRCode = ob_get_contents();
ob_end_clean();

// Mengubah gambar QR code menjadi URL data dalam format base64
$gambarQRCodeBase64 = base64_encode($gambarQRCode);
$urlGambarQRCode = 'data:image/png;base64,' . $gambarQRCodeBase64;

?>
<?php echo $urlGambarQRCode; ?>