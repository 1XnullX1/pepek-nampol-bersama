$relayNumber = 1;

// Import modul @josephdadams/usbrelay
const USBRelay = require("@josephdadams/usbrelay");

// Fungsi untuk mengaktifkan dan mematikan relay dengan jeda waktu
function toggleRelayWithDelay(relay, relayNumber, state, delay) {
  relay.setState(relayNumber, state); // Mengaktifkan atau mematikan relay
  setTimeout(function () {
    relay.setState(relayNumber, !state); // Mematikan atau mengaktifkan relay setelah jeda waktu
  }, delay);
}

// Fungsi untuk menampilkan relay yang terhubung
function displayConnectedRelays() {
  const connectedRelays = USBRelay.Relays;
  console.log("Relay yang terhubung:");
  console.log(connectedRelays);
}

// Inisialisasi dan penggunaan relay
async function main() {
  try {
    const relay = new USBRelay(); // Mengambil relay pertama yang terhubung
    // const relay = new USBRelay("spesifik_hid_path"); // Gunakan ini jika Anda memiliki spesifik HID path

    displayConnectedRelays();

    // Mengaktifkan Relay 1, menunggu 1 detik, kemudian mematikan Relay 1
    toggleRelayWithDelay(relay, 1, true, 10000);

    // Menunggu 2 detik, kemudian mengaktifkan Relay 2 dan mematikan semua relay sekaligus
    await new Promise((resolve) => setTimeout(resolve, 2000));
    relay.setState(2, true); // Mengaktifkan Relay 2
    relay.setState(0, false); // Mematikan semua relay sekaligus

    // Menampilkan relay yang terhubung kembali setelah 3 detik
    await new Promise((resolve) => setTimeout(resolve, 3000));
    displayConnectedRelays();
  } catch (error) {
    console.error("Error:", error);
  }
}

main();
