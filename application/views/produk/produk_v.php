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
                      $view = $this->db->get_where("produk",array("id_produk"=>$this->input->get("id_produk")))->result();
                      $act = "Update";
                  }elseif($this->input->get("act")=="add"){
                      $view = [
                          0 => (object)array(
                              "id_produk"=>"",
                              "nama_produk" =>"",
                              "jenis_pro" =>"",
                              "harga_belipro" =>"",
                              "harga_jualpro" =>"",
                              "diskripsi" =>"",
                              "images" =>""
                           )
                          ];
                          $act = "Simpan";
                  }
                  if(!empty($view)){
                    ?>
                     <form action="<?=base_url()?>produk/produk/<?=$act?>" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                          <div class="table_isi">
                            <div class="form-group"><label for="inputEstimatedBudget">Nama Produk</label>
                            <input name="id_produk" type="hidden"  value="<?=$view[0]->id_produk?>" >
                            <input name="nama_produk" type="text" id="0" value="<?=$view[0]->nama_produk?>"
                            class="form-control">
                          </div>
                              <?php
                              if(!empty($view[0]->images)){
                                $imgcek = file_exists(FCPATH.'images/'.$view[0]->images) ? $view[0]->images : 'noimages.jpg';
                                ?>
                                <img src="<?=base_url("images/").$imgcek?>"  width="100px" alt="">
                                <input name="images" type="hidden" id="0" value="<?=$view[0]->images?>" >
                                <?php
                              }
                              ?>
                              <div class="form-group"><label for="inputEstimatedBudget">Images</label>
                                  <input name="images" type="file" id="0" class="form-control" accept="image/*">
                              </div>
                              <div class="form-group">
                                  <label for="inputEstimatedBudget">Kategori</label>
                                  <select name="jenis_pro" id="jenis_pro" class="form-control">
                                      <option value="">--Pilih--</option>
                                      <?php
                                      $kat = $this->db->get('tb_kategori')->result();
                                      foreach ($kat as $key => $value) {
                                          echo '<option value="'.$value->jenis.'">'.$value->jenis.'</option>';
                                      }
                                      ?>
                                  </select>
                                </div>
                              <div class="form-group">
                                  <label for="inputEstimatedBudget">Diskripsi Produk</label>
                                  <textarea name="diskripsi" type="text" id="1" rowspan="3" class="form-control"><?=$view[0]->diskripsi?></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="inputEstimatedBudget">Harga Beli</label>
                                  <input name="harga_belipro" type="text" id="3" value="<?=$view[0]->harga_belipro?>"
                                      class="form-control">
                              </div>
                              <div class="form-group">
                                  <label for="inputEstimatedBudget">Harga Jual</label>
                                  <input name="harga_jualpro" type="text" id="4" value="<?=$view[0]->harga_jualpro?>"
                                      class="form-control">
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
                                          <th style="width:150px;">Kode Barang</th>
                                          <th style="width:250px;">Nama</th>
                                          <th style="width:120px;">Jenis</th>
                                          <th style="width:120px;">Harga Beli</th>
                                          <th style="width:120px;">Harga Jual</th>
                                          <th class="text-center">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($datas)) {
                                        foreach ($datas as $key => $value) {
                                    ?>
                                            <tr id="<?= $value->id_produk ?>">
                                                <?php
                                                echo "<th>" . strtoupper($value->kode_barang) . "</th>";
                                                echo "<th>" . strtoupper($value->nama_produk) . "</th>";
                                                echo "<th>" . strtoupper($value->jenis_pro) . "</th>";
                                                echo "<th>" . strtoupper($value->harga_belipro) . "</th>";
                                                echo "<th>" . strtoupper($value->harga_jualpro) . "</th>";
                                                ?>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-primary" href="" id="<?= $value->id_produk ?>" onclick="action_view('<?= $value->id_produk ?>')"><i class="fa fa-eye"></i></button>
                                                    <button class="btn btn-xs btn-primary" onclick="action_delete('<?= $value->id_produk ?>')"><i class="fa fa-trash-alt"></i></button>
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
    location.href = "?act=view&id_produk=" +id;
}


const action_delete = (id) => {
    console.log(id); // Menampilkan ID yang akan dihapus di console

    $.ajax({
        url: "<?= base_url() ?>produk/produk/delete/" + id,
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