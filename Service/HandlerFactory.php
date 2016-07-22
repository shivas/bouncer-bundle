<?php
namespace SerendipityHQ\Bundle\AwsSesBouncerBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\BouncerHandlerInterface;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\NoopHandler;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\NotificationHandler;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\SubscriptionConfirmationHandler;
use Symfony\Component\HttpFoundation\Request;

class HandlerFactory
{
    /** @var ObjectManager */
    private $objectManager;

    /**
     * @var AwsClientFactory
     */
    private $awsFactory;

    public function __construct(ObjectManager $entityManager, AwsClientFactory $awsFactory)
    {
        $this->objectManager = $entityManager;
        $this->awsFactory = $awsFactory;
    }

    /**
     * @param Request $request
     * @return BouncerHandlerInterface
     */
    public function buildHandler(Request $request)
    {
        $headerType = $request->headers->get('x-amz-sns-message-type');

        switch($headerType) {
            case NotificationHandler::HEADER_TYPE:
                return new NotificationHandler(
                    $this->objectManager->getRepository('AwsSesBouncerBundle:Bounce')
                );

            case SubscriptionConfirmationHandler::HEADER_TYPE:
                return new SubscriptionConfirmationHandler(
                    $this->objectManager->getRepository('AwsSesBouncerBundle:Topic'),
                    $this->awsFactory
                );

            default:
                return new NoopHandler(); // ignore all other types of messages for now
        }
    }
}
