<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaserequestsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaserequestsTable Test Case
 */
class PurchaserequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaserequestsTable
     */
    protected $Purchaserequests;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Purchaserequests',
        'app.Divprofiles',
        'app.Departments',
        'app.Items',
        'app.Inventories',
        'app.Designations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Purchaserequests') ? [] : ['className' => PurchaserequestsTable::class];
        $this->Purchaserequests = $this->getTableLocator()->get('Purchaserequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Purchaserequests);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PurchaserequestsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PurchaserequestsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
