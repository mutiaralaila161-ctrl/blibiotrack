<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> PERPUSApp </title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            overflow-x: auto;
        }

        .sidebar {
            width: 150px;
            background-color: rgb(243, 236, 200);
            position: relative;
        }

        .content {
            flex-grow: 1;
            padding: 15px;
            background-color: #fceff5;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">

        <?= $this->include('layouts/menu') ?>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Bootstrap JS Lokal -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>