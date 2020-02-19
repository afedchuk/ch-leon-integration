<?php

namespace App\Containers\BookingFollow\Tasks;

use App\Containers\BookingFollow\Data\Criterias\RelevantFollowsCriteria;
use App\Containers\BookingFollow\Data\Repositories\BookingFollowRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllBookingFollowsTask extends Task
{
    protected $repository;

    public function __construct(BookingFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->all();
    }

    /**
     * @return BookingFollowRepository
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function relevant()
    {
        return $this->repository->pushCriteria(
            new RelevantFollowsCriteria()
        );
    }
}
