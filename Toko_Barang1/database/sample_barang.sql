USE toko_barang1;

INSERT INTO barang (kode_barang, nama_barang, id_kategori, harga_jual, harga_beli, stok, satuan)
SELECT * FROM (
    SELECT 'BRG001', 'Beras Premium 5kg', 'KAT01', 78000.00, 65000.00, 24, 'pack'
    UNION ALL
    SELECT 'BRG002', 'Kopi Susu Botol', 'KAT02', 18000.00, 12500.00, 36, 'botol'
    UNION ALL
    SELECT 'BRG003', 'Lampu LED 12W', 'KAT03', 27000.00, 19500.00, 15, 'pcs'
    UNION ALL
    SELECT 'BRG004', 'Notebook A5', 'KAT04', 12000.00, 8000.00, 40, 'pcs'
    UNION ALL
    SELECT 'BRG005', 'Kaos Polos Basic', 'KAT05', 49000.00, 32000.00, 18, 'pcs'
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM barang LIMIT 1);
