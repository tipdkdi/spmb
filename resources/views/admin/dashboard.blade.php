<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5">DASHBOARD ADMIN</h1>
        <div class="card card-body">
            <h3>1. IMPORT PESERTA DARI SIA</h3>
            <div class="col-sm-3">
                <!-- <div class="row "> -->
                <select id="jalur" class="form-select mb-3" aria-label="Default select example">
                    <option value="">Pilih Jalur Penerimaan</option>
                    <option value="20243">Mandiri Lokal 2024</option>
                    <!-- <option value="20236">Bina Mandiri</option> -->
                </select>

                <button class="btn btn-secondary" onclick="importData()">Import Data SIA</button>
                <!-- </div> -->

            </div>

        </div>
        <hr>
        <div class="card card-body">
            <h3 class="mt-3">2. BUAT AKUN PENGAWAS</h3>
            <div class="col-sm-3">
                <select id="ujian" class="form-select mb-3" aria-label="Default select example">
                    <option value="">Pilih Ujian</option>
                    <option value="1">Mandiri Lokal 2024</option>
                    <!-- <option value="4">Bina Mandiri</option> -->
                </select>
                <button class="btn btn-primary" onclick="buatAkunPengawas()">Buat akun pengawas</button>

            </div>
        </div>

        <h3 class="mt-3">3. UPLOAD SOAL</h3>
        <!-- <form> -->
        <select class="form-control" id="kelompok_soal">
            <option value="1">TPA</option>
            <option value="2">Penalaran Matematika</option>
            <option value="3">Perhitungan Matematika</option>
            <option value="4">Literasi membaca</option>
            <option value="5">Literasi Ajaran Islam</option>
        </select> <br>
        <input type="file" name="csv_file" id="csv_file"><br>
        <br>
        <button class="btn btn-primary" onclick="uploadSoal()">Upload Soal</button>
        <!-- </form> -->

        <hr>
        <div class="card card-body">

            <h3 class="mt-3">4. CETAK</h3>
            <div class="col-sm-3">
                <!-- <option value="">Pilih Ujian</option>
                <option value="3">Pasca</option>
                <option value="4">Bina Mandiri</option> -->
                <button class="btn btn-primary" id="cetak-pengawas">Cetak Pengawas</button><br><br>
                <button class="btn btn-dark" id="cetak-peserta">Cetak Peserta</button>
            </div>
        </div>
    </div>


    <script>
        // alert('yo')
        // init()

        document.querySelector('#cetak-pengawas').addEventListener('click', async function() {
            if (document.querySelector('#ujian').value == "")
                return alert('pilih ujian')
            let url = "{{route('cetak.pengawas',':id')}}"
            url = url.replace(':id', document.querySelector('#ujian').value)
            window.location.href = url
        })
        document.querySelector('#cetak-peserta').addEventListener('click', async function() {
            if (document.querySelector('#ujian').value == "")
                return alert('pilih ujian')
            let url = "{{route('cetak.peserta',':id')}}"
            url = url.replace(':id', document.querySelector('#ujian').value)
            window.location.href = url
        })

        async function importData() {
            let jalur = document.querySelector('#jalur')
            // return console.log(jalur.value);
            if (jalur.value == '')
                return alert('Pilih jalur')
            let dataSend = new FormData()
            dataSend.append('filter', jalur.value)
            let sendRequest = await fetch("https://sia.iainkendari.ac.id/konseling_api/eksport_data_dari_sia", {
                method: "POST",
                body: dataSend
            })
            let response = await sendRequest.json()
            console.log(response);
            // return
            response.data.map(async (item, index) => {
                // if (index == 0) {
                // console.log(item);
                // return console.log('ggwp');
                let url = "{{route('sinkron')}}";
                let dataSend2 = new FormData()
                dataSend2.append('data', JSON.stringify(item))
                let sendRequest2 = await fetch(url, {
                    method: "POST",
                    body: dataSend2
                })
                let response2 = await sendRequest2.json()
                console.log(response2);
                // }
                // console.log(item.nama);
            })
        }
        async function uploadSoal() {
            // return 
            // return alert()
            var inputFile = document.getElementById('csv_file');
            var file = inputFile.files[0];

            let url = "{{route('import.soal')}}";
            let dataSend2 = new FormData()
            dataSend2.append('csv_file', file)
            dataSend2.append('urut', document.querySelector('#kelompok_soal').options[document.querySelector('#kelompok_soal').selectedIndex].dataset.urut)
            dataSend2.append('kelompok_soal_id', document.querySelector('#kelompok_soal').value)
            let sendRequest2 = await fetch(url, {
                method: "POST",
                body: dataSend2
            })
            let response2 = await sendRequest2.json()
            console.log(response2);
            if (response2.status == true)
                alert('sukses')
            // alert(document.querySelector('#kelompok_soal').value)
            // var e = document.getElementById("ddlViewBy");
            // var value = e.value;
        }
        async function buatAkunPengawas() {
            // return alert(document.querySelector('#ujian').value)
            if (document.querySelector('#ujian').value == "")
                return alert('pilih ujian')
            let url = '{{route("create.akun.pengawas",":id")}}';
            url = url.replace(':id', document.querySelector('#ujian').value)
            console.log(url);
            let sendRequest2 = await fetch(url)
            let response2 = await sendRequest2.json()
            console.log(response2);
            if (response2.status == true)
                alert('sukses')
        }
    </script>
</body>

</html>