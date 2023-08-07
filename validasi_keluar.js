// menginisialisasi QR scanner dan menampilkan hasilnya di textbox
let scanner = new Instascan.Scanner({
  video: document.getElementById("preview"),
});
Instascan.Camera.getCameras()
  .then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      alert("No Cameras found");
    }
  })
  .catch(function (e) {
    console.error(e);
  });

scanner.addListener("scan", function (content) {
  document.getElementById("no_id").value = content;
  // Trigger the submit button click event
  document.getElementById("submitBtn").click();
});

//Menghubungkan ke Scanner USB:
// Fungsi untuk menghubungkan ke perangkat USB
async function connectToBarcodeScanner() {
  try {
    const device = await navigator.usb.requestDevice({
      filters: [],
    });
    await device.open();
    await device.selectConfiguration(1);
    await device.claimInterface(0);
    return device;
  } catch (error) {
    console.error("Gagal menghubungkan ke perangkat USB:", error);
    return null;
  }
}

// Fungsi untuk membaca data dari scanner
async function readBarcodeData(device) {
  try {
    const result = await device.transferIn(1, 64); // Jumlah byte data yang akan dibaca
    const decoder = new TextDecoder();
    const barcodeData = decoder.decode(result.data);
    return barcodeData;
  } catch (error) {
    console.error("Gagal membaca data dari scanner:", error);
    return null;
  }
}

// Fungsi untuk menempatkan hasil ke dalam input box
function setResult(result) {
  document.getElementById("resultInput").value = result;
}

// Fungsi untuk mulai pemindaian
async function startScanning() {
  const scannerDevice = await connectToBarcodeScanner();
  if (scannerDevice) {
    const result = await readBarcodeData(scannerDevice);
    if (result) {
      setResult(result);
    }
  }
}
