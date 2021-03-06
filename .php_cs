<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src');

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'binary_operator_spaces' => [
            'default' => 'align_single_space_minimal',
        ],
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'class_attributes_separation' => ['elements' => ['const', 'method', 'property']],
    ))
    ->setCacheFile(__DIR__.'/vendor/.php_cs.cache')
    ->setFinder($finder)
;
