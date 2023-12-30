<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jadwal Kuliah |
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.4.4/css/tabulator_materialize.min.css" integrity="sha512-gW1AUGu6cjE1DNy4lkqoAZAyQu24gEv2vHvwgR/oIQa5oXAp/buBhi+XFRtluUo7asqFOO+zJdKqaDiIF+vXBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <div class="col-md-12 mb-3" id="mainbar">
                    <div class="vstack gap-3">
                        <div class="card shadow border-top-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title"><i class="bi bi-tools"></i> Toolbar</h5>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-text">Dosen</span>
                                            <select class="form-select" id="cat-dosen" style="width: 20%;">
                                                <option value="0">Pilih Kategori</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hstack gap-2">
                                        <button class="btn btn-primary btn-sm" id="tools-refresh">
                                            <i class="bi bi-arrow-clockwise"></i> Refresh
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-3 m-0" id="schedule">
                            <div class="col ps-0">
                                <div class="card shadow border-top-success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title"><i class="bi bi-input-cursor-text"></i> Senin</h5>
                                        </div>
                                        <div class="vstack gap-2">
                                            <div class="alert alert-primary" role="alert">
                                                nama_dosen <br>
                                                nama_kelas <br>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('components/watermark.php') ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.4.4/js/tabulator.min.js" integrity="sha512-BGo9xGWI32ZfTMp/ueR3fZKO5nYkPbt3uwMWr+w8w3e72H8A0sTQGO+iqRADwIT0eJkFP1HDgSC82gA4sTuQ6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- use version 0.19.2 -->
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.19.2/package/dist/xlsx.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bottom.js"></script>
<script>
    global_category = [];
    ENDPOINTS = {
        'data_dosen': 'api/v1/dosen/get',
        'get_jadwal': 'api/v1/relasi/detailed'
    }

    function load_data() {
        //just log ajax to console, no view is implemented
        console.log('load_data()');
        $.ajax({
            url: global_defaults.server_url + ENDPOINTS.get_jadwal,
            method: 'POST',
            data: {
                'id_dosen': $('#cat-dosen').val()
            },
            dataType: 'json',
            success: function (data) {
                data = data.data;
                //console.log(data);
                algo_proc(data);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function algo_proc(data) {
        //process the schedule into a dictionary, each day consist of two section both 4 hours
        //use greedy approach to fill the schedule

        schedule = {
            'senin': {
                'pagi': [],
                'sore': []
            },
            'selasa': {
                'pagi': [],
                'sore': []
            },
            'rabu': {
                'pagi': [],
                'sore': []
            },
            'kamis': {
                'pagi': [],
                'sore': []
            },
            'jumat': {
                'pagi': [],
                'sore': []
            }
        }

        //change jam in data to int and sort descending
        $.each(data, function (index, value) {
            value.jam = parseInt(value.jam);
        });

        data.sort(function (a, b) {
            return b.jam - a.jam;
        });

        $.each(schedule, function (day_index, day) {
            $.each(day, function (section_index, section) {
                sum = 0;
                console.log(data.length)
                //check if data is exhausted
                if (data.length == 0) return;
                //sum must not exceed 4, if it does move to next section
                $.each(data, function(classes_index, classes){
                    //check classes exist
                    if (classes == undefined) return;
                    if (sum + classes.jam > 4) return;
                    sum += classes.jam;
                    schedule[day_index][section_index].push(classes);
                    //remove from data
                    data.splice(classes_index, 1);
                })
            });
        })

        console.log(schedule);

        //fill view
        $('#schedule').html('');
        $.each(schedule, function (day_index, day) {
            html = '<div class="col ps-0 mb-2"><div class="card shadow border-top-success"><div class="card-body"><div class="d-flex justify-content-between align-items-center mb-3"><h5 class="card-title text-capitalize">' + day_index + '</h5></div><div class="vstack gap-2">';
            $.each(day, function (section_index, section) {
                waktu = [];
                    spent = 0;
                $.each(section, function (classes_index, classes) {
                    //check undefined
                    if (classes == undefined) return;
                    
                    if(section_index == 'pagi'){
                        waktu = [ 8 + spent, 8+spent+classes.jam];
                    }else{
                        waktu = [ 13 + spent, 13+spent+classes.jam];
                    }

                    spent += classes.jam;

                    //process to hh:mm
                    waktu = waktu[0] + ':00 - ' + waktu[1] + ':00';

                    html += '<div class="alert alert-primary" role="alert">' + classes.nama_dosen + '<br>' + classes.nama_kelas + '<br>' + waktu + '<br>' + classes.jam + '</div>';
                })
                //if not last add hr
                if (section_index != 'sore') {
                    html += '<hr>';
                }
            });

            html += '</div></div></div></div>';
            $('#schedule').append(html);
        })

        anim_delay = 100;
        //load every .card with 200ms delay
        $('.card').each(function (i) {
            //skip #card-selection
            if ($(this).attr('id') == 'card-selection') return;
            $(this).delay(anim_delay * i).fadeIn(anim_delay);
        });


    }

    $('#cat-dosen').change(function () {
        load_data();
    });

    $(document).ready(function () {
        //load_data();

        fill_select(global_defaults.server_url + ENDPOINTS.data_dosen, ['#cat-dosen'], field = 'nama');
    });

    $('#tools-refresh').click(function () {
        load_data();
    });
</script>

</html>