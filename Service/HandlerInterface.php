<?php

namespace SerendipityHQ\Bundle\AwsSesMonitorBundle\Service;

use Aws\Credentials\Credentials;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines the minimum requirements of a MonitorHandler.
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @param Credentials $credentials The AWS Credentials to use.
     *
     * @return int
     */
    public function handleRequest(Request $request, Credentials $credentials);
}
