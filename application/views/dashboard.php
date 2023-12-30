<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | <?= APPTITLE ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="<?php echo base_url(); ?>assets/css/llcp.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/global.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/official.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/llcp.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js" integrity="sha512-wT7uPE7tOP6w4o28u1DN775jYjHQApdBnib5Pho4RB0Pgd9y7eSkAV1BTqQydupYDB9GBhTcQQzyNMPMV3cAew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo base_url(); ?>assets/js/global.js"></script>
    <style>
        .card {
            display: none;
        }
    </style>

</head>

<body class="bg-cream-1" style="height:100vh;">
    <?php include('components/side.php') ?>
    <div class="d-flex flex-column w-100 h-100">
        <?php include('components/top.php') ?>
        <div class="d-flex justify-content-between align-items-center p-2 bg-white mb-3 ">
            <span class="fs-5 fw-bold text-white ms-2">
                spacer
            </span>
        </div>
        <div class="container-fluid p-2 p-md-3 py-4">
            <div class="row row-cols-1 m-0">
                <div class="col-md-9 mb-3">
                    <div class="vstack gap-3">
                        <h1>
                            Dashboard
                        </h1>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="vstack gap-3">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('components/watermark.php') ?>
</body>
<script src="<?php echo base_url(); ?>assets/js/bottom.js"></script>
<script>
    
</script>

</html>