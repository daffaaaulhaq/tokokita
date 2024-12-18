<?= $this->extend('backend/layout/pages-layout') ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Daftar Transaksi</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Daftar Transaksi
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Daftar Transaksi -->
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="table-responsive p-4">
                <div class="mb-3 text-right">
                    <a href="<?= route_to('transactions.create'); ?>" class="btn btn-primary">Tambah Transaksi</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Download Struk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Array untuk nama hari dalam bahasa Indonesia
                        $days = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];

                        foreach ($transactions as $transaction): 
                        ?>
                            <tr>
                                <td><?= $transaction['id']; ?></td>
                                <td><?= $transaction['customer_name']; ?></td>
                                <td>
                                    <?php if (!empty($transaction['products'])): ?>
                                        <ul>
                                            <?php foreach ($transaction['products'] as $product): ?>
                                                <li><?= $product['name'] . ' (' . $product['quantity'] . ')'; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        Tidak ada produk
                                    <?php endif; ?>
                                </td>
                                <td>IDR <?= number_format($transaction['grand_total'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php 
                                    // Mengambil nama hari dalam bahasa Inggris dan menggantinya dengan bahasa Indonesia
                                    $date = new DateTime($transaction['transaction_date']);
                                    $dayName = $date->format('l'); // Nama hari dalam bahasa Inggris (misalnya Monday, Tuesday)
                                    echo $date->format('H:i') . ' / ' . $days[$dayName] . ' / ' . $date->format('d-m-Y');
                                    ?>
                                </td>
                                <td><?= $transaction['payment_status']; ?></td>
                                <td>
                                <a href="<?= route_to('transactions.download', $transaction['id']); ?>" class="btn btn-info btn-sm">Download Struk</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-4"></div>
<?= $this->endSection() ?>
