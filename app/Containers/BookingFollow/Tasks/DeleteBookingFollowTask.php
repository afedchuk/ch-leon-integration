<?php

namespace App\Containers\BookingFollow\Tasks;

use App\Containers\BookingFollow\Data\Repositories\BookingFollowRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteBookingFollowTask extends Task
{

    protected $repository;

    public function __construct(BookingFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
