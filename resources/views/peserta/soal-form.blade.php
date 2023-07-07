@extends('template')

@section('css')
<style>
    #question {
        font-size: 16px;
    }

    .question_nav {
        /* width: 100%; */
        text-align: center;
    }

    .question_nav a {
        width: auto;
        display: inline-block;
        border: 1px solid black;

        background-color: #f5f5f5;
        color: #000;
    }

    .question_active {
        border: 2px solid yellow;
        background-color: orange !important;
        color: #fff !important;
        font-weight: bold !important;
    }

    .answered {
        background-color: green !important;
        color: #fff !important;

    }

    .navigation_page {
        list-style-type: none !important;
        padding: 0;
    }

    .navigation_page li {
        display: inline-block !important;
    }
</style>


@endsection
@section('content')
<!-- {{$sesi[0]}} -->

<div class="d-flex flex-column flex-xl-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-xl-325px mb-10">
        <!--begin::Card-->
        <div class="card card-flush" data-kt-sticky="true" data-kt-sticky-name="account-navbar" data-kt-sticky-offset="{default: false, xl: '80px'}" data-kt-sticky-width="{lg: '250px', xl: '325px'}" data-kt-sticky-left="auto" data-kt-sticky-top="90px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
            <!--begin::Card header-->
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-10">
                <!--begin::Summary-->
                <div class="d-flex flex-center flex-column mb-5">
                    <!--begin::Avatar-->
                    <div class="symbol mb-3 symbol-150px symbol-circle">
                        <img alt="Pic" src="{{$sesi[0]->dataDiri->foto}}" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <span class="fs-1 text-gray-800 text-hover-primary fw-bolder mb-1">{{$sesi[0]->dataDiri->nama_lengkap}}</span>

                    <span class="fs-5 badge bg-primary me-2 mb-2 card-rounded">No. Ujian : {{$sesi[0]->no_test}}</span>

                    <span class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1">TTL : {{$sesi[0]->dataDiri->lahir_tempat}}, {{\Carbon\Carbon::parse($sesi[0]->dataDiri->lahir_tanggal)->format('d M Y')}}</span>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <!--end::Position-->
                    <!--begin::Actions-->
                    <!--end::Actions-->
                </div>
                <!--end::Summary-->
                <div class="notice d-flex bg-light-warning rounded border-primary border border-dashed mb-3 p-6">
                    <h3 class="fw-bolder m-0 align-self-center" id="countdown"></h3>
                </div>
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <!--begin::Content-->
                        <div class="mb-3 mb-md-0 fw-semibold">

                            <h2>Informasi Ujian</h2>
                            <span class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1">{{$sesi[0]->ujianSesiRuangan->ujianSesi->ujian->ujian_nama}}</span>
                            <ul class="my-2 fs-2 px-5">
                                <li><span class="fs-6 text-gray-800 fw-bolder">Tanggal : {{\Carbon\Carbon::parse($sesi[0]->ujianSesiRuangan->ujianSesi->sesi_tanggal)->format('d M Y')}}</span></li>
                                <li><span class="fs-6 text-gray-800 fw-bolder">Waktu : <br>{{$sesi[0]->ujianSesiRuangan->ujianSesi->jam_mulai}} - {{$sesi[0]->ujianSesiRuangan->ujianSesi->jam_selesai}}</span></li>
                                <li><span class="fs-6 text-gray-800 fw-bolder">Ruang : {{$sesi[0]->ujianSesiRuangan->kode_ruangan}} - {{$sesi[0]->ujianSesiRuangan->ruangan}}</span></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Sidebar-->

    <!--begin::details View-->

    <div class="flex-lg-row-fluid ms-lg-10" style="width:500px;overflow-wrap: break-word;">

        <div class="card mb-10 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Soal <span id="bagian"></span></h3>
                </div>
                <!--end::Card title-->
                <!--begin::Action-->
                <a href="#" onclick="selesai()" class="btn btn-danger align-self-center">Selesai</a>
                <!--end::Action-->
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9 py-5 mb-5" style="overflow-wrap: break-word;">
                <!--begin::Row-->
                <p style="font-size :18px" id="question">
                    <!-- ini untuk tampil soalnya -->
                </p>
                <div class="col-sm-12 py-3" id="pilihanJawaban">
                    <!-- ini untuk tampil pilihan jawabannya -->
                </div>

                <div id="questionButton">
                    <button class="btn btn-success" id="btnNext"><i class="fa fa-save"></i>&nbsp Simpan dan Lanjut</button>
                    <button class="btn btn-secondary" id="btnSkip">Lewati</button>
                </div>
            </div>
        </div>
        <!--end::Card body-->


        <!-- </div> -->
        <!--end::details View-->
    </div>
    <div class=" flex-lg-row-fluid ms-lg-10 w-xl-10px w-xl-10px">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <!-- <div class="card-body pb-0 px-0"> -->
            <!-- {{$sesi[0]}} -->
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
                <h3 class="fw-bolder m-0 mb-2">Navigasi Soal</h3>

                <div id="navigasi">
                </div>
                <h6 style="margin-top: 10px">Keterangan</h6>
                <p class="fw-bolder m-0 mb-2"><i>Merah : Belum Terjawab, Hijau : Sudah terjawab, Orange : Soal Aktif</i></p>

            </div>
            <!--end::Card body-->
        </div>
    </div>
