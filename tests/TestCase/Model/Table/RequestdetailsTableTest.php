<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestdetailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestdetailsTable Test Case
 */
class RequestdetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestdetailsTable
     */
    protected $Requestdetails;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Requestdetails',
        'app.Requests',
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
        $config = $this->getTableLocator()->exists('Requestdetails') ? [] : ['className' => RequestdetailsTable::class];
        $this->Requestdetails = $this->getTableLocator()->get('Requestdetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Requestdetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RequestdetailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RequestdetailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
