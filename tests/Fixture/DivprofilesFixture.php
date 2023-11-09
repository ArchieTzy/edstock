<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DivprofilesFixture
 */
class DivprofilesFixture extends TestFixture
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
                'created' => '2023-10-18 10:48:35',
                'office_id' => 1,
                'address' => 'Lorem ipsum dolor sit amet',
                'proapp_officer' => 'Lorem ipsum dolor sit amet',
                'supply_officer' => 'Lorem ipsum dolor sit amet',
                'bacchair' => 'Lorem ipsum dolor sit amet',
                'bacsecretariat' => 'Lorem ipsum dolor sit amet',
                'bacmember1' => 'Lorem ipsum dolor sit amet',
                'bacmember2' => 'Lorem ipsum dolor sit amet',
                'bacmember3' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
