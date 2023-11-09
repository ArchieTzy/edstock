<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReqofficersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReqofficersTable Test Case
 */
class ReqofficersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReqofficersTable
     */
    protected $Reqofficers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Reqofficers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Reqofficers') ? [] : ['className' => ReqofficersTable::class];
        $this->Reqofficers = $this->getTableLocator()->get('Reqofficers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Reqofficers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReqofficersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
