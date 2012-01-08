<?php
// Microframeworks: slim & underscore
// note this is my generic app template
// not sure using underscore in this project
require_once '../vendor/Slim/Slim.php';
require_once '../vendor/underscore.php';
require_once '../vendor/idiorm.php';

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
// custom setting
$app = new Slim(array(
    'log.enable' => true,
    'log.path' => './log',
    'log.level' => 4,
    'templates.path' => './app/views',
    'connection.string' => 'sqlite:./data/url.sqlite',
    'service.name' => $_SERVER['SERVER_NAME'] . '/',
));

// application routes
require './app/routes/urls.php';

// run app!
$app->run();