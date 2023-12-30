<div class="d-flex justify-content-between align-items-center p-2 bg-blue-0 mb-3 fixed-top">
    <div class="d-flex align-items-center">
        <button class="btn btn-outline-light fs-4 p-0 border-0 px-2 nav-toggler" id="nav-side-btn">
            <i class="bi bi-list"></i>
        </button>
        <span class="fs-5 fw-bold text-white ms-2" id="extract-title">
            
        </span>
    </div>
    <div class="d-flex align-items-center d-none">
        <div class="input-group" style="min-width: 30vw;">
            <span class="input-group-text bg-transparent text-white" id="basic-addon1"><i class="bi bi-search me-2"></i> Search</span>
            <input type="text" class="form-control bg-transparent text-white" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="Search here...">
        </div>
    </div>
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <button class="btn btn-outline-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                User <i class="bi bi-person-circle ms-2"></i>
            </button>
            <ul class="dropdown-menu mt-2 p-0" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item fs-5" id="top-logout">
                        <i class="bi bi-power"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#top-logout').click(function () {
            auth_info.clearAuthInfo();
        });

        //extract words in title until | character
        var title = $('title').text();
        var extract = title.split('|')[0].trim();
        animate_text('#extract-title', extract, 20);
    });
</script>