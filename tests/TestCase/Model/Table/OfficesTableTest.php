<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OfficesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OfficesTable Test Case
 */
class OfficesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OfficesTable
     */
    protected $Offices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Offices',
        'app.Invtransreports',
        'app.Procurementplans',
        'app.Proptransreports',
        'app.Purchaseorders',
        'app.Purchaserequests',
        'app.Requisitionslips',
        'app.Rlsddsps',
        'app.Rpcis',
        'app.Rpcppes',
        'app.Rpcsps',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Offices') ? [] : ['className' => OfficesTable::class];
        $this->Offices = $this->getTableLocator()->get('Offices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Offices);

        parent::tearDown();
    }
}
