@extends('layouts.app')

@section('content')
<div class="card">
    <div class="actions" style="justify-content: space-between; align-items: center;">
        <div>
            <h1>Master Barang</h1>
            <p>Kelola produk yang ada di toko O! Save.</p>
        </div>
        <a href="{{ route('barang.create') }}" class="button">Tambah Barang</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->satuan }}</td>
                    <td>Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('barang.edit', $barang) }}" class="button button-secondary">Edit</a>
                            <form action="{{ route('barang.destroy', $barang) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="button button-danger" type="submit" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
