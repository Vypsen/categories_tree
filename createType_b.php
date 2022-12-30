<?php

$json = file_get_contents( __DIR__ . '/categories.json');
$categories = json_decode($json);
file_put_contents('type_b.txt', '');

function addCategoryTypeB($categories, $depth, $indent = ' ')
{
    if ($depth == 0){
        return;
    }
    foreach ($categories as $category)
    {
        $str = $indent . $category->name;
        file_put_contents('type_b.txt', $str . PHP_EOL, FILE_APPEND);
        if (!empty($category->childrens))
        {
            addCategoryTypeB($category->childrens, $depth - 1, $indent . '    ');
        }
    }
}

$depth = 2;
addCategoryTypeB($categories, $depth);
