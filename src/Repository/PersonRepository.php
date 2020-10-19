<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\ORM\Query;
use App\Entity\PersonSearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @return Person[]
     */
    public function findAllActiveQuery(PersonSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if($search->getPersonName()) {
            $query = $query
                ->andWhere('p.lastname = :personname')
                ->setParameter('personname', $search->getPersonName());
        }

        if($search->getLocalisations()->count() > 0){
            $k = 0;
            foreach($search->getLocalisations() as $localisation) {
                $k++;
                $query = $query
                    ->andWhere(":localisation$k MEMBER OF p.localisations")
                    ->setParameter("localisation$k", $localisation);
            }
        }

        return $query->getQuery();
    }

    private function findVisibleQuery() : QueryBuilder {
        return $this->createQueryBuilder('p')
         ->where('p.active = true');
    }
}
