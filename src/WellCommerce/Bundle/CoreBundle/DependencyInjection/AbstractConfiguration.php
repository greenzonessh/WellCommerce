<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class AbstractConfiguration
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    protected $treeRoot;

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        if (null !== $this->treeRoot) {
            $rootNode = $treeBuilder->root($this->treeRoot);
            $this->addServicesConfiguration($rootNode);
        }

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    protected function addServicesConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
            ->arrayNode('services')
            ->useAttributeAsKey('name')
            ->prototype('array')
            ->children()
            ->arrayNode('auto_services')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('repository')->defaultNull()->end()
            ->scalarNode('factory')->defaultNull()->end()
            ->end()
            ->end()
            ->arrayNode('orm_configuration')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('entity')->end()
            ->scalarNode('mapping')->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();
    }
}