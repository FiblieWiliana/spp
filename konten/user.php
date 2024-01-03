<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data User</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Data Utama</a>
                        </li>
                        <li class="breadcrumb-item active">Data User</li>
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
                    <h5>Data User</h5>
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
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
             $sql="SELECT * FROM user WHERE dihapus_pada IS NULL"; //biar ga keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){     
            ?>

                        <tr>
                            <td><?= $kolom ['id_user']; ?>
                            </td>
                            <td><?= $kolom ['nama']; ?>
                            </td>
                            <td><?= $kolom ['username']; ?>
                            </td>
                            <td><?= $kolom ['password']; ?>
                            </td>
                            <td><?= $kolom ['hak_akses']; ?>
                            </td>
                            <td>
                                <!-- tombol edit -->
                                <a href="#" data-toggle="modal" data-target="#modalubah<?=$kolom['id_user'];?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;<!-- untuk jarak -->
                                <!-- tombol hapus -->
                                <a
                                    onclick="return confirm('yakin akan mengahpus data ini?')"
                                    href="aksi/user.php?aksi=hapus&id_user=<?= $kolom['id_user']; ?> ">
                                    |
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- modal ubah periode -->
                        <div
                            class="modal fade"
                            id="modalubah<?=$kolom['id_user'];?>"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah user</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="aksi/user.php" method="post">
                                            <input type="hidden" name="aksi" value="ubah">
                                            <input type="hidden" name="id_user" value="<?=$kolom['id_user']; ?>">

                                            <label for="id_user">Id User
                                            </label>
                                            <input
                                                type="text"
                                                name="id_user"
                                                value="<?=$kolom['id_user'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="nama">Nama
                                            </label>
                                            <input
                                                type="text"
                                                name="nama"
                                                value="<?=$kolom['nama'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="username">Username
                                            </label>
                                            <input
                                                type="text"
                                                name="username"
                                                value="<?=$kolom['username'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="password">Password
                                            </label>
                                            <input
                                                type="password"
                                                name="password"
                                                value="<?=$kolom['password'];?>"
                                                class="form-control"
                                                required="required">

                                            <label for="hak_akses">Hak Akses
                                            </label>
                                            <select class="form-control"  name="hak_akses" id="hak_akses">
                                              <option value="<?=$kolom['hak_akses'];?>"><?=$kolom['hak_akses'];?></option>
                                              <option value="1">1</option>
                                               <option value="2">2</option>      
                                            </select> 

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
                        <?php  } ?>

                    </table>
                    <button
                        type="button"
                        class="btn bg-blue btn-block mt-3"
                        data-toggle="modal"
                        data-target="#modaltambah">
                        <i class="fas fas-plus"></i>
                        Tambah User Baru
                    </button>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- modal tambah user -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="aksi/user.php" method="post">
                        <input type="hidden" name="aksi" value="tambah">
                        <!-- <label for="id_user"> ID </label> <input type="text" name="id_user"
                        class="form-control" required="required"> -->

                        <label for="nama">Nama user
                        </label>
                        <input type="text" name="nama" class="form-control" required="required">

                        <label for="username">username
                        </label>
                        <input type="text" name="username" class="form-control" required="required">

                        <label for="password">password
                        </label>
                        <input type="text" name="password" class="form-control" required="required">
                                <!-- contoh buat pilihan -->
                        <label for="hak_akses">Hak Akses
                        </label>
                          <select class="form-control"  name="hak_akses" id="hak_akses">
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select>
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
             $sql="SELECT * FROM user WHERE dihapus_pada IS NOT NULL"; //biar keliatan di web ny klo di hapus tp msi kesimpen di database
             $query=mysqli_query($koneksi,$sql);
             while ($kolom=mysqli_fetch_array($query)){          
            ?>
                        <tr>
                            <td><?= $kolom ['id_user']; ?>
                            </td>
                            <td><?= $kolom ['nama']; ?>
                            </td>
                            <td><?= $kolom ['dihapus_pada']; ?>
                            </td>
                            <td>
                                <a
                                    onclick="return confirm('yakin akan mengembalikan data ini?')"
                                    href="aksi/user.php?aksi=restore&id_user=<?= $kolom['id_user']; ?> ">
                                    |
                                    <i class="fas fa-trash-restore"></i>
                                </a>
                                &nbsp;
                                <a
                                    onclick="return confirm('yakin akan mengahpus data ini secara permanen?')"
                                    href="aksi/user.php?aksi=hapus-permanen&id_user=<?= $kolom['id_user']; ?> ">
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