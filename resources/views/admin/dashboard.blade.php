<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<table>
    <thead>
        <th>NO</th>
        <th>iddata</th>
        <th>Nama</th>
        <th>Ket</th>
    </thead>
    <tbody id="content">

    </tbody>
</table>

<body>

    <script>
        // alert('yo')
        init()
        async function init() {
            let dataSend = new FormData()
            dataSend.append('filter', "20233")
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
    </script>
</body>

</html>