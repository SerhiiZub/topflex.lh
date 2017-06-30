<?php
use SebastianBergmann\CodeCoverage\Report\PHP;

/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 21.06.17
 * Time: 12:46
 */
class PrintHelper
{
    public static $options = array();

    /**
     * @param $tag
     * @param $property
     * @return string
     */
    public static function getOption($tag, $property)
    {
        if (!isset(self::$options[$tag][$property])){
            return '';
        }
        $str = self::$options[$tag][$property];
        if (is_array($str) || is_object($str)){
            $string = '';
            foreach ($str as $key => $value){
                $string .= $key . ': ' . $value . '; ';
            }
            $str = trim($string);
        }
        return strval($str);
    }

    /**
     * @param $tag
     * @return string
     */
    public static function getTagOptions($tag)
    {
        $str = '';
        if (empty(self::$options[$tag])){
            return $str;
        }
        foreach (self::$options[$tag] as $key => $property){
           $str .= $key . '="'. self::getOption($tag, $key) . '" ';
        }
        return $str;
    }

    /**
     * @param $tag
     * @param $propertyName
     * @param $value
     */
    public static function setOption($tag, $propertyName, $value)
    {
        self::$options[$tag][$propertyName] = $value;
    }

    public static function setArrayOptions($tag, $options = array())
    {
        foreach ($options as $key => $option){
            PrintHelper::setOption($tag, $key, $option);
        }
    }

    /**
     * @param $array
     * @param bool $keyPrint
     * @param array $options
     * @return string
     */
    public static function list($array, $keyPrint = true, $options = array('ul' => array('class' => '', 'style' => '')))
    {
        if (!empty($options['ul'])){
            self::setArrayOptions('ul', array_diff($options['ul'], array('', NULL)));
        }
        if (!empty($options['li'])){
            self::setArrayOptions('li', array_diff($options['li'], array('', NULL)));
        }

        $str = '<ul ' . self::getTagOptions('ul') . '>'.PHP_EOL;
        foreach ($array as $key => $value){
            $str .= '<li ' . self::getTagOptions('ul') . '>'.PHP_EOL;
            if ($keyPrint) {
                $str .= $key . ': ';
            }
            if (is_array($value) || is_object($value)){
                PrintHelper::list($value);
            } elseif (is_resource($value)){
                $str .= gettype($value);
            } else {
                $str .= $value;
            }

            $str .= '</li>'.PHP_EOL;
        }
        $str .= '</ul>'.PHP_EOL;
        return $str;
    }


    /**
     * @param $msg
     * @param string $href
     * @param array $options
     * @return string
     */
    public static function link($msg, $href = '', $options = array('class' => '', 'style' => ''))
    {
        self::setArrayOptions('a', array_diff($options, array('', NULL)));

        $str = '<a href="'.$href.'" ';
        $str .= self::getTagOptions('a');
        $str .= ">";
        $str .= $msg;
        $str .= '</a>'.PHP_EOL;
        return $str;
    }

    /**
     * @param $file
     * @param $line
     * @return string
     */
    public static function phpStormLink($file, $line)
    {
        $href = "phpstorm://open?file=$file&line=$line";
        $msg = "$file : $line";
        return self::link($msg, $href);
    }
}

/*PrintHelper::setArrayOptions('a',  array('style' => array('text-decoration'=>'none', 'float' => 'right')));

echo PrintHelper::phpStormLink(__FILE__, __LINE__);*/
