@extends('template')

@section('content')
<!--begin::Layout - Overview-->

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
                        <img alt="Pic" src="{{$data->dataDiri->foto}}" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <span class="fs-2 text-gray-800 text-hover-primary fw-bolder mb-1">{{$data->dataDiri->nama_lengkap}}</span>
                    <span class="fs-5 badge bg-primary me-2 mb-2 card-rounded">No. Ujian : {{$data->no_test}}</span>
                    <span class="fs-2 text-gray-800 text-hover-primary fw-bolder mb-1">TTL : {{$data->dataDiri->lahir_tempat}}, {{\Carbon\Carbon::parse($data->dataDiri->lahir_tanggal)->format('d M Y')}}</span>
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
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Detail Ujian</h3>
                </div>
                <!--end::Card title-->
                <!--begin::Action-->
                <!-- <a href="#" class="btn btn-primary align-self-center">Edit Profile</a> -->
                <button type="button" class="btn btn-info btn-sm align-self-center" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-backdrop="static" data-keyboard="false">
                    Baca Tata Tertib
                </button>
                <!--end::Action-->
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
                <!-- {{$data}} -->
                <!--begin::Row-->
                <div class="row mb-4">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Nama Ujian</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">{{$data->ujianSesiRuangan->ujianSesi->ujian->ujian_nama}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-4">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Lokasi Gedung</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-6">{{$data->ujianSesiRuangan->gedung}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-4">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Sesi</label>
                    <!-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i></label> -->
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-6">Sesi {{$data->ujianSesiRuangan->ujianSesi->sesi}}</span>

                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-4">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Kode Ruangan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <a href="#" class="fw-bold fs-6 text-dark text-hover-primary">{{$data->ujianSesiRuangan->kode_ruangan}}</a>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-4">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Ruangan
                        <!-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i> -->
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">{{$data->ujianSesiRuangan->ruangan}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-4">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Tanggal Ujian</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-dark">{{\Carbon\Carbon::parse($data->ujianSesiRuangan->ujianSesi->sesi_tanggal)->format('d M Y')}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Waktu</label>
                    <!--begin::Label-->
                    <!--begin::Label-->
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6">{{$data->ujianSesiRuangan->ujianSesi->jam_mulai}} - {{$data->ujianSesiRuangan->ujianSesi->jam_selesai}}</span>
                    </div>
                    <!--begin::Label-->

                </div>
                @if($data->is_aktif==1 && $data->status==2)
                <button class="btn btn-dark btn-sm" disabled>Anda Sudah Selesai Ujian</button>
                @else
                <button class="btn btn-primary" id="tombolMulaiUjian" disabled>Anda belum aktif</button>
                <!-- <button class="btn btn-primary btn-sm" id="tombolMulaiUjian" disabled>Anda belum aktif</button> -->
                <button id="refresh" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success btn-sm" onclick="refreshPage()">Refresh Halaman</button>

                @endif

                <!--end::Input group-->

            </div>
            <!--end::Card body-->
        </div>
        <!--end::details View-->
    </div>
</div>




