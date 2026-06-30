LAPORAN AKHIR
WORKSHOP DESAIN UI
"CihuyFootwear"








Muhammad Anshari Shidqi
434241075








FAKULTAS VOKASI
UNIVERSITAS AIRLANGGA
2024

---

DAFTAR ISI

DAFTAR ISI    ii
DAFTAR GAMBAR    iii
DAFTAR TABEL    iv

BAB 1    1
PENDAHULUAN    1
1. Deskripsi Topik    1
2. User Story    1
3. Use Case    2
4. Use Case Specification    3

BAB 2    5
DESAIN SISTEM    5
1. Wireframe    5
2. Front End    6
3. Pengujian Sistem    25

LAMPIRAN    26

---

DAFTAR GAMBAR

Gambar 1. Halaman Landing Page (Home) — Hero Section    6
Gambar 2. Halaman Landing Page — Brand Recommendation    6
Gambar 3. Halaman Landing Page — Featured Articles    7
Gambar 4. Halaman Koleksi Produk (Catalog)    8
Gambar 5. Halaman Filter Produk pada Koleksi    8
Gambar 6. Halaman Detail Produk    9
Gambar 7. Halaman Keranjang Belanja    10
Gambar 8. Halaman Checkout — Step 1 (Pengiriman)    11
Gambar 9. Halaman Checkout — Step 2 (Pembayaran)    12
Gambar 10. Halaman Riwayat Pesanan (History)    13
Gambar 11. Halaman Detail Pesanan Pelanggan    14
Gambar 12. Halaman Artikel (Blog)    15
Gambar 13. Halaman Detail Artikel    16
Gambar 14. Halaman Login    17
Gambar 15. Halaman Registrasi    18
Gambar 16. Halaman Dashboard Admin    19
Gambar 17. Halaman Kelola Produk — Daftar Produk    20
Gambar 18. Halaman Kelola Produk — Tambah/Edit Produk    20
Gambar 19. Halaman Kelola Artikel — Daftar Artikel    21
Gambar 20. Halaman Kelola Artikel — Arsip Artikel    22
Gambar 21. Halaman Kelola Pesanan Admin    23
Gambar 22. Halaman Kelola Pengguna    24
Gambar 23. Halaman Struktur Folder Views    25

DAFTAR TABEL

Tabel 1. User Story — Pelanggan    1
Tabel 2. User Story — Admin    2
Tabel 3. Use Case Diagram — Actor dan Fungsi    2
Tabel 4. Use Case Specification — Login    3
Tabel 5. Use Case Specification — Kelola Produk    3
Tabel 6. Use Case Specification — Checkout    3
Tabel 7. Use Case Specification — Kelola Pesanan    4
Tabel 8. Struktur Database — Tabel Users    4
Tabel 9. Struktur Database — Tabel Barang    4
Tabel 10. Struktur Database — Tabel Pesanan    4
Tabel 11. Struktur Database — Tabel Detail Pesanan    4
Tabel 12. Struktur Database — Tabel Artikel    5
Tabel 13. Spesifikasi Teknis Aplikasi    25

---

BAB 1
PENDAHULUAN

CihuyFootwear adalah aplikasi e-commerce berbasis web yang dirancang untuk memenuhi kebutuhan pengelolaan dan penjualan produk sepatu secara online. Aplikasi ini menyediakan dua antarmuka utama, yaitu antarmuka pelanggan (customer-facing) yang memungkinkan pengguna untuk melihat koleksi produk, menambah ke keranjang, melakukan checkout, serta melihat riwayat pesanan, dan antarmuka admin (dashboard) yang memungkinkan administrator untuk mengelola produk, artikel, pesanan, serta pengguna secara menyeluruh.

Proyek ini dibangun menggunakan framework Laravel dengan bahasa pemrograman PHP, database relasional untuk penyimpanan data, serta antarmuka pengguna yang responsif menggunakan Bootstrap 5 dan CSS kustom. Aplikasi ini mendukung autentikasi berbasis role, di mana setiap pengguna memiliki hak akses yang berbeda antara pelanggan dan administrator.

---

1. Deskripsi Topik

CihuyFootwear adalah sistem informasi e-commerce untuk toko sepatu yang mencakup fitur-fitur utama berikut:

