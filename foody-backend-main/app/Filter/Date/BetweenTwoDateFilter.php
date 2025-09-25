<?php

namespace App\Filter\Date;

use App\Filter\OthersBaseFilter;

class BetweenTwoDateFilter extends OthersBaseFilter
{
    private ?string $start;

    private ?string $end;

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(?string $start): void
    {
        $this->start = $start;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(?string $end): void
    {
        $this->end = $end;
    }
}
