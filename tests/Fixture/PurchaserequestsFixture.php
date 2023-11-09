<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchaserequestsFixture
 */
class PurchaserequestsFixture extends TestFixture
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
                'divprofile_id' => 1,
                'fcluster_id' => 1,
                'department_id' => 1,
                'prno' => 'Lorem ipsum dolor sit amet',
                'rcc' => 'Lorem ipsum dolor sit amet',
                'created' => 1,
                'item_id' => 1,
                'inventory_id' => 1,
                'purpose' => 'Lorem ipsum dolor sit amet',
                'designation_id' => 1,
            ],
        ];
        parent::init();
    }
}