a. Halaman Landing Page yang menampilkan brand recommendation, produk rekomendasi, dan artikel terbaru.
b. Katalog Produk dengan filter berbasis gender, brand, dan tipe sepatu.
c. Detail Produk dengan informasi harga, ukuran, dan deskripsi lengkap.
d. Keranjang Belanja berbasis session (session-based cart).
e. Proses Checkout dua langkah: informasi pengiriman dan metode pembayaran.
f. Riwayat Pesanan pelanggan.
g. Dashboard Admin untuk pengelolaan produk, artikel, pesanan, dan pengguna.
h. Sistem Artikel/Blog dengan fitur soft-delete (arsip).
i. Sistem autentikasi dengan role-based access control (admin dan pelanggan).
j. Integrasi data wilayah Indonesia (Provinsi, Kota, Kecamatan, Kelurahan) melalui API internal.

Scope proyek ini mencakup pengembangan front-end dan back-end secara penuh, mulai dari desain UI/UX, implementasi logika bisnis, hingga pengujian fungsionalitas sistem.

---

2. User Story

**Tabel 1. User Story — Pelanggan**

| ID | Sebagai | Saya ingin | Agar | Prioritas |
|----|---------|------------|------|-----------|
| US-01 | Pelanggan | melihat daftar produk sepatu lengkap | bisa memilih produk yang diinginkan | High |
| US-02 | Pelanggan | memfilter produk berdasarkan gender, brand, dan tipe | menemukan produk lebih cepat | High |
| US-03 | Pelanggan | melihat detail produk (harga, ukuran, deskripsi) | membuat keputusan pembelian | High |
| US-04 | Pelanggan | menambahkan produk ke keranjang | bisa berbelanja lebih dari satu produk | High |
| US-05 | Pelanggan | memilih ukuran sebelum checkout | mendapatkan produk dengan ukuran yang sesuai | High |
| US-06 | Pelanggan | memasukkan alamat pengiriman atau memilih Store Pickup | bisa memilih cara pengambilan barang | High |
| US-07 | Pelanggan | memilih metode pembayaran | bisa menyelesaikan transaksi dengan nyaman | High |
| US-08 | Pelanggan | melihat riwayat pesanan | melacak status pesanan | Medium |
| US-09 | Pelanggan | membaca artikel tentang sepatu dan tips perawatan | mendapatkan informasi tambahan | Low |
| US-10 | Pelanggan | membuat akun dan login | bisa mengakses riwayat pesanan | Medium |

**Tabel 2. User Story — Admin**

| ID | Sebagai | Saya ingin | Agar | Prioritas |
|----|---------|------------|------|-----------|
| US-11 | Admin | login ke dashboard | bisa mengelola sistem | High |
| US-12 | Admin | menambah, mengubah, dan menghapus produk | menjaga katalog produk tetap terkini | High |
| US-13 | Admin | melihat daftar pesanan masuk | memproses pesanan pelanggan | High |
| US-14 | Admin | mengubah status pesanan (P, CON, S, D, C) | pelanggan bisa melacak pesanan | High |
| US-15 | Admin | menambah, mengubah, dan menghapus artikel | menjaga konten blog tetap aktif | Medium |
| US-16 | Admin | memulihkan artikel dari arsip | tidak kehilangan data yang terhapus | Low |
| US-17 | Admin | mengelola akun pengguna | mengatur akses pengguna sistem | Medium |

---

3. Use Case

**Tabel 3. Use Case Diagram — Actor dan Fungsi**

| No | Aktor | Use Case / Fungsi |
|----|-------|-------------------|
| 1 | Pelanggan (Guest) | UC-01: Registrasi Akun |
| 2 | Pelanggan (Guest) | UC-02: Login |
| 3 | Pelanggan | UC-03: Melihat Katalog Produk |
| 4 | Pelanggan | UC-04: Memfilter Produk |
| 5 | Pelanggan | UC-05: Melihat Detail Produk |
| 6 | Pelanggan | UC-06: Menambah ke Keranjang |
| 7 | Pelanggan | UC-07: Mengelola Keranjang |
| 8 | Pelanggan | UC-08: Checkout |
| 9 | Pelanggan | UC-09: Memilih Metode Pengiriman |
| 10 | Pelanggan | UC-10: Memilih Metode Pembayaran |
| 11 | Pelanggan | UC-11: Melihat Riwayat Pesanan |
| 12 | Pelanggan | UC-12: Melihat Detail Pesanan |
| 13 | Pelanggan | UC-13: Membaca Artikel |
| 14 | Admin | UC-14: Login Admin |
| 15 | Admin | UC-15: Kelola Produk (CRUD) |
| 16 | Admin | UC-16: Kelola Artikel (CRUD + Arsip) |
| 17 | Admin | UC-17: Kelola Pesanan |
| 18 | Admin | UC-18: Kelola Pengguna (CRUD) |
| 19 | Admin | UC-19: Melihat Dashboard |

