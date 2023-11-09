<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlandetailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlandetailsTable Test Case
 */
class PlandetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlandetailsTable
     */
    protected $Plandetails;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Plandetails',
        'app.Plans',
        'app.Items',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Plandetails') ? [] : ['className' => PlandetailsTable::class];
        $this->Plandetails = $this->getTableLocator()->get('Plandetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Plandetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlandetailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PlandetailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
