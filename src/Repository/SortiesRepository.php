<?php

namespace App\Repository;

use App\Entity\Sorties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sorties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sorties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sorties[]    findAll()
 * @method Sorties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortiesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sorties::class);
    }

    public function recherche($like, $organisteur, $etat, $inscrit, $pasInscrit, $sortieSite,$dateDebut,$dateFin)
    {

        $qb = $this->createQueryBuilder('s');
        if (isset($like) && $like != "" && $like != null) {
            $qb->andWhere('s.nom LIKE :search');
            $qb->setParameter('search', '%' . $like . '%');
        }
        if (isset($organisteur) && $organisteur != "" && $organisteur != null) {
            $qb->andWhere('s.organisateur =:organisateur');
            $qb->setParameter('organisateur', $organisteur);
        }
        if (isset($etat) && $etat != "" && $etat != null) {
            $qb->andWhere('s.sortieEtat =:etat');
            $qb->setParameter('etat', $etat);
        }
        if (isset($inscrit) && $inscrit != "" && $inscrit != null) {
            $qb->andWhere('s.sortieParticipant =:inscrit');
            $qb->setParameter('inscrit', $inscrit);
        }
        if (isset($pasInscrit) && $pasInscrit != "" && $pasInscrit != null) {
            $qb->andWhere('s.sortieParticipant !=:pasInscrit');
            $qb->setParameter('pasInscrit', $pasInscrit);
        }
        if (isset($sortieSite) && $sortieSite != "" && $sortieSite != null) {
            $qb->andWhere('s.sortieSite =:sortieSite');
            $qb->setParameter('sortieSite', $sortieSite);
        }
        if (isset($dateDebut) && $dateDebut !="" && isset($dateFin )&& $dateFin!=""){
            $qb->andWhere('s.dateDebut >=:dateDebut AND s.dateCloture <=:dateFin');
            $qb->setParameter('dateDebut', $dateDebut);
            $qb->setParameter('dateFin', $dateFin);
        }


            $query = $qb->getQuery();

        //return $query->getResult();
        return new Paginator($query);
    }

    // /**
    //  * @return Sorties[] Returns an array of Sorties objects
    //  */
    /*
     * 
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sorties
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
