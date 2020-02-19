<?php

namespace App\Containers\BookingFollow\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BookingFollowRepository
 */
class BookingFollowRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
