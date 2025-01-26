<!-- Tambahkan link ke SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">

<!-- Tambahkan script ke SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
<div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title"><?= $judul?></h3>

                <div class="card-tools">
                  <a href = "<?= base_url('InfoToko/Input')?>" class="btn btn-flat btn-success btn-sm ">
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
                        <!-- <th class="text-center">Nama Pemohon</th>
                        <th class="text-center">Nama Perusahaan</th> -->
                        <th >Tipe Apotek</th>
                        <th >Wilayah Administrasi</th>
                        <th >Alamat</th>
                        <th >Foto</th>
                        <th width="200px" class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($infotoko as $key => $value){ ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                
                                <td class="text-center"><?= $value['merek']?></td>
                                <td class="text-center"><?= $value['nama_kecamatan']?></td>
                                <td ><?= $value['alamat']?>
                              </td>
                                <td class="text-center"><img src="<?= base_url('foto/'.$value['foto'])?>" style="width: 150px; height: 120px;"></td>
                                <td class="text-center"> 
                                <a href="<?= base_url('InfoToko/Detail/'. urlencode(base64_encode($value['id_toko'])))?>" class="btn btn-xs btn-success btn-flat mr-2"><i class="fas fa-eye"></i> View</a>
                                  <a href="<?= base_url('InfoToko/Edit/'. urlencode(base64_encode($value['id_toko'])))?>" class="btn btn-xs btn-primary btn-flat mr-2"><i class="fas fa-edit"></i> Edit</a>
                                  <button class="btn btn-xs btn-danger btn-flat btn-delete " data-url="<?= base_url('InfoToko/Delete/'. $value['id_toko'])?>" ><i class="fas fa-trash-alt"></i> Delete</button>
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

          <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true,"ordering": true,"info": true, "paging": true,"searching": true,"autoWidth": false,
     "buttons": [
    { extend: 'copy', className: 'btn-success' },
    { extend: 'csv', className: 'btn-success' },
    { extend: 'excel', className: 'btn-success' },
    { extend: 'pdf', className: 'btn-success' },
    { extend: 'print', className: 'btn-success' },
    { extend: 'colvis', className: 'btn-success' }
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
  document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            Swal.fire({
                title: 'Are you sure?',
                text: "Data Will Be Deleted!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        });
    });
</script>