<?php

namespace AppBundle\Repository;

/**
 * ProducerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProducerRepository extends \Doctrine\ORM\EntityRepository
{
  public function findAllOrderByName()
  {
    // requête DQL (Doctrine Query language = SQL + couche objet)
    return $this->getEntityManager()
    ->createQuery('SELECT p FROM AppBundle:Producer p ORDER BY p.name ASC')
    ->getResult();
  }
  public function findAllNotAssigned(){
    return $this->getEntityManager()
    ->createQuery(
      'SELECT p FROM AppBundle:Producer p
      WHERE NOT EXISTS (SELECT f FROM AppBundle:Fruit f WHERE p = f.producer)
      ORDER BY p.name ASC'
      )
    ->getResult();
  }
}
