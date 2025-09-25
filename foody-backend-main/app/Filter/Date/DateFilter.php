<?php

namespace App\Filter\Date;

use App\Filter\OthersBaseFilter;

class DateFilter extends OthersBaseFilter
{
    private ?int $day = null;

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): void
    {
        $this->day = $day;
    }
}
