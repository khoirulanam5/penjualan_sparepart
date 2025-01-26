
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>src/img/sparepart.png">
    <title>Ahas Ajima Motor</title>
    <!-- <title>
        <?php
        $data["title"] = "AHAS AJIMA MOTOR";
        $data["menu"]  = $menu;
        $data["datas"]  = $datas;
?>
    </title> -->
    <?php $this->load->view("Css"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        $this->load->view("NavTop", $data);
        $this->load->view("LeftMenu");
        $this->load->view($page,$data);
        $this->load->view("footer");
        ?>
    </div>
    <?php $this->load->view("js"); ?>
</body>
</html>

