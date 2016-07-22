<?php

use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\NotificationHandler;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\SubscriptionConfirmationHandler;

class HandlerFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $request;
    private $om;
    private $aws;

    protected function setUp()
    {
        $this->request = $this->getMockBuilder('\Symfony\Component\HttpFoundation\Request')
            ->getMock();
        $this->request->headers = new \Symfony\Component\HttpFoundation\HeaderBag();

        $this->aws = $this->getMockBuilder('\SerendipityHQ\Bundle\AwsSesBouncerBundle\Service\AwsClientFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $this->om = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->om
            ->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($this->createMock('Doctrine\Common\Persistence\ObjectRepository')));


    }

    public function testNoopHandlerCreated()
    {
        $factory = new \SerendipityHQ\Bundle\AwsSesBouncerBundle\Service\HandlerFactory($this->om, $this->aws);

        /** @var \Symfony\Component\HttpFoundation\Request $request */
        $this->request->headers->set('x-amz-sns-message-type', 'test-fake');
        $object = $factory->buildHandler($this->request);
        $this->assertInstanceOf('SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\NoopHandler', $object);
    }

    public function testNotificationHandlerCreated()
    {
        $factory = new \SerendipityHQ\Bundle\AwsSesBouncerBundle\Service\HandlerFactory($this->om, $this->aws);

        /** @var \Symfony\Component\HttpFoundation\Request $request */
        $this->request->headers->set('x-amz-sns-message-type', NotificationHandler::HEADER_TYPE);
        $object = $factory->buildHandler($this->request);
        $this->assertInstanceOf('SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\NotificationHandler', $object);
    }

    public function testSubscriptionConfirmationHandlerCreated()
    {
        $factory = new \SerendipityHQ\Bundle\AwsSesBouncerBundle\Service\HandlerFactory($this->om, $this->aws);

        /** @var \Symfony\Component\HttpFoundation\Request $request */
        $this->request->headers->set('x-amz-sns-message-type', SubscriptionConfirmationHandler::HEADER_TYPE);
        $object = $factory->buildHandler($this->request);
        $this->assertInstanceOf('SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\SubscriptionConfirmationHandler', $object);
    }
}