<?php


final class Dump {
    static private $instance = null;

    private $objects = array();
    private $view = true;
    private $cookie = true;
    private $cookieTime = 3600;
    private static $session = false;

/*    private function errorHendler(){
        set_error_handler('err_handler');
        function err_handler($errno, $errmsg, $filename, $linenum) {
            $date = date('Y-m-d H:i:s (T)');
            $f = fopen('errors.txt', 'a');
            if (!empty($f)) {
                $filename  =str_replace($_SERVER['DOCUMENT_ROOT'],'',$filename);
                $err  = "$errmsg = $filename = $linenum\r\n";
                fwrite($f, $err);
                fclose($f);
            }
        }
    }*/

    private function __construct() {}

    public function __destruct() {
//var_dump($this);
        if ($this->view !== true) return;
        if($this->cookie === true) {
//           $this->setCookie();
        }
//        $this->setLog();
//        $this->setSession();
//        echo '<hr>';
//        echo 'hello';
//                die('tut');
        if(static::$session){
            var_dump($_SESSION['debug']);
            unset($_SESSION['debug']);
            static::$session = false;

        }
        echo $this->printDump();


    }

    private function getLog(){
        if (!file_exists(dirname(__FILE__).'/log.txt')){
            return null;
        }
        return unserialize(file_get_contents(dirname(__FILE__).'/log.txt'));
    }

    private function setLog(){

        if (!file_exists(dirname(__FILE__).'/log.txt')){
            $fp = fopen(dirname(__FILE__).'/log.txt', 'a+');
            fclose($fp);
            chmod(dirname(__FILE__).'/log.txt', 0777);
        }

        $data = unserialize(file_get_contents(dirname(__FILE__).'/log.txt'));
        $data[time()] = $this->objects;
        file_put_contents(dirname(__FILE__).'/log.txt', serialize($data));

    }

    private function setCookie(){
        $data = !empty($_COOKIE["DumpCookie"])?$_COOKIE["DumpCookie"]:array();
        setcookie("DumpCookie", json_encode(array_push($data, $this->objects)), time()+$this->cookieTime);
    }

    private function getSession(){
        if (!session_id()){
            session_start();
        }
        return !empty($_SESSION['DumpSession']) ? array_map(function ($str){return unserialize($str);},$_SESSION['DumpSession']):null;
    }

    private function setSession(){
        if (!session_id('dump')){
            session_start('dump');
        }
//        $data[] = $_SESSION['DumpSession'];
        $data[time()] = serialize($this->objects);
        $_SESSION['DumpSession']=$data;
//        $_SESSION['DumpSession'][time()] = serialize(json_decode(json_encode($this->objects)));
    }

    private function getCookie(){
        return !empty($_COOKIE["DumpCookie"])? $_COOKIE["DumpCookie"] : null;
    }

    /**
     * @param $obj
     * @param null $name : string
     */
    static public function out($obj, $name = null, $stop = false, $session = false) {

        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        if (self::$instance == null) {
            self::$instance = new self();
        }


        $info = debug_backtrace();
        $key = 'Var-'.count(self::$instance->objects);

        if($name !== null && is_string($name)){

            if (isset(self::$instance->objects[$name])){
                self::$instance->objects[$name]['value'][] = $obj;
            } else {
                self::$instance->objects[$name]['value'][] = $obj;
                self::$instance->objects[$name]['path'] = $info[0]['file'];
                self::$instance->objects[$name]['line'] = $info[0]['line'];
                self::$instance->objects[$name]['trace'] = $info;
            }

        } else {
            self::$instance->objects[$key]['value'][] = $obj;
            self::$instance->objects[$key]['path'] = $info[0]['file'];
            self::$instance->objects[$key]['line'] = $info[0]['line'];
//            unset($info[0]);
            self::$instance->objects[$name]['trace'] = $info;
        }

        if ($stop !== false){
//            $this->
            exit();
        }

        if($session != false){

//            $_SESSION['debug'] = var_export($obj, 1);
//            static::$session = true;

        }
//        self::setLog();

    }

    /**
     * @param boolean $view
     */
    static public function setView($view){
        if (self::$instance == null) {
            self::$instance = new self();
        }
        self::$instance->view = $view;
    }

    static public function useCookie($cookie){
        if (self::$instance == null) {
            self::$instance = new self();
        }
        self::$instance->cookie = $cookie;
    }

    private function printDump(){
        ob_start();
        $data = $this->objects;
        include('index.php');
        return ob_get_clean();
       /* echo '<style>
                .mydump pre, p,
                .mydump [type="checkbox"]{
                    display: none;
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

                
        </style>';
        echo '<div id="mydump" style="display:none">';
        echo '<pre style="
            position: fixed;
            top: 20px; right: 20px; bottom: 40px; left: 20px;
            z-index: 9998;
            margin: 0;            
            background-color: darkgray;
            opacity: 0.9;
            padding: 20px;
            overflow-y: scroll;
            border-radius: 5px;
        ">';

        echo '<h3>Dump info:</h3>';
        foreach ($this->objects as $k => $v){

            echo '<div class="mydump">';
            echo '<label for="mydump-'.$k.'">';
            echo '<strong style="font-size: large" onclick="console.log(12345)">Variable: '.$k.'</strong>; path: '.$v['path'].'; Line: ' . $v['line'].';';
            echo '<label>';
            echo '<input type="checkbox" id="mydump-'.$k.'">';
            echo '<p class="dump-content" onclick="showDumpInfo();>';

            foreach ($v['value'] as $key => $val){
                echo '<br> <b>Item</b> - '.$key.':<br>';
                echo '<p style="border: solid 1px gray; border-radius: 5px; padding: 10px; background-color: lightgray" onclick="console.log(123)">';

                var_dump( $val);
                var_dump( $this->getLog());
//                var_dump( $this->getSession());
//                var_export( $this->getSession());
//                var_export( $val);
//                print_r( $val);
                echo '</p>';
            }

            echo '</p>';
            echo '</div>';
            echo '<hr>';
        }
        echo '</pre>';
        echo '</div>';
        echo '<div class="dump-panel" onclick="openbox(mydump);" >
                <span>Dump info: count - '.count($this->objects).' </span> 
                            <span>cookie: '.count($this->getCookie()).' </span> 
                            <span>session: '.count($this->getSession()).' </span>
                            <span>log: '.count($this->getLog()).'</span>
            </div>';
        echo "
        <script type='text/javascript'>
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
        function printLog(data) {
//            var data = 
          var myWindow = window.open(\"\", \"MsgWindow\", \"width=600,height=600\");
              myWindow.document.write(JSON.parse(data));
        }
        </script>";*/

    }

    private function printLogs($log){
        return json_encode($this->getLog());
//       return var_dump($this->getLog());
    }

}