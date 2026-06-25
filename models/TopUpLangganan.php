<?php
require_once "TransaksiTopUp.php";

class TopUpLangganan extends TransaksiTopUp {
    private $voucher_diskon;

    public function __construct($id, $nama, $id_game, $jumlah, $harga, $voucher_diskon) {
        parent::__construct($id, $nama, $id_game, $jumlah, $harga);
        $this->voucher_diskon = $voucher_diskon;
    }

    // Tahap 5: Overriding Perhitungan Bayar
    public function hitungTotalBayar() {
        return ($this->harga_dasar_paket * $this->jumlah_item) - $this->voucher_diskon;
    }

    public function getDetailBonus() {
        return "Diskon Potongan: Rp " . number_format($this->voucher_diskon, 0, ',', '.');
    }

    // Tahap 4: Query Spesifik Kategori
    public static function getDaftarLangganan($db) {
        $query = "SELECT * FROM tabel_transaksi WHERE kategori_topup = 'Langganan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}