<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kasir;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan', 'kasir', 'detailTransaksi.barang'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalTransaksi = $transaksi->count();
        $totalPendapatan = $transaksi->sum('total_harga');
        $kasirCount = Kasir::count();
        $pelangganCount = Pelanggan::count();

        return view('transactions.index', compact('transaksi', 'totalTransaksi', 'totalPendapatan', 'kasirCount', 'pelangganCount'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $kasirs = Kasir::orderBy('nama_kasir')->get();

        return view('transactions.create', compact('barangs', 'pelanggans', 'kasirs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_transaksi' => 'required|string|max:100|unique:transaksi,no_transaksi',
            'tanggal' => 'required|date',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_kasir' => 'required|exists:kasir,id_kasir',
            'tunai' => 'required|integer|min:0',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|exists:barang,id_barang',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|integer|min:0',
            'items.*.subtotal' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $totalItem = 0;
            $totalHarga = 0;
            foreach ($validated['items'] as $item) {
                $totalItem += $item['qty'];
                $totalHarga += $item['subtotal'];
            }

            $transaksi = Transaksi::create([
                'no_transaksi' => $validated['no_transaksi'],
                'tanggal' => $validated['tanggal'],
                'id_pelanggan' => $validated['id_pelanggan'],
                'id_kasir' => $validated['id_kasir'],
                'total_item' => $totalItem,
                'total_harga' => $totalHarga,
                'tunai' => $validated['tunai'],
                'kembalian' => max(0, $validated['tunai'] - $totalHarga),
            ]);

            foreach ($validated['items'] as $item) {
                $transaksi->detailTransaksi()->create([
                    'id_barang' => $item['id_barang'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            }
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'kasir', 'detailTransaksi.barang']);
        return view('transactions.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $kasirs = Kasir::orderBy('nama_kasir')->get();

        $transaksi->load(['detailTransaksi']);

        return view('transactions.edit', compact('transaksi', 'barangs', 'pelanggans', 'kasirs'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'no_transaksi' => 'required|string|max:100|unique:transaksi,no_transaksi,' . $transaksi->id_transaksi . ',id_transaksi',
            'tanggal' => 'required|date',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_kasir' => 'required|exists:kasir,id_kasir',
            'tunai' => 'required|integer|min:0',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|exists:barang,id_barang',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|integer|min:0',
            'items.*.subtotal' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($validated, $transaksi) {
            $totalItem = 0;
            $totalHarga = 0;
            foreach ($validated['items'] as $item) {
                $totalItem += $item['qty'];
                $totalHarga += $item['subtotal'];
            }

            $transaksi->update([
                'no_transaksi' => $validated['no_transaksi'],
                'tanggal' => $validated['tanggal'],
                'id_pelanggan' => $validated['id_pelanggan'],
                'id_kasir' => $validated['id_kasir'],
                'total_item' => $totalItem,
                'total_harga' => $totalHarga,
                'tunai' => $validated['tunai'],
                'kembalian' => max(0, $validated['tunai'] - $totalHarga),
            ]);

            $transaksi->detailTransaksi()->delete();

            foreach ($validated['items'] as $item) {
                $transaksi->detailTransaksi()->create([
                    'id_barang' => $item['id_barang'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            }
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
