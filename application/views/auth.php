<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="<?php echo base_url(); ?>assets/css/llcp.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/global.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/official.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/llcp.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js" integrity="sha512-wT7uPE7tOP6w4o28u1DN775jYjHQApdBnib5Pho4RB0Pgd9y7eSkAV1BTqQydupYDB9GBhTcQQzyNMPMV3cAew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo base_url(); ?>assets/js/global.js"></script>

</head>

<body style="height:100vh;" class="bg-cream-1">
    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <div class="card rounded-0 shadow border-0" style="min-width: 400px;">
            <div class="card-header text-center fs-3 fw-bold bg-blue-0 text-white">
                <a class="btn btn-outline-light border-0 fs-4" href="./">
                    <?= APPTITLE ?>
                </a>
            </div>
            <div class="card-body" id="body-login">
                <div class="mb-2">
                    <label for="verify-username" class="form-label mb-1">Username</label>
                    <input type="text" class="form-control" id="verify-username">
                </div>
                <div class="mb-5">
                    <label for="verify-password" class="form-label mb-1">Password</label>
                    <input type="password" class="form-control" id="verify-password">
                </div>
                <button class="btn btn-primary w-100 mb-3" id="btn-login">
                    Login
                </button>
            </div>

            <div class="card-footer text-center" id="version">

            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $("#btn-login").click(function () {
            $.ajax({
                url: global_defaults.server_url + 'api/v1/open/user/verify',
                type: "POST",
                data: {
                    username: $("#verify-username").val(),
                    password: $("#verify-password").val()
                },
                dataType: "json",
                success: function (data) {
                    data = data.data;

                    auth_info.setAuthInfo(data.user_id, data.session_id, data.name);

                    console.log(auth_info.getAuthInfo());
                }
            });
        });

        //on register
        $('#btn-register').click(function () {
            $.ajax({
                url: global_defaults.server_url + 'api/v1/user/create',
                type: "POST",
                data: {
                    username: $("#register-username").val(),
                    password: $("#register-password").val(),
                    nama: $("#register-nama").val(),
                    desa: $("#register-desa").val(),
                    hp: $("#register-hp").val(),
                    alamat: $("#register-alamat").val()
                },
                dataType: "json",
                success: function (data) {
                    alert('Register success');

                    //reload page
                    location.reload();
                }
            });
        });

        $('#version').html(global_defaults.VERSION);
    });
</script>

</html>