<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MethodsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MethodsTable Test Case
 */
class MethodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MethodsTable
     */
    protected $Methods;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Methods',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Methods') ? [] : ['className' => MethodsTable::class];
        $this->Methods = $this->getTableLocator()->get('Methods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Methods);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MethodsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
