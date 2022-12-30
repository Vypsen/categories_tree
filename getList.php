<?php

require_once('Category.php');

$categories = Category::getCategories();
echo Category::buildTreeCategories($categories);