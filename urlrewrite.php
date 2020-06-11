<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/products_i_services/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/products_i_services/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/materials/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/materials/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/proekti/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/proekti/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/articles/index.php',
    'SORT' => 100,
  ),
);
