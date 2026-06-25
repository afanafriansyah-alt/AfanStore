<?php
require_once "TransaksiTopUp.php";

class TopUpReguler extends TransaksiTopUp {
    private $bonus_diamond;
    private $biaya_admin;

    public function __construct($id, $nama, $id_game, $jumlah, $harga, $bonus_diamond, $biaya_admin) {
        parent::__construct($id, $nama, $id_game, $jumlah, $harga);
        $this->bonus_diamond = $bonus_diamond;
        $this->biaya_admin = $biaya_admin;
    }

    // Tahap 5: Overriding Perhitungan Bayar
    public function hitungTotalBayar() {
        return $this->harga_dasar_paket + $this->biaya_admin;
    }

    // Tahap 5: Overriding Detail Bonus
    public function getDetailBonus() {
        return "Bonus: " . $this->bonus_diamond . " Diamonds (Biaya Admin: Rp " . number_format($this->biaya_admin, 0, ',', '.') . ")";
    }

    // Tahap 4: Query Spesifik Kategori
    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_transaksi WHERE kategori_topup = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}