</div>

<!-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pertanyaan <span id="questionNumberInfo"></span></h3>
            <h1 id="countdown"></h1>

            <div class="d-flex justify-content-end pt-7">
                <a onclick="return confirm('yakin selesai?')" href="#" class="btn btn-danger" id="btnFinish"><i class="fa fa-stop-circle"></i> &nbsp Selesai</a>

            </div>

        </div>

        <div class="card-footer">
            <h4>Navigasi Soal</h4>
        </div>
    </div> -->

@endsection

@section('script')
<script>
    var totalPindah = 0

    var container = document.querySelector('#kt_content_container')
    container.classList.remove('container-xxl')
    // Waktu dari database
    var tanggal = "{{$sesi[0]->ujianSesiRuangan->ujianSesi->sesi_tanggal}}"
    var waktuSelesai = "{{$sesi[0]->ujianSesiRuangan->ujianSesi->jam_selesai}}"
    var waktuDatabase = `${tanggal}T${waktuSelesai}`; // Ubah dengan waktu dari database Anda

    // Mendapatkan tanggal dan waktu sekarang
    var sekarang = new Date().getTime();

    // Mendapatkan tanggal dan waktu dari database
    var target = new Date(waktuDatabase).getTime();

    // Hitung selisih waktu antara sekarang dan target
    var selisih = target - sekarang;

    // Mendapatkan waktu dalam hari, jam, menit, dan detik
    var hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
    var jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
    var detik = Math.floor((selisih % (1000 * 60)) / 1000);

    // Menampilkan hitung mundur dalam elemen dengan id "countdown"
    var countdownElement = document.getElementById("countdown");
    countdownElement.innerHTML = "Sisa Waktu: <br>" + jam + " jam, " + menit + " menit, " + detik + " detik";

    // Memperbarui hitung mundur setiap detik
    var countdownInterval = setInterval(function() {
        sekarang = new Date().getTime();
        selisih = target - sekarang;
        hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
        jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
        detik = Math.floor((selisih % (1000 * 60)) / 1000);

        countdownElement.innerHTML = "Sisa Waktu: <br>" + jam + " jam, " + menit + " menit, " + detik + " detik";

        // Menghentikan hitung mundur saat mencapai waktu target
        if (selisih < 0) {
            clearInterval(countdownInterval);
            countdownElement.innerHTML = "Waktu telah berakhir";
        }
    }, 1000);

    var bagianUrutan, pertanyaanUrutan
    var showPertanyaan = document.querySelector('#question')
    var showNext = document.querySelector('#btnNext')
    var showPilihan = document.querySelector('#pilihanJawaban')
    var skip = document.querySelector('#btnSkip')
    var navigasi = document.querySelector('#navigasi')
    var bagian = document.querySelector('#bagian')
    var sesiPesertaId = "{{$sesi[0]->id}}";
    var current
    init()
    async function init() {
        getQuestion(1, 1)
        showNavigasi()
    }

    async function selesai() {
        let konfirmasi = confirm('Yakin Selesai? Pastikan semua soal sudah terjawab')
        if (konfirmasi) {
            let konfirmasi2 = confirm('Yakin? Anda tidak dapat ujian kembali')
            if (konfirmasi2) {

                var input

                // String yang diinginkan
                var stringYangDiinginkan = "selesaimi";
                while (true) {
                    input = prompt("Ketikkan 'selesaimi' untuk mengakhiri: ");
                    // Memeriksa apakah inputan sama dengan string yang diinginkan
                    if (input === stringYangDiinginkan) {
                        let url = "{{route('update.selesai')}}";
                        let dataSend = new FormData()
                        dataSend.append('id', "{{$sesi[0]->id}}")
                        let sendRequest = await fetch(url, {
                            method: "POST",
                            body: dataSend
                        })
                        let response = await sendRequest.json()
                        // console.log(response);
                        console.log(response);
                        if (response.status == true) {
                            alert("Anda telah selesai, jangan lupa logout ya!!.");
                            return window.location.href = "{{route('peserta.dashboard')}}";
                        }
                        break;
                    } else {
                        alert("tidak sesuai, anda belum bisa mengakhiri, ulangi lagi.");
                        break;
                    }
                }
            }
        }
    }
    async function showNavigasi() {
        let url = "{{route('navigasi',':id')}}";
        url = url.replace(':id', sesiPesertaId)
        let sendRequest = await fetch(url)
        let response = await sendRequest.json()
        console.log(response);
        let content = '<span></span>'
        let tombolCell = ''
        let total = 0 //ini untuk supaya pertanyaan bagian lainnya dia sambung nomor urut pertanyaan selanjutnya
        let kelipatan = 6
        totalPindah = 0
        response.map((data) => {
            content += `<span class="fs-5 badge bg-dark me-2 mb-2 card-rounded">${data.bagian_nama}</span>`
            content += `<table class="question_nav" style="font-size:18px">`
            let totalSoal = data.soal_kelompok.soal.length
            data.soal_kelompok.soal.map((item, index) => {
                // content += `<button onclick='next(${data.id},${item.peserta_pertanyaan.urutan})'>${item.peserta_pertanyaan.urutan}</button>`
                let state = ''
                let currentState = 'question_nav'
                // state = (item.peserta_pertanyaan.peserta_jawaban.length == 0) ? 'question_nav' : ''
                // console.log(`${item.id} -  ${current}`);
                // console.log(current);
                // console.log(item.id == current);
                currentState = (item.id == current) ? 'question_active' : ''
                state = (item.peserta_soal.peserta_jawaban != null) ? 'answered' : ''
                tombolCell += `<td><a class="btn btn-secondary btn-sm ${state} ${currentState}" href="#" onclick='next(${data.id},${item.peserta_soal.urutan})'>${item.peserta_soal.urutan}</a></td>`
                if (index == kelipatan || index == totalSoal - 1) {
                    content += `<tr>`
                    content += tombolCell
                    content += `</tr>`
                    tombolCell = ''
                    kelipatan = kelipatan + 7
                }
            })
            kelipatan = 6
            content += `</table><div class="mt-2"></div>`
            total = total + data.soal_kelompok.soal.length
            // content = ''
            console.log(totalSoal);
            totalPindah = totalPindah + totalSoal
        })
        navigasi.innerHTML = content


    }
    async function getQuestion(bagian_urutan, pertanyaan_urutan) { //menampilkan pertanyaan sesuai nomor yang dipilih
        bagianUrutan = bagian_urutan
        pertanyaanUrutan = pertanyaan_urutan
        showPertanyaan.innerHTML = ''
        showPilihan.innerHTML = ""
        let dataSend = new FormData()
        dataSend.append('ujian_id', "{{$sesi[0]->ujianSesiRuangan->ujianSesi->ujian_id}}")
        dataSend.append('ujian_peserta_id', "{{$sesi[0]->id}}")
        dataSend.append('bagian_urutan', bagianUrutan)
        dataSend.append('pertanyaan_urutan', pertanyaanUrutan)
        let sendRequest = await fetch("{{route('soal.get')}}", {
            method: "POST",
            body: dataSend
        })
        let response = await sendRequest.json()
        console.log(response);
        // return
        bagian.innerText = response.bagian_nama
        current = response.soal_kelompok.soal[0].id
        // console.log(current);
        showPertanyaan.innerText = `${response.soal_kelompok.soal[0].peserta_soal.urutan}. ${response.soal_kelompok.soal[0].soal}`
        let BagianNext = response.bagian_urutan
        let pertanyaanNext = response.soal_kelompok.soal[0].peserta_soal.urutan + 1
        if (response.soal_kelompok.soal[0].peserta_soal.is_last_urutan_bagian == true) {

            BagianNext = BagianNext + 1
            // console.log(`${response.soal_kelompok.soal[0].peserta_soal.is_last_urutan_bagian}`);
        }
        console.log(response.soal_kelompok.soal[0].peserta_soal.urutan);
        if (response.soal_kelompok.soal[0].peserta_soal.urutan == totalPindah) {
            showNext.setAttribute('onclick', `saveAja(${response.soal_kelompok.soal[0].peserta_soal.id})`)
            // skip.setAttribute('onclick', `next(${BagianNext}, ${pertanyaanNext})`)
            skip.setAttribute('onclick', `next(1, 1)`)


        } else {
            // showNext.setAttribute('onclick', `saveAndNext(1, 1, ${response.soal_kelompok.soal[0].peserta_soal.id})`)
            // skip.setAttribute('onclick', `next(1, 1)`)
            showNext.setAttribute('onclick', `saveAndNext(${BagianNext}, ${pertanyaanNext}, ${response.soal_kelompok.soal[0].peserta_soal.id})`)
            skip.setAttribute('onclick', `next(${BagianNext}, ${pertanyaanNext})`)

        }

        let content = ''
        response.soal_kelompok.soal[0].peserta_soal.peserta_soal_opsi.opsis.map((data) => {
            if (response.soal_kelompok.soal[0].peserta_soal.peserta_jawaban == null)
                content +=
                `<div class="mb-5" >
                <div class="form-check form-check-custom form-check-solid form-check-sm">
                    <input class="form-check-input" type="radio" value="${data.id}" name="jawaban" id="jawaban${data.id}" />
                    <label class="form-check-label" for="jawaban${data.id}" style="font-size:16px">
                    ${data.opsi_text}
                    </label>
                </div>
            </div>`
            else
                content +=
                `<div class="mb-5">
            <div class="form-check form-check-custom form-check-solid form-check-sm">
                <input class="form-check-input" type="radio" value="${data.id}" name="jawaban" id="jawaban${data.id}" 
                ${(response.soal_kelompok.soal[0].peserta_soal.peserta_jawaban.soal_opsi_id==data.id) ? 'checked' : ''}
                />
                <label class="form-check-label" for="jawaban${data.id}" style="font-size:16px">
                ${data.opsi_text}
                </label>
            </div>
        </div>`
        })
        showPilihan.innerHTML = ""
        showPilihan.innerHTML = content

    }

    async function save(pertanyaanId) { //simpan jawaban
        const radioButtons = document.querySelectorAll('input[name="jawaban"]');
        // alert(selectedValue)
        let isRadioButtonClicked = false;
        let selectedValue = '';

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                isRadioButtonClicked = true;
                selectedValue = radioButtons[i].value;
                break;
            }
        }

        if (!isRadioButtonClicked) {
            alert('Mohon pilih salah satu opsi.');
        }
        let dataSend = new FormData()
        dataSend.append('peserta_soal_id', pertanyaanId)
        dataSend.append('soal_opsi_id', selectedValue)
        let sendRequest = await fetch("{{route('jawaban.store')}}", {
            method: "POST",
            body: dataSend
        })
        let response = await sendRequest.json()


        //disini tinggal tampilkan di navigasi warna hijau



    }
    async function next(bagianId, urutan) { //utk petanyaan selanjutnya
        getQuestion(bagianId, urutan) //hanya tampilkan saja pertanyaan selanjutnya
        showNavigasi()
    }
    async function saveAja(pertanyaanId) {
        save(pertanyaanId)
        showNavigasi()
    }

    async function saveAndNext(bagianId, urutan, pertanyaanId) { //simpan dan langsung lanjut ke pertanyaan selanjutnya
        save(pertanyaanId)
        next(bagianId, urutan)
        showNavigasi()
    }
</script>
@endsection