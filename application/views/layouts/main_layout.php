

<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view("components/meta", $data); ?>
    </head>
    <body class="no-overflow" data-color="theme-3"  id="objectBox">
        <?php $this->load->view("components/header"); ?>
        <?php $this->load->view("components/slider"); ?>
        <?php $this->load->view("main_content/" . $main_content); ?>
        <?php $this->load->view("components/footer"); ?>

    </body>
</html>