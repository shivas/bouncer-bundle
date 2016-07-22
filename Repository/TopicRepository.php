<?php
namespace SerendipityHQ\Bundle\AwsSesBouncerBundle\Repository;

use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\Topic;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\TopicRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class TopicRepository extends EntityRepository implements TopicRepositoryInterface
{
    /**
     * @param $topicArn
     * @return Topic|null
     */
    public function getTopicByArn($topicArn)
    {
        return $this->findOneBy(array('topicArn' => $topicArn));
    }

    /**
     * @param Topic $topic
     * @return mixed
     */
    public function save(Topic $topic)
    {
        $this->_em->persist($topic);
        $this->_em->flush();
    }

    /**
     * @param Topic $topic
     * @return mixed
     */
    public function remove(Topic $topic)
    {
        $this->createQueryBuilder('topic')
            ->delete()
            ->where('topic.topicArn = :arn')
            ->setParameter('arn', $topic->getTopicArn())
            ->getQuery()
            ->execute();
    }
}
