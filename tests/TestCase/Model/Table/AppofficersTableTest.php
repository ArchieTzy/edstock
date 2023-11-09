<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppofficersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppofficersTable Test Case
 */
class AppofficersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppofficersTable
     */
    protected $Appofficers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Appofficers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Appofficers') ? [] : ['className' => AppofficersTable::class];
        $this->Appofficers = $this->getTableLocator()->get('Appofficers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Appofficers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AppofficersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
