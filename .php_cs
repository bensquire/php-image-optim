<?php
# php-cs-fixer fix . --allow-risky=yes -vvv

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in([__DIR__ . '/src', __DIR__ . '/tests']);

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP71Migration:risky' => true,
        '@PHP71Migration' => true,

        '@PSR2' => true,
        'psr4' => true,

        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'operators' => [
                '=' => 'single_space',
            ]
        ],
        'cast_spaces' => true,
        'class_attributes_separation' => [
            'elements' => ['method', 'property']
        ],
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => true,
        'logical_operators' => true,
        'lowercase_cast' => true,
        'modernize_types_casting' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_statement' => true,
        'no_leading_import_slash' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_whitespace_in_blank_line' => true,
        'ordered_imports'=> [
            'imports_order' =>  null,
            'sort_algorithm' => 'alpha'
        ],
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_indent' => true,
        'phpdoc_order' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'return_type_declaration' => true,
        'single_line_after_imports' => true,
        'single_quote' => true,
        'strict_comparison' => true,
        'trailing_comma_in_multiline_array' => true,
        'unary_operator_spaces' => true,
        'yoda_style' => ['always_move_variable' => true],

        'php_unit_construct' => true,
        'php_unit_set_up_tear_down_visibility' => true,
        'php_unit_dedicate_assert' => true,
        'php_unit_method_casing' => true,
        'php_unit_mock_short_will_return' => true,
    ])
    ->setFinder($finder);