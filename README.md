# 💻 LAPORAN PROYEK: PENGEMBANGAN WEB SERVER DAN APLIKASI SEDERHANA

**Proyek:** Instalasi Web Server NginX

Proyek ini dibuat untuk memenuhi tugas mata pelajaran **Administrasi Sistem Jaringan (ASJ)**, yang merupakan salah satu elemen Capaian Pembelajaran Konsentrasi Keahlian Teknik Komputer dan Jaringan (**CP KKTKJ**) pada program TJKT. Proyek ini berfokus pada implementasi layanan Web Server, konfigurasi PHP, dan pengamanan koneksi menggunakan SSL/HTTPS.

---

### 1. 👥 Informasi Kelompok dan Spesifikasi Lingkungan Praktik

#### 1.1. Informasi Kelompok

| Peran | Nama Lengkap | Kelas |
| :--- | :--- | :--- |
| **Ketua Kelompok** | Ahnaf Naufadillah | XITJKT-2 |
| Anggota 1 | Meicha Clara | XITJKT-2 |
| Anggota 2 | Ahmad Zais | XTJKT-2 |
| Anggota 3 | Sinta Bella | XITJKT-2 |
| **Nama Sekolah/Institusi** | SMKN 1 SOREANG | |

#### 1.2. Spesifikasi Alat dan Bahan (Host) 🛠️

| Komponen | Deskripsi / Versi |
| :--- | :--- |
| **Virtualisasi** | VMware Workstation 9 |
| **Sistem Operasi Host** | Windows 10 |
| **RAM Host (Minimal)** | 4GB |
| **CPU Host** | Intel Celeron N4020 |

#### 1.3. Spesifikasi Server Virtual (VM) 🖥️

| Spesifikasi | Detail |
| :--- | :--- |
| **Sistem Operasi Tamu (Guest OS)** | Debian Trixie (12.x) |
| **Alamat IP Server** | ` 103.217.145.187` |
| **RAM VM** | 2 GB |
| **vCPU** | 1 Core |
| **Web Server yang Dipilih** | **Nginx** |
| **Versi PHP yang Dipakai** | **php-fpm** |

---

### 2. 📝 Dokumentasi Teknis dan Langkah-Langkah Pengerjaan

#### 2.1. Persiapan Dasar (Debian Trixie di VMware)

1.  Melakukan *update* dan *upgrade* sistem.
    ```bash
    sudo apt update && sudo apt upgrade -y
    ```
2.  Memastikan konfigurasi jaringan (Bridge/NAT/Host-Only) sudah benar.

#### 2.2. Instalasi dan Konfigurasi Web Server 🌐

Kami menggunakan **NginX**. Berikut langkah-langkah utamanya:

* **Instalasi:**
* Perbarui semua paket agar Debian siap digunakan
    ```bash
    apt update && apt upgrade
    ```
* Pasang web server Nginx
     ```bash
    apt install nginx
    ```
* Jalankan dan aktifkan otomatis saat boot:
    ```bash
    systemctl start nginx
    ```
     ```bash
    systemctl enable nginx
    ```
* Cek status:
    ```bash
    systemctl status nginx
    ``` 
* Jika statusnya active (running), berarti Nginx sudah berjalan.
* Buka browser dan akses: http://103.217.145.187
* Jika muncul halaman “Welcome to Nginx!”, berarti server aktif.
* **Konfigurasi Virtual Host/Server Block:**
    [Jelaskan secara singkat penyesuaian konfigurasi yang Kalian lakukan pada file utama, misalnya penentuan Document Root dan port.]

#### 2.3. Konfigurasi PHP 🐘

Kami menggunakan **php-fpm** untuk mengintegrasikan PHP dengan *Web Server*.

* **Instalasi PHP:**
* Agar server bisa menjalankan file .php, pasang PHP dan modul pendukung:
    ```bash
  apt install php8.4-fpm php8.4-cli
    ```
* Mengaktifkan PHP di Konfigurasi Default Nginx
    ```bash
  mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default.asli
    ```
* Buka/buat file konfigurasi bawaan Nginx:
    ```bash
  nano /etc/nginx/sites-available/default
    ```
