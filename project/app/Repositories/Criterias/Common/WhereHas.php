<?php

namespace App\Repositories\Criterias\Common;

use App\Repositories\Criterias\Criteria;
use App\Repositories\Repository;

class WhereHas extends Criteria
{
    private $relationship;

    public function __construct($relationship)
    {
        $this->relationship = $relationship;
    }

    public function apply($queryBuilder, Repository $repository)
    {
        return $queryBuilder->whereHas($this->relationship);
    }
}
