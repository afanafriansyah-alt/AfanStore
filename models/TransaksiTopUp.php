<?php
abstract class TransaksiTopUp {
    protected $id_transaksi;
    protected $nama_pembeli;
    protected $id_akun_game;
    protected $jumlah_item;
    protected $harga_dasar_paket;

    public function __construct($id_transaksi, $nama_pembeli, $id_akun_game, $jumlah_item, $harga_dasar_paket) {
        $this->id_transaksi = $id_transaksi;
        $this->nama_pembeli = $nama_pembeli;
        $this->id_akun_game = $id_akun_game;
        $this->jumlah_item = $jumlah_item;
        $this->harga_dasar_paket = $harga_dasar_paket;
    }

    // Getter untuk kebutuhan enkapsulasi saat dipanggil di View
    public function getIdTransaksi() { return $this->id_transaksi; }
    public function getNamaPembeli() { return $this->nama_pembeli; }
    public function getIdAkunGame() { return $this->id_akun_game; }
    public function getJumlahItem() { return $this->jumlah_item; }
    public function getHargaDasarPaket() { return $this->harga_dasar_paket; }

    // Metode Abstrak wajib
    abstract public function hitungTotalBayar();
    abstract public function getDetailBonus();
}