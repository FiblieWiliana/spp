<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Biaya</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Data Utama</a>
                        </li>
                        <li class="breadcrumb-item active">Biaya</li>
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
                    <h5>Data Biaya</h5>
                </div>
                <div class="card-body">
                    <button
                        class="btn bg-blue mb-2"
                        data-toggle="modal"
                        data-target="#modalRecycleBin">
                        <i class="fas fa-trash"></i>
                        Recyle Bin</button>
                    <table id="example1" class="table table-hover">
                        <thead class="bg-blue">
                            <th>Id</th>
                            <th>Id Periode</th>
                            <th>Tingkat</th>
                            <th>Jurusan</th>
                            <th>Deskripsi Biaya</th>
                            <th>Jumlah biaya</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
             $sql="SELECT biaya.*,periode.periode,jurusan.jurusan FROM biaya,periode,jurusan WHERE biaya.dihapus_pada IS NULL AND biaya.id_periode=periode.id_periode AND biaya.id_jurusan=jurusan.id_jurusan "; 
             //biar ga keliatan di web ny klo di hapus tp msi kesimpen di database. 
              //biaya.dihapus biar cm di biaya aja krna dihapus pada itu ambigu
             $query=mysqli_query($koneksi,$sql); 
             while ($kolom=mysqli_fetch_array($query)){     
            ?>

                        <tr>
                            <td><?= $kolom ['id_biaya']; ?>
                            </td>
                            <td><?= $kolom ['periode']; ?>
                            </td>
                            <td><?= $kolom ['tingkat']; ?>
                            </td>
                            <td><?= $kolom ['jurusan']; ?>
                            </td>
                            <td><?= $kolom ['deskripsi_biaya']; ?>
                            </td>
                            <td><?= number_format($kolom ['jumlah_biaya']); ?>
                            </td>
                            <td><?= $kolom ['tanggal_jatuh_tempo']; ?>
                            </td>
                           
                            </td>
                            <td>
                                <!-- tombol edit -->
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#modalubah<?=$kolom['id_biaya'];?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;<!-- untuk jarak -->
                                <!-- tombol hapus -->
                                <a
                                    onclick="return confirm('yakin akan mengahpus data ini?')"
                                    href="aksi/biaya.php?aksi=hapus&id_biaya=<?= $kolom['id_biaya']; ?> ">
                                    |
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- modal ubah periode -->
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

                                            <label for="id_jurusan">jurusan</label>
                                                <select name="id_jurusan" id="id_jurusan" class="form-control" required>
                                                    <option value="">--Pilih Jurusan--</option>
                                                    <?php
                                                        $sql_jurusan="SELECT * FROM jurusan WHERE dihapus_pada IS NULL ORDER BY jurusan ASC";
                                                        $query_jurusan=mysqli_query
                                                        ($koneksi,$sql_jurusan);
                                                        while($jurusan=mysqli_fetch_array
                                                        ($query_jurusan)){
                                                            if($kolom['id_jurusan']==$jurusan['id_jurusan']){
                                                                echo "<option value='$jurusan[id_jurusan]' selected>$jurusan[jurusan]</option>"; //selected biar ada sama???
                                                            } else {
                                                                echo "<option value='$jurusan[id_jurusan]'>$jurusan[jurusan]</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>

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
                    <button
                        type="button"
                        class="btn bg-blue btn-block mt-3"
                        data-toggle="modal"
                        data-target="#modaltambah">
                        <i class="fas fas-plus"></i>
                        Tambah Biaya Baru
                    </button>
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
<!-- modal tambah biaya -->
<div
class="modal fade"
id="modaltambah"
tabindex="-1"
role="dialog"
aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Tambah biaya</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="aksi/biaya.php" method="post">
        <input type="hidden" name="aksi" value="tambah">

        <label for="id_periode">id periode
        </label>
        <?php 
                   $query2 = "SELECT * FROM periode";
                   $sql2 = mysqli_query($koneksi,$query2);
                   ?>
        <select name="id_periode" id="id_periode" class="form-control">
            <option value="">--Pilih Periode</option>

            <?php while ($kolom2 = mysqli_fetch_array($sql2)) : ?>
            <option name="periode" value="<?= $kolom2['id_periode'] ?>"><?= $kolom2['periode'] ?></option>
            <?php endwhile ?>
        </select>

        <label for="tingkat">tingkat
        </label>
        <input
            type="text"
            name="tingkat"
            class="form-control"
            required="required">
        
            <label for="id_jurusan">jurusan</label>
        <select name="id_jurusan" id="id_jurusan" class="form-control" required>
            <option value="">--Pilih Jurusan--</option>
            <?php
                $sql_jurusan="SELECT * FROM jurusan WHERE dihapus_pada IS NULL ORDER BY jurusan ASC";
                $query_jurusan=mysqli_query
                ($koneksi,$sql_jurusan);
                while($jurusan=mysqli_fetch_array($query_jurusan)){
                    echo "<option value='$jurusan[id_jurusan]'>$jurusan[jurusan]</option>";
                }
            ?>
        </select>

        <label for="deskripsi_biaya">deskripsi biaya
        </label>
        <input
            type="text"
            name="deskripsi_biaya"
            class="form-control"
            required="required">

        <label for="jumlah_biaya">jumlah biaya
        </label>
        <input
            type="number"
            name="jumlah_biaya"
            class="form-control"
            required="required">

        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo
        </label>
        <input
            type="date"
            name="tanggal_jatuh_tempo"
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
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>