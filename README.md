# 💻 TEMPLATE LAPORAN PROYEK: PENGEMBANGAN WEB SERVER DAN APLIKASI SEDERHANA

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
    ```bash
    # [Tuliskan perintah instalasi Web Server Kalian, contoh: sudo apt install nginx -y]
    ```
* **Konfigurasi Virtual Host/Server Block:**
    [Jelaskan secara singkat penyesuaian konfigurasi yang Kalian lakukan pada file utama, misalnya penentuan Document Root dan port.]

#### 2.3. Konfigurasi PHP 🐘

Kami menggunakan **php-fpm** untuk mengintegrasikan PHP dengan *Web Server*.

* **Instalasi PHP:**
* Agar server bisa menjalankan file .php, pasang PHP dan modul pendukung:
    ```bash
  apt install php8.4-fpm php8.4-cli
    ```
* **Integrasi:**
    [Jelaskan langkah-langkah integrasi antara PHP dengan Web Server yang Kalian pilih.]

#### 2.4. Implementasi SSL (HTTPS) 🔒

Untuk mengaktifkan akses HTTPS, kami membuat *self-signed certificate*.

1.  Membuat direktori untuk *certificate*.
2.  Membuat *Key* dan *Certificate* menggunakan OpenSSL.
3.  Memodifikasi konfigurasi *Web Server* untuk menggunakan port **443** dan menunjuk ke *certificate* yang telah dibuat, serta memastikan akses dapat dilakukan melalui `https://103.217.145.187`.

---

### 3. 📊 Analisis Web Server

Berdasarkan pengalaman kami dalam proyek ini, berikut adalah analisis kelebihan dan kekurangan dari *Web Server* yang kami gunakan:

| Aspek | Kelebihan (NginX) 👍 | Kekurangan (NginX) 👎 |
| :--- | :--- | :--- |
| **Performa & Kecepatan** | kelebihannya yang pertama kecepatan tinggi untuk static content bahkan lebih cepat daripada apache, kedua mampu menangani banyak koneksi secara bersamaan, ketiga konsumsi resource rendah jadi memakan jauh lebih sedikit ram dan cpu dibandingkan web server lain, keempat skalabilitas tinggi | [Tuliskan kekurangannya.] |
| **Kemudahan Konfigurasi**| [Tuliskan kelebihannya.] | [Tuliskan kekurangannya.] |
| **Fitur & Modularitas** | [Tuliskan kelebihannya.] | [Tuliskan kekurangannya.] |

---

### 4. 🧠 Refleksi Proyek: Kesan dan Kendala

#### 4.1. Kesan Selama Proses Pengerjaan ✨

[Tuliskan kesan anggota kelompok, misalnya: "Kami merasa mendapatkan banyak ilmu baru, terutama dalam praktik Version Control menggunakan Git dan GitHub yang belum pernah kami lakukan sebelumnya."]

#### 4.2. Kendala dan Solusi yang Diterapkan 💡

| Kendala yang Kalian Hadapi 🚧 | Solusi yang Ditemukan ✅ |
| :--- | :--- |
| [Tuliskan kendala teknis atau kolaborasi lain yang Kalian hadapi.] | [Jelaskan solusi spesifik Kalian.] |

---

### 5. 📂 Dokumentasi Konten Website

Seluruh *source code* (Halaman Utama dan Halaman Profil) yang berada di *document root* server telah disalin dan di-*commit* ke dalam folder `/html` di *repository* GitHub ini.

---

### 6. 🎬 Dokumentasi Video Pengerjaan

Seluruh proses pengerjaan telah direkam dan diunggah ke YouTube.

**Link Video YouTube:**

[![Thumbnail Video Pengerjaan](https://img.youtube.com/vi/1-qlNtQS1OA/0.jpg)](https://www.youtube.com/watch?v=1-qlNtQS1OA)

**PETUNJUK:** Ganti semua teks di dalam tanda kurung siku `[ ... ]` dengan informasi proyek yang relevan.
