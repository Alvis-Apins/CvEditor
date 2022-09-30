<?php

namespace App\Repository;

use App\Entity\CvJobExperienceSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CvJobExperienceSkills>
 *
 * @method CvJobExperienceSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method CvJobExperienceSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method CvJobExperienceSkills[]    findAll()
 * @method CvJobExperienceSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvJobExperienceSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CvJobExperienceSkills::class);
    }

    public function add(CvJobExperienceSkills $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CvJobExperienceSkills $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CvJobExperienceSkills[] Returns an array of CvJobExperienceSkills objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CvJobExperienceSkills
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
