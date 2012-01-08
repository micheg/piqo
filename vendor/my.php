<?php
    // i now need max, probably in future min and other
    class ORM_EXT extends ORM
    {
        public static function for_table($table_name)
        {
            parent::_setup_db();
            return new self($table_name);
        }
        public function max($column)
        {
            if(method_exists('ORM', 'max')) return parent::max($column);
            $this->select_expr('MAX('.$column.')', 'maxvalue');
            $result = $this->find_one();
            return ($result !== false && isset($result->maxvalue)) ? (int) $result->maxvalue : 0;
        }
        public function min($column)
        {
            if(method_exists('ORM', 'min')) return parent::min($column);
            $this->select_expr('MIN('.$column.')', 'minvalue');
            $result = $this->find_one();
            return ($result !== false && isset($result->minvalue)) ? (int) $result->minvalue : 0;
        }
    }

    /**
     *
     * MY
     *
     * http://github.com/micheg/piqo
     *
     * A single-class contain utility function used in project
     *
     * Copyright (c) 2012, Michelangelo Giacomelli
     * All rights reserved.
     * 
     * BSD Licensed.
     *
     */
    class MY
    {
        public static function have_http($url)
        {
            return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
        }
        public static function base_encode($val, $base=62, $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        {
            $str = '';
            do
            {
                $i = $val % $base;
                $str = $chars[$i] . $str;
                $val = ($val - $i) / $base;
            } while($val > 0);
            return $str;
        }
        public static function base_decode($str, $base=62, $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        {
            $len = strlen($str);
            $val = 0;
            $arr = array_flip(str_split($chars));
            for($i = 0; $i < $len; ++$i)
            {
                $val += $arr[$str[$i]] * pow($base, $len-$i-1);
            }
            return $val;
        }
    }

?>