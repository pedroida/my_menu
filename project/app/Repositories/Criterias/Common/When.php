<?php

namespace App\Repositories\Criterias\Common;

use App\Repositories\Criterias\Criteria;
use App\Repositories\Repository;

class When extends Criteria
{
    private $condition;
    private $closure;

    public function __construct($condition, $closure)
    {
        $this->condition = $condition;
        $this->closure = $closure;
    }

    public function apply($queryBuilder, Repository $repository)
    {
        return $queryBuilder->when($this->condition, $this->closure);
    }
}
