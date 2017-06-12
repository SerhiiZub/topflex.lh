<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 09.06.17
 * Time: 12:13
 */

function dmp($val){
//    echo '<pre>';
//    echo '<plaintext>';

//    echo '<code style="color: black">';
    echo '<xmp style="size: 8px">';
    var_dump($val);
    echo '</xmp>';
//    echo '</code>';

//    echo '</plaintext>';
//    echo '<pre>';
}
?>

<!--<html>-->
<style>
    .dump-content{

        opacity: 1;
    }
    .dump-panel{
        position: fixed;
        bottom: 0;
        left: 0px;
        height: 30px;
        width: 100%;
        background-color: black;
        color: aliceblue;
        opacity: 0.8;
        z-index: 9997;
        padding-top: 4px;
        padding-left: 10px;
    }
    .dump-pre {
        z-index: 9999 !important;
        position: fixed;
        top: 60px; right: 20px; bottom: 40px; left: 20px;
        /*z-index: 9996;*/
        margin: 0;
        background-color: darkgray;
        opacity: 0.9;
        padding: 20px;
        overflow-y: scroll;
        border-radius: 5px;
    }
    .title{

    }

    .dump-container{
        border: solid 1px gray;
        border-radius: 5px;
        padding: 10px;
        background-color: lightgray
    }

    .dump-content{
        display: none;
        cursor: pointer;
    }
</style>


<div id="mydump" style="display:none">
    <div class="dump-pre">
    <h4>Dump info:</h4>
        <?php foreach ($data as $k => $v) : ?>
            <div class="dumpItem">
            <span class="title" style="cursor: pointer">
                    <span class="dump-label"><strong style="font-size: large" >Variable: <?php echo $k;?></strong></span>
                    <a href="phpstorm://open?file=<?php echo $v['path']?>&line=<?php  echo $v['line']?>">
                        <span>path: <?php echo $v['path']?>; Line: <?php  echo $v['line']?></span>
                    </a>
            </span>
            <div class="dump-content" style="display: none;">
                    <?php foreach ($v['value'] as $key => $val) : ?>
                        <br/> <b>Item</b> - <?php echo $key;?>:<br/>
                            <div class="dump-container">
                             <?php dmp($val);?>
                            </div>
                    <?php endforeach;?>
            </div>
            </div>
            <hr>
        <?php endforeach;?>
    </div>
</div>

<div class="dump-panel" onclick="openbox(mydump);" >
    <span>Dump info: count - <?php echo count($this->objects);?> </span>
</div>
<!--</html>-->
<script>
    function openbox(id){
        var display = id.style.display;
        if(display=='none'){
            id.style.display='flex';
        }else{
            id.style.display='none';
        }
    }

    var $_mydump = document.getElementById('mydump');

    $_mydump.querySelectorAll(".dumpItem").forEach(function(element, index, array) {
        element.getElementsByClassName('title')[0].onclick = function () {
            var content = element.getElementsByClassName('dump-content');
            if (content[0].style.display === 'none') {
                content[0].style.display = 'block';
            } else {
                content[0].style.display = 'none';
            }
        };
    });
</script>
