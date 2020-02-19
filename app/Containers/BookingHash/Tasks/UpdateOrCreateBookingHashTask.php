<?php

namespace App\Containers\BookingHash\Tasks;

use App\Containers\BookingHash\Data\Repositories\BookingHashRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateOrCreateBookingHashTask extends Task
{
    protected $repository;

    public function __construct(BookingHashRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes, array $values)
    {
        try {
            return $this->repository->updateOrCreate($attributes, $values);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