---

4. Use Case Specification

**Tabel 4. Use Case Specification — Login**

| Item | Deskripsi |
|------|---------|
| UC ID | UC-02 |
| Nama | Login |
| Aktor | Pelanggan / Admin |
| Trigger | User mengakses halaman login |
| Pre-condition | User belum login |
| Basic Flow | 1. User memasukkan email dan password |
| | 2. Sistem memvalidasi kredensial |
| | 3. Sistem mengarahkan berdasarkan role: Admin → Dashboard, Pelanggan → Koleksi |
| Alternative Flow | Jika kredensial salah, tampilkan pesan error |
| Post-condition | User masuk ke sistem sesuai role |

**Tabel 5. Use Case Specification — Kelola Produk**

| Item | Deskripsi |
|------|---------|
| UC ID | UC-15 |
| Nama | Kelola Produk |
| Aktor | Admin |
| Pre-condition | Admin sudah login |
| Basic Flow | 1. Admin mengakses menu Produk |
| | 2. Admin melihat daftar produk |
| | 3. Admin menambah produk baru (nama, harga, brand, tipe, gender, deskripsi, gambar) |
| | 4. Admin mengedit produk yang ada |
| | 5. Admin menghapus produk |
| Post-condition | Data produk tersimpan/terupdate di database |

**Tabel 6. Use Case Specification — Checkout**

| Item | Deskripsi |
|------|---------|
| UC ID | UC-08 |
| Nama | Checkout |
| Aktor | Pelanggan (ter-autentikasi) |
| Pre-condition | Pelanggan sudah login dan keranjang tidak kosong |
| Basic Flow | 1. Pelanggan membuka halaman checkout |
| | 2. Pilih metode pengiriman: Delivery (dengan alamat) atau Store Pickup |
| | 3. Jika Delivery: isi formulir alamat (Provinsi → Kota → Kecamatan → Kelurahan) |
| | 4. Pilih metode pembayaran (Virtual Account / Credit Card / QRIS) |
| | 5. Centang syarat dan ketentuan |
| | 6. Klik "Buat Pesanan" |
| | 7. Keranjang dikosongkan, pesanan tersimpan |
| Alternative Flow | Jika alamat tidak lengkap, tampilkan warning per field |
| Post-condition | Pesanan tersimpan dengan status 'P' (Pending) |

**Tabel 7. Use Case Specification — Kelola Pesanan**

| Item | Deskripsi |
|------|---------|
| UC ID | UC-17 |
| Nama | Kelola Pesanan |
| Aktor | Admin |
| Pre-condition | Admin sudah login |
| Basic Flow | 1. Admin mengakses menu Pesanan |
| | 2. Admin melihat daftar pesanan (termasuk status badge P/CON/S/D/C) |
| | 3. Admin mengklik dropdown status untuk mengubah langsung |
| | 4. Admin bisa lihat detail pesanan lengkap |
| Post-condition | Status pesanan ter-update di database |

---

BAB 2
DESAIN SISTEM

Desain sistem pada aplikasi CihuyFootwear mencakup perancangan struktur basis data, wireframe halaman utama, implementasi antarmuka pengguna (front-end), serta pengujian sistem. Desain sistem ini menggunakan pendekatan MVC (Model-View-Controller) yang diterapkan secara native oleh framework Laravel. View dirancang secara statis (tanpa framework JavaScript) dengan bantuan Blade template engine. Styling menggunakan kombinasi Bootstrap 5 untuk layout dasar dan CSS kustom untuk tampilan yang lebih spesifik sesuai identitas brand CihuyFootwear.

---

1. Wireframe

Wireframe dirancang menggunakan pendekatan Mobile-First Responsive Design dengan breakpoint utama pada 480px (mobile), 768px (tablet), dan 1024px (desktop). Berikut wireframe halaman utama:

