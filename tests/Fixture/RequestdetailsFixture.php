<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RequestdetailsFixture
 */
class RequestdetailsFixture extends TestFixture
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
                'item_id' => 1,
                'cost' => 1,
                'qty' => 1,
                'total' => 1,
                'created' => '2023-11-09 21:23:01',
                'modified' => '2023-11-09 21:23:01',
                'deleted' => '2023-11-09 21:23:01',
            ],
        ];
        parent::init();
    }
}
