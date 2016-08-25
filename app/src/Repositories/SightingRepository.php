<?php

namespace Audabon\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Audabon\Entities\Sighting;
use Audabon\Entities\Bird;

Class SightingRepository extends EntityRepository {

    public function getBirds($birdSpecies)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s')
            ->from(Sighting::class, 's')
            ->leftJoin(Bird::class, 'b', 'WITH', 's.bird = b.id');
        foreach ($birdSpecies as $key => $value) {
            if ($key == "species") {
                $qb->andWhere("b.'$key' = '$value'");
            } else {
                $qb->andWhere("s.'$key' = '$value'");
            }
        }

        return $qb->getQuery()->getResult();
    }
}