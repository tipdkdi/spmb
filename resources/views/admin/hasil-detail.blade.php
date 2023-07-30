<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ujian</title>
</head>

<body>
    @foreach($data->pesertaSoal as $index => $value)
    <p>{{$index + 1}}. {{$value->soal->soal}}</p>
    <ul>
        @foreach($value->pesertaSoalOpsi->opsis as $opsi)
        @if($opsi->is_jawaban==true && $opsi->jawabannyaPeserta==true)
        <li style='background:green'>{{$opsi->opsi_text}}</li>
        @elseif($opsi->is_jawaban==true)
        <li style='background:green'>{{$opsi->opsi_text}}</li>
        @elseif($opsi->jawabannyaPeserta==true)
        <li style='background:red'>{{$opsi->opsi_text}}</li>
        @else
        <li>{{$opsi->opsi_text}}</li>
        @endif
        @endforeach
    </ul>
    @endforeach
</body>

</html>