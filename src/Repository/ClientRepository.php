<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function searchByCompanyNamePaginated(string $companyName,int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;
        $query = $this->createQueryBuilder('c')
            ->andWhere('c.companyName LIKE :companyName')
            ->setParameter('companyName', '%' . $companyName . '%')
            ->orderBy('c.id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        $result['client'] = $data;
        $result['pages'] = ceil($paginator->count() / $limit);
        $result['current'] = $page;
        return $result;

    }

    public function getAllPaginated(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;
        $query = $this->createQueryBuilder('client')
            ->orderBy('client.id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        $result['client'] = $data;
        $result['pages'] = ceil($paginator->count() / $limit);
        $result['current'] = $page;
        return $result;
    }

}
