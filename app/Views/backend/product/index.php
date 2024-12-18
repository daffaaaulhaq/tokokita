<?= $this->extend('backend/layout/pages-layout') ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Daftar Produk</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Daftar Produk
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Tambah Produk Button -->

<!-- Daftar Produk -->
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="table-responsive p-4">
                <div class="mb-3 text-right">
                    <a href="<?= route_to('product.create'); ?>" class="btn btn-primary">Tambah Produk</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id']; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><?= $product['description']; ?></td>
                                <td><?= 'IDR ' . number_format($product['price']); ?></td>
                                <td><?= $product['quantity']; ?></td>
                                <td>
                                    <a href="<?= route_to('product.edit', $product['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= route_to('product.delete', $product['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk ini?')">Hapus</a>
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