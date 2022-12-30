<?php

require_once('Database/Database.php');


class Category
{
    private static Database $db;
    private $id, $name, $parent_id;
    public $alias;
    private $tableName = 'categories';
    public function __construct($category, $parent_id)
    {
        $this->id = $category->id;
        $this->name = $category->name;
        $this->alias = $category->alias;
        $this->parent_id = $parent_id;

        $this->openConnection();
    }

    static private function openConnection(): void
    {
        self::$db = new Database();
    }

    public function save(): void
    {
        $sql = "INSERT INTO  " . $this->tableName . '(id, name, alias, parent_id )' .
            " VALUES  ('{$this->id}', '{$this->name}', '{$this->alias}', {$this->parent_id})";

        self::$db->sendSql($sql);
    }

    static function getCategories()
    {
        self::openConnection();

        $sql = "SELECT * FROM  categories";
        $query = self::$db->sendSql($sql);
        $data = pg_fetch_all($query);

        return $data;
    }

    static function getParentsTree($categories)
    {
        $categoryIdParent = array();
        foreach ($categories as $category){
            if (!$category['parent_id'])
            {
                $category['parent_id'] = "0";
            }
            $categoryIdParent[$category['parent_id']][$category['id']] = $category;
        }
        return $categoryIdParent;
    }

    static public function buildTreeCategories($categories)
    {
        $build = function($categoryIdParent, $parent_id = 0) use (&$build){
            if(!empty($categoryIdParent) && isset($categoryIdParent[$parent_id])){
                $tree = '<ul>';
                foreach($categoryIdParent[$parent_id] as $cat){
                    $tree .= '<li >'.$cat['name'] . " " . $cat['alias'];
                    $tree .=  $build($categoryIdParent, $cat['id']);
                    $tree .= '</li>';
                }
                $tree .= '</ul>';
            }
            else return null;

            return $tree;
        };

        $categoryIdParent = self::getParentsTree($categories);

        return $build($categoryIdParent);
    }
}