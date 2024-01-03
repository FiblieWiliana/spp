<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periode</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Data Utama</a>
                        </li>
                        <li class="breadcrumb-item active">Periode</li>
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
                    <h5>Data Periode Pendidikan</h5>
                </div>
                <div class="card-body">
                    <button
                        class="btn bg-blue mb-2"
                        data-toggle="modal"
                        data-target="#modalRecycleBin">
                        <i class="fas fa-trash"></i>
                        Recyle Bin</button>
                    <table id="example1" class="table table-hover" >
                        <thead class="bg-blue">
                            <th>ID</th>
                            <th>Periode</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Ahkir</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
             $sql="SELECT * FROM periode WHERE dihapus_pada IS NULL"; //biar ga keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){          
            ?>
                        <tr>
                            <td><?= $kolom ['id_periode']; ?>
                            </td>
                            <td><?= $kolom ['periode']; ?>
                            </td>
                            <td><?= $kolom ['tanggal_awal']; ?>
                            </td>
                            <td><?= $kolom ['tanggal_ahkir']; ?>
                            </td>
                            <td>

                                <!-- tombol edit -->
                                <a href="#" data-toggle="modal" data-target="#modalubah<?=$kolom['id_periode'];?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;<!-- untuk jarak -->
                                <!-- tombol hapus -->
                                <a
                                    onclick="return confirm('yakin akan mengahpus data ini?')"
                                    href="aksi/periode.php?aksi=hapus&id_periode=<?= $kolom['id_periode']; ?> ">
                                    |
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- modal ubah periode -->
                        <div
                            class="modal fade"
                            id="modalubah<?=$kolom['id_periode'];?>"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Periode</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="aksi/periode.php" method="post">
                                            <input type="hidden" name="aksi" value="ubah">
                                            <input type="hidden" name="id_periode" value="<?=$kolom['id_periode']; ?>">
                                            <label for="periode">
                                                periode
                                            </label>
                                            <input
                                                type="text"
                                                name="periode"
                                                value="<?=$kolom['periode'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="tanggal_awal">tanggal awal
                                            </label>
                                            <input
                                                type="date"
                                                name="tanggal_awal"
                                                value="<?=$kolom['tanggal_awal'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="tanggal_ahkir">tanggal ahkir
                                            </label>
                                            <input
                                                type="date"
                                                name="tanggal_ahkir"
                                                value="<?=$kolom['tanggal_ahkir'];?>"
                                                class="form-control"
                                                required="required">

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
                        Tambah Periode Baru
                    </button>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal tambah periode -->
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/periode.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <label for="periode">
                        periode
                    </label>
                    <input type="text" name="periode" class="form-control" required="required">

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
                        <th>Periode</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </thead>
                    <?php
             $sql="SELECT * FROM periode WHERE dihapus_pada IS NOT NULL"; //biar keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){          
            ?>
                    <tr>
                        <td><?= $kolom ['id_periode']; ?>
                        </td>
                        <td><?= $kolom ['periode']; ?>
                        </td>
                        <td><?= $kolom ['dihapus_pada']; ?>
                        </td>
                        <td>
                            <a
                                onclick="return confirm('yakin akan mengembalikan data ini?')"
                                href="aksi/periode.php?aksi=restore&id_periode=<?= $kolom['id_periode']; ?> ">
                                |
                                <i class="fas fa-trash-restore"></i>  
                            </a> 
                            &nbsp;
                            <a
                                onclick="return confirm('yakin akan mengahpus data ini secara permanen?')"
                                href="aksi/periode.php?aksi=hapus-permanen&id_periode=<?= $kolom['id_periode']; ?> ">
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