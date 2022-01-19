<?php

/*
 * This file is part of the "Invoice format fixation" plugin for Kimai 2.
 * All rights reserved by Kevin Papst (www.kevinpapst.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\InvoiceFormatFixationBundle\EventSubscriber;

use App\Configuration\SystemConfiguration;
use App\Event\InvoicePreRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class InvoicePreRenderSubscriber implements EventSubscriberInterface
{
    private $configuration;

    public function __construct(SystemConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            InvoicePreRenderEvent::class => ['configureFormatter', 200],
        ];
    }

    public function configureFormatter(InvoicePreRenderEvent $event)
    {
        $language = $this->configuration->find('invoice.formatter_language');

        if (empty($language)) {
            return;
        }

        $event->getModel()->getFormatter()->setLocale($language);
    }
}
