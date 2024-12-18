<?= $this->extend('backend/layout/pages-layout') ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Edit Produk</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('product.index'); ?>">Daftar Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Produk
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Form Edit Produk -->
<div class="row">
    <div class="col-12">
        <div class="card-box p-4">
            <form action="<?= route_to('product.update', $product['id']); ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= old('name', $product['name']); ?>" placeholder="Masukkan Nama Produk">
                    <div class="text-danger"><?= session('validation') ? session('validation')->getError('name') : ''; ?></div>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Masukkan Deskripsi Produk"><?= old('description', $product['description']); ?></textarea>
                    <div class="text-danger"><?= session('validation') ? session('validation')->getError('description') : ''; ?></div>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="text" name="price" id="price" class="form-control" value="<?= old('price', $product['price']); ?>" placeholder="Masukkan Harga Produk">
                    <div class="text-danger"><?= session('validation') ? session('validation')->getError('price') : ''; ?></div>
                </div>
                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?= old('quantity', $product['quantity']); ?>" placeholder="Masukkan Jumlah Produk">
                    <div class="text-danger"><?= session('validation') ? session('validation')->getError('quantity') : ''; ?></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Perbarui Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mt-4"></div>
<?= $this->endSection() ?>
