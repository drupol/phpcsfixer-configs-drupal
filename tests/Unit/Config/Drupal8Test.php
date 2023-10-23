<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Config;

use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineAfterStartOfClass;
use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineBeforeEndOfClass;
use drupol\PhpCsFixerConfigsDrupal\Fixer\InlineCommentSpacerFixer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Config\Drupal8
 */
final class Drupal8Test extends TestCase
{
    public function testConfigDefault(): void
    {
        $config = new \drupol\PhpCsFixerConfigsDrupal\Config\Drupal8();

        self::assertSame('.php-cs-fixer.cache', $config->getCacheFile());
        $fixers = $config->getCustomFixers();
        self::assertCount(3, $fixers);
        self::assertInstanceOf(BlankLineAfterStartOfClass::class, $fixers[0]);
        self::assertInstanceOf(BlankLineBeforeEndOfClass::class, $fixers[1]);
        self::assertInstanceOf(InlineCommentSpacerFixer::class, $fixers[2]);

        self::assertSame('txt', $config->getFormat());
        self::assertFalse($config->getHideProgress());
        self::assertSame('  ', $config->getIndent());
        self::assertSame("\n", $config->getLineEnding());
        self::assertSame('drupal8', $config->getName());
        self::assertNull($config->getPhpExecutable());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame([
            '@PSR12' => true,
            '@PSR12:risky' => true,
            '@PSR2' => false,
            '@PhpCsFixer' => true,
            'Drupal/blank_line_after_start_of_class' => true,
            'Drupal/blank_line_before_end_of_class' => true,
            'Drupal/inline_comment_spacer' => true,
            'align_multiline_comment' => [
                'comment_type' => 'all_multiline',
            ],
            'array_indentation' => true,
            'array_push' => true,
            'array_syntax' => [
                'syntax' => 'short',
            ],
            'backtick_to_shell_exec' => true,
            'binary_operator_spaces' => true,
            'blank_line_before_statement' => [
                'statements' => [
                    0 => 'break',
                    1 => 'case',
                    2 => 'continue',
                    3 => 'declare',
                    4 => 'default',
                    5 => 'do',
                    6 => 'exit',
                    7 => 'for',
                    8 => 'foreach',
                    9 => 'goto',
                    10 => 'if',
                    11 => 'include',
                    12 => 'include_once',
                    13 => 'require',
                    14 => 'require_once',
                    15 => 'return',
                    16 => 'switch',
                    17 => 'throw',
                    18 => 'try',
                    19 => 'while',
                    20 => 'yield',
                ],
            ],
            'blank_lines_before_namespace' => false,
            'braces_position' => [
                'allow_single_line_anonymous_functions' => true,
                'allow_single_line_empty_anonymous_classes' => true,
                'classes_opening_brace' => 'same_line',
                'control_structures_opening_brace' => 'same_line',
                'functions_opening_brace' => 'same_line',
            ],
            'cast_spaces' => [
                'space' => 'single',
            ],
            'class_attributes_separation' => true,
            'class_definition' => [
                'multi_line_extends_each_single_line' => true,
            ],
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'combine_nested_dirname' => false,
            'comment_to_phpdoc' => false,
            'compact_nullable_type_declaration' => true,
            'concat_space' => [
                'spacing' => 'one',
            ],
            'constant_case' => [
                'case' => 'upper',
            ],
            'control_structure_braces' => true,
            'control_structure_continuation_position' => [
                'position' => 'next_line',
            ],
            'date_time_immutable' => false,
            'declare_equal_normalize' => [
                'space' => 'single',
            ],
            'declare_parentheses' => true,
            'declare_strict_types' => false,
            'dir_constant' => true,
            'doctrine_annotation_array_assignment' => [
                'operator' => ':',
            ],
            'doctrine_annotation_braces' => [
                'syntax' => 'without_braces',
            ],
            'doctrine_annotation_indentation' => true,
            'doctrine_annotation_spaces' => [
                'after_argument_assignments' => false,
                'after_array_assignments_colon' => true,
                'after_array_assignments_equals' => false,
                'around_parentheses' => true,
                'before_argument_assignments' => false,
                'before_array_assignments_colon' => false,
                'before_array_assignments_equals' => false,
            ],
            'echo_tag_syntax' => [
                'format' => 'long',
            ],
            'elseif' => true,
            'encoding' => true,
            'ereg_to_preg' => true,
            'error_suppression' => [
                'mute_deprecation_error' => true,
                'noise_remaining_usages' => true,
            ],
            'escape_implicit_backslashes' => true,
            'explicit_indirect_variable' => false,
            'explicit_string_variable' => true,
            'final_class' => false,
            'final_internal_class' => true,
            'final_public_method_for_abstract_class' => false,
            'fopen_flag_order' => true,
            'fopen_flags' => true,
            'full_opening_tag' => true,
            'fully_qualified_strict_types' => true,
            'function_declaration' => [
                'closure_function_spacing' => 'one',
            ],
            'function_to_constant' => true,
            'general_phpdoc_annotation_remove' => [
                'annotations' => [
                    0 => 'package',
                    1 => 'subpackage',
                    2 => 'author',
                    3 => 'version',
                ],
            ],
            'general_phpdoc_tag_rename' => true,
            'global_namespace_import' => [
                'import_classes' => false,
                'import_constants' => false,
                'import_functions' => false,
            ],
            'header_comment' => false,
            'heredoc_indentation' => false,
            'heredoc_to_nowdoc' => true,
            'implode_call' => true,
            'include' => true,
            'increment_style' => [
                'style' => 'pre',
            ],
            'indentation_type' => false,
            'integer_literal_case' => true,
            'is_null' => true,
            'line_ending' => true,
            'linebreak_after_opening_tag' => true,
            'list_syntax' => false,
            'logical_operators' => true,
            'lowercase_keywords' => true,
            'lowercase_static_reference' => true,
            'magic_constant_casing' => true,
            'magic_method_casing' => true,
            'mb_str_functions' => false,
            'method_argument_space' => [
                'on_multiline' => 'ensure_fully_multiline',
                'keep_multiple_spaces_after_comma' => false,
            ],
            'method_chaining_indentation' => true,
            'modernize_types_casting' => true,
            'multiline_comment_opening_closing' => true,
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'no_multi_line',
            ],
            'native_constant_invocation' => true,
            'native_function_casing' => true,
            'native_function_invocation' => [
                'include' => [
                    0 => '@compiler_optimized',
                ],
                'scope' => 'namespaced',
                'strict' => true,
            ],
            'native_type_declaration_casing' => true,
            'new_with_parentheses' => true,
            'no_alias_functions' => true,
            'no_alternative_syntax' => false,
            'no_binary_string' => true,
            'no_blank_lines_after_class_opening' => false,
            'no_blank_lines_after_phpdoc' => false,
            'no_closing_tag' => true,
            'no_empty_comment' => true,
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_blank_lines' => [
                'tokens' => [
                    0 => 'break',
                    1 => 'case',
                    2 => 'continue',
                    3 => 'curly_brace_block',
                    4 => 'default',
                    5 => 'extra',
                    6 => 'parenthesis_brace_block',
                    7 => 'return',
                    8 => 'square_brace_block',
                    9 => 'switch',
                    10 => 'throw',
                    11 => 'use',
                ],
            ],
            'no_homoglyph_names' => true,
            'no_leading_namespace_whitespace' => true,
            'no_mixed_echo_print' => [
                'use' => 'print',
            ],
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_multiple_statements_per_line' => true,
            'no_null_property_initialization' => true,
            'no_php4_constructor' => false,
            'no_short_bool_cast' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_spaces_after_function_name' => true,
            'no_spaces_around_offset' => [
                'positions' => [
                    0 => 'inside',
                    1 => 'outside',
                ],
            ],
            'no_superfluous_elseif' => true,
            'no_superfluous_phpdoc_tags' => [
                'allow_mixed' => true,
                'allow_unused_params' => true,
                'remove_inheritdoc' => false,
            ],
            'no_trailing_comma_in_singleline' => [
                'elements' => [
                    0 => 'arguments',
                    1 => 'array_destructuring',
                    2 => 'array',
                    3 => 'group_import',
                ],
            ],
            'no_trailing_whitespace' => true,
            'no_trailing_whitespace_in_comment' => true,
            'no_unneeded_braces' => true,
            'no_unneeded_control_parentheses' => [
                'statements' => [
                    0 => 'break',
                    1 => 'clone',
                    2 => 'continue',
                    3 => 'echo_print',
                    4 => 'return',
                    5 => 'switch_case',
                    6 => 'yield',
                ],
            ],
            'no_unneeded_final_method' => true,
            'no_unreachable_default_argument_value' => true,
            'no_unset_cast' => true,
            'no_unset_on_property' => true,
            'no_unused_imports' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'no_whitespace_before_comma_in_array' => true,
            'no_whitespace_in_blank_line' => true,
            'non_printable_character' => true,
            'normalize_index_brace' => true,
            'not_operator_with_space' => false,
            'not_operator_with_successor_space' => false,
            'nullable_type_declaration_for_default_null_value' => true,
            'object_operator_without_whitespace' => true,
            'ordered_class_elements' => [
                'order' => [
                    0 => 'use_trait',
                    1 => 'constant_public',
                    2 => 'constant_protected',
                    3 => 'constant_private',
                    4 => 'property_public',
                    5 => 'property_protected',
                    6 => 'property_private',
                    7 => 'construct',
                    8 => 'destruct',
                    9 => 'magic',
                    10 => 'phpunit',
                    11 => 'method_public',
                    12 => 'method_protected',
                    13 => 'method_private',
                ],
                'sort_algorithm' => 'alpha',
            ],
            'ordered_imports' => [
                'imports_order' => [
                    0 => 'class',
                    1 => 'function',
                    2 => 'const',
                ],
                'sort_algorithm' => 'alpha',
            ],
            'ordered_interfaces' => false,
            'php_unit_construct' => [
                'assertions' => [
                    0 => 'assertSame',
                    1 => 'assertEquals',
                    2 => 'assertNotEquals',
                    3 => 'assertNotSame',
                ],
            ],
            'php_unit_dedicate_assert' => false,
            'php_unit_dedicate_assert_internal_type' => false,
            'php_unit_expectation' => [
                'target' => 'newest',
            ],
            'php_unit_fqcn_annotation' => true,
            'php_unit_internal_class' => [
                'types' => [
                    0 => 'abstract',
                    1 => 'final',
                    2 => 'normal',
                ],
            ],
            'php_unit_method_casing' => true,
            'php_unit_mock' => true,
            'php_unit_mock_short_will_return' => true,
            'php_unit_namespaced' => [
                'target' => '5.7',
            ],
            'php_unit_no_expectation_annotation' => [
                'target' => 'newest',
                'use_class_const' => true,
            ],
            'php_unit_set_up_tear_down_visibility' => true,
            'php_unit_size_class' => false,
            'php_unit_strict' => false,
            'php_unit_test_annotation' => true,
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
            ],
            'php_unit_test_class_requires_covers' => true,
            'phpdoc_add_missing_param_annotation' => false,
            'phpdoc_align' => false,
            'phpdoc_annotation_without_dot' => false,
            'phpdoc_indent' => true,
            'phpdoc_inline_tag_normalizer' => true,
            'phpdoc_line_span' => [
                'const' => 'multi',
                'property' => 'multi',
                'method' => 'multi',
            ],
            'phpdoc_no_access' => true,
            'phpdoc_no_alias_tag' => true,
            'phpdoc_no_empty_return' => false,
            'phpdoc_no_package' => true,
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_order' => true,
            'phpdoc_order_by_value' => true,
            'phpdoc_return_self_reference' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_single_line_var_spacing' => true,
            'phpdoc_summary' => true,
            'phpdoc_tag_type' => [
                'tags' => [
                    'inheritDoc' => 'inline',
                ],
            ],
            'phpdoc_to_comment' => false,
            'phpdoc_to_return_type' => false,
            'phpdoc_trim' => true,
            'phpdoc_trim_consecutive_blank_line_separation' => true,
            'phpdoc_types' => true,
            'phpdoc_types_order' => false,
            'phpdoc_var_annotation_correct_order' => true,
            'phpdoc_var_without_name' => true,
            'pow_to_exponentiation' => true,
            'protected_to_private' => true,
            'random_api_migration' => true,
            'return_assignment' => true,
            'return_type_declaration' => [
                'space_before' => 'none',
            ],
            'self_accessor' => false,
            'self_static_accessor' => true,
            'semicolon_after_instruction' => true,
            'set_type_to_cast' => true,
            'simple_to_complex_string_variable' => true,
            'simplified_null_return' => false,
            'single_blank_line_at_eof' => true,
            'single_class_element_per_statement' => [
                'elements' => [
                    0 => 'const',
                    1 => 'property',
                ],
            ],
            'single_import_per_statement' => false,
            'single_line_after_imports' => true,
            'single_line_comment_style' => true,
            'single_line_throw' => false,
            'single_quote' => [
                'strings_containing_single_quote_chars' => false,
            ],
            'single_space_around_construct' => true,
            'single_trait_insert_per_statement' => true,
            'space_after_semicolon' => true,
            'spaces_inside_parentheses' => [
                'space' => 'none',
            ],
            'standardize_increment' => true,
            'standardize_not_equals' => true,
            'statement_indentation' => true,
            'static_lambda' => true,
            'strict_comparison' => true,
            'strict_param' => true,
            'string_length_to_empty' => true,
            'string_line_ending' => true,
            'switch_case_semicolon_to_colon' => true,
            'switch_case_space' => true,
            'ternary_to_null_coalescing' => false,
            'trailing_comma_in_multiline' => [
                'elements' => [
                    0 => 'arrays',
                ],
            ],
            'trim_array_spaces' => true,
            'type_declaration_spaces' => true,
            'unary_operator_spaces' => true,
            'visibility_required' => true,
            'void_return' => false,
            'whitespace_after_comma_in_array' => true,
            'yoda_style' => [
                'equal' => false,
                'identical' => false,
                'less_and_greater' => false,
                'always_move_variable' => false,
            ],
        ], $config->getRules());
        self::assertTrue($config->getUsingCache());

        $finder = $config->getFinder();
        self::assertInstanceOf(Finder::class, $finder);

        $config->setFormat('xml');
        self::assertSame('xml', $config->getFormat());

        $config->setHideProgress(true);
        self::assertTrue($config->getHideProgress());

        $config->setIndent("\t");
        self::assertSame("\t", $config->getIndent());

        $finder = new Finder();
        $config->setFinder($finder);
        self::assertSame($finder, $config->getFinder());

        $config->setLineEnding("\r\n");
        self::assertSame("\r\n", $config->getLineEnding());

        $config->setPhpExecutable(null);
        self::assertNull($config->getPhpExecutable());

        $config->setUsingCache(false);
        self::assertFalse($config->getUsingCache());
    }
}
