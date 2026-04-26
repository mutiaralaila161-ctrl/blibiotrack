<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>blibiotrack</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body{
            font-family: "Segoe UI", sans-serif;
            background:#c3d1f0;
            overflow-x:hidden;
        }

        /* TOPBAR */
        .topbar{
            height:60px;
            background:#ffffff;
            display:flex;
            align-items:center;
            padding:0 15px;
            position:sticky;
            top:0;
            z-index:1000;
            border-bottom:1px solid #ddd;
        }

        /* SIDEBAR */
        .sidebar{
            width:260px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            background:#c3d1f0;
            overflow-y:auto;
            padding:15px;
            transition: all 0.3s ease;
            z-index:1050;
        }

        /* CONTENT */
        .content{
            margin-left:260px;
            padding:20px;
            transition: all 0.3s ease;
            min-height:100vh;
        }

        /* DESKTOP COLLAPSE */
        .sidebar.hide{
            margin-left:-260px;
        }

        .content.full{
            margin-left:0;
        }

        /* MOBILE */
        @media(max-width:768px){
            .sidebar{
                margin-left:-260px;
            }

            .sidebar.show{
                margin-left:0;
            }

            .content{
                margin-left:0;
            }
        }

        /* OVERLAY MOBILE */
        .overlay{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.4);
            display:none;
            z-index:1040;
        }

        .overlay.active{
            display:block;
        }

        /* PROFILE */
        .profile-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 10px auto;
            border: 2px solid #bdd1f1;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <?= $this->include('layouts/menu') ?>
</div>

<!-- OVERLAY MOBILE -->
<div class="overlay" id="overlay"></div>

<!-- TOPBAR -->
<nav class="topbar">
    <button class="btn btn-primary" id="toggleSidebar">
        <i class="bi bi-list"></i>
    </button>

    <span class="ms-2 fw-bold">PERPUSApp</span>
</nav>

<!-- CONTENT WRAPPER (INI PENTING) -->
<main class="content" id="content">
    <?= $this->renderSection('content') ?>
</main>

<!-- JS -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleBtn = document.getElementById('toggleSidebar');
    const overlay = document.getElementById('overlay');

    function openMobile() {
        sidebar.classList.add('show');
        overlay.classList.add('active');
    }

    function closeMobile() {
        sidebar.classList.remove('show');
        overlay.classList.remove('active');
    }

    toggleBtn.addEventListener('click', function () {

        if (window.innerWidth > 768) {
            sidebar.classList.toggle('hide');
            content.classList.toggle('full');
        } else {
            if (sidebar.classList.contains('show')) {
                closeMobile();
            } else {
                openMobile();
            }
        }

    });

    overlay.addEventListener('click', closeMobile);

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
        }
    });

});
</script>

</body>
</html>