<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
            <?= ucwords(str_replace("_", " ", $menu)) ?>
          </h1>
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
              <button class="btn btn-xs btn-primary" onclick="action_add()"><i class="fa fa-plus"></i> Tambah</button>
              <?php
              if ($this->input->get("act") == "view") {
                $view = $this->db->get_where("pelanggan", array("id_pelanggan" => $this->input->get("id_pelanggan")))->result();
                $act = "Update";
              } elseif ($this->input->get("act") == "add") {
                $view = [
                  0 => (object) array(
                    "id_pelanggan" => "",
                    "nama_pelanggan" => "",
                    "desa" => "",
                    "kodepos" => "",
                    "rt" => "",
                    "rw" => "",
                    "kabupaten" => "",
                    "kecamatan" => "",
                    "no_hp" => "",
                    "email" => "",
                  )
                ];
                $act = "Simpan";
              }
              if (!empty($view)) {
                ?>
                <form action="<?=base_url()?>user/pelanggan/<?= $act ?>" method="post">
                  <div class="modal-body">
                    <div class="table_isi">
                    <?php
                        if($this->input->get('act')=='add'){
                          ?>
                          <div class="form-group"><label for="inputEstimatedBudget">Username</label>  
                          <input name="id_pelanggan" type="text"   class="form-control">
                          </div>
                          <?php
                        }else{
                          ?>
                          <input name="id_pelanggan" type="hidden" value="<?= $view[0]->id_pelanggan ?>">
                          <?php
                        }
                        ?>
                      <div class="form-group"><label for="inputEstimatedBudget">Nama Pelanggan</label>                      
                        <input name="nama_pelanggan" type="text" id="0" value="<?= $view[0]->nama_pelanggan ?>"
                          class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Desa</label>
                        <input name="desa" type="text" id="1" value="<?= $view[0]->desa ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Kode Pos</label>
                        <input name="kodepos" type="text" id="kodepos" value="<?= $view[0]->kodepos ?>"
                          class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Rt</label>
                        <input name="rt" type="text" id="rt" value="<?= $view[0]->rt ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Rw</label>
                        <input name="rw" type="text" id="rw" value="<?= $view[0]->rw ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Kabupaten</label>
                        <input name="kabupaten" type="text" id="kabupaten" value="<?= $view[0]->kabupaten ?>"
                          class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Kecamatan</label>
                        <input name="kecamatan" type="text" id="kecamatan" value="<?= $view[0]->kecamatan ?>"
                          class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">No Hp</label>
                        <input name="no_hp" type="number" id="2" value="<?= $view[0]->no_hp ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Email</label>
                        <input name="email" type="email" id="3" value="<?= $view[0]->email ?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-success" id="update" value="<?= $act ?>" style="display: block;">
                    <button class="btn btn-success" onclick="batal()" style="display: block;"> Batal</button>
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
                            <th style="">NO </th>
                            <th style="">Nama Pelanggan</th>
                            <th style="">Desa</th>
                            <th style="">kodepos</th>
                            <th style="">rt</th>
                            <th style="">rw</th>
                            <th style="">kabupaten</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          if (!empty($datas)) {
                            foreach ($datas as $key => $value) {
                              ?>
                              <tr id="<?= $value->id_pelanggan ?>">
                                <?php
                                echo "<th>" . $no . "</th>";
                                echo "<th>" . strtoupper($value->nama_pelanggan) . "</th>";
                                echo "<th>" . strtoupper($value->desa) . "</th>";
                                echo "<th>" . strtoupper($value->kodepos) . "</th>";
                                echo "<th>" . strtoupper($value->rt) . "</th>";
                                echo "<th>" . strtoupper($value->rw) . "</th>";
                                echo "<th>" . strtoupper($value->kabupaten) . "</th>";
                                ?>
                                <td>
                                  <button class="btn btn-xs btn-primary" href="" id="<?= $value->id_pelanggan ?>"
                                    onclick="action_view('<?= $value->id_pelanggan ?>')"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-xs btn-primary"
                                            onclick="action_delete('<?= $value->id_pelanggan ?>')">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                              </tr>
                              <?php $no++;
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
<script src="<?= base_url() ?>src/dataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/jszip.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/pdfmake.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/vfs_fonts.js"></script>
<script src="<?= base_url() ?>src/dataTables/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/buttons.print.min.js"></script>
<script src="<?= base_url() ?>src/dataTables/buttons.colVis.min.js"></script>
<script type="text/javascript">
  var table = $("#tables").DataTable();

  function action_add(id) {
    location.href = "?act=add";
  }

  function batal() {
    $("form").remove();
  }
  const action_view = (id) => {
    var data = table.row("#" + id).data();
    console.log(data);
    location.href = "?act=view&id_pelanggan=" + id;
  }


  const action_delete = (id) => {
    console.log(id); // Menampilkan ID yang akan dihapus di console

    $.ajax({
        url: "<?= base_url() ?>user/pelanggan/delete/" + id,
        type: "POST",
        success: function (response) {
            if (response == "1") {
                swal({
                    title: "Good",
                    text: "Hapus data berhasil",
                    type: "success"
                }).then(function () {
                    window.location.reload(); // Refresh halaman setelah data berhasil dihapus
                });
            } else {
                swal({
                    title: "Error",
                    text: response, // Menampilkan pesan error jika ada
                    type: "error"
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Menampilkan pesan error di console
            swal({
                title: "Error",
                text: "Terjadi kesalahan pada server. Coba lagi nanti.",
                type: "error"
            });
        }
    });
}
</script>