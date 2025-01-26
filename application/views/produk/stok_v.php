<script src="<?=base_url('src/js/')?>hm_sweetalert.min.js"></script>
    <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$menu?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-body">
               <button class="btn btn-xs btn-primary"  onclick="action_add()"><i class="fa fa-plus"></i> Tambah</button>
               <?php  
                  if($this->input->get("act")=="view"){
                      $view = $this->db->get_where("tb_stok",array("id_stok"=>$this->input->get("id_stok")))->result();
                      $act = "Update";
                  }elseif($this->input->get("act")=="add"){
                      $view = [
                          0 => (object)array(
                              "id_stok"=>"",
                              "id_produk" =>"",
                              "jml_stok" => ""
                           )
                          ];
                          $act = "Simpan";
                  }
                  if(!empty($view)){
                    ?>
                     <form action="<?=base_url()?>produk/stok/<?=$act?>" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                          <div class="table_isi">
                            <div class="form-group">
                                <label for="inputEstimatedBudget">Nama Sparepart</label>
                                    <input name="id_stok" type="hidden"  value="<?=$view[0]->id_stok?>" >
                                    <select name="id_produk" id="id_produk" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $kat = $this->db->get('produk')->result();
                                        foreach ($kat as $key => $value) {
                                            echo '<option value="'.$value->id_produk.'">'.$value->nama_produk.'</option>';
                                        }
                                    ?>
                                </select>
                          </div>
                              <div class="form-group">
                                  <label for="inputEstimatedBudget">Jumlah Stok</label>
                                  <input name="jml_stok" type="text" id="5" value="<?=$view[0]->jml_stok?>" class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <input type="submit" class="btn btn-primary" id="update" value="<?=$act?>" style="display: block;">
                          <button class="btn btn-primary" onclick="batal()" style="display: block;" > Batal</button>
                      </div>
                  </form>
                    <?php
                  }
                  ?>
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                    <div>
                    <?php if ($this->session->flashdata('message')): ?>
                        <script>
                            <?= $this->session->flashdata('message'); ?>
                        </script>
                        <?php $this->session->unset_userdata('message'); ?>
                    <?php endif; ?>
                          <div class="row">
                          </div>
                          <div class="card-body">
                              <table class="table table-bordered table-striped" id="tables">
                                  <thead>
                                      <tr>
                                          <th style="">Nama Sparepart</th>
                                          <th style="">Jumlah Stok</th>
                                          <th class="text-center">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($datas)) {
                                        $no = 1;
                                        foreach ($datas as $key => $value) {
                                    ?>
                                            <tr id="<?= $value->id_stok ?>">
                                                <?php
                                                echo "<th>" . strtoupper($value->nama_produk) . "</th>";
                                                echo "<th>" . strtoupper($value->jml_stok) . "</th>";
                                                ?>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-primary" href="" id="<?= $value->id_stok ?>" onclick="action_view('<?= $value->id_stok ?>')"><i class="fa fa-eye"></i></button>
                                                    <button class="btn btn-xs btn-primary" onclick="action_delete('<?= $value->id_stok ?>')"><i class="fa fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                    <?php
                                            $no++;
                                        }
                                    }
                                    ?>
                                </tbody>

                              </table>
                          </div>
                        
                      </div>      
                  </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <div>Donut</div>
                </div>
                </div>
              </div>
            </div>
          </section>
        </div>
    </section>
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>src/dataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>src/dataTables/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>src/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>src/dataTables/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>src/dataTables/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>src/dataTables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>src/dataTables/jszip.min.js"></script>
<script src="<?= base_url()?>src/dataTables/pdfmake.min.js"></script>
<script src="<?= base_url()?>src/dataTables/vfs_fonts.js"></script>
<script src="<?= base_url()?>src/dataTables/buttons.html5.min.js"></script>
<script src="<?= base_url()?>src/dataTables/buttons.print.min.js"></script>
<script src="<?= base_url()?>src/dataTables/buttons.colVis.min.js"></script>
<script type="text/javascript">
var table = $('#tables').DataTable({order:[[0,'desc']]});

function action_add(id) {
    location.href = "?act=add";
}

function batal(){
  $("form").remove();
}

function action_view (id){
    var data = table.row("#" + id).data();
    console.log(data);
    location.href = "?act=view&id_stok=" +id;
}


const action_delete = (id) => {
    console.log(id); // Menampilkan ID yang akan dihapus di console

    $.ajax({
        url: "<?= base_url() ?>produk/stok/delete/" + id,
        type: "POST",
        success: function (response) {
            if (response == "1") {
                swal({
                    title: "Good",
                    text: "Hapus data berhasil",
                    icon: "success"
                }).then(function () {
                    window.location.reload(); // Refresh halaman setelah data berhasil dihapus
                });
            } else {
                swal({
                    title: "Error",
                    text: response, // Menampilkan pesan error jika ada
                    icon: "error"
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Menampilkan pesan error di console
            swal({
                title: "Error",
                text: "Terjadi kesalahan pada server. Coba lagi nanti.",
                icon: "error"
            });
        }
    });
}
</script>