* Sesuaikan atau edit seperti contoh berikut:
    ```bash
  server {
    listen 80 default_server;          # Dengarkan koneksi HTTP di port 80 (standar web)
    listen [::]:80 default_server;     # Dukungan untuk IPv6

    root /var/www/html;                # Folder utama tempat file website disimpan
    index index.php index.html;        # Urutan file index yang akan dicari pertama kali

    server_name _;                     # "_" artinya menerima semua nama domain/host

    # Bagian utama untuk menangani request ke website
    location / {
        # Coba tampilkan file sesuai permintaan
        # Jika tidak ada, coba foldernya
        # Jika tetap tidak ada, arahkan ke index.php (penting untuk WordPress, Moodle, dll.)
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Bagian untuk menjalankan file PHP
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;             # Include konfigurasi standar PHP-FPM
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;    # Jalur socket PHP-FPM versi 8.4

        # Beritahu PHP file mana yang harus dijalankan
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;                        # Include parameter tambahan untuk PHP
    }

    # Bagian untuk file statis (gambar, CSS, JS, font, dll.)
    # Dikasih aturan cache supaya website lebih cepat dibuka
    location ~* \.(?:ico|css|js|gif|jpe?g|png|woff2?|eot|ttf|svg|mp4)$ {
        expires 6M;             # Browser boleh menyimpan file ini 6 bulan
        access_log off;         # Jangan dicatat di log akses (hemat space/log)
        log_not_found off;      # Jangan catat kalau file statis tidak ditemukan
    }

    # Lindungi file .htaccess atau file tersembunyi (.ht*)
    # Biasanya digunakan Apache, tapi tetap diblokir di Nginx agar aman
    location ~ /\.ht {
        deny all;
    }
}
    ```
* Simpan (Ctrl+O, Enter) dan keluar (Ctrl+X)
* Uji konfigurasi:
   ```bash
  nginx -t
    ```
* Jika hasilnya syntax is ok, restart Nginx:
    ```bash
  systemctl restart nginx
    ```
* Menguji PHP:
* Buat file uji coba di direktori bawaan Nginx:
    ```bash
  nano /var/www/html/info.php
    ```
* Masukan script berikut:
    ```bash
  <?php
   phpinfo();
?>
    ```
* Buka web browser dan akses http://103.217.145.187/info.php
* **Integrasi:**
    [Jelaskan langkah-langkah integrasi antara PHP dengan Web Server yang Kalian pilih.]

#### 2.4. Implementasi SSL (HTTPS) 🔒

Untuk mengaktifkan akses HTTPS, kami membuat *self-signed certificate*.

1.  Membuat direktori untuk *certificate*.
2.  Membuat *Key* dan *Certificate* menggunakan OpenSSL.
3.  Memodifikasi konfigurasi *Web Server* untuk menggunakan port **443** dan menunjuk ke *certificate* yang telah dibuat, serta memastikan akses dapat dilakukan melalui `https://103.217.145.187`.

---
* Pertama, buat folder untuk menyimpan sertifikat:
     ```bash
  mkdir /etc/ssl/nginx
    ```
* Pastikan openssl sudah ter-install:
     ```bash
  apt install openssl
    ```
* Lalu buat sertifikat dan key:
   ```bash
  openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/nginx/selfsigned.key -out /etc/ssl/nginx/selfsigned.crt
    ```
* Setelah selfsigned.key dan selfsigned.crt berhasil di buat, kita masukan kedalam konfigurasi website kita:
   ```bash
  nano /etc/nginx/sites-available/default
    ```
* Ubah isinya sekaligus pelajari scripnya seperti dibawah ini :
 ```bash
 # Konfigurasi HTTP (port 80)
# ==========================
server {
    listen 80 default_server;          # Dengarkan koneksi HTTP di port 80
    listen [::]:80 default_server;     # Dukungan untuk IPv6

    root /var/www/html;                # Folder utama untuk file website
    index index.php index.html;        # File index yang akan dicari pertama

    server_name _;                     # "_" artinya menerima semua nama domain/host

    # Bagian utama untuk menangani request
    location / {
        # Coba tampilkan file/ folder sesuai permintaan
        # Jika tidak ada, teruskan ke index.php (penting untuk WordPress/Moodle)
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Bagian untuk menjalankan file PHP
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock; # Jalur socket PHP-FPM

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Lindungi file tersembunyi (.htaccess, .git, .env, dll.)
    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Atur caching untuk file statis (gambar, css, js, font, video)
    location ~* \.(?:ico|css|js|gif|jpe?g|png|woff2?|eot|ttf|svg|mp4)$ {
        expires 6M;             # Simpan cache selama 6 bulan
        access_log off;         # Tidak perlu dicatat di access log
        log_not_found off;      # Jika file tidak ada, jangan penuhkan log
    }
}

# ==========================
# Konfigurasi HTTPS (port 443, SSL/TLS)
# ==========================
server {
    listen 443 ssl default_server;      # Dengarkan koneksi HTTPS di port 443
    listen [::]:443 ssl default_server; # Dukungan untuk IPv6

    root /var/www/html;                 # Sama seperti HTTP
    index index.php index.html;
    server_name _;

    # Lokasi sertifikat SSL self-signed
    ssl_certificate /etc/ssl/nginx/selfsigned.crt;
    ssl_certificate_key /etc/ssl/nginx/selfsigned.key;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~* \.(?:ico|css|js|gif|jpe?g|png|woff2?|eot|ttf|svg|mp4)$ {
        expires 6M;
        access_log off;
        log_not_found off;
    }
}
    ```
 ```
  
* Uji dan Restart Nginx untuk melihat apakah ssl sudah terpasang:
 ```bash
  nginx -t
    ```
 ```
 ```bash
  systemctl restart nginx
    ```
 ```
* Buka di web browser
 ```bash
  https://103.217.145.187
    ```
 ```
