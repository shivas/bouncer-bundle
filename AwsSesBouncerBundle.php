<?php
namespace SerendipityHQ\Bundle\AwsSesBouncerBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AwsSesBouncerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $modelDir = realpath(__DIR__.'/Resources/config/doctrine/mappings');
        $mappings = array(
            $modelDir => 'SerendipityHQ\Bundle\AwsSesBouncerBundle\Model',
        );

        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('aws_ses_bouncer.model_manager_name'),
                    'aws_ses_bouncer.backend_orm',
                    array('AwsSesBouncerBundle' => 'SerendipityHQ\Bundle\AwsSesBouncerBundle\Model')
                ));
        }
    }
}
