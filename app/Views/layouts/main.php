<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BLIBIOTRACK</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
    /* === GLOBAL === */
    body{
        font-family: "Segoe UI", sans-serif;
        background: linear-gradient(135deg, #c3d1f0, #e6ecff);
        overflow-x:hidden;
    }

    /* === TOPBAR === */
    .topbar{
        height:60px;
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        display:flex;
        align-items:center;
        padding:0 15px;
        position:sticky;
        top:0;
        z-index:1000;
        border-bottom:1px solid rgba(0,0,0,0.05);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* === SIDEBAR === */
    .sidebar{
        width:260px;
        height:100vh;
        position:fixed;
        top:0;
        left:0;
        background: linear-gradient(180deg, #0d6efd, #0b5ed7);
        color:white;
        overflow-y:auto;
        padding:20px 15px;
        transition: all 0.3s ease;
        z-index:1050;
        box-shadow: 4px 0 15px rgba(0,0,0,0.1);
    }

    .sidebar a{
        color: rgba(255,255,255,0.85);
        text-decoration:none;
        display:block;
        padding:10px 12px;
        border-radius:8px;
        margin-bottom:5px;
        transition:0.2s;
    }

    .sidebar a:hover{
        background: rgba(255,255,255,0.15);
        color:#fff;
    }

    /* === CONTENT === */
    .content{
        margin-left:260px;
        padding:25px;
        transition: all 0.3s ease;
        min-height:100vh;
    }

    .content > div{
        background:#ffffff;
        padding:25px;
        border-radius:12px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    }

    /* === TABLE FIX === */
    table{
        width:100%;
        border-collapse: collapse;
    }

    table th{
        background:#0d6efd;
        color:white;
        padding:10px;
    }

    table td{
        padding:10px;
        border-bottom:1px solid #eee;
    }

    table tr:hover{
        background:#f5f8ff;
    }

    /* === FORM === */
    form{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        align-items:center;
    }

    form input, form select{
        padding:7px 10px;
        border-radius:8px;
        border:1px solid #ddd;
    }

    form button{
        background:#198754;
        color:white;
        border:none;
        padding:7px 14px;
        border-radius:8px;
    }

    /* === BUTTON === */
    .btn-primary{
        border-radius:10px;
    }

    /* === PROFILE === */
    .profile-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
        display: block;
        margin: 10px auto;
        border: 3px solid rgba(255,255,255,0.6);
    }

    /* === COLLAPSE === */
    .sidebar.hide{
        margin-left:-260px;
    }

    .content.full{
        margin-left:0;
    }

    /* === MOBILE === */
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

    /* === OVERLAY === */
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

    /* === SCROLLBAR === */
    .sidebar::-webkit-scrollbar{
        width:6px;
    }

    .sidebar::-webkit-scrollbar-thumb{
        background: rgba(255,255,255,0.3);
        border-radius:10px;
    }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <?= $this->include('layouts/menu') ?>
</div>

<!-- OVERLAY -->
<div class="overlay" id="overlay"></div>

<!-- TOPBAR -->
<nav class="topbar">
    <button class="btn btn-primary" id="toggleSidebar">
        <i class="bi bi-list"></i>
    </button>

    <span class="ms-3 fw-bold">
        <i class="bi bi-journal-bookmark-fill me-1"></i> BLIBIOTRACK
    </span>
</nav>

<!-- CONTENT -->
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