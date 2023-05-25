<?php
include 'lib/session.php';
Session::init();
?>
<?php
include 'lib/database.php';
include 'helper/format.php';

spl_autoload_register(function ($classname) {
    include_once "classes/" . $classname . ".php";
});
$menu = new menu();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveling</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@1,500&display=swap');
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md bg-dark navbar-transparent">

            <div class="logo navbar-brand">
                <h2>Following <span>Filmore</span>
                    <p>Traveling Toles of
                        <br>a Huntle KV
                    </p>
                </h2>
            </div>

            <button style="color: 000;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <div class="menu">
                    <ul id="menu">
                        <?php
                        $menu_list = $menu->menu_show();
                        $i = 0;
                        if ($menu_list) {
                            while ($result = $menu_list->fetch_assoc()) {
                                if ($result['menuType'] == 0) {
                        ?>
                                    <a href="#">
                                        <li <?php if ($i == 0) echo 'class="active"' ?>><?php echo $result['menuName'] ?></li>
                                    </a>
                        <?php
                                }
                                $i++;
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>