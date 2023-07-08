@extends('template')

@section('content')
<div class="d-flex flex-column flex-xl-row">

    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-xl-325px mb-10">
        <!--begin::Card-->
        <div class="card card-flush" data-kt-sticky="true" data-kt-sticky-name="account-navbar" data-kt-sticky-offset="{default: false, xl: '80px'}" data-kt-sticky-width="{lg: '250px', xl: '325px'}" data-kt-sticky-left="auto" data-kt-sticky-top="90px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">

            <!--begin::Card body-->
            <div class="card-body p-10">
                <!--begin::Summary-->
                <div class="d-flex flex-center flex-column mb-5">
                    <!--begin::Avatar-->
                    <div class="symbol mb-3 symbol-100px symbol-circle">
                        <img alt="Pic" src="https://sia.iainkendari.ac.id/assets/template/admincore/assets/images/user_bg.png" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->




                    <span class="fs-2 badge bg-dark me-2 mb-2 card-rounded">{{$data->nama_pengawas}}</span>
                    <h1 class="my-3">Informasi Ujian</h1>
                    <div class="notice d-flex bg-light-warning rounded border-primary border border-dashed mb-3 p-6">
                        <ul class="my-2 fs-2 px-2">

                            <li class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1">Lokasi : {{$data->gedung}}</li>
                            <li class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1">Tanggal Ujian : {{$data->ujianSesi->sesi_tanggal}}</li>
                            <li class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1">Waktu : {{$data->ujianSesi->jam_mulai}} - {{$data->ujianSesi->jam_selesai}}</li>
                            <li class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1"><span class="badge bg-success me-2 mb-2 card-rounded">Jumlah Peserta : {{count($data->peserta)}} Peserta</span></li>
                        </ul>
                    </div>
                    <div class="d-flex flex-center flex-column mt-10">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mx-3">
                            @csrf
                            <button type="submit" class="btn btn-danger px-5">Logout</button>
                        </form>
                        <!-- <a href="">Sign Out</a> -->
                    </div>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <!-- <div class="fs-6 fw-bold text-gray-400 mb-2">{{$data->no_test}}</div> -->
                    <!--end::Position-->
                    <!--begin::Actions-->
                    <!--end::Actions-->
                </div>
                <!--end::Summary-->

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Sidebar-->
    <div class="flex-lg-row-fluid ms-lg-10">
        <div class="card card-xxl-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5 pb-3">
                <!--begin::Card title-->
                <!-- <div class="notice d-flex bg-light-warning rounded border-primary border border-dashed mb-3 p-6"> -->
                <h3 class="fw-bolder m-0 align-self-center" id="countdown"></h3>
                <!-- </div> -->
                <!-- <h3 class="card-title fw-bolder text-gray-800 fs-2">{{$data->nama_pengawas}}</h3> -->
                <!--end::Card title-->
                <button class="btn btn-dark" onclick="refreshPage()">Refresh Halaman</button>

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!-- {{$data}} -->


                <div class="table-responsive">
                    <table class="table table-hover table-rounded table-striped border gy-7 gs-7 fs-5">
                        <thead>
                            <th>No Kursi</th>
                            <th>Foto</th>
                            <th>No. Tes</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>HP</th>
                            <th>Status</th>
                            <th>Aktifkan</th>
                        </thead>
                        <tbody>
                            @foreach ($data->peserta as $index => $item)
                            <tr>
                                <td>{{$item->no_urut}}</td>
                                <!-- <td>{{$index + 1}}</td> -->
                                <td><img src="{{$item->dataDiri->foto}}" width="80"></td>
                                <td>{{$item->no_test}}</td>
                                <td>{{$item->dataDiri->nama_lengkap}}</td>
                                <td>{{$item->dataDiri->lahir_tanggal}}</td>
                                <td>{{$item->dataDiri->no_hp}}</td>
                                <td>
                                    <div id="status_{{$item->id}}">

                                        @if($item->is_aktif== 0 && $item->status==0)
                                        <span class="fs-8 badge bg-danger me-2 mb-2 card-rounded">Belum Aktif</span>
                                        @elseif($item->status==0)
                                        <span class="fs-8 badge bg-warning me-2 mb-2 card-rounded">Belum Mulai</span>
                                        @elseif($item->status==1)
                                        <span class="fs-8 badge bg-info me-2 mb-2 card-rounded">Mengerjakan Soal</span>


                                        @else
                                        <span class="fs-8 badge bg-success me-2 mb-2 card-rounded">Selesai Mengerjakan</span>

                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" onclick="aktifkan(event,'{{$item->id}}')" type="checkbox" value="1" name="aktif" data-id="{{$item->id}}" id="aktif_{{$item->id}}" {{($item->is_aktif==1)?  "checked='checked'" : ""}} />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    // init()
    // alert('ss')
    var container = document.querySelector('#kt_content_container')
    container.classList.remove('container-xxl')
    var tanggal = "{{$data->ujianSesi->sesi_tanggal}}"
    var waktuSelesai = "{{$data->ujianSesi->jam_selesai}}"
    var waktuDatabase = `${tanggal}T${waktuSelesai}`; // Ubah dengan waktu dari database Anda

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
    countdownElement.innerHTML = "Sisa Waktu Ujian: " + jam + " jam, " + menit + " menit, " + detik + " detik";

    // Memperbarui hitung mundur setiap detik
    var countdownInterval = setInterval(function() {
        sekarang = new Date().getTime();
        selisih = target - sekarang;
        hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
        jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
        detik = Math.floor((selisih % (1000 * 60)) / 1000);

        countdownElement.innerHTML = "Sisa Waktu Ujian: " + jam + " jam, " + menit + " menit, " + detik + " detik";

        // Menghentikan hitung mundur saat mencapai waktu target
        if (selisih < 0) {
            clearInterval(countdownInterval);
            countdownElement.innerHTML = "Waktu telah berakhir";
        }
    }, 1000);


    function refreshPage() {
        location.reload();
    }

    async function aktifkan(e, id) {
        let value = 0;
        if (e.target.checked) {
            value = 1
        }
        let url = "{{route('update.aktif')}}";
        let dataSend = new FormData()
        dataSend.append('id', e.target.dataset.id)
        dataSend.append('is_aktif', value)
        let sendRequest = await fetch(url, {
            method: "POST",
            body: dataSend
        })
        let response = await sendRequest.json()
        console.log(response);
        if (response.status == true) {
            const status = document.querySelector(`#status_${id}`)
            status.innerHTML = ''
            if (response.data.is_aktif == 0 && response.data.status == 0)
                status.innerHTML = '<span class="fs-8 badge bg-danger me-2 mb-2 card-rounded">Belum Aktif</span>'
            else if (response.data.is_aktif == 0 && response.data.status == 1)
                status.innerHTML = '<span class="fs-8 badge bg-danger me-2 mb-2 card-rounded">Belum Aktif</span>'
            else if (response.data.status == 0)
                status.innerHTML = '<span class="fs-8 badge bg-warning me-2 mb-2 card-rounded">Belum Mulai</span>'
            else if (response.data.status == 1)
                status.innerHTML = '<span class="fs-8 badge bg-info me-2 mb-2 card-rounded">Mengerjakan Soal</span>'
            else
                status.innerHTML = '<span class="fs-8 badge bg-success me-2 mb-2 card-rounded">Selesai Mengerjakan</span>'


        }
    }

    async function init() {
        let url = "";
        // url = url.replace(':id', sesiPesertaId)
        let sendRequest = await fetch(url)
        let response = await sendRequest.json()
        console.log(response);
        document.querySelector('#no_pendaftaran').innerText = response[0].iddata
        document.querySelector('#nama').innerText = response[0].nama
        document.querySelector('#ttl').innerText = `${response[0].tmplahir}, ${response[0].tgllahir}`
    }
</script>
@endsection