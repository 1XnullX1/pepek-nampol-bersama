<php? function clearForm() { document.getElementById('nik').value='' ; document.getElementById('no_id').value='' ;
    document.getElementById('nama').value='' ; document.getElementById('alamat').value='' ;
    document.getElementById('no_telphone').value='' ; document.getElementById('tanggal_berlaku').value='' ;
    document.getElementById('status_user').selectedIndex=0; document.getElementById('validation').selectedIndex=0;
    document.getElementById('fileToUpload').value='' ; document.getElementById('previewGambar').src='' ;
    document.getElementById('lokasi_gambar').src='' ; } // Menghubungkan fungsi "clearForm" dengan tombol "CLEAR"
    document.querySelector('button[name="clear" ]').addEventListener('click', clearForm);>
    </php>