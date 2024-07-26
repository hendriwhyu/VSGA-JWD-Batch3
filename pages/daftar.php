<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sertifikasi JWD" />
    <meta name="author" content="Hendri Wahyu Perdana" />
    <title>Sertifikasi - Daftar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/" />

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />

  </head>
  <body>
    <?php include '../components/header.php'; ?>
    <?php include '../utils/config.php'; ?>

    <main>
      <section class="py-5 px-5 text-start">
        <div class="container-fluid py-lg-5 rounded">
          <div class="row card py-lg-5">
            <div class="px-5">
              <h1 class="fw-bold">Daftar Beasiswa</h1>
              <form action="../controller/tambah-beasiswa.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama" class="form-label">Masukkan Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" required/>
                </div>
                <div class="mb-3">
                  <label for="nim" class="form-label">Masukkan Nim</label>
                  <select class="form-select" name="nim" id="nim" required>
                    <option selected disabled value="">Pilih NIM</option>
                    <?php
                      include '../controller/show-nim.php';
                      $dataNim = getDataNim($conn);
                      foreach ($dataNim as $row) {
                        echo "<option value='$row[nim]'>$row[nim]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Masukkan Email</label>
                  <input type="email" class="form-control" id="email" name="email" required />
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Nomor HP</label>
                  <input type="number" class="form-control" id="phone" name="no_hp" required />
                </div>
                <div class="mb-3">
                  <label for="semester" class="form-label">Semester Saat Ini</label>
                  <select class="form-select" id="semester" name="semester" required>
                    <option selected disabled value="">Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="ipk" class="form-label">IPK Terakhir</label>
                  <input type="number" readonly class="form-control" name="ipk" id="ipk" required />
                </div>
                <div class="mb-3">
                  <label for="beasiswa" class="form-label">Pilihan Beasiswa</label>
                  <select class="form-select" id="beasiswa" name="beasiswa" required>
                    <option selected disabled value="">Pilih Beasiswa</option>
                    <?php
                      $beasiswa = $_GET['beasiswa'] ?? '';
                      $beasiswaOptions = ['KIPK', 'Unggulan', 'Prestasi'];
                      foreach ($beasiswaOptions as $option) {
                        $selected = $option === $beasiswa ? "selected" : "";
                        echo "<option value='$option' $selected>" . ucfirst($option) . "</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="berkas" class="form-label">Upload Berkas Syarat</label>
                  <input type="file" class="form-control" id="file" name="file" required />
                </div>
                <div class="d-flex gap-2">
                  <button class="btn btn-secondary btn-block w-100" type="reset">Batal</button>
                  <button class="btn btn-primary btn-block w-100" id="daftar" type="submit">Daftar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php include '../components/footer.php'; ?>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const nimSelect = document.getElementById("nim");
        const ipkInput = document.getElementById("ipk");

        nimSelect.addEventListener("change", function () {
          const selectedNim = this.value;
          fetch(`../controller/get-ipk-by-nim.php?nim=${selectedNim}`)
            .then((response) => response.json())
            .then((data) => {
              const nilai = parseFloat(data.ipk); // Asumsi bahwa response JSON memiliki field 'ipk'
              ipkInput.value = nilai;
              if (nilai < 3.0) {
                document.getElementById("beasiswa").disabled = true;
                document.getElementById("file").disabled = true;
                document.getElementById("daftar").disabled = true;
              } else {
                document.getElementById("beasiswa").disabled = false;
                document.getElementById("file").disabled = false;
                document.getElementById("daftar").disabled = false;
              }
            })
            .catch((error) => {
              console.error("Error fetching IPK:", error);
              alert("Gagal mengambil data IPK");
            });
        });
      });
    </script>
  </body>
</html>
