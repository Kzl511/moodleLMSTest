<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Behat\Output\Node\Printer\JUnit;

use Behat\Behat\Output\Node\EventListener\JUnit\JUnitDurationListener;
use Behat\Behat\Output\Node\Printer\FeaturePrinter;
use Behat\Behat\Output\Statistics\PhaseStatistics;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Testwork\Output\Formatter;
use Behat\Testwork\Output\Printer\JUnitOutputPrinter;
use Behat\Testwork\Tester\Result\TestResult;

/**
 * Prints the <testsuite> element.
 *
 * @author Wouter J <wouter@wouterj.nl>
 */
final class JUnitFeaturePrinter implements FeaturePrinter
{
    private ?FeatureNode $currentFeature = null;

    public function __construct(
        private PhaseStatistics $statistics,
        private ?JUnitDurationListener $durationListener = null
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function printHeader(Formatter $formatter, FeatureNode $feature)
    {
        $this->statistics->reset();
        $this->currentFeature = $feature;
        /** @var JUnitOutputPrinter $outputPrinter */
        $outputPrinter = $formatter->getOutputPrinter();
        $outputPrinter->addTestsuite();
    }

    /**
     * {@inheritDoc}
     */
    public function printFooter(Formatter $formatter, TestResult $result)
    {
        $stats = $this->statistics->getScenarioStatCounts();

        if (0 === count($stats)) {
            $totalCount = 0;
        } else {
            $totalCount = (int) array_sum($stats);
        }

        /** @var JUnitOutputPrinter $outputPrinter */
        $outputPrinter = $formatter->getOutputPrinter();

        $outputPrinter->extendTestsuiteAttributes(array(
            'name' => $this->currentFeature->getTitle(),
            'tests' => $totalCount,
            'skipped' => $stats[TestResult::SKIPPED],
            'failures' => $stats[TestResult::FAILED],
            'errors' => $stats[TestResult::PENDING] + $stats[TestResult::UNDEFINED],
            'time' => $this->durationListener ? $this->durationListener->getFeatureDuration($this->currentFeature) : '',
        ));

        $this->statistics->reset();
        $this->currentFeature = null;
    }
}
