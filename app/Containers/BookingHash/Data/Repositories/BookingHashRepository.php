<?php

namespace App\Containers\BookingHash\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BookingHashRepository
 */
class BookingHashRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
