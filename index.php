<?php
require_once "config/database.php";
require_once "models/TopUpReguler.php";
require_once "models/TopUpLangganan.php";
require_once "models/TopUpPremium.php";

$database = new Database();
$db = $database->getConnection();

// Mengambil data mentah dari database menggunakan metode statis
$dataReguler = TopUpReguler::getDaftarReguler($db);
$dataLangganan = TopUpLangganan::getDaftarLangganan($db);
$dataPremium = TopUpPremium::getDaftarPremium($db);

// Menampung semua objek ke dalam satu array penampung polimorfik
$listTransaksi = [];

foreach ($dataReguler as $row) {
    $listTransaksi[] = new TopUpReguler(
        $row['id_transaksi'], $row['nama_pembeli'], $row['id_akun_game'],
        $row['jumlah_item'], $row['harga_dasar_paket'], $row['bonus_diamond'], $row['biaya_admin']
    );
}

foreach ($dataLangganan as $row) {
    $listTransaksi[] = new TopUpLangganan(
        $row['id_transaksi'], $row['nama_pembeli'], $row['id_akun_game'],
        $row['jumlah_item'], $row['harga_dasar_paket'], $row['voucher_diskon']
    );
}

foreach ($dataPremium as $row) {
    $listTransaksi[] = new TopUpPremium(
        $row['id_transaksi'], $row['nama_pembeli'], $row['id_akun_game'],
        $row['jumlah_item'], $row['harga_dasar_paket'], $row['akses_border_eksklusif'],
        $row['cashback_koin'], $row['pajak_layanan']
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFAN STORE - Top Up Game Termurah & Terpercaya</title>
    <style>
        /* Reset & Global Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0f172a; color: #f8fafc; }
        
        /* Navbar / Header */
        header { background: linear-gradient(90deg, #1e3a8a, #3b82f6); padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        header h1 { font-size: 28px; font-weight: 800; color: #fff; letter-spacing: 1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        .nav-links { font-weight: bold; color: #bfdbfe; font-size: 14px; }

        /* Container */
        .container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; }
        .section-title { font-size: 22px; font-weight: 700; margin-bottom: 20px; color: #60a5fa; border-left: 4px solid #3b82f6; padding-left: 10px; }

        /* Game Grid Showcase */
        .game-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 50px; }
        .game-card { background: #1e293b; border-radius: 12px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; border: 1px solid #334155; cursor: pointer; }
        .game-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4); border-color: #3b82f6; }
        .game-card img { width: 100%; height: 150px; object-fit: cover; }
        .game-card-content { padding: 15px; text-align: center; }
        .game-card-content h3 { font-size: 18px; color: #fff; margin-bottom: 5px; }
        .game-card-content p { font-size: 12px; color: #94a3b8; margin-bottom: 15px; }
        .btn-topup { background: #f59e0b; color: #fff; border: none; padding: 8px 20px; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.2s; width: 100%; }
        .btn-topup:hover { background: #d97706; }

        /* Tables for Transaction OOP */
        .table-wrapper { background: #1e293b; border-radius: 12px; overflow: hidden; margin-bottom: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); border: 1px solid #334155; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 15px 20px; border-bottom: 1px solid #334155; font-size: 14px; }
        th { background-color: #0f172a; color: #94a3b8; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        tr:hover { background-color: #2dd4bf1a; }
        
        /* Badges & Colors */
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .bg-reguler { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid #3b82f6; }
        .bg-langganan { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid #10b981; }
        .bg-premium { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid #f59e0b; }
        .total-harga { font-weight: 800; color: #10b981; }
        code { background: #0f172a; padding: 3px 6px; border-radius: 4px; color: #f472b6; font-family: monospace; }
        
        /* Footer */
        footer { text-align: center; padding: 20px; color: #64748b; font-size: 13px; margin-top: 20px; border-top: 1px solid #334155; }
    </style>
</head>
<body>

    <header>
        <h1>⚡ AFAN STORE</h1>
        <div class="nav-links">Pusat Top-Up Game & Voucher</div>
    </header>

    <div class="container">
        
        <h2 class="section-title">Pilih Game Favoritmu</h2>
        <div class="game-grid">
            <div class="game-card">
                <img src="https://placehold.co/600x300/1e1e38/ffffff?text=Mobile+Legends" alt="Mobile Legends">
                <div class="game-card-content">
                    <h3>Mobile Legends: Bang Bang</h3>
                    <p>Diamonds & Weekly Pass</p>
                    <button class="btn-topup">Top Up Sekarang</button>
                </div>
            </div>
            <div class="game-card">
                <img src="https://placehold.co/600x300/ff9900/ffffff?text=PUBG+Mobile" alt="PUBG Mobile">
                <div class="game-card-content">
                    <h3>PUBG Mobile</h3>
                    <p>UC & Royale Pass</p>
                    <button class="btn-topup">Top Up Sekarang</button>
                </div>
            </div>
            <div class="game-card">
                <img src="https://placehold.co/600x300/ff4655/ffffff?text=Valorant" alt="Valorant">
                <div class="game-card-content">
                    <h3>Valorant</h3>
                    <p>Valorant Points (VP)</p>
                    <button class="btn-topup">Top Up Sekarang</button>
                </div>
            </div>
            <div class="game-card">
                <img src="https://placehold.co/600x300/10b981/ffffff?text=Free+Fire" alt="Free Fire">
                <div class="game-card-content">
                    <h3>Free Fire</h3>
                    <p>Diamonds & Membership</p>
                    <button class="btn-topup">Top Up Sekarang</button>
                </div>
            </div>
        </div>

        <h2 class="section-title" style="margin-top: 40px;">Riwayat Transaksi Langsung (Live OOP Data)</h2>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th colspan="7"><span class="badge bg-reguler">Tier: Top-Up Reguler</span></th>
                </tr>
                <tr>
                    <th>ID</th><th>Nama Pembeli</th><th>ID Akun (Server)</th><th>Jml</th><th>Harga Paket</th><th>Fasilitas & Bonus</th><th>Total Bayar</th>
                </tr>
                <?php foreach ($listTransaksi as $tx): ?>
                    <?php if ($tx instanceof TopUpReguler): ?>
                    <tr>
                        <td>#<?= $tx->getIdTransaksi(); ?></td>
                        <td><?= $tx->getNamaPembeli(); ?></td>
                        <td><code><?= $tx->getIdAkunGame(); ?></code></td>
                        <td><?= $tx->getJumlahItem(); ?> Item</td>
                        <td>Rp <?= number_format($tx->getHargaDasarPaket(), 0, ',', '.'); ?></td>
                        <td><?= $tx->getDetailBonus(); ?></td>
                        <td class="total-harga">Rp <?= number_format($tx->hitungTotalBayar(), 0, ',', '.'); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th colspan="7"><span class="badge bg-langganan">Tier: Langganan Pass</span></th>
                </tr>
                <tr>
                    <th>ID</th><th>Nama Pembeli</th><th>ID Akun (Server)</th><th>Durasi</th><th>Harga per Bulan</th><th>Fasilitas & Bonus</th><th>Total Bayar</th>
                </tr>
                <?php foreach ($listTransaksi as $tx): ?>
                    <?php if ($tx instanceof TopUpLangganan): ?>
                    <tr>
                        <td>#<?= $tx->getIdTransaksi(); ?></td>
                        <td><?= $tx->getNamaPembeli(); ?></td>
                        <td><code><?= $tx->getIdAkunGame(); ?></code></td>
                        <td><?= $tx->getJumlahItem(); ?>x Pas</td>
                        <td>Rp <?= number_format($tx->getHargaDasarPaket(), 0, ',', '.'); ?></td>
                        <td><?= $tx->getDetailBonus(); ?></td>
                        <td class="total-harga">Rp <?= number_format($tx->hitungTotalBayar(), 0, ',', '.'); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th colspan="7"><span class="badge bg-premium">Tier: Premium / VIP</span></th>
                </tr>
                <tr>
                    <th>ID</th><th>Nama Pembeli</th><th>ID Akun (Server)</th><th>Jml</th><th>Harga Paket</th><th>Fasilitas & Bonus</th><th>Total Bayar</th>
                </tr>
                <?php foreach ($listTransaksi as $tx): ?>
                    <?php if ($tx instanceof TopUpPremium): ?>
                    <tr>
                        <td>#<?= $tx->getIdTransaksi(); ?></td>
                        <td><?= $tx->getNamaPembeli(); ?></td>
                        <td><code><?= $tx->getIdAkunGame(); ?></code></td>
                        <td><?= $tx->getJumlahItem(); ?> Paket</td>
                        <td>Rp <?= number_format($tx->getHargaDasarPaket(), 0, ',', '.'); ?></td>
                        <td><?= $tx->getDetailBonus(); ?></td>
                        <td class="total-harga">Rp <?= number_format($tx->hitungTotalBayar(), 0, ',', '.'); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>

    </div>

    <footer>
        &copy; 2026 AFAN STORE | Proyek Simulasi PBO - Sistem Reservasi & Manajemen Database
    </footer>

</body>
</html>