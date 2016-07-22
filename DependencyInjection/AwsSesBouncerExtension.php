<?php

namespace SerendipityHQ\Bundle\AwsSesBouncerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * {@inheritdoc}
 */
class AwsSesBouncerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // load db_driver container configuration
        $loader->load(sprintf('%s.xml', $config['db_driver']));

        if ($config['filter']['enabled']) { // if enabled - define filter
            $loader->load('filter.xml');

            $mailers = $config['filter']['mailer_name'];
            $filter = $container->getDefinition('aws_ses_bouncer.swift_mailer.filter');
            foreach ($mailers as $mailer) {
                $filter->addTag(sprintf('swiftmailer.%s.plugin', $mailer));
            }
        }

        $container->setParameter(sprintf('aws_ses_bouncer.backend_%s', $config['db_driver']), true);
        $container->setParameter('aws_ses_bouncer.driver', $config['db_driver']);
        $container->setParameter('aws_ses_bouncer.manager_name', $config['model_manager_name']);
        $container->setParameter('aws_ses_bouncer.bounce_endpoint', $config['bounce_endpoint']);
        $container->setParameter('aws_ses_bouncer.filter', $config['filter']);
        $container->setParameter('aws_ses_bouncer.filter.filter_not_permanent', $config['filter']['filter_not_permanent']);
        $container->setParameter('aws_ses_bouncer.aws_config', $config['aws_config']);
    }
}
