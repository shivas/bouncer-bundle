<?php
namespace SerendipityHQ\Bundle\AwsSesBouncerBundle\Repository;

use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\Bounce;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\BounceRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class BounceRepository extends EntityRepository implements BounceRepositoryInterface
{
    /**
     * @param $email
     * @return Bounce|null
     */
    public function findBounceByEmail($email)
    {
        return $this->findOneBy(array('emailAddress' => mb_strtolower($email)));
    }

    /**
     * @param Bounce $bounce
     * @return mixed
     */
    public function save(Bounce $bounce)
    {
        $this->_em->persist($bounce);
        $this->_em->flush();
    }
}
