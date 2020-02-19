<?php

namespace App\Containers\BookingHash\Tasks;

use App\Containers\BookingHash\Data\Repositories\BookingHashRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindBookingHashByReferenceNumberTask extends Task
{

    protected $repository;

    public function __construct(BookingHashRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($number)
    {
        $result = $this->repository->findByField('reference_number', $number);

        return $result->first();
    }
}
