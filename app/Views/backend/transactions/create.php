<?= $this->extend('backend/layout/pages-layout') ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Tambah Transaksi</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('transactions.index'); ?>">Daftar Transaksi</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Tambah Transaksi
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Form Tambah Transaksi -->
<div class="row">
    <div class="col-12">
        <div class="card-box p-4">
            <form action="<?= route_to('transactions.store'); ?>" method="POST" id="transactionForm">
                <?= csrf_field() ?>

                <div id="productList">
                    <div class="product-item">
                        <div class="form-group">
                            <label for="product_id">Produk:</label>
                            <select name="product_id[]" class="form-control product_id" required onchange="updatePrice(this)">
                                <option value="">Pilih Produk</option>
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?= $product['id']; ?>" data-price="<?= $product['price']; ?>">
                                            <?= $product['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Tidak ada produk tersedia</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Jumlah:</label>
                            <input type="number" name="quantity[]" class="form-control quantity" required oninput="updatePrice(this)">
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-3" onclick="addProduct()">Tambah Produk</button>

                <div class="form-group">
                    <label for="customer_name">Nama Pelanggan:</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="payment_status">Status Pembayaran:</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="Unpaid">Unpaid</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="grand_total">Total Harga Keseluruhan:</label>
                    <input type="text" name="grand_total" id="grand_total" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updatePrice(element) {
    const productItems = document.querySelectorAll('.product-item');
    let grandTotal = 0;

    productItems.forEach(item => {
        const productSelect = item.querySelector('.product_id');
        const quantityInput = item.querySelector('.quantity');

        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = selectedOption ? parseFloat(selectedOption.getAttribute('data-price')) : 0;
        const quantity = parseInt(quantityInput.value) || 0;

        grandTotal += price * quantity;
    });

    const grandTotalInput = document.getElementById('grand_total');
    grandTotalInput.value = grandTotal.toFixed(2); // Format dengan dua desimal
}



    function addProduct() {
        const productList = document.getElementById('productList');
        const newProductItem = document.createElement('div');
        newProductItem.classList.add('product-item', 'mt-3');

        newProductItem.innerHTML = `
            <div class="form-group">
                <label for="product_id">Produk:</label>
                <select name="product_id[]" class="form-control product_id" required onchange="updatePrice(this)">
                    <option value="">Pilih Produk</option>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id']; ?>" data-price="<?= $product['price']; ?>">
                                <?= $product['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Tidak ada produk tersedia</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" name="quantity[]" class="form-control quantity" required oninput="updatePrice(this)">
            </div>
        `;

        productList.appendChild(newProductItem);
    }
</script>

<div class="mt-4"></div>
<?= $this->endSection() ?>