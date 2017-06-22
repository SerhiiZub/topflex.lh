<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 09.06.17
 * Time: 12:13
 */
?>
<html>
<style>
    .mydump pre, p,
    .mydump [type="checkbox"]{
        /*display: none;*/
    }

    .mydump [type="checkbox"]:checked ~ pre{
        display: block;
    }
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
        z-index: 9999;
        padding-top: 4px;
        padding-left: 10px;
    }
    .dump-pre {
        position: fixed;
        top: 20px; right: 20px; bottom: 40px; left: 20px;
        z-index: 9998;
        margin: 0;
        background-color: darkgray;
        opacity: 0.9;
        padding: 20px;
        overflow-y: scroll;
        border-radius: 5px;
    }
</style>
<script>
    function openbox(id){
        var display = id.style.display;
        if(display=='none'){
            id.style.display='block';
        }else{
            id.style.display='none';
        }
    }

    function showDumpInfo() {
        console.log(this);
    }
/*    function printLog(data) {
//            var data =
        var myWindow = window.open("", "MsgWindow", "width=600,height=600");
        myWindow.document.write(JSON.parse(data));
    }*/
</script>

<div id="mydump" style="display:none">
    <pre class="dump-pre">
    <h3>Dump info:</h3>
        <?php foreach ($data as $k => $v) : ?>
            <div class="mydump">
                <label for="mydump-<?php echo $k;?>" onclick="console.log(this)">
                    <strong style="font-size: large" >Variable: <?php echo $k;?></strong>
                </label>
                <input type="checkbox" id="mydump-<?php echo $k;?>">
                <p class="dump-content" onclick="showDumpInfo();">
                    <?php foreach ($v['value'] as $key => $val) : ?>
                        <br> <b>Item</b> - <?php echo $key;?>:<br>
                        <p style="border: solid 1px gray; border-radius: 5px; padding: 10px; background-color: lightgray" onclick="console.log(123)">
                            <?php var_dump( $val);?>
                        </p>
                    <?php endforeach;?>
                </p>
            </div>
            <hr>
        <?php endforeach;?>
    </pre>
</div>

<div class="dump-panel" onclick="openbox(mydump);" >
    <span>Dump info: count - <?php echo count($this->objects);?> </span>
<!--    <span>cookie: '.count($this->getCookie()).' </span>-->
<!--    <span>session: '.count($this->getSession()).' </span>-->
<!--    <span>log: '.count($this->getLog()).'</span>-->
</div>
</html>