<?php

namespace App\Client\Repository;

use App\Client\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function createListQuery()
    {
        return $this->createQueryBuilder('c')->orderBy('c.id', 'DESC')->getQuery();
    }
}
