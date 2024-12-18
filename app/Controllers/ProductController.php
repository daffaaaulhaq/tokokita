<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        // Ambil semua produk dari tabel
        $products = $productModel->findAll();

        // Kirim data ke view
        return view('backend/product/index', ['products' => $products]);

        helper('number');
        // Pastikan setiap harga adalah angka desimal yang valid
        foreach ($products as $key => $product) {
            if (!is_numeric($product['price'])) {
                $products[$key]['price'] = 'Data harga tidak valid';
            }
        }
    }

    public function create()
    {
        return view('backend/product/create', [
            'validation' => \Config\Services::validation()
        ]);
    }


    public function edit($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }

        return view('backend/product/edit', ['product' => $product]);
    }



    public function delete($id)
    {
        $productModel = new ProductModel();

        // Hapus produk berdasarkan ID
        $productModel->delete($id);

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus');
    }

    public function store()
    {
        $productModel = new ProductModel();
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
        ];

        // Validasi
        if (!$this->validate($productModel->validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Simpan data produk
        $productModel->save($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update($id)
    {
        $productModel = new ProductModel();

        // Validasi input
        if (!$this->validate($productModel->validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Memperbarui data produk
        $productModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function landingPage()
    {
        $productModel = new ProductModel();
        $products = $productModel->findAll(); // Ambil semua produk dari database

        return view('frontend/landing-page', [
            'products' => $products,
            'storeName' => 'Toko Kitaa', // Ganti dengan nama toko Anda
        ]);
    }
}
