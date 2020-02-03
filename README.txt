#Pembuka
Ini contoh website buat ujian praktek, kurang lebih semua yang ada disoal udah diimplementasiin disini.
Silahkan dieksploitasi sendiri, Kalau ingin di ubah silahkan diubah, atau dibuat menjadi lebih simple lagi

#Konfigurasi umum
1. Buat database 'pengaduan_app' lalu import file 'pengaduan_app.sql'

#Database
1. Tabel admin = akun admin (bisa ditambah)
2. Tabel keluhan = data keluhan
3. Tabel departemen = list departemen (bisa ditambah)

#Struktur Folder dan file
1. Asset -> css = file css
2. Asset -> image = asset gambar web
3. Asset -> js = file js
4. Asset -> upload = tempat nyimpen foto keluhan yang di input
5. core -> config.php = file konfigurasi
6. core -> database.php = koneksi database
7. core -> function.php = kumpulan fungsi yang akan dipaggil di bagian tampilan
8. core -> init.php = file untuk memanggil 3 file core diatas, agar pemanggilan di bagian tampilan hanya file 'init.php' saja
9. admin.php = tampilan dashboard admin
10. cari-keluhan.php = tampilan untuk mencari keluhan client/pelapor
11. index.php = tampilan untuk membuat keluhan
12. login.php = tampilan login
13. profile.php = tampilan profile

#login
username = admin
password = admin

#Upload gambar
buat cari aman ukuran min gambar < 2MB kalo lebih nanti gambarnya gk keupload.

