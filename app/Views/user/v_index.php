<style>
    /* Style untuk background dan warna teks saat peran adalah admin */
    .text-admin {
        background-color: green; /* Warna latar belakang */
        color: white; /* Warna teks */
        padding: 5px 10px; /* Spasi di sekitar teks */
        border-radius: 5px; /* Membuat sudut teks */
    }

    .text-superadmin {
        background-color: red; /* Warna latar belakang */
        color: white; /* Warna teks */
        padding: 5px 10px; /* Spasi di sekitar teks */
        border-radius: 5px; /* Membuat sudut teks */
    }

    /* Style untuk background dan warna teks saat peran adalah user */
    .text-user {
        background-color: blue; /* Warna latar belakang */
        color: white; /* Warna teks */
        padding: 5px 10px; /* Spasi di sekitar teks */
        border-radius: 5px; /* Membuat sudut teks */
    }

    /* Style untuk sel tabel */
    td {
        text-align: center; /* Menengahkan teks horizontal */
        vertical-align: middle !important; /* Menengahkan teks vertikal */
    }
</style>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul?></h3>

            <div class="card-tools">
                <a href="<?= base_url('UserControll/Input')?>" class="btn btn-flat btn-success btn-sm ">
                    <i class="fas fa-plus "></i> Create
                </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php 
                //notif insert
                  if (session()->getFlashdata('insert')) {
                    echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> ';
                    echo session()->getFlashdata('insert');
                    echo '</h5></div>';
                  }
                  // notif update
                  if (session()->getFlashdata('update')) {
                    echo '<div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> ';
                    echo session()->getFlashdata('update');
                    echo '</h5></div>';
                  }
                  // notif delete
                  if (session()->getFlashdata('delete')) {
                    echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> ';
                    echo session()->getFlashdata('delete');
                    echo '</h5></div>';
                  }
                ?>
            <table id="example1" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px" class="text-center">No</th>
                        <th >Role</th>
                        <th >Fullname</th>
                        <th >Username</th>
                        <th >E-mail</th>
                        <th >Foto</th>
                        <th >Aktif</th>
                        <?php if (in_groups('superadmin')) : ?>
                        <th width="200px" class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                        foreach ($user as $key => $user){ ?>
                    <tr>
                        <td class="text-center center-content"><?= $no++ ?></td>
                        <td class="text-center center-content ">
                            <?php if ($user['group_name'] == 'admin'): ?>
                                <span class="text-admin"><?= $user['group_name'] ?></span>
                            <?php elseif ($user['group_name'] == 'superadmin'): ?>
                                <span class="text-superadmin"><?= $user['group_name'] ?></span>
                            <?php else: ?>
                                <span class="text-user"><?= $user['group_name'] ?></span>
                            <?php endif; ?>
                        </td>
<td class="text-center center-content"><?= $user['fullname']?></td>
<td class="text-center center-content"><?= $user['username']?></td>
<td class="text-center center-content"><?= $user['email']?></td>
<td class="text-center center-content">
    <img src="<?= base_url('foto/'.$user['foto'])?>" style="width: 100px; height: 100px;">
</td>
<td class="text-center center-content">
    <?php if ($user['active'] == 1): ?>
        <i class="fas fa-check-circle text-success"></i> <!-- Icon centang -->
    <?php else: ?>
        <i class="fas fa-times-circle text-danger"></i> <!-- Icon X -->
    <?php endif; ?>
</td>
<td class="text-center center-content">
    <?php if (in_groups('superadmin')) : ?>
        <a href="<?= base_url('UserControll/Edit/' . urlencode(base64_encode($user['id']))) ?>" class="btn btn-xs btn-primary btn-flat mr-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="<?= base_url('UserControll/Delete/' . $user['id']) ?>" class="btn btn-xs btn-danger btn-flat delete-btn">
            <i class="fas fa-trash-alt"></i> Delete
        </a>
    <?php endif; ?>
</td>



                    </tr>
                    <?php }
                        ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "ordering": true,
        "info": true,
        "paging": true,
        "searching": true,
        "autoWidth": false,
        "buttons": [{
                extend: 'copy',
                className: 'btn-success'
            },
            {
                extend: 'csv',
                className: 'btn-success'
            },
            {
                extend: 'excel',
                className: 'btn-success'
            },
            {
                extend: 'pdf',
                className: 'btn-success'
            },
            {
                extend: 'print',
                className: 'btn-success'
            },
            {
                extend: 'colvis',
                className: 'btn-success'
            }
        ]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.href;
            
            Swal.fire({
                title: 'Are you sure?',
                text: "Data Will Be Deleted!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});
</script>