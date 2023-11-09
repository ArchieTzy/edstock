<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderdetailsFixture
 */
class OrderdetailsFixture extends TestFixture
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
                'order_id' => 1,
                'item_id' => 1,
                'cost' => 1,
                'qty' => 1,
                'total' => 1,
                'created' => '2023-11-07 19:01:10',
                'modified' => '2023-11-07 19:01:10',
            ],
        ];
        parent::init();
    }
}