[Halaman Landing Page]
+------------------------------------------+
| HEADER: Logo | Search | Nav (Home, Koleksi, |
|             Keranjang, Pesanan, Login)     |
+------------------------------------------+------------------+
| HERO SECTION                           |
| "Temukan Sepatu Impianmu"                 |
| CTA: Lihat Koleksi | Baca Artikel       |
+------------------------------------------+
| BRAND RECOMMENDATION (4 brand card)       |
+------------------------------------------+
| PRODUK REKOMENDASI (4 product card)       |
+------------------------------------------+
| ARTIKEL TERBARU (4 article card)         |
+------------------------------------------+
| FOOTER (Brand, Kategori, Info, Akun)    |
+------------------------------------------+

[Halaman Koleksi]
+----------+----------------------------------+
| SIDEBAR  | JUDUL: Our Collection             |
| Filter:  | +------------------------------+ |
| - Gender | | [produk] [produk] [produk]  |
| - Brand  | | [produk] [produk] [produk]  |
| - Tipe   | | [produk] [produk] [produk]  |
|          | | [produk]                    |
+----------+----------------------------------+

[Halaman Checkout - Step 1]
+----------------------------------+
| [Pengiriman] --- [Pembayaran]     |
+----------------------------------+
| Form: Email, Nama, Alamat, Kota   |
| Dropdown Wilayah Indonesia         |
| [    Go to Payment ->]            |
+----------------------------------+

[Halaman Dashboard Admin]
+--------+-----------------------------+
| SIDEBAR | STAT CARDS (4 stat)      |
| Dashboard|---------------------------+
| Produk  | TABLE: Recent Orders      |
| Artikel | ID | Status | Total    |
| Pesanan |-------------------------|
| Logout  | [action dropdown]         |
+--------+-----------------------------+

---

2. Front End

Berikut penjelasan singkat setiap halaman beserta screenshoot hasil implementasi:

**2.1 Landing Page**

Landing page merupakan halaman utama yang diakses pengguna saat pertama kali mengunjungi situs. Halaman ini terdiri dari beberapa section:

a. **Hero Section** — Menampilkan headline utama, tagline, serta dua tombol aksi (CTA): "Lihat Koleksi" dan "Baca Artikel". Hero section menggunakan background image dengan gradient overlay untuk keterbacaan teks.

b. **Brand Recommendation** — Menampilkan 4 brand sepatu yang tersedia (Converse, Prabu, Hoka, Adidas, Nike, Redwing) dalam bentuk card grid responsive. Setiap card memiliki efek hover zoom pada gambar dan tombol aksi.

c. **Produk Rekomendasi** — Menampilkan 4 produk sepatu pilihan dalam card layout dengan badge (Best Seller/New Arrival), gambar, nama, harga, dan tombol aksi.

d. **Featured Articles** — Menampilkan 4 artikel terbaru dari blog dalam card layout dengan image, badge kategori (Trending/Terbaru), judul, excerpt, dan tombol "Baca Selengkapnya".

e. **Footer** — Terdiri dari 4 kolom: informasi brand, kategori, informasi kontak, dan akun pengguna. Footer juga dilengkapi newsletter subscription dan social media links.

Landing page sepenuhnya responsif, menggunakan CSS grid untuk brand/products/articles dan Flexbox untuk footer. Pada mobile, semua grid berubah menjadi 2 kolom (tablet) atau 1 kolom (mobile).

---

**2.2 Koleksi Produk (Catalog)**

Halaman koleksi menampilkan seluruh produk dengan fitur filter sidebar. Filter menggunakan radio button yang dapat dipilih dan di-unselect. Filter mencakup:

- Jenis Kelamin: Pria, Wanita, Anak-anak, Unisex
- Brand: Converse, Prabu, Hoka, Adidas, Nike, Redwing (data dinamis dari database)
- Jenis Sepatu: Sneakers, Leather, Olahraga (data dinamis dari database)

Product grid menggunakan CSS Grid dengan `grid-template-columns: repeat(4, 1fr)` pada desktop, `repeat(3, 1fr)` pada tablet, dan `repeat(2, 1fr)` pada mobile. Setiap product card memiliki badge (Best Seller/New), gambar produk, nama, harga (format Rupiah), dan deskripsi singkat. Sidebar filter bersifat sticky pada desktop dan off-canvas drawer pada mobile.

Fitur JavaScript pada halaman ini:
- Filter produk secara client-side (tanpa reload halaman)
- Reorder cards: produk yang sesuai filter muncul di posisi atas DOM
- Radio button toggle (click to select, click again to unselect)
- Mobile sidebar toggle dengan overlay backdrop

