<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'request_id' => 1,
                'office_id' => 1,
                'supplier_id' => 1,
                'po_no' => 'Lorem ipsum dolor sit amet',
                'method_id' => 1,
                'place_of_delivery' => 'Lorem ipsum dolor sit amet',
                'date_of_delivery' => '2023-11-09 21:30:14',
                'delivery_term' => 'Lorem ipsum dolor sit amet',
                'payment_term' => 'Lorem ipsum dolor sit amet',
                'fund_available' => 'Lorem ipsum dolor sit a',
                'ors_burs_no' => 'Lorem ipsum dolor sit amet',
                'date_of_burs' => '2023-11-09 21:30:14',
                'deleted' => '2023-11-09 21:30:14',
                'created' => '2023-11-09 21:30:14',
                'modified' => '2023-11-09 21:30:14',
            ],
        ];
        parent::init();
    }
}
