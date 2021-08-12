<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        td {
            padding:3px 3px 3px;
        }
        .table_po {
            padding:3px 3px 3px;
            border-collapse: collapse;
            border:1px solid;
            width:100%
        }
        .table_po tr td{
            border:1px solid;
            text-align:center;
        }
    </style>
</head>
<body>
<h2 align="center">Laporan Penjualan</h2>
<h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req->start))}} - {{date("d-m-Y",strtotime($req->end))}}</h5>
<table class='table_po'>
    <tr style="font-weight:bold">
        <td>No</td>
        <td>Nama Pemesan</td>
        <td>Harga</td>
        <td>Status</td>
        <td>Transaksi Pada</td>
        <td>Tanda Tangan</td>
    </tr>
    @foreach($data as $k => $r)
        <tr>
            <td>{{$k+1}}</td>
            <td>{{$r->user->name}}</td>
            <td>{{$r->total}}</td>
            <td>{{\App\Casts\OrderStatus::lang($r->status)}}</td>
            <td>{{$r->created_at->format("d-m-Y")}}</td>
            <td></td>
        </tr>
    @endforeach
</table>
<br>
<br>

</body>
</html>

<script>
    window.onload = function() { window.print(); }
</script>
