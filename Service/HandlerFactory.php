<?php

namespace SerendipityHQ\Bundle\AwsSesMonitorBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Creates the handlers.
 */
class HandlerFactory
{
    /** @var EntityManager */
    private $_em;

    /**
     * @var AwsClientFactory
     */
    private $awsFactory;

    /**
     * HandlerFactory constructor.
     *
     * @param EntityManager    $entityManager
     * @param AwsClientFactory $awsFactory
     */
    public function __construct(EntityManager $entityManager, AwsClientFactory $awsFactory)
    {
        $this->_em = $entityManager;
        $this->awsFactory = $awsFactory;
    }

    /**
     * @param Request $request
     *
     * @return HandlerInterface
     */
    public function buildBouncesHandler(Request $request)
    {
        return $this->buildHandler($request, 'Topic');
    }

    /**
     * @param Request $request
     *
     * @return HandlerInterface
     */
    public function buildComplaintsHandler(Request $request)
    {
        return $this->buildHandler($request, 'Complaint');
    }

    /**
     * @param Request $request
     * @param string $repoName The name of the repository to load
     *
     * @return HandlerInterface
     */
    public function buildHandler(Request $request, $repoName)
    {
        $headerType = $request->headers->get('x-amz-sns-message-type');

        switch ($headerType) {
            case NotificationHandler::HEADER_TYPE:
                return new NotificationHandler(
                    $this->_em->getRepository('AwsSesMonitorBundle:' . $repoName)
                );

            case SubscriptionConfirmationHandler::HEADER_TYPE:
                return new SubscriptionConfirmationHandler(
                    $this->_em->getRepository('AwsSesMonitorBundle:' . $repoName),
                    $this->awsFactory
                );

            default:
                return new NoopHandler(); // ignore all other types of messages for now
        }
    }
}
