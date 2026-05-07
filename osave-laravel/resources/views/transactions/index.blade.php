@extends('layouts.app')

@section('content')
<div class="hero">
    <div class="hero-text">
        <p class="small-badge">Dashboard Penjualan</p>
        <h1>Daftar Transaksi O! Save</h1>
        <p>Kelola semua transaksi penjualan dengan elegan, cepat, dan rapi. Pilih kasir perempuan, pelanggan baru, dan lihat ringkasan bisnis secara langsung.</p>
    </div>
    <div class="actions" style="justify-content: flex-end; align-items: center;">
        <a href="{{ route('transaksi.create') }}" class="button">Tambah Transaksi</a>
        <a href="{{ route('barang.index') }}" class="button button-secondary">Kelola Barang</a>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <strong>{{ $totalTransaksi }}</strong>
        <span>Total Transaksi</span>
    </div>
    <div class="stat-card">
        <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
        <span>Omset Hari Ini</span>
    </div>
    <div class="stat-card">
        <strong>{{ $pelangganCount }}</strong>
        <span>Pelanggan Terdaftar</span>
    </div>
    <div class="stat-card">
        <strong>{{ $kasirCount }}</strong>
        <span>Kasir Perempuan</span>
    </div>
</div>

<div class="card">
    <div class="actions" style="justify-content: space-between; align-items: center;">
        <div>
            <h2>Riwayat Transaksi</h2>
            <p>Ringkasan penjualan berdasarkan data struk O! Save.</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>No Transaksi</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->no_transaksi }}</td>
                    <td>{{ $order->tanggal->format('d/m/Y H:i') }}</td>
                    <td>{{ $order->pelanggan->nama_pelanggan }}</td>
                    <td>{{ $order->kasir->nama_kasir }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('transaksi.show', $order) }}" class="button button-secondary">Detail</a>
                            <a href="{{ route('transaksi.edit', $order) }}" class="button button-secondary">Edit</a>
                            <form action="{{ route('transaksi.destroy', $order) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="button button-danger" type="submit" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
