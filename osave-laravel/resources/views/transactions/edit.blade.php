@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Edit Transaksi</h1>
    <p>Perbarui data transaksi beserta item yang dibeli.</p>

    @if($errors->any())
        <div class="alert" style="background:#fee2e2;color:#991b1b;">{{ implode(', ', $errors->all()) }}</div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi) }}" method="POST" id="transaction-form">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="field">
                <label for="no_transaksi">No Transaksi</label>
                <input id="no_transaksi" name="no_transaksi" value="{{ old('no_transaksi', $transaksi->no_transaksi) }}" required>
            </div>
            <div class="field">
                <label for="tanggal">Tanggal</label>
                <input id="tanggal" name="tanggal" type="datetime-local" value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="field">
                <label for="id_pelanggan">Pelanggan</label>
                <select id="id_pelanggan" name="id_pelanggan" required>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}" {{ $pelanggan->id_pelanggan === $transaksi->id_pelanggan ? 'selected' : '' }}>{{ $pelanggan->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="id_kasir">Kasir</label>
                <select id="id_kasir" name="id_kasir" required>
                    @foreach($kasirs as $kasir)
                        <option value="{{ $kasir->id_kasir }}" {{ $kasir->id_kasir === $transaksi->id_kasir ? 'selected' : '' }}>{{ $kasir->nama_kasir }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="tunai">Tunai</label>
                <input id="tunai" name="tunai" type="number" min="0" value="{{ old('tunai', $transaksi->tunai) }}" required>
            </div>
        </div>

        <div class="card" style="margin-top:20px;">
            <div class="actions" style="justify-content: space-between; align-items: center;">
                <h2>Daftar Item</h2>
                <button type="button" class="button button-secondary" onclick="addItemRow()">Tambah Item</button>
            </div>
            <table id="items-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->detailTransaksi as $index => $detail)
                        <tr>
                            <td>
                                <select name="items[{{ $index }}][id_barang]" class="item-product" onchange="updateRow(this)">
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id_barang }}" data-price="{{ $barang->harga_satuan }}" {{ $detail->id_barang === $barang->id_barang ? 'selected' : '' }}>{{ $barang->nama_barang }} (Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[{{ $index }}][qty]" value="{{ $detail->qty }}" min="1" onchange="updateRow(this)"></td>
                            <td><input type="number" name="items[{{ $index }}][harga_satuan]" value="{{ $detail->harga_satuan }}" readonly></td>
                            <td><input type="number" name="items[{{ $index }}][subtotal]" value="{{ $detail->subtotal }}" readonly></td>
                            <td><button type="button" class="button button-danger" onclick="removeRow(this)">Hapus</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="actions" style="margin-top:18px;">
            <a href="{{ route('transaksi.index') }}" class="button button-secondary">Kembali</a>
            <button type="submit" class="button">Perbarui Transaksi</button>
        </div>
    </form>
</div>

<script>
    const barangs = @json($barangs->map(function($item) { return ['id' => $item->id_barang, 'name' => $item->nama_barang, 'price' => $item->harga_satuan]; }));
    function addItemRow() {
        const tbody = document.querySelector('#items-table tbody');
        const rows = tbody.querySelectorAll('tr');
        const index = rows.length;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="items[${index}][id_barang]" class="item-product" onchange="updateRow(this)">
                    <option value="">-- Pilih Barang --</option>
                    ${barangs.map(item => `<option value="${item.id}" data-price="${item.price}">${item.name} (Rp ${item.price.toLocaleString('id-ID')})</option>`).join('')}
                </select>
            </td>
            <td><input type="number" name="items[${index}][qty]" value="1" min="1" onchange="updateRow(this)"></td>
            <td><input type="number" name="items[${index}][harga_satuan]" readonly></td>
            <td><input type="number" name="items[${index}][subtotal]" readonly></td>
            <td><button type="button" class="button button-danger" onclick="removeRow(this)">Hapus</button></td>
        `;
        tbody.appendChild(row);
    }

    function updateRow(field) {
        const row = field.closest('tr');
        const productSelect = row.querySelector('.item-product');
        const qtyInput = row.querySelector('input[type="number"][name$="[qty]"]');
        const priceInput = row.querySelector('input[type="number"][name$="[harga_satuan]"]');
        const subtotalInput = row.querySelector('input[type="number"][name$="[subtotal]"]');

        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = Number(selectedOption.dataset.price || 0);
        const qty = Number(qtyInput.value || 0);

        priceInput.value = price;
        subtotalInput.value = price * qty;
    }

    function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
        updateInputNames();
    }

    function updateInputNames() {
        const rows = document.querySelectorAll('#items-table tbody tr');
        rows.forEach((row, index) => {
            const selects = row.querySelectorAll('select, input');
            selects.forEach(element => {
                const name = element.name;
                if (!name) return;
                const updated = name.replace(/items\[\d+\]/, `items[${index}]`);
                element.name = updated;
            });
        });
    }
</script>
@endsection
