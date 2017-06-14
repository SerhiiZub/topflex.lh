<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 09.06.17
 * Time: 12:13
 */

function dmp($val){
    echo '<pre>';
//    echo '<plaintext>';

    echo '<code style="color: black">';
    echo '<xmp style="size: 8px">';
    var_dump($val);
    echo '</xmp>';
    echo '</code>';

//    echo '</plaintext>';
    echo '<pre>';
}

function trace($arr){
    $k = 0;
    $str = '';
    foreach ($arr as $value){
        $arg = '';
        if(!empty($value['args']) && $value['args'] != null){

            for ($i=0; $i < count($value['args']); $i++){
                $arg .= gettype($value['args'][$i]);
                if($i < count($value['args'])-1){
                    $arg .=' ,';
                }
            }
        }


        $str .= '#'.$k++.' - ';
        $str .= !empty($value['class']) ? ucfirst($value['class']) : '';
        $str .= !empty($value['type']) ? $value['type'] : '';
        $str .= !empty($value['function']) ? $value['function']."($arg) : " : "";
        $str .= !empty($value['file']) && !empty($value['line']) ? phpstormLink($value['file'], $value['line']) : '';
        $str .= "<br>";
    }
    return $str;
}

function phpstormLink($file, $line){
    $href = "phpstorm://open?file=$file&line=$line";
    return "<a href='$href' style='text-decoration: none; float: right'>$file : $line</a>";
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
    .path{
        float: right;
    }
</style>


<div id="mydump" style="display:none">
    <div class="dump-pre">
    <h4>Dump info:</h4>
        <?php foreach ($data as $k => $v) : ?>
            <div class="dumpItem">
            <span class="title" style="cursor: pointer">
                    <span class="dump-label"><strong style="font-size: large" ><?php echo gettype($v['value'][0])?>: <?php echo $k;?></strong></span>
                    <a href="phpstorm://open?file=<?php echo $v['path']?>&line=<?php  echo $v['line']?>">
                        <span class="path"><?php echo $v['path']?>  : <?php  echo $v['line']?></span>
                    </a>
            </span>
            <div class="dump-content" style="display: none;">
                    <?php foreach ($v['value'] as $key => $val) : ?>
                        <br/> <b>Item</b> - <?php echo $key;?>:<br/>
                            <div class="dump-container">
                                <?php echo trace($v['trace'])?>
                             <?php dmp($val);?>
                            </div>
                    <?php endforeach;?>
            </div>
            </div>
            <hr>
        <?php endforeach;?>
        <?php
//        session_start();
//        if(isset($_SESSION['debug'])){
//            dmp($_SESSION['debug']);
//            $_SESSION['debug'] = '';
//            unset($_SESSION['debug']);
//            echo '<hr>';
////            dmp($_SESSION['debug']);
//        }

        ?>
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
