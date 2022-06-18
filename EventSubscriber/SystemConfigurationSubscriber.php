<?php

/*
 * This file is part of the "Invoice format fixation bundle" for Kimai.
 * All rights reserved by Kevin Papst (www.kevinpapst.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\InvoiceFormatFixationBundle\EventSubscriber;

use App\Event\SystemConfigurationEvent;
use App\Form\Model\Configuration;
use App\Form\Type\LanguageType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class SystemConfigurationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SystemConfigurationEvent::class => ['onSystemConfiguration', 100],
        ];
    }

    public function onSystemConfiguration(SystemConfigurationEvent $event): void
    {
        foreach ($event->getConfigurations() as $configuration) {
            if ($configuration->getSection() !== 'invoice') {
                continue;
            }

            $configuration->addConfiguration(
                (new Configuration('invoice.formatter_language'))
                    ->setLabel('invoice.formatter_language')
                    ->setTranslationDomain('system-configuration')
                    ->setOptions(['help' => 'help.invoice.formatter_language'])
                    ->setRequired(false)
                    ->setType(LanguageType::class)
            );

            break;
        }
    }
}
