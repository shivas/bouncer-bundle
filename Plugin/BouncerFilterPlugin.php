<?php
namespace SerendipityHQ\Bundle\AwsSesBouncerBundle\Plugin;

use Doctrine\Common\Persistence\ObjectManager;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\Bounce;
use SerendipityHQ\Bundle\AwsSesBouncerBundle\Model\BounceRepositoryInterface;
use Swift_Events_SendEvent;

class BouncerFilterPlugin implements \Swift_Events_SendListener
{
    /** @var BounceRepositoryInterface */
    private $bounceRepo;

    private $blacklisted;
    /**
     * @var bool
     */
    private $filterNotPermanent;

    public function __construct(ObjectManager $manager, $filterNotPermanent)
    {
        $this->bounceRepo = $manager->getRepository('AwsSesBouncerBundle:Bounce');
        $this->filterNotPermanent = $filterNotPermanent;
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();
        $this->blacklisted = array();

        $message->setTo($this->filterForBlacklisted($message->getTo()));
        $message->setCc($this->filterForBlacklisted($message->getCc()));
        $message->setBcc($this->filterForBlacklisted($message->getBcc()));
    }

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        $evt->setFailedRecipients(array_keys($this->blacklisted));
    }

    /**
     * @param $recipients
     * @return mixed
     */
    private function filterForBlacklisted($recipients)
    {
        if (!is_array($recipients)) {
            return $recipients;
        }

        $emails = array_keys($recipients);

        foreach ($emails as $email) {
            $bounce = $this->bounceRepo->findBounceByEmail($email);
            if ($bounce instanceof Bounce) {

                if ($bounce->isPermanent() || $this->filterNotPermanent) {
                    $this->blacklisted[$email] = $recipients[$email];
                    unset($recipients[$email]);
                }
            }
        }

        return $recipients;
    }
}
