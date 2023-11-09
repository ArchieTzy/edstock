<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;


class OptionsHelper extends Helper
{

    protected $_defaultConfig = [];

    public function months()
    {
        $array = [
            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December'
        ];

        return $array;
    }

    public function status()
    {
        $array = [
          0=>'Pending',
          1=>'Approved',
          2=>'Disapproved'
        ];

        return $array;
    }
}
