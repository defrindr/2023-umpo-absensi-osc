<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | <?= APPTITLE ?> </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="<?php echo base_url(); ?>assets/css/llcp.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/global.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/official.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/llcp.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <style>
        /* for even col remove start padding */
        .newsrow > .col:nth-child(2n+1) {
            
            padding-left: 0;
        }

        /* for even col remove end padding */
        .newsrow > .col:nth-child(2n) {
            padding-right: 0;
        }
    </style>
</head>

<body class="bg-cream-1 p-2" style="height:100vh;">
    HOME
    <?php include('components/watermark.php') ?>
</body>
<script>
    $(document).ready(function () {
        load_desa();
    });

    function load_desa() {
        $.ajax({
            url: "<?= base_url('api/v1/open/desa') ?>",
            type: "GET",
            dataType: "json",
            success: function (response) {
                data = response.data;

                $.each(data, function (i, item) {
                    $('#desa-selector').append(`
                        <option value="${item.id}">${item.desa}</option>
                    `);
                });
            }
        });
    }
</script>

</html>