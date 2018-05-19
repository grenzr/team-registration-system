<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Event::class));
    }
}
