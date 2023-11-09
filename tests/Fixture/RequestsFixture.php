<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RequestsFixture
 */
class RequestsFixture extends TestFixture
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
                'office_id' => 1,
                'fcluster_id' => 1,
                'department_id' => 1,
                'pr_no' => 'Lorem ipsum dolor sit amet',
                'responsibility_center_code' => 'Lorem ipsum dolor sit amet',
                'purpose' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'requester' => 'Lorem ipsum dolor sit amet',
                'approver' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2023-11-09 21:16:59',
                'modified' => '2023-11-09 21:16:59',
                'deleted' => '2023-11-09 21:16:59',
            ],
        ];
        parent::init();
    }
}
