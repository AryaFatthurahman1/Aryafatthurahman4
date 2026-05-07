@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Ubah Barang</h1>
    <p>Perbarui informasi barang.</p>

    @if($errors->any())
        <div class="alert" style="background:#fee2e2;color:#991b1b;">{{ implode(', ', $errors->all()) }}</div>
    @endif

    <form action="{{ route('barang.update', $barang) }}" method="POST" class="form-grid">
        @csrf
        @method('PUT')
        <div class="field">
            <label for="kode_barang">Kode Barang</label>
            <input id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
        </div>
        <div class="field">
            <label for="nama_barang">Nama Barang</label>
            <input id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>
        <div class="field">
            <label for="satuan">Satuan</label>
            <input id="satuan" name="satuan" value="{{ old('satuan', $barang->satuan) }}" required>
        </div>
        <div class="field">
            <label for="harga_satuan">Harga Satuan</label>
            <input id="harga_satuan" name="harga_satuan" type="number" min="0" value="{{ old('harga_satuan', $barang->harga_satuan) }}" required>
        </div>
        <div class="actions">
            <a href="{{ route('barang.index') }}" class="button button-secondary">Kembali</a>
            <button type="submit" class="button">Perbarui</button>
        </div>
    </form>
</div>
@endsection
