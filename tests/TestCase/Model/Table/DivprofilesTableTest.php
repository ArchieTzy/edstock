<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DivprofilesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DivprofilesTable Test Case
 */
class DivprofilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DivprofilesTable
     */
    protected $Divprofiles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Divprofiles',
        'app.Offices',
        'app.Iars',
        'app.Purchaseorders',
        'app.Purchaserequests',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Divprofiles') ? [] : ['className' => DivprofilesTable::class];
        $this->Divprofiles = $this->getTableLocator()->get('Divprofiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Divprofiles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DivprofilesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DivprofilesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
