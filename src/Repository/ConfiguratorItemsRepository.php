<?php

namespace App\Repository;

use App\Entity\ConfiguratorItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ConfiguratorItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConfiguratorItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConfiguratorItems[]    findAll()
 * @method ConfiguratorItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfiguratorItemsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ConfiguratorItems::class);
    }

//    /**
//     * @return ConfiguratorItems[] Returns an array of ConfiguratorItems objects
//     */
    
    public function getAllConfigs( )
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT ci.*, c.name as profileName, c.type as selectType
            FROM `configurator_items_options` ci
            INNER JOIN configurator_items c ON c.id = ci.configurator_item_id
            ORDER BY configurator_item_id ASC, sequence ASC
            ';
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
       $array = $stmt->fetchAll();

       $fields_grouped = array();
       foreach ( $array as $value ) { // Group values as per type
          $fields_grouped[$value['profileName']][] = $value;
        }
        return $fields_grouped;
    }
    

    /*
    public function findOneBySomeField($value): ?ConfiguratorItems
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