<div class="modal" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tata Tertib</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <strong>TATA TERTIB MENGIKUTI CBT MANDIRI LOKAL IAIN KENDARI</strong>
                <ol>
                    <li>Peserta masuk ke dalam ruang ujian paling cepat 15 (limat belas) menit sebelum tes dimulai;</li>
                    <li>Peserta harus melakukan registrasi dengan cara login paling lambat 5 (lima) menit sebelum ujian dimulai;</li>
                    <li>Toleransi keterlambatan 15 (lima belas) menit setelah ujian dilaksanakan dan tidak ada tambahan waktu ujian;</li>
                    <li>Peserta yang terlambat lebih dari 15 menit setelah ujian dilaksanakan tidak diperkenankan untuk mengikuti tes (dianggap gugur);</li>
                    <li>Peserta wajib mengenakan pakaian dengan atasan kemeja polos dan bawahan warna gelap;</li>
                    <li>Peserta dilarang :<br>
                        a. bertanya dan/atau berbicara dengan orang di sekitar tempat tes;<br>
                        b. menerima dan/atau memberikan sesuatu dari/kepada orang disekitar tempat tes;<br>
                        c. keluar ruangan tempat tes;<br>
                        d. membaca referensi yang bersumber dari manapun;<br>
                        e. merokok selama ujian berlangsung.</li>
                </ol>
                <strong>TATA CARA, ALUR DAN TATA TERTIB MENGIKUTI CBT LOKAL MANDIRI IAIN KENDARI<br>
                    <br>
                    A. TATA CARA MENGIKUTI UJIAN</strong> 

                <ol>
                    <li>Peserta wajib menggunakan perangkat baik PC Desktop/ Laptop yang disediakan oleh panitia.</li>
                    <li>Peserta melaksanakan Ujian CBT Lokal Mandiri IAIN Kendari di tempat yang telah ditetapkan pada kartu ujian masing-masing.</li>
                    <li>Mengikuti Ujian CBT Lokal Mandiri Mandiri IAIN Kendari sesuai sesi dan waktu yang tertera pada Kartu Peserta Ujian;</li>
                    <li>Peserta wajib mengikuti tahapan kegiatan yang tertera pada kartu ujian;</li>
                    <li>Apabila peserta mengalami kendala teknis maka peserta dapat menghubungi panitia atau pengawas pelaksana Ujian CBT Lokal Mandiri IAIN Kendari;</li>
                </ol>
                <strong>B. ALUR MENGIKUTI UJIAN CBT ML IAIN KENDARI<br>
                    >> Sebelum Ujian :</strong>

                <ol>
                    <li>Masuk ke dalam ruangan ujian;</li>
                    <li>Login 5 (lima) menit sebelum ujian dimulai pada layanan CBT IAIN Kendari</li>
                </ol>
                <strong>>> Saat Ujian :</strong>

                <ol>
                    <li>Peserta memulai ujian;</li>
                    <li>Selama ujian peserta wajib mematuhi tata tertib ujian;</li>
                    <li>Peserta dilarang:<br>
                        1. bertanya/berbicara dengan orang di sekitar tempat tes;<br>
                        2. menerima/memberikan sesuatu dari/kepada orang di sekitar tempat tes;<br>
                        3. membaca referensi yang bersumber dari manapun;<br>
                        4. Merokok selama ujian berlangsung.</li>
                </ol>
                <strong>>> Setelah Ujian :</strong>

                <ol>
                    <li>Peserta memastikan log out dari sistem aplikasi</li>
                </ol>
                <strong>KONTAK PANITIA</strong><br>
                Kontak person Panitia Pelaksana SMS, WA Only Selama Jam Kantor 08.00 sd 17.00 WITA : 085394648629, 082113874437<br>
                <br>
                <strong>JOIN GRUP TELEGRAM MABA 2023</strong>

                <ol>
                    <li>Install Telegram pada smartphone anda;</li>
                    <li>Wajib untuk bergabung pada grup telegram mahasiswa baru tahun 2023 <a href="https://iainkendari.ac.id/go/maba2023" target="_blank">https://iainkendari.ac.id/go/maba2023</a></li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Munculkan modal ketika halaman selesai dimuat
    $(document).ready(function() {
        $('#kt_modal_1').modal({
            show: true,
            backdropasasd: 'static',
            keyboard: false
        });

        // $('#kt_modal_1').modal()
    });
</script>
<script>
    $(document).ready(function() {
        // $('#myModal').modal('show'); Use this For Not Static Modal

        $('#kt_modal_1').modal({
            backdrop: 'static',
            keyboard: false
        }); // Use THis For Static Modal

    });

    function refreshPage() {
        location.reload();
    }

    const tombolMulaiUjian = document.querySelector('#tombolMulaiUjian');
    var isAktif = "{{$data->is_aktif}}";
    if (isAktif == 1) {
        tombolMulaiUjian.removeAttribute('disabled');
        tombolMulaiUjian.innerText = "Mulai Ujian"
        document.querySelector('#refresh').parentNode.removeChild(document.querySelector('#refresh'))

        tombolMulaiUjian.addEventListener("click", async function() {
            tombolMulaiUjian.setAttribute('disabled', 'disabled');
            tombolMulaiUjian.innerHTML = `<span><i class="fa fa-spinner"></i> Memuat Soal...</span>`

            let url = "{{route('create.soal.peserta')}}";
            // url = url.replace(':id', sesiPesertaId)

            let dataSend = new FormData()
            dataSend.append('ujianId', "{{$data->ujianSesiRuangan->ujianSesi->ujian->id}}")
            dataSend.append('ujian_sesi_peserta_id', "{{$data->id}}")
            let sendRequest = await fetch(url, {
                method: "POST",
                body: dataSend
            })
            let response = await sendRequest.json()
            console.log(response);
            if (response.status == true) {
                return window.location.href = "{{route('peserta.form.ujian',1)}}";

            }
            return alert('ada kesalahan coba lagi')

        });
    }
</script>


@endsection