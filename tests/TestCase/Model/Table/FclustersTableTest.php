<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FclustersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FclustersTable Test Case
 */
class FclustersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FclustersTable
     */
    protected $Fclusters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fclusters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fclusters') ? [] : ['className' => FclustersTable::class];
        $this->Fclusters = $this->getTableLocator()->get('Fclusters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fclusters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FclustersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
