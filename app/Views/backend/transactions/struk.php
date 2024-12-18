<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            background-color:rgb(155, 155, 155);
            color: white;
            padding: 10px 0;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
        }

        .address {
            font-size: 14px;
        }

        .info {
            margin: 20px;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color:rgb(155, 155, 155);
            color: white;
        }

        .total {
            font-weight: bold;
            text-align: right;
            margin: 20px;
            font-size: 18px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Toko Kita</h1>
        <p class="address">Jl. Dago atas No 9, Bandung</p>
        <p>Telp: 08512345678</p>
    </div>

    <div class="info">
        <p><strong>Nama Pelanggan:</strong> <?= htmlspecialchars($transaction['customer_name']); ?></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($transaction['transaction_date'])); ?></p>
        <p><strong>Status Pembayaran:</strong> <?= htmlspecialchars($transaction['payment_status']); ?></p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Banyak Produk</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= isset($product['name']) ? htmlspecialchars($product['name']) : 'N/A'; ?></td>
                    <td><?= htmlspecialchars($product['quantity']); ?></td>
                    <td>IDR <?= isset($product['price']) ? number_format($product['price'] * $product['quantity'], 0, ',', '.') : 'N/A'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total Semua Harga: IDR <?= number_format($totalPrice, 0, ',', '.'); ?></strong></p>
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di Toko Kita!</p>
    </div>
</body>

</html>