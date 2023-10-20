<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Fixer;

use PhpCsFixer\Fixer\ConfigurableFixerInterface;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolverInterface;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

/**
 * Class LineLengthFixer.
 */
final class LineLengthFixer implements ConfigurableFixerInterface
{
    /**
     * @var \Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer
     */
    private $lineLengthFixer;

    /**
     * LineLengthFixer constructor.
     */
    public function __construct($indent, $lineEnding)
    {
        $whitespacesFixerConfig = new \PhpCsFixer\WhitespacesFixerConfig($indent, $lineEnding);

        $indentDetector = new \Symplify\CodingStandard\TokenRunner\Analyzer\FixerAnalyzer\IndentDetector(
            $whitespacesFixerConfig
        );

        $blockFinder = new \Symplify\CodingStandard\TokenRunner\Analyzer\FixerAnalyzer\BlockFinder();

        $tokenSkipper = new \Symplify\CodingStandard\TokenRunner\Analyzer\FixerAnalyzer\TokenSkipper(
            $blockFinder
        );

        $lineLengthTransformer = new \Symplify\CodingStandard\TokenRunner\Transformer\FixerTransformer\LineLengthTransformer(
            $indentDetector,
            $tokenSkipper,
            $whitespacesFixerConfig
        );

        $this->lineLengthFixer = new \Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer(
            $lineLengthTransformer,
            $blockFinder
        );
    }

    public function configure(array $configuration = null): void
    {
        $this->lineLengthFixer->configure((array) $configuration);
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        $this->lineLengthFixer->fix($file, $tokens);
    }

    public function getConfigurationDefinition(): FixerConfigurationResolverInterface
    {
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return $this->lineLengthFixer->getDefinition();
    }

    public function getName(): string
    {
        return 'Drupal/line_length';
    }

    public function getPriority(): int
    {
        return $this->lineLengthFixer->getPriority();
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $this->lineLengthFixer->isCandidate($tokens);
    }

    public function isRisky(): bool
    {
        return $this->lineLengthFixer->isRisky();
    }

    public function supports(SplFileInfo $file): bool
    {
        return $this->lineLengthFixer->supports($file);
    }
}
