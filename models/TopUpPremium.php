<?php
require_once "TransaksiTopUp.php";

class TopUpPremium extends TransaksiTopUp {
    private $akses_border_eksklusif;
    private $cashback_koin;
    private $pajak_layanan;

    public function __construct($id, $nama, $id_game, $jumlah, $harga, $border, $cashback, $pajak) {
        parent::__construct($id, $nama, $id_game, $jumlah, $harga);
        $this->akses_border_eksklusif = $border;
        $this->cashback_koin = $cashback;
        $this->pajak_layanan = $pajak; // Menggunakan persentase (Contoh: 11%)
    }

    // Tahap 5: Overriding Perhitungan Bayar
    public function hitungTotalBayar() {
        $pajak = ($this->pajak_layanan / 100) * $this->harga_dasar_paket;
        return ($this->harga_dasar_paket + $pajak) + 2500;
    }

    public function getDetailBonus() {
        $border_status = $this->akses_border_eksklusif ? "Aktif" : "Tidak Ada";
        return "Border VIP: " . $border_status . " | Cashback: " . $this->cashback_koin . " Koin";
    }

    // Tahap 4: Query Spesifik Kategori
    public static function getDaftarPremium($db) {
        $query = "SELECT * FROM tabel_transaksi WHERE kategori_topup = 'Premium'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}