<?php

$json = file_get_contents( __DIR__ . '/categories.json');
$categories = json_decode($json);
file_put_contents('type_a.txt', '');

function addCategoryTypeA($categories, $aliasParent = '', $indent = ' ')
{
    foreach ($categories as $category)
    {
        $category->alias = $aliasParent . '/' . $category->alias;
        $str = $indent . $category->name . '  ' . $category->alias;
        file_put_contents('type_a.txt', $str . PHP_EOL, FILE_APPEND);
        if (!empty($category->childrens))
        {
            addCategoryTypeA($category->childrens, $category->alias, $indent . '    ');
        }
    }
}

addCategoryTypeA($categories);
