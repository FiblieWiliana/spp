 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">

                <p>Laporan Pembayaran Per-Siswa</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill"></i>
              </div>
              <a href="#" data-toggle="modal" data-target="#modalBayarSiswa"class="small-box-footer">Cetak <i class="fas fa-print"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">

                <p>Laporan Tunggakan</p>
              </div>
              <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <a href="#" data-toggle="modal" data-target="#modalTunggakan" class="small-box-footer">Cetak <i class="fas fa-print"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- modal laporan pembayaran umum -->
<div
    class="modal fade" id="modalBayarUmum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Periode Laporan Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="pdf/output/laporan_pembayaran_umum.php" method="get" target="_blank">
                   

                    <label for="tanggal_awal">tanggal awal
                    </label>
                    <input type="date" name="tanggal_awal" class="form-control" required="required">

                    <label for="tanggal_ahkir">tanggal ahkir
                    </label>
                    <input
                        type="date"
                        name="tanggal_ahkir"
                        class="form-control"
                        required="required">

                    <button type="submit" class="btn bg-blue btn-block">
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
  <!-- modal laporan tunggakan -->
<div
    class="modal fade" id="modalTunggakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Batas Waktu Tunggakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="pdf/output/laporan_tunggakan.php" method="get" target="_blank">
                   

                    <label for="tanggal_jatuh_tempo">tanggal Jatuh Tempo
                    </label>
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" required="required">

                    <button type="submit" class="btn bg-blue btn-block">
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

 <!-- modal laporan pembayaran persiswa -->
 <div
    class="modal fade" id="modalBayarSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Siswa & Periode Laporan Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="pdf/output/laporan_pembayaran_siswa.php" method="get" target="_blank">
                   
                    <label for="id_siswa">Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                      <?php
                       $id_siswa=$_SESSION['id'];
                        $sql="SELECT * FROM siswa WHERE dihapus_pada IS NULL AND id_siswa=$id_siswa ORDER BY nis ASC";
                        $query=mysqli_query($koneksi,$sql);
                        while($siswa=mysqli_fetch_array($query)){
                          echo "<option value='$siswa[id_siswa]'>$siswa[nis]-$siswa[nama] ($siswa[kelas])</option>";
                        } ?>
                    </select>
                    <label for="tanggal_awal">tanggal awal
                    </label>
                    <input type="date" name="tanggal_awal" class="form-control" required="required">

                    <label for="tanggal_ahkir">tanggal ahkir
                    </label>
                    <input
                        type="date"
                        name="tanggal_ahkir"
                        class="form-control"
                        required="required">

                    <button type="submit" class="btn bg-blue btn-block">
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>