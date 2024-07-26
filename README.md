
# Proyek Sertifikasi JWD

Proyek ini merupakan bagian dari sertifikasi Junior Web Development, yang bertujuan untuk mengembangkan sistem pendaftaran dan validasi beasiswa. Sistem ini dirancang untuk memudahkan pengelolaan data mahasiswa yang mendaftar beasiswa. Dalam proyek ini, teknologi PHP, Bootstrap, dan DataTables digunakan untuk membangun bagian frontend, sedangkan MySQL digunakan untuk backend. Proyek ini tidak hanya memberikan solusi efektif dalam manajemen data pendaftaran beasiswa, tetapi juga menunjukkan keterampilan dan pengetahuan yang diperoleh selama sertifikasi.

## Struktur Direktori

Berikut adalah struktur direktori dari proyek ini:

```
.
├── assets
│   ├── brand
│   ├── dist
│   ├── images
│   │   └── logo.png
├── components
│   ├── footer.php
│   ├── header.php
├── controller
│   ├── get-ipk-by-nim.php
│   ├── show-beasiswa.php
│   ├── show-nim.php
│   ├── tambah-beasiswa.php
│   └── update-status.php
├── pages
│   ├── daftar.php
│   ├── hasil.php
│   └── index.php
├── utils
│   ├── config.php
│   ├── upload-file.php
├── uploads
│   └── <uploaded_files>
├── beasiswa.sql
└── README.md
```

## Instalasi

1. **Clone Repository**: Clone repository ini ke direktori web server Anda.
2. **Import Database**: Import file `beasiswa.sql` ke database MySQL Anda.
3. **Konfigurasi Database**: Edit file `utils/config.php` untuk menyesuaikan dengan konfigurasi database Anda.
4. **Upload File**: Pastikan folder `uploads` dapat diakses dan memiliki izin menulis untuk menyimpan file yang diupload.

## Database

Database memiliki dua tabel utama: `mahasiswa` dan `nilai`. Berikut adalah struktur tabel:

### Tabel `mahasiswa`

| Field         | Type        | Description                   |
|---------------|-------------|-------------------------------|
| id            | int         | Primary key, Auto Increment   |
| nama          | varchar(255)| Nama mahasiswa                |
| nim           | varchar(20) | NIM mahasiswa                 |
| email         | varchar(255)| Email mahasiswa               |
| no_hp         | varchar(16) | Nomor HP mahasiswa            |
| semester      | int         | Semester saat ini             |
| ipk           | float       | IPK terakhir                  |
| beasiswa      | varchar(255)| Jenis beasiswa                |
| status_ajuan  | tinyint(1)  | Status ajuan (0/1)            |
| file          | text        | File yang diupload            |

### Tabel `nilai`

| Field | Type        | Description                   |
|-------|-------------|-------------------------------|
| id    | int         | Primary key, Auto Increment   |
| nim   | varchar(20) | NIM mahasiswa                 |
| ipk   | float       | IPK mahasiswa                 |

## Fitur

1. **Pendaftaran Beasiswa**: Mahasiswa dapat mendaftar beasiswa dengan mengisi form dan mengupload berkas syarat.
2. **Validasi Beasiswa**: Admin dapat memvalidasi ajuan beasiswa melalui halaman hasil pendaftaran.
3. **Detail Mahasiswa**: Admin dapat melihat detail mahasiswa yang mendaftar melalui modal yang ditampilkan saat tombol "Detail" diklik.
4. **Export Data**: Data pendaftaran dapat diexport dalam format Excel dan dicetak.

## Penggunaan

1. **Halaman Pendaftaran**: Mahasiswa dapat mengakses halaman pendaftaran di `pages/daftar.php`.
2. **Halaman Hasil Pendaftaran**: Admin dapat melihat hasil pendaftaran dan melakukan validasi di `pages/hasil.php`.

## Contoh Kode

### Menampilkan Data dengan Modal

Berikut adalah contoh kode untuk menampilkan detail mahasiswa dengan modal Bootstrap di halaman hasil pendaftaran:

```php
<td>
  <button type='button' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#detailModal$index'>Detail</button>
  <form action='../controller/update-status.php' method='POST' class='d-inline'>
    <input type='hidden' name='id' value='$row[id]' />
    <button type='submit' name='action' value='validate' class='btn btn-success btn-sm' onclick='return confirm("Apakah anda yakin ingin validasi?")'>Validasi</button>
  </form>
</td>
```

### Modal Detail Mahasiswa

```php
<div class='modal fade' id='detailModal$index' tabindex='-1' aria-labelledby='detailModalLabel$index' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='detailModalLabel$index'>Detail Mahasiswa</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <p><strong>Nama:</strong> $row[nama]</p>
        <p><strong>Email:</strong> $row[email]</p>
        <p><strong>Nomor HP:</strong> $row[no_hp]</p>
        <p><strong>Semester:</strong> $row[semester]</p>
        <p><strong>IPK Terakhir:</strong> $row[ipk]</p>
        <p><strong>Beasiswa:</strong> $row[beasiswa]</p>
        <p><strong>Status:</strong> $status</p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
      </div>
    </div>
  </div>
</div>
```

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT. Silakan lihat file `LICENSE` untuk detail lebih lanjut.
