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
        <h3>1. IMPORT PESERTA DARI SIA</h3>
        <button class="btn btn-primary" onclick="importData()">Import Data SIA</button>
        <hr>
        <h3 class="mt-3">2. BUAT AKUN PENGAWAS</h3>
        <button class="btn btn-primary" onclick="buatAkunPengawas()">Buat akun pengawas</button>
        <hr>

        <h3 class="mt-3">3. UPLOAD SOAL</h3>
        <!-- <form> -->
        <select class="form-control" id="kelompok_soal">
            <option value="1" data-urut="1">TKD 1</option>
            <option value="2" data-urut="42">TKD 2</option>
            <option value="3" data-urut="58">TKD 3</option>
            <option value="4" data-urut="78">TKD 4</option>
            <option value="5" data-urut="98">TKD 5</option>
            <option value="6" data-urut="157">TKD 6</option>
            <option value="7" data-urut="177">TKD 7</option>
            <option value="8" data-urut="191">Moderasi Beragama</option>
        </select> <br>
        <input type="file" name="csv_file" id="csv_file"><br>
        <br>
        <button class="btn btn-primary" onclick="uploadSoal()">Upload Soal</button>
        <!-- </form> -->

        <hr>
        <h3 class="mt-3">4. CETAK</h3>
        <a class="btn btn-primary" href="{{route('cetak.pengawas')}}">Cetak Akun Pengawas</a><br><br>
        <a class="btn btn-dark" href="{{route('cetak.peserta')}}">Cetak Akun Peserta</a>
    </div>


    <script>
        // alert('yo')
        // init()
        async function importData() {
            let dataSend = new FormData()
            dataSend.append('filter', "20235")
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
            let url = "{{route('create.akun.pengawas')}}";
            let sendRequest2 = await fetch(url)
            let response2 = await sendRequest2.json()
            console.log(response2);
            if (response2.status == true)
                alert('sukses')
        }
    </script>
</body>

</html>