<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\ProductModel;
use App\Models\TransactionProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;

date_default_timezone_set('Asia/Jakarta');

class TransactionController extends BaseController
{
    protected $transactionModel;
    protected $productModel;
    protected $transactionProductModel; // Tambahkan ini

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
        $this->transactionProductModel = new TransactionProductModel(); // Inisialisasi model
    }

    public function index()
    {
        $transactionModel = new \App\Models\TransactionModel();
        $transactionProductModel = new \App\Models\TransactionProductModel();

        // Ambil semua transaksi
        $transactions = $transactionModel->findAll();

        // Tambahkan detail produk pada masing-masing transaksi
        foreach ($transactions as &$transaction) {
            $products = $transactionProductModel
                ->select('products.name, transaction_products.quantity')
                ->join('products', 'products.id = transaction_products.product_id')
                ->where('transaction_products.transaction_id', $transaction['id'])
                ->findAll();

            $transaction['products'] = $products;
        }

        return view('backend/transactions/index', ['transactions' => $transactions]);
    }



    public function create()
    {
        $data['products'] = $this->productModel->findAll(); // Mengambil semua produk

        // Debug: Cek apakah produk berhasil diambil
        if (empty($data['products'])) {
            log_message('error', 'No products found in the database.');
        }

        return view('backend/transactions/create', $data); // Mengirim data ke view
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Start database transaction

        // Save main transaction data
        $transactionData = [
            'customer_name' => $this->request->getPost('customer_name'),
            'payment_status' => $this->request->getPost('payment_status'),
            'transaction_date' => date('Y-m-d H:i:s'),
            'grand_total' => (float) $this->request->getPost('grand_total'), // Pastikan ini diambil dengan benar
        ];

        // Debug: Cek data yang disimpan
        log_message('info', 'Transaction Data: ' . json_encode($transactionData));

        $transactionId = $this->transactionModel->insert($transactionData); // Insert transaction

        if (!$transactionId) {
            log_message('error', 'Failed to insert transaction');
            return redirect()->back()->with('error', 'Failed to save transaction.');
        }

        // Prepare and save related products
        $products = $this->request->getPost('product_id');
        $quantities = $this->request->getPost('quantity');

        $transactionProducts = [];
        foreach ($products as $index => $productId) {
            $quantity = (int) $quantities[$index];

            // Check if data is valid
            if ($productId && $quantity > 0) {
                // Prepare data for transaction products table
                $transactionProducts[] = [
                    'transaction_id' => $transactionId, // Use the correct transaction ID
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ];

                // Reduce product stock after a valid purchase
                $this->reduceProductStock($productId, $quantity);
            }
        }

        if (!empty($transactionProducts)) {
            $insertedProducts = $this->transactionProductModel->insertBatch($transactionProducts); // Save all products
            if (!$insertedProducts) {
                log_message('error', 'Failed to insert products');
                return redirect()->back()->with('error', 'Failed to save products.');
            }
        }

        $db->transComplete(); // Complete database transaction

        if ($db->transStatus() === false) {
            log_message('error', 'Transaction failed');
            return redirect()->back()->with('error', 'Failed to save transaction.');
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction successfully added.');
    }

    // Helper: Update stok produk
    private function reduceProductStock($productId, $quantity)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($productId);
        if ($product && $product['quantity'] >= $quantity) {
            $productModel->update($productId, [
                'quantity' => $product['quantity'] - $quantity,
            ]);
        }
    }

    // Helper: Ambil harga produk
    private function getProductPrice($productId)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($productId);
        return $product['price'] ?? 0;
    }

    public function downloadStruk($transactionId)
{
    $transactionModel = new TransactionModel();
    $transactionProductModel = new TransactionProductModel();
    
    // Ambil data transaksi berdasarkan ID
    $transaction = $transactionModel->find($transactionId);

    // Cek apakah transaksi ditemukan
    if (!$transaction) {
        return redirect()->back()->with('error', 'Transaction not found.');
    }

    // Ambil produk yang terkait dengan transaksi
    $products = $transactionProductModel
        ->select('transaction_products.quantity, products.name, products.price')
        ->join('products', 'products.id = transaction_products.product_id')
        ->where('transaction_id', $transactionId)
        ->findAll();

    // Cek apakah produk ditemukan
    if (empty($products)) {
        return redirect()->back()->with('error', 'No products found for this transaction.');
    }

    // Hitung total harga
    $totalPrice = 0;
    foreach ($products as $product) {
        $totalPrice += $product['price'] * $product['quantity'];
    }

    // Buat tampilan HTML untuk struk
    $html = view('backend/transactions/struk', [
        'transaction' => $transaction,
        'products' => $products,
        'totalPrice' => $totalPrice
    ]);

    // Set opsi DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    // Inisialisasi DomPDF
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);

    // Set ukuran kertas dan orientasi
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Output PDF ke browser
    return $dompdf->stream("struk-transaction-{$transactionId}.pdf", array("Attachment" => false));
}
}
