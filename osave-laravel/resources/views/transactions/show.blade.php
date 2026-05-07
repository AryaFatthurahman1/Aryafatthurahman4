@extends('layouts.app')

@section('content')
<div class="card">
    <div class="actions" style="justify-content: space-between; align-items: center;">
        <div>
            <h1>Detail Transaksi</h1>
            <p>Informasi lengkap transaksi {{ $transaksi->no_transaksi }}.</p>
        </div>
        <div class="actions">
            <a href="{{ route('transaksi.edit', $transaksi) }}" class="button">Edit</a>
            <a href="{{ route('transaksi.index') }}" class="button button-secondary">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="actions" style="justify-content: space-between; gap: 20px; flex-wrap: wrap;">
            <div>
                <p><strong>No Transaksi</strong><br>{{ $transaksi->no_transaksi }}</p>
                <p><strong>Tanggal</strong><br>{{ $transaksi->tanggal->format('d/m/Y H:i') }}</p>
                <p><strong>Pelanggan</strong><br>{{ $transaksi->pelanggan->nama_pelanggan }}</p>
                <p><strong>Kasir</strong><br>{{ $transaksi->kasir->nama_kasir }}</p>
            </div>
            <div>
                <p><strong>Total Item</strong><br>{{ $transaksi->total_item }}</p>
                <p><strong>Total Harga</strong><br>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                <p><strong>Tunai</strong><br>Rp {{ number_format($transaksi->tunai, 0, ',', '.') }}</p>
                <p><strong>Kembalian</strong><br>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->detailTransaksi as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->barang->satuan }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
