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
                $view = $this->db->get_where("ongkos_kirim",array("id_ongkos"=>$this->input->get("id_ongkos")))->result();
                $act = "Update";
              }elseif($this->input->get("act")=="add"){
                $view = [
                  0 => (object)array(
                    "id_ongkos"=>"",
                    "lokasi_tujuan" =>"",
                    "jarak" =>"",
                    "jenis" =>"JASA TOKO",
                    "biaya" =>"",
                  )
                ];
                $act = "Simpan";
              }
              if(!empty($view)){
                ?>
                <form action="<?=base_url()?>transaksi/ongkir_toko/<?=$act?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="table_isi">
                     <?php
                     if (empty($view[0]->id_ongkos)) {
                       ?>
                       <div class="form-group">
                        <label for="inputEstimatedBudget">Id Lokasi</label>
                        <input name="id_ongkos" type="text" id="" class="form-control">
                      </div>
                      <?php
                    }else{
                      ?>
                      <input name="id_ongkos" type="hidden"  value="<?=$view[0]->id_ongkos?>" >
                      <?php
                    } ?>
                    <div class="form-group">
                      <label for="inputEstimatedBudget">Lokasi Tujuan</label>
                      <input name="lokasi_tujuan" type="text" id="0" value="<?=$view[0]->lokasi_tujuan?>"
                      class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="inputEstimatedBudget">Jarak Lokasi</label>
                      <input name="jarak" type="text" id="1" value="<?=$view[0]->jarak?>"
                      class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="inputEstimatedBudget">Jenis</label>
                      <input name="jenis" type="text" id="2" value="<?=$view[0]->jenis?>" class="form-control" >
                      <div class="form-group">
                        <label for="inputEstimatedBudget">Biaya</label>
                        <input name="biaya" type="number" id="2" value="<?=$view[0]->biaya?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update" style="display: block;"> <?=$act?></button>
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
                            <th style="">ID </th>
                            <th style="">Lokasi Tujuan</th>
                            <th style="">Jenis</th>
                            <th style="">Biaya</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          if (!empty($datas)) {

                            foreach ($datas as $key => $value) {
                              if ($value->id_ongkos != 6) {
                                ?>
                                <tr id="<?= $value->id_ongkos ?>">
                                  <?php
                                  echo "<th>" . strtoupper($value->id_ongkos) . "</th>";
                                  echo "<th>" . strtoupper($value->lokasi_tujuan) . "</th>";
                                  echo "<th>" . strtoupper($value->jenis) . "</th>";
                                  echo "<th>" . strtoupper($value->biaya) . "</th>";
                                  ?>
                                  <td class="text-center">
                                    <button class="btn btn-xs btn-primary" href="" id="<?= $value->id_ongkos ?>" onclick="action_view('<?= $value->id_ongkos ?>')"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-xs btn-primary" onclick="action_delete('<?= $value->id_ongkos ?>')"><i class="fa fa-trash-alt"></i></button>
                                  </td>
                                </tr>
                                <?php $no++;
                              }
                            }
                          } 
                          ?>
                        </tbody>
                      </table>
                    </div>

                  </div>      
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
      var table = $('#tables').DataTable();

      function action_add(id) {
        location.href = "?act=add";
      }

      function batal(){
        $("form").remove();
      }
      const action_view = (id) => {
        var data = table.row("#" + id).data();
        console.log(data);
        location.href = "?act=view&id_ongkos=" + data[0];
      }


      const action_delete = (id) => {
        var row = JSON.stringify(table.row("#" + id).data());
        $.ajax({
          url: "<?=base_url()?>transaksi/ongkir_toko/delete",
          type: "POST",
          data: {
            row
          },
          success: function(e) {
            if(e == "1"){
              swal({
                title: "Good",
                text: "Hapus data berhasil",
                type: "success"
              }).then(function() {
                window.location.reload();
              })
            }

          }
        })
      }
    </script>