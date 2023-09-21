<?php
namespace Pyrrah\Twemoji;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class TwemojiExtension extends AbstractExtension
{
    /** @var TwemojiService */
    private $service;

    public function __construct(TwemojiService $service)
    {
        $this->service = $service;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('twemoji', [$this->service, 'replace'], ['is_safe' => ['html']]),
        ];
    }
}
