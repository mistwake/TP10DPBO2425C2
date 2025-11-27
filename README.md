# TP10

## Desain Program
<img width="1482" height="1468" alt="diagram" src="https://github.com/user-attachments/assets/9997a5b1-b89c-4f69-9569-21468693c0a0" />

## Alur Program
Aplikasi ini menggunakan konsep MVVM di mana alur kerjanya dibagi menjadi 3 bagian:
1. Akses Utama (index.php) Semua akses masuk lewat satu pintu. File ini mengatur apakah pengguna ingin melihat halaman (lewat parameter ?page=...) atau memproses data seperti simpan/hapus (lewat parameter ?action=...).
2. Menampilkan Data (Read)
- User buka menu.
- ViewModel minta data ke Model (Database).
- Data diserahkan ke View untuk ditampilkan ke layar.
3. Mengelola Data (Create, Update, Delete)
- User mengisi form dan klik tombol Simpan/Hapus.
- Data dikirim ke ViewModel untuk diproses.
- Model mengeksekusi perintah SQL (Insert/Update/Delete) ke database.
- Sistem kembali menampilkan daftar data terbaru.
4. Relasi Data Khusus fitur Peminjaman, sistem otomatis mengambil Nama Buku dan Nama Anggota dari tabel lain (Join Table), sehingga yang muncul bukan hanya angka ID, tapi informasi yang jelas.

## Dokumentasi
https://github.com/user-attachments/assets/984bca57-43f8-45a4-bf8a-4af4d9824289
