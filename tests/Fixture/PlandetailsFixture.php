<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlandetailsFixture
 */
class PlandetailsFixture extends TestFixture
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
                'plan_id' => 1,
                'code' => 'Lorem ipsum dolor sit amet',
                'item_id' => 1,
                'qty' => 1,
                'cost' => 1,
                'total' => 1,
                'jan' => 1,
                'feb' => 1,
                'mar' => 1,
                'apr' => 1,
                'may' => 1,
                'jun' => 1,
                'jul' => 1,
                'aug' => 1,
                'sep' => 1,
                'oct' => 1,
                'nov' => 1,
                'decm' => 1,
                'created' => '2023-10-22 14:24:58',
            ],
        ];
        parent::init();
    }
}
