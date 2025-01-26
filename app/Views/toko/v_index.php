<!-- Tambahkan link ke SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">

<!-- Tambahkan script ke SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('Toko/Input') ?>" class="btn btn-flat btn-success btn-sm">
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php
            if (session()->getFlashdata('insert')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('insert');
                echo '</h5></div>';
            }
            if (session()->getFlashdata('update')) {
                echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('update');
                echo '</h5></div>';
            }
            if (session()->getFlashdata('delete')) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('delete');
                echo '</h5></div>';
            }
            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="30px">No</th>
                        <th>Tipe Apotek</th>
                        <th>Marker</th>
                        <th>Logo</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($toko as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-center"><?= $value['merek'] ?></td>
                            <td class="text-center"><img src="<?= base_url('marker/' . $value['marker']) ?>" style="width: 75px; height: auto;"></td>
                            <td class="text-center"><img src="<?= base_url('icon/' . $value['logo']) ?>" style="width: 75px; height: auto;"></td>
                            <td class="text-center">
                                <a href="<?= base_url('Toko/Edit/' . urlencode(base64_encode($value['id_merek']))) ?>" class="btn btn-sm btn-primary btn-flat mr-2"><i class="fas fa-edit"></i> Edit</a>
                                <button class="btn btn-sm btn-danger btn-flat btn-delete" data-url="<?= base_url('Toko/Delete/' . $value['id_merek']) ?>"><i class="fas fa-trash-alt"></i> Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
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
