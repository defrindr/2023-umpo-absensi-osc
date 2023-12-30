<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jadwal 2 |
        <?= APPTITLE ?>
    </title>

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
            <div class="card shadow border-top-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><i class="bi bi-table"></i> Data Table</h5>
                    </div>
                    <div class="mt-2 d-flex justify-content-evenly align-items-center gap-2" id="sched-buttons">
                        <button class="btn btn-outline-dark flex-fill text-capitalize" target="senin">
                            senin
                        </button>
                    </div>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Ruang</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody id="sched-data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include('components/watermark.php') ?>
</body>
<script src="<?php echo base_url(); ?>assets/js/bottom.js"></script>
<script>
    var schedule_data;
    var local_ruang = {};

    ENDPOINTS = {
        'schedule': 'api/v1/relasi/schedule',
        'ruang': 'api/v1/ruang/get',
    }

    $(document).ready(function() {
        //load ruang
        $.ajax({
            url: ENDPOINTS.ruang,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(data) {
                $.each(data.data, function(index, value) {
                    local_ruang[value.id] = value.nama;
                });
            },
            error: function(xhr, status, error) {
                console.log(error)
            }
        })

        days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
        //clear buttons
        $('#sched-buttons').html('');
        days.forEach(day => {
            $('#sched-buttons').append(`
                <button class="btn btn-outline-dark flex-fill text-capitalize" target="${day}">
                    ${day}
                </button>
            `)
        });

        //set active first button
        $('#sched-buttons button').first().addClass('active');

        load_data();
        show(days[0]);

    });

    function show(day){
        //clear data
        $('#sched-data').html('');
        //show data
        display = schedule_data[day];

        console.log(display);

        $.each(display, function(index, value) {
            html = '<tr>';
            html += '<td>' + local_ruang[index] + '</td><td class="vstack gap-2">';
            $.each(value, function(index2, value2) {
                html += '<div class="d-flex justify-content-between align-items-center border border-dark p-2">';
                html += '<div class="d-flex flex-column">';
                html += '<span>' + value2.nama_kelas + '</span>';
                html += '<span>' + value2.nama_dosen + '</span>';
                html += '</div>';
                html += '<span>' + value2.waktu + '</span>';
                html += '</div>';
            });
            html += '</td></tr>';

            $('#sched-data').append(html);
        });
    }

    $(document).on('click', '#sched-buttons button', function() {
        //clear active
        $('#sched-buttons button').removeClass('active');
        //set active
        $(this).addClass('active');

        show($(this).attr('target'));
    });

    function load_data(){
        $.ajax({
            url: ENDPOINTS.schedule,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(data) {
                
                data = data.data;

                schedule_data = data;
            },
            error: function(xhr, status, error) {
                console.log(error)
            }
        })
    }

</script>

</html>