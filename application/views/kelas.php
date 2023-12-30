<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Kelas | <?= APPTITLE ?></title>

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
    <div class="modal fade" id="modal-help" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-help-label">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
                <div class="col-md-9 mb-3" id="mainbar">
                    <div class="vstack gap-3">
                        <div class="card shadow border-top-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title"><i class="bi bi-tools"></i> Toolbar</h5>
                                    <div class="hstack gap-2">
                                        <button class="btn btn-primary btn-sm" id="tools-refresh">
                                            <i class="bi bi-arrow-clockwise"></i> Refresh
                                        </button>
                                        <button class="btn btn-success btn-sm" id="tools-export">
                                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                                        </button>
                                        <button class="btn btn-dark btn-sm" id="tools-sidebar">
                                            <i class="bi bi-box-arrow-in-up-left"></i> Sidebar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow border-top-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title"><i class="bi bi-table"></i> Data Table</h5>
                                </div>
                                <div id="loader-container">
                                    <div class="d-flex flex-column justify-content-between align-items-center p-2">
                                        <div class="spinner-border" role="status" id="loader-spinner">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div class="p-2 py-1 fs-5" id="loader-message">
                                            Loading
                                        </div>
                                    </div>
                                </div>
                                <div id="error-container">
                                    <div class="d-flex flex-column justify-content-between align-items-center p-2 font-monospace">
                                        <h5 class="card-title text-danger"><i class="bi bi-x-circle"></i> Error</h5>
                                        <div class="p-2 py-0 fs-4" id="error-message">
                                            Loading
                                        </div>
                                    </div>
                                </div>


                                <div id="data-table">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="scroll-stopper">

                    </div>
                </div>
                <div class="col-md-3 mb-3" id="sidebar">
                    <div id="scroll-spacer">

                    </div>
                    <div class="vstack gap-3">
                        <div class="card shadow border-top-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title"><i class="bi bi-input-cursor-text"></i> New</h5>
                                    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modal-help">
                                        <i class="bi bi-question-circle"></i> Bantuan
                                    </button>
                                </div>
                                <div class="vstack gap-2">
                                    <!-- both update and insert got the same inputs, except insert doesn't have id -->
                                    <div>
                                        <label for="create-nama" class="form-label">Nama</label>
                                        <label for="create-nama" class="form-counter float-end"></label>
                                        <input type="text" class="form-control" id="create-nama" maxlength="64">
                                    </div>
                                    <div>
                                        <label for="create-ruang" class="form-label">Ruang</label>
                                        <label for="create-ruang" class="form-counter float-end"></label>
                                        <select class="form-select" id="create-ruang">

                                        </select>
                                    </div>
                                    <div>
                                        <label for="create-jam" class="form-label">Jam</label>
                                        <label for="create-jam" class="form-counter float-end"></label>
                                        <input type="text" class="form-control" id="create-jam" maxlength="2">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary btn-sm" id="create-submit">
                                            <i class="bi bi-check2"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow border-top-info" id="card-selection" style="display: none;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title"><i class="bi bi-check2-square"></i> Selection Properties</h5>
                                    <button class="btn btn-outline-danger btn-sm" onclick="toggleSelection()">
                                        <i class="bi bi-x-lg"></i> Close
                                    </button>
                                </div>
                                <div class="vstack gap-2">
                                <div>
                                        <label for="update-id" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="update-id" readonly>
                                    </div>
                                    <div>
                                        <label for="update-nama" class="form-label">Nama</label>
                                        <label for="update-nama" class="form-counter float-end"></label>
                                        <input type="text" class="form-control" id="update-nama" maxlength="64">
                                    </div>
                                    <div>
                                        <label for="update-ruang" class="form-label">Ruang</label>
                                        <label for="update-ruang" class="form-counter float-end"></label>
                                        <select class="form-select" id="update-ruang">

                                        </select>
                                    </div>
                                    <div>
                                        <label for="update-jam" class="form-label">Jam</label>
                                        <label for="update-jam" class="form-counter float-end"></label>
                                        <input type="text" class="form-control" id="update-jam" maxlength="2">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary btn-sm" id="update-submit">
                                            <i class="bi bi-check2"></i> Submit
                                        </button>
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
        'update': 'api/v1/kelas/update',
        'create': 'api/v1/kelas/create',
        'delete': 'api/v1/kelas/delete',
        'load': 'api/v1/kelas/get',
        'ruang': 'api/v1/ruang/get',
    }
    local_ruang = {};

    function toggleSelection(id = null) {
        //if id is null, hide the card
        if (id == null) {

            $('#card-selection').fadeOut(anim_delay, function () {
                //clear all data
                $.each($('#card-selection input, #card-selection textarea'), function (i, e) {
                    $(e).val('');
                });
            });
            return;
        }
        $('#card-selection').fadeIn(anim_delay);

        //fill data from table
        var row = table.getRow(id);
        $('#update-id').val(id);
        $('#update-nama').val(row.getData().nama);
        $('#update-ruang').val(row.getData().ruang);
        $('#update-jam').val(row.getData().jam);

    }

    $('#update-submit').click(function () {
        //get data from form
        data = {
            id: $('#update-id').val(),
            nama: $('#update-nama').val(),
            ruang: $('#update-ruang').val(),
            jam: $('#update-jam').val(),
        }

        $.ajax({
            url: global_defaults.server_url + ENDPOINTS.update,
            type: 'POST',
            data: data,
            success: function (data) {
                load_data();
                //hide card
                toggleSelection();
            }
        });
    });

    $('#create-submit').click(function () {
        data = {
            nama: $('#create-nama').val(),
            ruang: $('#create-ruang').val(),
            jam: $('#create-jam').val(),
        }

        break_flag = false;
        $.each(data, function (i, e) {
            if (e == '') {
                break_flag = true;
            }
        });

        if (break_flag) {
            alert('Mohon isi semua data', 'danger');
            return;
        }

        $.ajax({
            url: global_defaults.server_url + ENDPOINTS.create,
            type: 'POST',
            data: data,
            success: function (data) {
                //refresh table
                load_data();
            }
        });
    });

    function deleteItem(id) {
        //confirm delete
        if (!confirm('Apakah anda yakin ingin menghapus data ini?')) return;

        $.ajax({
            url: global_defaults.server_url + ENDPOINTS.delete,
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (data) {
                //delete row
                table.deleteRow(id);

                bin('Data deleted', 'success');
            },
            error: function (data) {
                //alert response code and message
                alert(data.status + ' ' + data.responseJSON.message, 'danger');

                bin('Data failed to delete', 'danger');
            }
        });
    }

    var table = new Tabulator("#data-table", {
        layout: "fitColumns",      //fit columns to width of table
        responsiveLayout: "hide",  //hide columns that dont fit on the table
        addRowPos: "top",          //when adding a new row, add it to the top of the table
        history: true,             //allow undo and redo actions on the table
        pagination: "local",       //paginate the data
        paginationSize: 16,         //allow 7 rows per page of data
        paginationCounter: "rows", //display count of paginated rows in footer
        movableColumns: true,      //allow column order to be changed
        columnDefaults: {
            tooltip: true,         //show tool tips on cells
        },
        columns: [
            { title: "No", field: "no", width: 80 },
            { title: "Nama", field: "nama"},
            { title: "Ruang", field: "ruang", visible: false},
            { title: "Ruang Name", field: "ruang_name", width:200},
            { title: "Jam", field: "jam", width:200},
            //hidden created
            { title: "Action", field: "action", width: 100, formatter: "html", tooltip: false , download: false},
        ],
    });

    function load_data() {
        //hide table and error
        $('#error-container').hide();
        $('#data-table').hide();
        //show loading
        $('#loader-container').show();

        $.ajax({
            url: global_defaults.server_url + ENDPOINTS.load,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                //hide loading
                $('#loader-container').fadeOut(anim_delay, function () {
                    data = data.data;

                    //add number
                    $.each(data, function (i, v) {
                        data[i].no = i + 1;
                        data[i].ruang_name = local_ruang[data[i].ruang];
                    });

                    table.setData(data);

                    //add action buttons
                    $.each(data, function (i, v) {
                        var id = data[i].id;
                        var action = '<div class="d-flex justify-content-between align-items-center">';
                        action += '<button class="btn btn-sm btn-outline-primary" onclick="toggleSelection(`' + id + '`)"><i class="bi bi-pencil"></i></button>';
                        action += '<button class="btn btn-sm btn-outline-danger" onclick="deleteItem(`' + id + '`)"><i class="bi bi-trash"></i></button>';
                        action += '</div>';
                        data[i].action = action;
                    });

                    //show table
                    $('#data-table').fadeIn();
                    bin('Data loaded successfully', 'success');
                });

                
            },
            error: function (xhr, status, error) {
                //hide loading
                $('#loader-container').hide();

                //show error
                $('#error-container').show();

                //set error message, code and status
                //example: 404 - Not Found
                $('#error-message').text(xhr.status + ' - ' + xhr.statusText);

                bin('Error loading data', 'danger');
            }
        });
    }

    $(document).ready(function () {
        load_data();

        //get ruang
        $.ajax({
            url: global_defaults.server_url + ENDPOINTS.ruang,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                //clear select
                $('#create-ruang').html('');
                $('#update-ruang').html('');

                //add options
                $.each(data.data, function (i, e) {
                    $('#create-ruang').append('<option value="' + e.id + '">' + e.nama + '</option>');
                    $('#update-ruang').append('<option value="' + e.id + '">' + e.nama + '</option>');

                    //add to local
                    local_ruang[e.id] = e.nama;
                });
            }
        });
    });

    $('#tools-refresh').click(function () {
        load_data();
    });

    //on tool export button click print table data
    $("#tools-export").click(function () {
        //filename is $extract-title-$date
        //date is in iso format
        var date = new Date();
        var raw_title = $('#extract-title').text();
        //remove characters after | then trim spaces
        var title = raw_title.split('|')[0].trim();
        var filename = title + '-' + date.toISOString().split('T')[0];
        table.download("xlsx", filename + ".xlsx");
    });
</script>

</html>