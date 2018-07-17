<?php

namespace Ipallet\ZarinpalBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class IpalletZarinpalExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter(
            'ipallet_zarinpal.merchant_id',
            $config['merchant_id']
        );

        $container->setParameter(
            'ipallet_zarinpal.call_back_url',
            $config['call_back_url']
        );

        $container->setParameter(
            'ipallet_zarinpal.payment_url',
            $config['payment_url']
        );

        $container->setParameter(
            'ipallet_zarinpal.authorize_url',
            $config['authorize_url']
        );
    }
}
