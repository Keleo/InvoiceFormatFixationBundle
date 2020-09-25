<?php

/*
 * This file is part of the "Invoice format fixation" plugin for Kimai 2.
 * All rights reserved by Kevin Papst (www.kevinpapst.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\InvoiceFormatFixationBundle\EventSubscriber;

use App\Event\SystemConfigurationEvent;
use App\Form\Model\Configuration;
use App\Form\Model\SystemConfiguration as SystemConfigurationModel;
use App\Form\Type\LanguageType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SystemConfigurationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            SystemConfigurationEvent::class => ['onSystemConfiguration', 100],
        ];
    }

    public function onSystemConfiguration(SystemConfigurationEvent $event)
    {
        foreach ($event->getConfigurations() as $configuration) {
            if ($configuration->getSection() !== SystemConfigurationModel::SECTION_FORM_INVOICE) {
                continue;
            }
            $configuration->addConfiguration(
                (new Configuration())
                    ->setName('invoice.formatter_language')
                    ->setLabel('invoice.formatter_language')
                    ->setTranslationDomain('system-configuration')
                    ->setOptions(['help' => 'help.invoice.formatter_language'])
                    ->setRequired(false)
                    ->setType(LanguageType::class)
            );
        }
    }
}
