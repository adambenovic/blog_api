<?php
/**
 * Created by PhpStorm.
 * User: adam.benovic
 * Date: 15. 1. 2019
 * Time: 7:30
 */

namespace App\Repository;


use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends BaseRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param int $id ID of user to get
     * @return User The user from DB
     */
    public function getUserByID(int $id): User
    {
        try
        {
            $user = $this->createQueryBuilder('a')
                ->andWhere('a.id= :val')
                ->setParameter('val', $id)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        catch (\Doctrine\ORM\NonUniqueResultException $ex)
        {
            echo "User not unique. NEVER HAPPENS";
        }

        return $user;
    }
}