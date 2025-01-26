<div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title"><?= $judul?></h3>

                <div class="card-tools">
                  <a href = "<?= base_url('Wilayah/Input')?>" class="btn btn-flat btn-success btn-sm ">
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
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Wilayah</th>
                        <th>Warna</th>
                        <th width="150px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($wilayah as $key => $value){ ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama_wilayah']?></td>
                                <td style="background-color:<?= $value['warna']?> ;"></td>
                                <td class="text-center"> 
                                  <a href="<?= base_url('Wilayah/Edit/'. urlencode(base64_encode($value['id_wilayah'])))?>" class="btn btn-sm btn-primary btn-flat mr-2"><i class="fas fa-edit"></i> Edit</a>
                                  <a href="<?= base_url('Wilayah/Delete/'. $value['id_wilayah'])?>" class="btn btn-sm btn-danger btn-flat" id="delete-link-<?= $value['id_wilayah'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>

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
        <div class="col-md-12">
        <div id="map" style="width: 100%; height: 800px;"></div>
        </div>
        <script>
     var peta1 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    });
    var peta2 = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    });
    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
    attribution: '© CartoDB'
});
    


const map = L.map('map', {
	center: [<?= $web['koordinat_wilayah'] ?>],
	zoom: <?= $web['zoom_view'] ?>,
	layers: [peta2]
});

const baseMaps = {
	'Streets': peta1,
    'Satelite' : peta2,
	'Dark': peta3,
    
};
var layerControl = L.control.layers(baseMaps).addTo(map);
<?php foreach ($wilayah as $key => $value) { ?>
  L.geoJSON(<?= $value['geojson'] ?>, { 
    fillColor: '<?= $value['warna'] ?>', 
    fillOpacity: 0.8,})
  .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
  .addTo(map);
<?php } ?>
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true,
      "ordering": true,
      "info": true, 
      "paging": true,
      "searching": true,
      "autoWidth": false,
      "buttons": [
        { extend: 'copy', className: 'btn-success' },
        { extend: 'csv', className: 'btn-success' },
        { extend: 'excel', className: 'btn-success' },
        { extend: 'pdf', className: 'btn-success' },
        { extend: 'print', className: 'btn-success' },
        { extend: 'colvis', className: 'btn-success' }
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  document.querySelectorAll('[id^="delete-link-"]').forEach(function(deleteLink) {
    deleteLink.addEventListener('click', function(event) {
      event.preventDefault();
      var deleteUrl = this.href;
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
          window.location.href = deleteUrl;
        }
      });
    });
  });
</script>