---

**2.3 Detail Produk**

Halaman detail produk menampilkan informasi lengkap satu produk meliputi:
- Gambar produk dengan badge
- Brand, nama produk, dan harga
- Rating bintang (5-star display statis)
- Selector ukuran (EU 38–49) dengan highlight aktif
- Kontrol jumlah (quantity +/-)
- Tombol "Add to Cart" dan "Buy Now"

Fitur Add to Cart menggunakan AJAX (fetch API) untuk menambahkan produk ke session cart tanpa reload halaman, dengan toast notification sebagai konfirmasi. Fitur Buy Now menambahkan produk ke cart lalu langsung redirect ke halaman keranjang. Halaman ini dilengkapi breadcrumb navigasi dan tombol "Kembali" untuk navigasi kembali ke halaman sebelumnya. Bagian bawah halaman menampilkan daftar produk serupa (related products).

---

**2.4 Keranjang Belanja**

Halaman keranjang menampilkan seluruh item yang ditambahkan ke cart dengan informasi:
- Gambar produk, nama, brand, size, harga per item
- Kontrol quantity (+/-) dengan AJAX update
- Tombol hapus item dengan konfirmasi
- Subtotal per item (harga x quantity)
- Ringkasan total di panel kanan (sidebar pada desktop)
- Input kode diskon
- Tombol "Lanjut ke Checkout"

Jika keranjang kosong, ditampilkan empty state dengan ilustrasi dan tombol "Mulai Belanja" yang mengarahkan ke halaman koleksi. Session cart dikelola sepenuhnya melalui Laravel session storage dengan key format `{barang_id}-{size}`.

---

**2.5 Pembayaran (Checkout)**

Halaman checkout menggunakan sistem dua langkah (two-step):

**Step 1 — Pengiriman:**
- Toggle metode pengiriman: Delivery atau On The Store (Store Pickup)
- Jika Delivery: formulir alamat lengkap dengan dropdown bertingkat (Provinsi → Kota → Kecamatan → Kelurahan) yang terintegrasi dengan API wilayah Indonesia
- Jika Store Pickup: tampil notifikasi bahwa pesanan diambil di toko
- Formulir mencakup: Nama Depan, Nama Belakang, Alamat, Provinsi, Kota, Kecamatan, Kelurahan, Kode Pos, Nomor Telepon

**Step 2 — Pembayaran:**
- Tiga metode pembayaran:
  - Virtual Account (BCA, Mandiri, BNI, BRI)
  - Credit Card (Visa, Mastercard, JCB)
  - QRIS
- Checkbox persetujuan Syarat & Ketentuan
- Tombol "Buat Pesanan"

Status pesanan menggunakan kode singkat: P (Pending), CON (Confirmed), S (Shipped), D (Delivered/Completed), C (Cancelled). Order number format: `ORD-YYYYMMDD-XXXX` (contoh: ORD-20260625-0001).

---

**2.6 Riwayat Transaksi**

Halaman history pesanan pelanggan menampilkan daftar seluruh pesanan yang pernah dibuat dengan informasi:
- Preview gambar produk (maksimal 3 thumbnail)
- Nomor pesanan (ORD-YYYYMMDD-XXXX)
- Tanggal dan jam pesanan
- Jumlah produk
- Alamat pengiriman (ringkasan)
- Status badge (warna berbeda untuk setiap status)
- Metode pembayaran
- Total pembayaran

Setiap card pesanan bisa diklik untuk melihat detail pesanan lengkap.

---

**2.7 Kelola Produk**

Halaman admin untuk mengelola data produk sepatu. Fitur:
- Tabel daftar produk dengan kolom: No, Gambar, Nama, Brand, Harga, Type, Gender, Badge, Aksi (Edit/Hapus)
- Tombol "Tambah Produk" untuk menambah produk baru
- Form tambah/edit produk mencakup: Nama, Harga, Brand, Badge (Best Seller/New Arrival), Type, Gender, Deskripsi
- Konfirmasi hapus dengan JavaScript confirm dialog
- Soft delete tidak diterapkan pada produk (dihapus permanen)

---

**2.8 Kelola Artikel**

