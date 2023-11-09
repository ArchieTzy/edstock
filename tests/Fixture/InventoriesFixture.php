<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InventoriesFixture
 */
class InventoriesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'created' => '2023-10-15 10:06:50',
                'item_id' => 1,
                'unit' => 'Lorem ipsum dolor sit amet',
                'qty' => 1,
                'unit_cost' => 1,
                'total_cost' => 1,
            ],
        ];
        parent::init();
    }
}