* Browser akan memberi peringatan “Not Secure” atau “Untrusted Certificate”. Klik Advanced → Proceed untuk lanjut.
* Klik Lanjutkan dan anda akan ketemu error 404 , tenang, itu artinya halaman yang di tuju tidak ada, dan memang tidak ada karena kita belum buat file index.php, jadi silahkan buatkan dulu..
 ```bash
  nano /var/www/html/index.php
    ```
 ```
* Isi dengan script sederhana, boleh gunakan bahasa html
 ```bash
  <?php
   echo 'Selamat datang di situs saya!';
?>
    ```
 ```
* maka akan muncul halaman website kita




### 3. 📊 Analisis Web Server

Berdasarkan pengalaman kami dalam proyek ini, berikut adalah analisis kelebihan dan kekurangan dari *Web Server* yang kami gunakan:

| Aspek | Kelebihan (NginX) 👍 | Kekurangan (NginX) 👎 |
| :--- | :--- | :--- |
| **Performa & Kecepatan** | kelebihannya yang pertama kecepatan tinggi untuk static content bahkan lebih cepat daripada apache, kedua mampu menangani banyak koneksi secara bersamaan, ketiga konsumsi resource rendah jadi memakan jauh lebih sedikit ram dan cpu dibandingkan web server lain, keempat skalabilitas tinggi | kekurangannya yang pertama tidak optimal untuk konten dinamis tanpa backend, performanya tergantung setting |
| **Kemudahan Konfigurasi**| kelebihannya yang pertama konfigurasi lebih ringkas dan terstruktur, kedua file konfigurasi lebih rapih, ketiga banyak pengaturan performa sudah dioptimalkan secara default	 | kekurangannya yang pertama tidak mendukung .htaccess, kedua rewrite lebih sulit butuh pemahaman mendalam, ketiga perubahan konfigurasi harus reload server, keempat modul tidak bisa dinamis |
| **Fitur & Modularitas** | kelebihannya yang pertama modul internal efisien dan stabil tidak mudah crash atau konflik antar modul, kedua fitur keamanan tersedia secara native, ketiga ringan dan modular walau modul statis, keempat mendukung HTTP/2 dan HTTP/3 | kekurangannya yang pertama modul tidak bisa dimuat secara dinamis, kedua fitur tidak selengkap apache jika kustomisasi, ketiga tidak semua modul pihak ketiga stabil, fitur advanced butuh pemahaman mendalam, keempat tidak mendukung .htaccess jadi pengguna tidak bisa menambahkan aturan pada setiap folder seperti apache |

---

### 4. 🧠 Refleksi Proyek: Kesan dan Kendala

#### 4.1. Kesan Selama Proses Pengerjaan ✨

kami merasa mendapat banyak ilmu baru dan instalasi nginx terasa cepat dan ringan jika dibandingkan dengan apache yang terasa agak berat terutama dalam hal manajemen request dan pemakaian sumber daya server. Kami jadi benar-benar paham kenapa Nginx sering dijuluki sebagai high perfomance web server yang ideal untuk load balancing dan reverse proxy, meskipun di awal kami sempat sedikit pusing karena harus belajar konfigurasi PHP-FPM yang berbeda dengan cara kerja Apache.

#### 4.2. Kendala dan Solusi yang Diterapkan 💡
Selama proses penginstalan kami tidak menemukan kendala apa pun, proses berjalan dengan lancar

### 5. 📂 Dokumentasi Konten Website

Ada pada repository kami (nginex2)

### 6. 🎬 Dokumentasi Video Pengerjaan

**Link Video YouTube:**

[![Thumbnail Video Pengerjaan]([[https://img.youtube.com/vi/1-qlNtQS1OA/0.jpg)](https://www.youtube.com/watch?v=1-qlNtQS1OA](https://youtu.be/UGz_oqmz8kc?si=GgKLpAzogNx-OLPe)](https://youtu.be/UGz_oqmz8kc?si=GgKLpAzogNx-OLPe))

