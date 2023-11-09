<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFixture
 */
class ItemsFixture extends TestFixture
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
                'created' => '2023-10-21 15:03:28',
                'category_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
                'unit_id' => 1,
                'cost' => 1,
            ],
        ];
        parent::init();
    }
}
