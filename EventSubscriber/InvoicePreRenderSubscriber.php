<?php

/*
 * This file is part of the "Invoice format fixation bundle" for Kimai.
 * All rights reserved by Kevin Papst (www.kevinpapst.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\InvoiceFormatFixationBundle\EventSubscriber;

use App\Configuration\LanguageFormattings;
use App\Configuration\SystemConfiguration;
use App\Event\InvoicePreRenderEvent;
use App\Invoice\DefaultInvoiceFormatter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class InvoicePreRenderSubscriber implements EventSubscriberInterface
{
    public function __construct(private LanguageFormattings $formatter, private SystemConfiguration $configuration)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            InvoicePreRenderEvent::class => ['configureFormatter', 200],
        ];
    }

    public function configureFormatter(InvoicePreRenderEvent $event): void
    {
        $language = $this->configuration->find('invoice.formatter_language');

        if (empty($language) || !\is_string($language)) {
            return;
        }

        $formatter = new DefaultInvoiceFormatter($this->formatter, $language);

        $event->getModel()->setFormatter($formatter);
    }
}
