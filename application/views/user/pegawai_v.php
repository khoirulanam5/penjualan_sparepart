<script src="<?=base_url()?>src/js/hm_sweetalert.min.js"></script>
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
                            if($this->input->get('act')=="view" && !empty($datas)){
                                foreach($datas as $k => $val){
                                    if($val->id_pegawai == $this->input->get("id_pegawai")){
                                        $view[] = $val;
                                    }
                                }
                                $act = "Update";
                               
                            }elseif($this->input->get('act')=="add"){
                                $view = [
                                    0 => (object)array(
                                        "id_pegawai"=>"",
                                        "nama"=>"",
                                        "no_hp"=>"",
                                        "email"=>"",
                                        "password"=>"",
                                        "level"=>""
                                     )
                                    ];
                                    $act = "Simpan";
                            }
                            if(!empty($view)){
                              ?>
                               <form action="<?=base_url()?>user/pegawai/<?=$act?>" method="post">
                                <div class="modal-body">
                                    <div class="table_isi">
                                        <div class="form-group"><label for="inputEstimatedBudget">Nama</label>
                                            <input name="id_pegawai" type="hidden"  value="<?=$view[0]->id_pegawai?>" >
                                            <input name="nama" type="text" id="0" value="<?=$view[0]->nama?>"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEstimatedBudget">No Hp</label>
                                            <input name="no_hp" type="number" id="1" value="<?=$view[0]->no_hp?>"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEstimatedBudget">Email</label>
                                            <input name="email" type="email" id="2" value="<?=$view[0]->email?>" <?=(empty($view[0]->email) ? '':'readonly="readonly"')?>
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEstimatedBudget">Password</label>
                                            <input name="password" type="password" id="password" value=""
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEstimatedBudget">Level</label>
                                            <select name="level" id="" class="form-control">
                                            <?php
                                                echo '<option value="'.$view[0]->level.'">'.ucwords($view[0]->level).'</option>';
                                                echo '<option value="">-- Pilih--</option>';
                                                echo '<option value="counter">Counter</option>';
                                                echo '<option value="kasir">Kasir</option>';
                                                echo '<option value="frontdesk">Frontdesk</option>';
                                                echo '<option value="kepala_bengkel">Kepala Bengkel</option>';
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEstimatedBudget">Status</label>
                                            <select name="status" id="" class="form-control">
                                            <?php
                                                echo '<option value="">-- Pilih--</option>';
                                                echo '<option value="1">Aktif</option>';
                                                echo '<option value="0">Non Aktif</option>';
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" id="update" value="<?=$act?>" style="display: block;">
                                    <button class="btn btn-success" onclick="batal()" style="display: block;" > Batal</button>
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
                                            <div class="col-lg-1 col-sm-3">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped" id="tables">
                                                <thead>
                                                    <tr>
                                                        <th style="">ID </th>
                                                        <th style="">Nama</th>
                                                        <th style="">No Hp</th>
                                                        <th style="">Email</th>
                                                        <th style="">Level</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                        if (!empty($datas)) {
                                                            
                                                            foreach ($datas as $key => $value) {
                                                              ?>
                                                            <tr id="<?= $value->id_pegawai ?>">
                                                                <?php
                                                                    echo "<th>" . strtoupper($value->id_pegawai) . "</th>";
                                                                    echo "<th>" . strtoupper($value->nama) . "</th>";
                                                                    echo "<th>" . strtoupper($value->no_hp) . "</th>";
                                                                    echo "<th>" . strtoupper($value->email) . "</th>";
                                                                    echo "<th>" . strtoupper($value->level) . "</th>";
                                                                ?>
                                                                <td>
                                                                    <button class="btn btn-xs btn-primary" href=""
                                                                        id="<?= $value->id_pegawai ?>"
                                                                        onclick="action_view('<?= $value->id_pegawai ?>')"><i
                                                                            class="fa fa-eye"></i></button>
                                                                    <button class="btn btn-xs btn-primary"
                                                                        onclick="action_delete('<?= $value->id_pegawai ?>')"><i
                                                                            class="fa fa-trash-alt"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $no++;
                                                            }
                                                        } 
                                                        ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="margin-left: auto;">Tambah Data
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url() ?>user/pegawai/simpan"
                                                        method="post">
                                                        <div class="modal-body">
                                                            <?php
                                                      if(!empty($field)){
                                                        foreach ($field as $key => $value) {
                                                          if ($value != "id") {
                                                        ?>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span
                                                                            class="input-group-text"><?= $value ?></span>
                                                                    </div>
                                                                    <input type="text" name="<?= $value ?>"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                      }
                                                    }
                                                    ?>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary" value="Save">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                                    <div>Donut</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </section>
</div>
<script src="<?=base_url()?>src/js/jquery.min.js"></script>
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
    location.href = "?act=view&id_pegawai=" + data[0];
}


const action_delete = (id) => {
    console.log(id); // Menampilkan ID yang akan dihapus di console

    $.ajax({
        url: "<?= base_url() ?>user/pegawai/delete/" + id,
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