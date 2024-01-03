<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembayaran</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>Data Pembayaran</h5>
                </div>
                <div class="card-body">
                    <button
                        class="btn bg-blue mb-2"
                        data-toggle="modal"
                        data-target="#modalRecycleBin">
                        <i class="fas fa-trash"></i>
                        Recyle Bin</button>
                    <table id="example1" class="table table-hover table-sm">
                        <thead class="bg-blue">
                            <th>Id</th>
                            <th>Siswa</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
             $sql="SELECT bayar.*,siswa.nis,siswa.nama,siswa.kelas,bayar_metode.metode FROM bayar,siswa,bayar_metode WHERE bayar.dihapus_pada IS NULL AND bayar.id_siswa=siswa.id_siswa AND bayar.id_bayar_metode=bayar_metode.id_bayar_metode"; 
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){     
            ?>
                        <tr>
                            <td><?= $kolom ['id_bayar']; ?></td>
                            <td><?= $kolom ['nis']; ?>-<?= $kolom ['nama']; ?>(<?= $kolom ['kelas']; ?>)</td>
                            <td><?= $kolom ['metode']; ?></td>
                            <td><img src="file/buktibayar/<?= $kolom ['bukti']; ?>" alt="<?= $kolom ['bukti']; ?>" width="100"></td>
                            <td><?= $kolom ['tanggal_bayar']; ?></td>
                            <td align="right"><?=number_format ($kolom  ['nominal_bayar']); ?></td>
                            <td>
                                <?php
                                    if($kolom['status_verifikasi']=='Belum Verifikasi'){
                                        $class="badge badge-sm badge-danger";
                                    } else {
                                        $class="badge badge-sm badge-success";
                                    }
                                ?>
                                <span class="<?= $class ; ?>">
                                    <?= $kolom ['status_verifikasi']; ?>
                                </span>
                            </td>
                                                   
                            <td> 
                                <!-- info alokasi  -->
                                <a href="index.php?p=bayar-alokasi&id_bayar=<?=$kolom['id_bayar'];?>" title="Informasi Alokasi Pembayaran"><i class="fas fa-search"></i></a>&nbsp; 
                                <!-- tombol konfirmasi -->
                                <?php if($kolom['status_verifikasi']=='Belum Verifikasi'){
                                    ?>
                                
                                <a
                                    onclick="return confirm('yakin akan mengkonfirmasi data ini?')"
                                    href="index.php?p=bayar-konfirmasi&id_bayar=<?=$kolom['id_bayar'];?>" title="konfirmasi pembayaran">
                                    <i class="fas fa-check"></i>
                                </a>
                                
                                <?php } ?>

                                &nbsp;<!-- untuk jarak -->
                                <!-- tombol hapus -->
                                <a
                                    onclick="return confirm('yakin akan mengahpus data ini?')"
                                    href="aksi/bayar.php?aksi=hapus&id_bayar=<?= $kolom['id_bayar']; ?>" title="Hapus Pembayaran">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- modal ubah bayar -->
                        <div
                            class="modal fade"
                            id="modalubah<?=$kolom['id_biaya'];?>"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah biaya</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="aksi/biaya.php" method="post">

                                            <input type="hidden" name="aksi" value="ubah">
                                            <input type="hidden" name="id_biaya" value="<?=$kolom['id_biaya']; ?>">
                                            <label for="id_periode">id periode
                                            </label>
                                            <?php 
                                                $query2 = "SELECT * FROM periode";
                                                $sql2 = mysqli_query($koneksi,$query2);
                                                ?>
                                            <select name="id_periode" class="form-control" required="required">
                                                <option value="">-- Pilih Periode --</option>
                                                    <?php
                                                        $sql_periode="SELECT * FROM periode WHERE id_periode IS NOT NULL";
                                                        $query_periode=mysqli_query($koneksi,$sql_periode);
                                                        while($periode=mysqli_fetch_array($query_periode)){
                                                            if($kolom['id_periode']==$periode['id_periode']){
                                                                echo "<option value='$periode[id_periode]' selected>$periode[periode]</option>";
                                                            } else {
                                                                echo "<option value='$periode[id_periode]'>$periode[periode]</option>";     
                                                            }
                                                            
                                                        }
                                                    ?>
                                            </select>

                                            <label for="tingkat">tingkat
                                            </label>
                                            <input
                                                type="text"
                                                name="tingkat"
                                                value="<?=$kolom['tingkat'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="jurusan">jurusan
                                            </label>
                                            <input
                                                type="text"
                                                name="jurusan"
                                                value="<?=$kolom['jurusan'];?>"
                                                class="form-control"
                                                required="required">

                                            <!-- value itu dipake biar nnti data nya keliatan pas mau ngubah data sblmny -->
                                            <label for="deskripsi_biaya">deskripsi biaya
                                            </label>
                                            <input
                                                type="text"
                                                name="deskripsi_biaya"
                                                value="<?=$kolom['deskripsi_biaya'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="jumlah_biaya">jumlah biaya
                                            </label>
                                            <input
                                                type="text"
                                                name="jumlah_biaya"
                                                value="<?=$kolom['jumlah_biaya'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="tanggal_jatuh_tempo">tanggal_jatuh_tempo
                                            </label>
                                            <input
                                                type="text"
                                                name="tanggal_jatuh_tempo"
                                                value="<?=$kolom['tanggal_jatuh_tempo'];?>"
                                                class="form-control"
                                                required="required">
                                            &nbsp;
                                            <button type="submit" class="btn bg-blue btn-block">
                                                <i class="fas fa-save"></i>
                                                simpan
                                            </button>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Send message</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
             } //ahkir while
             ?>

                    </table>
                    <a href="index.php?p=bayar-tambah"><button
                        type="button"
                        class="btn bg-blue btn-block mt-3">
                        <i class="fas fas-plus"></i>
                        Tambah Biaya Baru
                    </button></a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- modal recycle bin-->
<div
class="modal fade"
id="modalRecycleBin"
tabindex="-1"
role="dialog"
aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Data Penghapusan Sementara</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-hover">
        <thead class="bg-blue">
            <th>Id Biaya</th>
            <th>deskripsi biaya</th>
            <th>Dihapus Pada</th>
            <th>Aksi</th>
        </thead>
        <?php
             $sql="SELECT * FROM biaya WHERE dihapus_pada IS NOT NULL"; //biar keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){          
            ?>
        <tr>
            <td><?= $kolom ['id_biaya']; ?>
            </td>
            <td><?= $kolom ['deskripsi_biaya']; ?>
            </td>
            <td><?= $kolom ['dihapus_pada']; ?>
            </td>
            <td>
                <a
                    onclick="return confirm('yakin akan mengembalikan data ini?')"
                    href="aksi/biaya.php?aksi=restore&id_biaya=<?= $kolom['id_biaya']; ?> ">
                    |
                    <i class="fas fa-trash-restore"></i>
                </a>
                &nbsp;
                <a
                    onclick="return confirm('yakin akan mengahpus data ini secara permanen?')"
                    href="aksi/biaya.php?aksi=hapus-permanen&id_biaya=<?= $kolom['id_biaya']; ?> ">
                    |
                    <i class="fas fa-eraser"></i>
                </a>
            </td>
        </tr>

        <?php
             } //ahkir while
             ?>

    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary">Send message</button>
</div>
</div>
</div>
</div>