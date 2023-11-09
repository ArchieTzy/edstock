<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DesignationsFixture
 */
class DesignationsFixture extends TestFixture
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
                'created' => '2023-10-12 21:45:50',
                'user_id' => 1,
                'designation' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
