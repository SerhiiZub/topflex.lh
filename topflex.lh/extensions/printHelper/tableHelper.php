<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 21.06.17
 * Time: 17:18
 */




class tableHelper extends PrintHelper
{
    private $columnName;
    private $columnValue;
    private $thead = array();
    private $data = array();
    private $htmlOptions = array();

    public function setHead($thead){
        if (is_array($thead)){
            $this->thead = $thead;
        } elseif (is_object($thead)) {
            foreach ($thead as $key => $value){
                $this->thead[$key] = $value;
            }
        } else {
            $this->thead[] = $thead;
        }
        return $this->thead;
    }

    public function setData($data){
        if (is_array($data)){
            $this->data = $data;
        } elseif (is_object($data)) {
            foreach ($data as $key => $value){
                $this->data[$key] = $value;
            }
        } else {
            $this->data[] = $data;
        }
        return $this->data;
    }

    /**
     * @param $array
     * @param $htmlOptions
     * @return string
     */

    public function thead($array, $htmlOptions)
    {
        foreach ($htmlOptions as $tag => $options){
            self::setArrayOptions($tag, array_diff($htmlOptions[$tag], array('', NULL)));
        }

        $str = '<thead '.self::getTagOptions('thead').'>' . PHP_EOL;
        $str .= '<tr '.self::getTagOptions('tr').'>' . PHP_EOL;
        foreach ($array as $column){
            $str .= '<th'.self::getTagOptions('th').'>';
            $str .= $column;
            $str .= '</th>';
        }
        $str .= '</tr>' . PHP_EOL;
        $str .= '<thead>' . PHP_EOL;

        return $str;
    }

    public function tbody($array, $htmlOptions)
    {
        foreach ($htmlOptions as $tag => $options){
            self::setArrayOptions($tag, array_diff($htmlOptions[$tag], array('', NULL)));
        }

        $str = '<tbody '.self::getTagOptions('tbody').'>' . PHP_EOL;

        foreach ($array as $row){
            $str .= '<tr '.self::getTagOptions('tr').'>' . PHP_EOL;
            foreach ($row as $col){
                $str .= '<td'.self::getTagOptions('td').'>';
                $str .= $col;
                $str .= '</td>' . PHP_EOL;
            }

            $str .= '</tr>' . PHP_EOL;
        }

        $str .= '<tbody>' . PHP_EOL;

        return $str;
    }

/*    public static function table($array, $htmlOptions)
    {
        foreach ($htmlOptions as $tag => $options){
            self::setArrayOptions($tag, array_diff($htmlOptions[$tag], array('', NULL)));
        }

        $str = '<table '.self::getTagOptions('table').'>' . PHP_EOL;
        $str .= '<thead '.self::getTagOptions('thead').'>' . PHP_EOL;
        $str .= '<tr '.self::getTagOptions('tr').'>' . PHP_EOL;
        $str .= '</tr>' . PHP_EOL;
        $str .= '<tbody '.self::getTagOptions('table').'>'. PHP_EOL;
        $str .= '<tr '.self::getTagOptions('tr').'>' . PHP_EOL;
        $str .= '</tr>' . PHP_EOL;
        $str .= '</tbody>'. PHP_EOL;
        $str .= '</table>' . PHP_EOL;
        return $str;
    }*/
}