<?php
/**
 * User: boshurik
 * Date: 25.04.16
 * Time: 15:45
 */

namespace BoShurik\TelegramBotBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CommandCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $pool = $container->getDefinition('bo_shurik_telegram_bot.command_pool');

        array_map(
            function ($serviceAndTag) use ($pool) {
                list($id, $tag) = $serviceAndTag;

                $pool->addMethodCall('addCommand', [new Reference($id)]);
            },
            $this->getOrderedServices($container)
        );
    }

    /**
     * @param ContainerBuilder $container
     * @return string[]
     */
    private function getOrderedServices(ContainerBuilder $container)
    {
        $servicesAndTags = $this->getServicesAndTags($container);

        usort(
            $servicesAndTags,
            function ($left, $right) {
                return ($right[1]['priority'] ?? 0) <=> ($left[1]['priority'] ?? 0);
            }
        );

        return $servicesAndTags;
    }

    /**
     * @param ContainerBuilder $container
     * @return string[]
     */
    private function getServicesAndTags(ContainerBuilder $container)
    {
        $services = [];

        foreach ($container->findTaggedServiceIds('bo_shurik_telegram_bot.command') as $id => $tags) {
            foreach ($tags as $tag) {
                $services[] = [$id, $tag];
            }
        }

        return $services;
    }
}