Halaman admin untuk mengelola artikel blog dengan fitur:
- Tabel daftar artikel dengan kolom: No, Gambar, Judul, Author, Kategori, Tanggal, Aksi
- Tombol "Tambah Artikel" dan "Arsip" pada header
- Form tambah/edit artikel mencakup: Judul, Konten, Gambar, Author, Kategori (Trending/Terbaru)
- Soft delete: tombol hapus memindahkan artikel ke halaman Arsip (bukan hapus permanen)

Halaman Arsip Artikel menampilkan artikel yang sudah dihapus dengan dua aksi:
- Restore: memulihkan artikel ke daftar utama
- Delete Permanen: menghapus artikel dari database secara permanen

---

**2.9 Kelola Pesanan**

Halaman admin untuk mengelola pesanan pelanggan dengan fitur:
- Tabel daftar pesanan dengan kolom: No, No Pesanan, Pelanggan, Items, Status (dropdown), Total, Tanggal, Aksi
- Dropdown status inline yang bisa langsung diubah (auto-submit on change)
- Tombol lihat detail pesanan
- Halaman detail pesanan menampilkan informasi lengkap: produk yang dipesan, alamat pengiriman, ringkasan pembayaran
- Form update status di halaman detail

---

**2.10 Kelola Pengguna**

Halaman admin untuk mengelola akun pengguna dengan fitur:
- Tabel daftar pengguna dengan kolom: No, Username, Email, Role (badge Admin/Pelanggan), Terdaftar, Aksi
- Tombol "Tambah Pengguna"
- Form tambah/edit: Username, Email, Password, Role (Admin/Pelanggan)
- Proteksi: admin tidak bisa menghapus akun sendiri (tombol hapus dinonaktifkan)
- Password field opsional pada form edit (kosongkan jika tidak ingin mengubah password)

---

3. Pengujian Sistem

Pengujian sistem dilakukan secara fungsional dengan metode Black Box Testing, yaitu menguji setiap fitur berdasarkan requirement tanpa melihat kode sumber secara menyeluruh. Berikut ringkasan pengujian:

| No | Fitur | Skenario Pengujian | Hasil |
|----|-------|---------------------|-------|
| 1 | Login Pelanggan | Login dengan kredensial pelanggan, diarahkan ke koleksi | Berhasil |
| 2 | Login Admin | Login dengan kredensial admin, diarahkan ke dashboard | Berhasil |
| 3 | Filter Produk | Pilih filter gender/brand/type, produk difilter dan di-reorder | Berhasil |
| 4 | Uncheck Filter | Klik ulang radio button aktif, filter di-unselect | Berhasil |
| 5 | Add to Cart | Pilih ukuran → Add to Cart → toast notification | Berhasil |
| 6 | Buy Now | Pilih ukuran → Buy Now → redirect ke keranjang | Berhasil |
| 7 | Checkout Delivery | Isi alamat lengkap → Pilih pembayaran → Buat Pesanan | Berhasil |
| 8 | Checkout Store Pickup | Pilih On The Store → Langsung ke pembayaran → Buat Pesanan | Berhasil |
| 9 | Soft Delete Artikel | Hapus artikel → Muncul di Arsip | Berhasil |
| 10 | Restore Artikel | Restore dari Arsip → Kembali ke daftar | Berhasil |
| 11 | Update Status Pesanan | Ubah dropdown status inline → Status terupdate | Berhasil |
| 12 | CRUD Kelola Produk | Tambah/Edit/Hapus produk | Berhasil |
| 13 | CRUD Kelola Artikel | Tambah/Edit/Hapus + Arsip/Restore | Berhasil |
| 14 | CRUD Kelola Pengguna | Tambah/Edit/Hapus pengguna | Berhasil |
| 15 | Proteksi Hapus Diri Sendiri | Admin coba hapus akun sendiri | Ditolak, tampil pesan error |
| 16 | Responsif Mobile | Akses semua halaman via mobile viewport | Berhasil |
| 17 | Mobile Nav | Buka hamburger menu di mobile | Berhasil |

---

LAMPIRAN

**Link Logbook** :
https://github.com/Anshari06/logbook-cihuyfootwear

**Link Project Repo** :
https://github.com/Anshari06/CihuyFootwear

**Link Demo Live (Web Statis - Deployed)** :
http://cihuyfootwear.test

**Link Video** :
https://drive.google.com/file/d/xxxxx/view

---

*Surabaya, Juni 2024*
*Muhammad Anshari Shidqi — 434241075*
