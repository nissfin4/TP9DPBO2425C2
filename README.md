# TP9DPBO2425C2
Tugas Praktikum 9
Janji: Saya Nisrina Safinatunnajah dengan NIM 2410093 mengerjakan Tugas Praktikum 9 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

Di dalam program ini ada dua bagian utama yaitu CRUD untuk data Pembalap dan CRUD untuk data Acara. Tabel Acara dipilih sebagai tabel tambahan karena masih berhubungan dengan dunia balapan.

Struktur program mengikuti pola MVP. Bagian Model bertanggung jawab untuk semua proses yang berhubungan dengan data, mulai dari class Pembalap dan Acara sampai fungsi CRUD seperti tambah, ambil, edit, dan hapus data dari database. View hanya menampilkan antarmuka ke pengguna, seperti form tambah data, form edit yang otomatis terisi, dan tabel yang menampilkan daftar Pembalap atau Acara. View tidak memanggil database atau Model secara langsung. Semua proses dari View dilewatkan ke Presenter, dan Presenter yang akan berkomunikasi dengan Model. Setelah Model mengembalikan data, Presenter meneruskannya ke View untuk ditampilkan. Untuk memastikan hubungan View–Presenter lebih terstruktur, program juga menggunakan file kontrak/interface.

Fitur CRUD pada kedua tabel sudah berjalan lengkap. Pengguna bisa melakukan CRUD. Semua fitur ini tersedia untuk tabel Pembalap maupun tabel Acara. Hanya isi datanya saja yang berbeda, tapi alurnya sama.

folder yang dibagi berdasarkan komponen MVP yaitu folder models untuk semua class dan query, folder views untuk tampilan, folder presenters untuk penghubung antara View dan Model, serta folder kontrak yang berisi interface.

Dokumentasi Video Youtube:
[![Tonton Video](https://img.youtube.com/vi/TgUAswJ1YM4/0.jpg)](https://www.youtube.com/watch?v=TgUAswJ1YM4)

