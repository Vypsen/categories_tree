<?php
require_once('Category.php');

$json = file_get_contents( __DIR__ . '/categories.json');
$categories = json_decode($json);

function addCategoriesDB($categories, $aliasParent = '', $parentId = 'NULL')
{
    foreach ($categories as $category)
    {
        $category->alias = $aliasParent . '/' . $category->alias;
        $categoryObj = new Category($category, $parentId);
        $categoryObj->save();

        if (!empty($category->childrens))
        {
            addCategoriesDB($category->childrens, $category->alias, $category->id);
        }
    }
}

addCategoriesDB($categories);