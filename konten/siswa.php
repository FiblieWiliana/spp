<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Siswa</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Data Utama</a>
                        </li>
                        <li class="breadcrumb-item active">Siswa</li>
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
                    <h5>Data Peserta Didik</h5>
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
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
             $sql="SELECT * FROM siswa WHERE dihapus_pada IS NULL"; //biar ga keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){     
            ?>

                        <tr>
                            <td><?= $kolom ['id_siswa']; ?>
                            </td>
                            <td><?= $kolom ['nis']; ?>
                            </td>
                            <td><?= $kolom ['nama']; ?>
                            </td>
                            <td><?= $kolom ['no_hp']; ?>
                            </td>
                            <td><?= $kolom ['email']; ?>
                            </td>
                          <td>
                            <!-- tombol edit -->
                            <a
                                href="#"
                                data-toggle="modal"
                                data-target="#modalubah<?=$kolom['id_siswa'];?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;<!-- untuk jarak -->
                            <!-- tombol hapus -->
                            <a
                                onclick="return confirm('yakin akan mengahpus data ini?')"
                                href="aksi/siswa.php?aksi=hapus&id_siswa=<?= $kolom['id_siswa']; ?> ">
                                |
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- modal ubah periode -->
                    <div
                        class="modal fade"
                        id="modalubah<?=$kolom['id_siswa'];?>"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="aksi/siswa.php" method="post">
                                        <input type="hidden" name="aksi" value="ubah">
                                        <input type="hidden" name="id_siswa" value="<?=$kolom['id_siswa']; ?>">
                                        

                                        <label for="nis">NIS
                                        </label>
                                        <input
                                            type="text"
                                            name="nis"
                                            value="<?=$kolom['nis'];?>" 
                                            class="form-control"
                                            required="required">
                                        <!-- value itu dipake biar nnti data nya keliatan pas mau ngubah data sblmny -->
                                        <label for="nama">Nama Siswa
                                        </label>
                                        <input
                                            type="text"
                                            name="nama"
                                            value="<?=$kolom['nama'];?>"
                                            class="form-control"
                                            required="required">


                                        <label for="tingkat">Tingkat
                                        </label>
                                        <input
                                            type="text"
                                            name="tingkat"
                                            value="<?=$kolom['tingkat'];?>"
                                            class="form-control"
                                            required="required">


                                        <label for="kelas">kelas
                                        </label>
                                        <input
                                            type="text"
                                            name="kelas"
                                            value="<?=$kolom['kelas'];?>"
                                            class="form-control"
                                            required="required">

                                        <label for="id_jurusan">id_jurusan 
                                        </label>
                                       
                                        <select name="id_jurusan" class="form-control" required="required">
                                            <option value="">-- Pilih Jurusan --</option>
                                            <?php
                                                $sql_jurusan="SELECT * FROM jurusan WHERE dihapus_pada IS NULL ORDER BY jurusan ASC";
                                                $query_jurusan=mysqli_query($koneksi,$sql_jurusan);
                                                while($jurusan=mysqli_fetch_array($query_jurusan)){
                                                    if($kolom['id_jurusan']==$jurusan['id_jurusan']){
                                                    echo " <option value='$jurusan[id_jurusan]' selected>$jurusan[jurusan]</option>";
                                                    } else {
                                                        echo " <option value='$jurusan[id_jurusan]'>$jurusan[jurusan]</option>";

                                                    }
                                                };
                                            ?>
                                        </select>
                                    

                                        <label for="alamat">alamat
                                        </label>
                                        <textarea name="alamat" id="alamat" cols="60" rows="3" ><?=$kolom['alamat'];?></textarea>
                                        <label for="no_hp">No Telp
                                        </label>
                                        <input
                                            type="text"
                                            name="no_hp"
                                            value="<?=$kolom['no_hp'];?>"
                                            class="form-control"
                                            required="required">

                                        <label for="email">Email
                                        </label>
                                        <input
                                            type="email"
                                            name="email"
                                            value="<?=$kolom['email'];?>"
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
                        Tambah Siswa Baru
                    </button>
                </div>
            </div>
        </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal tambah siswa -->
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="aksi/siswa.php" method="post">
                <input type="hidden" name="aksi" value="tambah">

                <label for="nis">NIS
                </label>
                <input type="text" name="nis" class="form-control" required="required">

                <label for="nama">Nama Siswa
                </label>
                <input type="text" name="nama" class="form-control" required="required">

                <label for="tingkat">Tingkat
                </label>
                <input type="number" name="tingkat" class="form-control" required="required">

                <label for="kelas">Kelas
                </label>
                <input type="text" name="kelas" class="form-control" required="required">

                <label for="id_jurusan">Jurusan
                </label>
                <select type="text" name="id_jurusan" class="form-control" required="required">
                    <option value="">-- Pilih Jurusan --</option>
                    <?php
                        $sql_jurusan="SELECT * FROM jurusan WHERE dihapus_pada IS NULL ORDER BY jurusan ASC";
                        $query_jurusan=mysqli_query($koneksi,$sql_jurusan);
                        while($jurusan=mysqli_fetch_array($query_jurusan)){
                            echo " <option value='$jurusan'[id_jurusan]>$jurusan[jurusan]</option>";
                        };
                    ?>
                </select>
               
                <!-- alamat harus pake textarea -->
                <label for="alamat">Alamat
                </label>
                <textarea name="alamat" id="alamat" cols="60" rows="3"></textarea> 

                <label for="no_hp">No Telpon
                </label>
                <input type="text" name="no_hp" class="form-control" required="required">

                <label for="email">Email
                </label>
                <input type="text" name="email" class="form-control" required="required">
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
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Dihapus Pada</th>
                    <th>Aksi</th>
                </thead>
                <?php
             $sql="SELECT * FROM siswa WHERE dihapus_pada IS NOT NULL"; //biar keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){          
            ?>
                <tr>
                    <td><?= $kolom ['id_siswa']; ?>
                    </td>
                    <td><?= $kolom ['nama']; ?>
                    </td>
                    <td><?= $kolom ['dihapus_pada']; ?>
                    </td>
                    <td>
                        <a
                            onclick="return confirm('yakin akan mengembalikan data ini?')"
                            href="aksi/siswa.php?aksi=restore&id_siswa=<?= $kolom['id_siswa']; ?> ">
                            |
                            <i class="fas fa-trash-restore"></i>
                        </a>
                        &nbsp;
                        <a
                            onclick="return confirm('yakin akan mengahpus data ini secara permanen?')"
                            href="aksi/siswa.php?aksi=hapus-permanen&id_siswa=<?= $kolom['id_siswa']; ?> ">
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