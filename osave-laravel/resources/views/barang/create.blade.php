@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Tambah Barang</h1>
    <p>Masukkan data produk baru berdasarkan struk O! Save.</p>

    @if($errors->any())
        <div class="alert" style="background:#fee2e2;color:#991b1b;">{{ implode(', ', $errors->all()) }}</div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST" class="form-grid">
        @csrf
        <div class="field">
            <label for="kode_barang">Kode Barang</label>
            <input id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
        </div>
        <div class="field">
            <label for="nama_barang">Nama Barang</label>
            <input id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
        </div>
        <div class="field">
            <label for="satuan">Satuan</label>
            <input id="satuan" name="satuan" value="{{ old('satuan', 'pcs') }}" required>
        </div>
        <div class="field">
            <label for="harga_satuan">Harga Satuan</label>
            <input id="harga_satuan" name="harga_satuan" type="number" min="0" value="{{ old('harga_satuan') }}" required>
        </div>
        <div class="actions">
            <a href="{{ route('barang.index') }}" class="button button-secondary">Kembali</a>
            <button type="submit" class="button">Simpan</button>
        </div>
    </form>
</div>
@endsection
