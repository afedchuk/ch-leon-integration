<?php

namespace App\Containers\Leon\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class LeonRepository
 */
class LeonRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
