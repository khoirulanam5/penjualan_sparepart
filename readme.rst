# 🛠️ Sistem Penjualan Sparepart dengan Algoritma **FP-Growth**

Sistem ini digunakan untuk mengelola penjualan sparepart dengan fitur *market basket analysis* menggunakan **algoritma FP-Growth** untuk menemukan pola pembelian pelanggan. Sistem dilengkapi dengan manajemen stok, transaksi, laporan, serta landing page modern.

---

## 🚀 Teknologi yang Digunakan

* **Backend:** CodeIgniter 3
* **Database:** MySQL
* **Frontend:** HTML, CSS, JavaScript, Bootstrap
* **Algoritma:** FP-Growth (Frequent Pattern Growth)
* **UI:** Landing page modern dan responsif

---

## 👥 Role Pengguna

### 1. **Counter**

* Input data layanan / sparepart masuk
* Verifikasi kebutuhan pelanggan awal

### 2. **Kasir**

* Melakukan transaksi penjualan
* Input item pembelian
* Cetak struk

### 3. **Frontdesk**

* Mengatur antrian service
* Melayani pelanggan yang membutuhkan konsultasi

### 4. **Kepala / Pimpinan**

* Melihat laporan penjualan
* Melihat hasil analisis pola pembelian (FP-Growth)
* Monitoring aktivitas seluruh user

### 5. **Pelanggan**

* Melihat informasi sparepart
* Melakukan pemesanan pada landing page

---

## ⭐ Fitur Unggulan

### 🔹 **1. Manajemen Sparepart**

* Tambah, edit, hapus sparepart
* Cek stok & pengingat stok minimum

### 🔹 **2. Transaksi Penjualan**

* Input pembelian pelanggan
* Cetak struk
* Riwayat transaksi lengkap

### 🔹 **3. Algoritma FP-Growth**

* Analisis pola pembelian berdasarkan data penjualan
* Menghasilkan frequent itemset
* Rekomendasi produk yang sering dibeli bersama

### 🔹 **4. Laporan Lengkap**

* Laporan penjualan harian, mingguan, bulanan
* Laporan stok
* Laporan hasil analisis FP-Growth

### 🔹 **5. Landing Page Modern**

* Informasi sparepart
* Promo & rekomendasi
* Responsif dan interaktif

---

## 📂 Struktur Folder (Singkat)

```
/application
    /controllers
    /models
    /views
/assets
    /css
    /js
    /img
/database
    sparepart_fp.sql
/index.php
```

---

## 🛠️ Instalasi

1. Clone atau download project
2. Import database `sparepart_fp.sql`
3. Atur koneksi database di `/application/config/database.php`
4. Jalankan di localhost (XAMPP, Laragon, dsb.)

---

## 🧠 Tentang Algoritma FP-Growth

Algoritma FP-Growth digunakan untuk menemukan pola pembelian pelanggan tanpa perlu membangkitkan candidate itemset seperti Apriori. Kelebihannya:

* Lebih cepat dan efisien
* Cocok untuk dataset besar
* Memberikan insight untuk rekomendasi produk

---

## 📝 Lisensi

Project ini dibuat untuk kebutuhan sistem penjualan dan analisis pola pembelian menggunakan FP-Growth.

---
