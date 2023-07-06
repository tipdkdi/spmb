@extends('template')

@section('content')
<div class="card card-xxl-stretch">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5 pb-3">
        <!--begin::Card title-->
        <h3 class="card-title fw-bolder text-gray-800 fs-2">Dashboard</h3>
        <!--end::Card title-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
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
                        <td>{{$item->dataDiri->no_hp}}</td>
                        <td>{{$item->dataDiri->lahir_tanggal}}</td>
                        <td>
                            @if($item->is_aktif== 0 && $item->status==0)
                            <span class="fs-8 badge bg-danger me-2 mb-2 card-rounded">Belum Aktif</span>
                            @elseif($item->status==0)
                            <span class="fs-8 badge bg-warning me-2 mb-2 card-rounded">Belum Mulai</span>
                            @elseif($item->status==1)
                            <span class="fs-8 badge bg-info me-2 mb-2 card-rounded">Mengerjakan Soal</span>


                            @else
                            <span class="fs-8 badge bg-success me-2 mb-2 card-rounded">Selesai Mengerjakan</span>

                            @endif
                        </td>
                        <td>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" onclick="aktifkan(event)" type="checkbox" value="1" name="aktif" data-id="{{$item->id}}" id="aktif_{{$item->id}}" {{($item->is_aktif==1)?  "checked='checked'" : ""}} />
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

</script>
@endsection
@section('script')
<script>
    // init()

    async function aktifkan(e) {
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