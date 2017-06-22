<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 22.06.17
 * Time: 13:36
 */
$path = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'bootstrap-3.3.7-dist'.DIRECTORY_SEPARATOR;
$pathJquery = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        <?php include $path.'css/bootstrap.min.css';?>
        <?php include $path.'css/bootstrap-theme.min.css';?>
    </style>
    <script type="text/javascript">
        <?php include $pathJquery.'jquery/jquery-3.2.1.min.js';?>
        <?php include $path.'js/bootstrap.min.js';?>
    </script>
</head>
<body>
<!-- Вкладки (навигация по панелям) -->
<script type="text/javascript">
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            //Получить название активной вкладки
            var activeTab = $(e.target).text();
            // Получить название предыдущей активной вкладки
            var previousTab = $(e.relatedTarget).text();
            $(".tab-active span").html(activeTab);
            $(".tab-previous span").html(previousTab);
        });
    });
</script>

<div class="container">
    <h2>Modal Example</h2>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                    <ul class="nav nav-tabs" id="myTabEvents">
                        <li class="active"><a class="tabnav" data-toggle="tab" href="#evPanel1">Панель 1</a></li>
                        <li><a class="tabnav" data-toggle="tab" href="#evPanel2">Панель 2</a></li>
                        <li><a class="tabnav" data-toggle="tab" href="#evPanel3">Панель 3</a></li>
                    </ul>
                </div>
                <div class="modal-body">
                    <!-- Панели -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Панель 1 -->
                        <div id="evPanel1" class="tab-pane fade in active">
                            <!-- Содержимое панели 1 -->
                            <h3>Заголовок панели 1</h3>
                            <p>Содержимое панели 1...</p>
                        </div>
                        <!-- Панель 2 -->
                        <div id="evPanel2" class="tab-pane fade">
                            <!-- Содержимое панели 2 -->
                            <h3>Заголовок панели 2</h3>
                            <p>Содержимое панели 2...</p>
                        </div>
                        <!-- Панель 3 -->
                        <div id="evPanel3" class="tab-pane fade">
                            <!-- Содержимое панели 3 -->
                            <h3>Заголовок панели 3</h3>
                            <p>Содержимое панели 3...</p>
                        </div>

<!--                        <hr>-->

                    </div>
                </div>
                <div class="modal-footer">
                    <p class="tab-active"><strong>Активная вкладка</strong>: <span></span></p>
                    <p class="tab-previous"><strong>Предыдущая активная вкладка</strong>: <span></span></p>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
</body>
</html>
