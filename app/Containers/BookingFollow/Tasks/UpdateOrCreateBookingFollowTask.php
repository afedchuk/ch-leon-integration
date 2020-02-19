<?php

namespace App\Containers\BookingFollow\Tasks;

use App\Containers\BookingFollow\Data\Repositories\BookingFollowRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateOrCreateBookingFollowTask extends Task
{
    protected $repository;

    public function __construct(BookingFollowRepository $repository)
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
