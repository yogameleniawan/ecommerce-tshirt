<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>

    <table border="10px solid black">
        <tr>
            <td colspan="8" style="background-color: yellow;">
                <b>Transaction Report : {{$month}}</b>
            </td>
        </tr>
        <tr>
            <th><b>No.</b> </th>
            <th><b>Nama Pembeli</b></th>
            <th><b>Nama Barang</b></th>
            <th><b>Alamat</b></th>
            <th><b>Jumlah</b></th>
            <th><b>Harga</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Harga Total</b></th>
        </tr>
        @foreach($data as $key=>$d)
        <tr>
            <td style="text-align: center;vertical-align: middle">{{ $key+1}}</td>
            <td style="text-align: center;vertical-align: middle">{{ $d->name_user }}</td>
            <td style="text-align: center;vertical-align: middle">{{ $d->name_item }}</td>
            <td style="text-align: center;vertical-align: middle">{{ $d->address }}</td>
            <td style="text-align: center;vertical-align: middle">{{ $d->qty }}</td>
            @foreach($item as $i)
            @if($i->id == $d->id_item)
            <td style="text-align: center;vertical-align: middle">Rp. {{$i->price}}</td>
            @endif
            @endforeach
            <td style="text-align: center;vertical-align: middle">{{ date('j F Y', strtotime($d->created_at)) }}</td>
            <td style="text-align: center;vertical-align: middle">Rp. {{ $d->price }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7" style="text-align: center;vertical-align: middle;background-color:#73cc00">
                <b>Total Earning Monthly</b>
            </td>
            <td style="text-align: center;vertical-align: middle;background-color:#73cc00"><b>Rp. {{$count}}</b></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: yellow;text-align:left"><b>Total Products Sold</b></td>
        </tr>
        <tr>
            <td style="text-align: center;vertical-align: middle"><b>No.</b></td>
            <td style="text-align: center;vertical-align: middle"><b>Nama Barang</b></td>
            <td style="text-align: center;vertical-align: middle"><b>Jumlah Terjual</b></td>
        </tr>

        @foreach($product as $i=>$p)

        <tr>

            <td style="text-align: center;vertical-align: middle">{{ $i+1}}</td>
            <td style="text-align: center;vertical-align: middle">{{ $p->name }}</td>
            <td style="text-align: center;vertical-align: middle">
                <?php $total = 0 ?>
                @foreach($itemSold as $itm)
                @if($itm->id_item == $p->id)
                <?php $total += $itm->qty ?>

                @endif
                @endforeach
                {{$total}}
            </td>
        </tr>

        @endforeach
        <tr>
            <td colspan="2" style="text-align: center;vertical-align: middle;background-color:#73cc00"><b>Total </b></td>
            <td style="text-align: center;vertical-align: middle;background-color:#73cc00"><b>{{$sum}}</b></td>
        </tr>
    </table>
</body>

</html>
