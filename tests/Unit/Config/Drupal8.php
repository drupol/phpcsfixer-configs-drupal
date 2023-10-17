<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Config;

use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineAfterStartOfClass;
use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineBeforeEndOfClass;
use drupol\PhpCsFixerConfigsDrupal\Fixer\ControlStructureCurlyBracketsElseFixer;
use drupol\PhpCsFixerConfigsDrupal\Fixer\InlineCommentSpacerFixer;
use drupol\PhpCsFixerConfigsDrupal\Fixer\TryCatchBlock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers drupol\PhpCsFixerConfigsDrupal\Config\Drupal8
 */
final class Drupal8 extends TestCase
{
    public function testConfigDefault(): void
    {
        $config = new \drupol\PhpCsFixerConfigsDrupal\Config\Drupal8();

        self::assertSame('.php-cs-fixer.cache', $config->getCacheFile());
        $fixers = $config->getCustomFixers();
        self::assertCount(5, $fixers);
        self::assertInstanceOf(BlankLineAfterStartOfClass::class, $fixers[0]);
        self::assertInstanceOf(BlankLineBeforeEndOfClass::class, $fixers[1]);
        self::assertInstanceOf(ControlStructureCurlyBracketsElseFixer::class, $fixers[2]);
        self::assertInstanceOf(InlineCommentSpacerFixer::class, $fixers[3]);
        self::assertInstanceOf(TryCatchBlock::class, $fixers[4]);

        self::assertSame('txt', $config->getFormat());
        self::assertFalse($config->getHideProgress());
        self::assertSame('  ', $config->getIndent());
        self::assertSame("\n", $config->getLineEnding());
        self::assertSame('drupal8', $config->getName());
        self::assertNull($config->getPhpExecutable());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame([
            '@PSR12' => TRUE,
            '@PSR12:risky' => TRUE,
            '@PSR2' => FALSE,
            '@PhpCsFixer' => TRUE,
            'Drupal/blank_line_after_start_of_class' => TRUE,
            'Drupal/blank_line_before_end_of_class' => TRUE,
            'Drupal/control_structure_braces_else' => TRUE,
            'Drupal/inline_comment_spacer' => TRUE,
            'Drupal/try_catch_block' => TRUE,
            'align_multiline_comment' => [
                'comment_type' => 'all_multiline',
            ],
            'array_indentation' => TRUE,
            'array_push' => TRUE,
            'array_syntax' => [
                'syntax' => 'short',
            ],
            'backtick_to_shell_exec' => TRUE,
            'binary_operator_spaces' => TRUE,
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
            'blank_lines_before_namespace' => FALSE,
            'braces' => [
                'allow_single_line_closure' => TRUE,
                'position_after_functions_and_oop_constructs' => 'same',
                'position_after_control_structures' => 'same',
                'position_after_anonymous_constructs' => 'same',
            ],
            'cast_spaces' => [
                'space' => 'single',
            ],
            'class_attributes_separation' => FALSE,
            'class_definition' => [
                'multi_line_extends_each_single_line' => TRUE,
            ],
            'combine_consecutive_issets' => TRUE,
            'combine_consecutive_unsets' => TRUE,
            'combine_nested_dirname' => FALSE,
            'comment_to_phpdoc' => FALSE,
            'compact_nullable_typehint' => TRUE,
            'concat_space' => [
                'spacing' => 'one',
            ],
            'constant_case' => [
                'case' => 'upper',
            ],
            'control_structure_braces' => TRUE,
            'control_structure_continuation_position' => [
                'position' => 'same_line',
            ],
            'curly_braces_position' => [
                'classes_opening_brace' => 'same_line',
                'functions_opening_brace' => 'same_line',
            ],
            'date_time_immutable' => FALSE,
            'declare_equal_normalize' => [
                'space' => 'single',
            ],
            'declare_parentheses' => TRUE,
            'declare_strict_types' => FALSE,
            'dir_constant' => TRUE,
            'doctrine_annotation_array_assignment' => [
                'operator' => ':',
            ],
            'doctrine_annotation_braces' => [
                'syntax' => 'without_braces',
            ],
            'doctrine_annotation_indentation' => TRUE,
            'doctrine_annotation_spaces' => [
                'after_argument_assignments' => FALSE,
                'after_array_assignments_colon' => TRUE,
                'after_array_assignments_equals' => FALSE,
                'around_parentheses' => TRUE,
                'before_argument_assignments' => FALSE,
                'before_array_assignments_colon' => FALSE,
                'before_array_assignments_equals' => FALSE,
            ],
            'echo_tag_syntax' => [
                'format' => 'long',
            ],
            'elseif' => TRUE,
            'encoding' => TRUE,
            'ereg_to_preg' => TRUE,
            'error_suppression' => [
                'mute_deprecation_error' => TRUE,
                'noise_remaining_usages' => TRUE,
            ],
            'escape_implicit_backslashes' => TRUE,
            'explicit_indirect_variable' => FALSE,
            'explicit_string_variable' => TRUE,
            'final_class' => FALSE,
            'final_internal_class' => TRUE,
            'final_public_method_for_abstract_class' => FALSE,
            'fopen_flag_order' => TRUE,
            'fopen_flags' => TRUE,
            'full_opening_tag' => TRUE,
            'fully_qualified_strict_types' => TRUE,
            'function_declaration' => [
                'closure_function_spacing' => 'one',
            ],
            'function_to_constant' => TRUE,
            'function_typehint_space' => TRUE,
            'general_phpdoc_annotation_remove' => [
                'annotations' => [
                    0 => 'package',
                    1 => 'subpackage',
                    2 => 'author',
                    3 => 'version',
                ],
            ],
            'general_phpdoc_tag_rename' => TRUE,
            'global_namespace_import' => [
                'import_classes' => FALSE,
                'import_constants' => FALSE,
                'import_functions' => FALSE,
            ],
            'header_comment' => FALSE,
            'heredoc_indentation' => FALSE,
            'heredoc_to_nowdoc' => TRUE,
            'implode_call' => TRUE,
            'include' => TRUE,
            'increment_style' => [
                'style' => 'pre',
            ],
            'indentation_type' => FALSE,
            'integer_literal_case' => TRUE,
            'is_null' => TRUE,
            'line_ending' => TRUE,
            'linebreak_after_opening_tag' => TRUE,
            'list_syntax' => FALSE,
            'logical_operators' => TRUE,
            'lowercase_keywords' => TRUE,
            'lowercase_static_reference' => TRUE,
            'magic_constant_casing' => TRUE,
            'magic_method_casing' => TRUE,
            'mb_str_functions' => FALSE,
            'method_argument_space' => [
                'on_multiline' => 'ensure_fully_multiline',
                'keep_multiple_spaces_after_comma' => FALSE,
            ],
            'method_chaining_indentation' => TRUE,
            'modernize_types_casting' => TRUE,
            'multiline_comment_opening_closing' => TRUE,
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'no_multi_line',
            ],
            'native_constant_invocation' => TRUE,
            'native_function_casing' => TRUE,
            'native_function_invocation' => [
                'include' => [
                    0 => '@compiler_optimized',
                ],
                'scope' => 'namespaced',
                'strict' => TRUE,
            ],
            'native_function_type_declaration_casing' => TRUE,
            'new_with_braces' => TRUE,
            'no_alias_functions' => TRUE,
            'no_alternative_syntax' => FALSE,
            'no_binary_string' => TRUE,
            'no_blank_lines_after_class_opening' => FALSE,
            'no_blank_lines_after_phpdoc' => FALSE,
            'no_closing_tag' => TRUE,
            'no_empty_comment' => TRUE,
            'no_empty_phpdoc' => TRUE,
            'no_empty_statement' => TRUE,
            'no_extra_blank_lines' => [
                'tokens' => [
                    0 => 'break',
                    1 => 'case',
                    2 => 'continue',
                    3 => 'default',
                    4 => 'extra',
                    5 => 'parenthesis_brace_block',
                    6 => 'return',
                    7 => 'square_brace_block',
                    8 => 'switch',
                    9 => 'throw',
                    10 => 'use',
                    11 => 'use_trait',
                ],
            ],
            'no_homoglyph_names' => TRUE,
            'no_leading_namespace_whitespace' => TRUE,
            'no_mixed_echo_print' => [
                'use' => 'print',
            ],
            'no_multiline_whitespace_around_double_arrow' => TRUE,
            'no_multiple_statements_per_line' => TRUE,
            'no_null_property_initialization' => TRUE,
            'no_php4_constructor' => FALSE,
            'no_short_bool_cast' => TRUE,
            'no_singleline_whitespace_before_semicolons' => TRUE,
            'no_spaces_after_function_name' => TRUE,
            'no_spaces_around_offset' => [
                'positions' => [
                    0 => 'inside',
                    1 => 'outside',
                ],
            ],
            'no_spaces_inside_parenthesis' => TRUE,
            'no_superfluous_elseif' => TRUE,
            'no_superfluous_phpdoc_tags' => [
                'allow_mixed' => TRUE,
                'allow_unused_params' => TRUE,
                'remove_inheritdoc' => FALSE,
            ],
            'no_trailing_comma_in_list_call' => TRUE,
            'no_trailing_comma_in_singleline' => [
                'elements' => [
                    0 => 'arguments',
                    1 => 'array_destructuring',
                    2 => 'array',
                    3 => 'group_import',
                ],
            ],
            'no_trailing_whitespace' => TRUE,
            'no_trailing_whitespace_in_comment' => TRUE,
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
            'no_unneeded_curly_braces' => TRUE,
            'no_unneeded_final_method' => TRUE,
            'no_unreachable_default_argument_value' => TRUE,
            'no_unset_cast' => TRUE,
            'no_unset_on_property' => TRUE,
            'no_unused_imports' => TRUE,
            'no_useless_else' => TRUE,
            'no_useless_return' => TRUE,
            'no_whitespace_before_comma_in_array' => TRUE,
            'no_whitespace_in_blank_line' => TRUE,
            'non_printable_character' => TRUE,
            'normalize_index_brace' => TRUE,
            'not_operator_with_space' => FALSE,
            'not_operator_with_successor_space' => FALSE,
            'nullable_type_declaration_for_default_null_value' => TRUE,
            'object_operator_without_whitespace' => TRUE,
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
            'ordered_interfaces' => FALSE,
            'php_unit_construct' => [
                'assertions' => [
                    0 => 'assertSame',
                    1 => 'assertEquals',
                    2 => 'assertNotEquals',
                    3 => 'assertNotSame',
                ],
            ],
            'php_unit_dedicate_assert' => FALSE,
            'php_unit_dedicate_assert_internal_type' => FALSE,
            'php_unit_expectation' => [
                'target' => 'newest',
            ],
            'php_unit_fqcn_annotation' => TRUE,
            'php_unit_internal_class' => [
                'types' => [
                    0 => 'abstract',
                    1 => 'final',
                    2 => 'normal',
                ],
            ],
            'php_unit_method_casing' => TRUE,
            'php_unit_mock' => TRUE,
            'php_unit_mock_short_will_return' => TRUE,
            'php_unit_namespaced' => [
                'target' => '5.7',
            ],
            'php_unit_no_expectation_annotation' => [
                'target' => 'newest',
                'use_class_const' => TRUE,
            ],
            'php_unit_set_up_tear_down_visibility' => TRUE,
            'php_unit_size_class' => FALSE,
            'php_unit_strict' => FALSE,
            'php_unit_test_annotation' => TRUE,
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
            ],
            'php_unit_test_class_requires_covers' => TRUE,
            'phpdoc_add_missing_param_annotation' => FALSE,
            'phpdoc_align' => FALSE,
            'phpdoc_annotation_without_dot' => FALSE,
            'phpdoc_indent' => TRUE,
            'phpdoc_inline_tag_normalizer' => TRUE,
            'phpdoc_line_span' => [
                'const' => 'multi',
                'property' => 'multi',
                'method' => 'multi',
            ],
            'phpdoc_no_access' => TRUE,
            'phpdoc_no_alias_tag' => TRUE,
            'phpdoc_no_empty_return' => FALSE,
            'phpdoc_no_package' => TRUE,
            'phpdoc_no_useless_inheritdoc' => TRUE,
            'phpdoc_order' => TRUE,
            'phpdoc_order_by_value' => TRUE,
            'phpdoc_return_self_reference' => TRUE,
            'phpdoc_scalar' => TRUE,
            'phpdoc_separation' => TRUE,
            'phpdoc_single_line_var_spacing' => TRUE,
            'phpdoc_summary' => TRUE,
            'phpdoc_tag_type' => [
                'tags' => [
                    'inheritDoc' => 'inline',
                ],
            ],
            'phpdoc_to_comment' => FALSE,
            'phpdoc_to_return_type' => FALSE,
            'phpdoc_trim' => TRUE,
            'phpdoc_trim_consecutive_blank_line_separation' => TRUE,
            'phpdoc_types' => TRUE,
            'phpdoc_types_order' => FALSE,
            'phpdoc_var_annotation_correct_order' => TRUE,
            'phpdoc_var_without_name' => TRUE,
            'pow_to_exponentiation' => TRUE,
            'protected_to_private' => TRUE,
            'random_api_migration' => TRUE,
            'return_assignment' => TRUE,
            'return_type_declaration' => [
                'space_before' => 'none',
            ],
            'self_accessor' => FALSE,
            'self_static_accessor' => TRUE,
            'semicolon_after_instruction' => TRUE,
            'set_type_to_cast' => TRUE,
            'simple_to_complex_string_variable' => TRUE,
            'simplified_null_return' => FALSE,
            'single_blank_line_at_eof' => TRUE,
            'single_class_element_per_statement' => [
                'elements' => [
                    0 => 'const',
                    1 => 'property',
                ],
            ],
            'single_import_per_statement' => FALSE,
            'single_line_after_imports' => TRUE,
            'single_line_comment_style' => TRUE,
            'single_line_throw' => FALSE,
            'single_quote' => [
                'strings_containing_single_quote_chars' => FALSE,
            ],
            'single_trait_insert_per_statement' => TRUE,
            'space_after_semicolon' => TRUE,
            'standardize_increment' => TRUE,
            'standardize_not_equals' => TRUE,
            'statement_indentation' => TRUE,
            'static_lambda' => TRUE,
            'strict_comparison' => TRUE,
            'strict_param' => TRUE,
            'string_length_to_empty' => TRUE,
            'string_line_ending' => TRUE,
            'switch_case_semicolon_to_colon' => TRUE,
            'switch_case_space' => TRUE,
            'ternary_to_null_coalescing' => FALSE,
            'trailing_comma_in_multiline' => [
                'elements' => [
                    0 => 'arrays',
                ],
            ],
            'trim_array_spaces' => TRUE,
            'unary_operator_spaces' => TRUE,
            'visibility_required' => TRUE,
            'void_return' => FALSE,
            'whitespace_after_comma_in_array' => TRUE,
            'yoda_style' => [
                'equal' => FALSE,
                'identical' => FALSE,
                'less_and_greater' => FALSE,
                'always_move_variable' => FALSE,
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
