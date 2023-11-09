<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FundClustersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FundClustersTable Test Case
 */
class FundClustersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FundClustersTable
     */
    protected $FundClusters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.FundClusters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FundClusters') ? [] : ['className' => FundClustersTable::class];
        $this->FundClusters = $this->getTableLocator()->get('FundClusters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FundClusters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FundClustersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
