<?php

namespace App\Containers\BookingFollow\Tasks;

use App\Containers\BookingFollow\Data\Repositories\BookingFollowRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateBookingFollowTask extends Task
{

    protected $repository;

    public function __construct(BookingFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
