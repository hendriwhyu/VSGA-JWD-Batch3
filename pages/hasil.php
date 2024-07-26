<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sertifikasi JWD" />
  <meta name="author" content="Hendri Wahyu Perdana" />
  <meta name="generator" content="" />
  <title>Sertifikasi - Hasil</title>

  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css"/>
  <!-- DataTables Buttons CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap5.min.css"/>
</head>
<body>
  <?php include '../components/header.php'; ?>
  <?php
    include '../utils/config.php';
    include '../controller/show-beasiswa.php';
    
    $data = getDataBeasiswa($conn);
  ?>

  <main class="min-vh-100">
    <section class="py-5 px-5">
      <div class="container-fluid card px-5 py-5">
        <h2 class="fw-bold">Hasil Pendaftaran</h2>
        <table id="resultTable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Nomor HP</th>
              <th>Semester</th>
              <th>IPK Terakhir</th>
              <th>Beasiswa</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $index = 1;
            foreach($data as $row){
              $status = $row['status_ajuan'] == 1 ? 'Terverifikasi' : 'Belum Terverifikasi';
                echo "
                <tr>
                    <td>$index</td>
                    <td>$row[nama]</td>
                    <td>$row[email]</td>
                    <td>$row[no_hp]</td>
                    <td>$row[semester]</td>
                    <td>$row[ipk]</td>
                    <td>$row[beasiswa]</td>
                    <td>$status</td>
                    <td>
                      <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#detailModal$index'>Detail</button>
                      <form action='../controller/update-status.php' method='POST' class='d-inline'>
                        <input type='hidden' name='id' value='$row[id]' />
                        <button type='submit' name='action' value='validate' class='btn btn-success btn-sm' onclick='return confirm(\"Apakah anda yakin ingin validasi peserta ini?\")'>Validasi</button>
                      </form>
                    </td>
                </tr>
                ";
                $index++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Modal -->
  <?php
  $index = 1;
  foreach($data as $row){
      echo "
      <div class='modal fade' id='detailModal$index' tabindex='-1' aria-labelledby='detailModalLabel$index' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='detailModalLabel$index'>Detail Mahasiswa</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <img src='../assets/uploads/$row[file]' class='bd-placeholder-img card-img-top' width=200 height=200 alt='Beasiswa Prestasi'>
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
      ";
      $index++;
  }
  ?>

  <?php include '../components/footer.php'; ?>

  <!-- Bootstrap core JS -->
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
  <!-- DataTables Buttons JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

  <script>
    // Initialize DataTable with buttons
    $(document).ready(function() {
      $('#resultTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'print',
          {
            extend: 'excelHtml5',
            title: 'Data Mahasiswa Pendaftaran'
          }
        ]
      });
    });
  </script>
</body>
</html>
