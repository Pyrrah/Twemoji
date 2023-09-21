<?php
namespace Pyrrah\Twemoji;

use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TwemojiService
{
    /** @var array */
    private $emojis;

    public function __construct(
        HttpClientInterface $httpClient,
        CacheInterface $cache,
        $format = 'svg',
        $version = '14.2.0'
    )
    {
        $this->emojis = $cache->get('twemoji', function (CacheItem $item) use ($httpClient, $format, $version) {
            $reponse = $httpClient->request(
                'GET',
                'https://api.github.com/repos/twitter/twemoji/git/trees/master?recursive=1',
                [
                    'headers' => [
                        'Accept' => 'application/vnd.github.v3+json',
                    ],
                ]
            );

            $emojis = [];
            foreach ($reponse->toArray()['tree'] as $element) {
                if (!preg_match('#^assets/svg/([0-9a-z-]+).svg$#', $element['path'], $matches)) {
                    continue;
                }
                $emoji = '';
                foreach (explode('-', $matches[1]) as $code) {
                    $emoji .= mb_chr(hexdec($code));
                }
                $emojis[$emoji] = sprintf(
                    '<img draggable="false" class="emoji" alt="%s" src="https://twemoji.maxcdn.com/v/%s/%s/%s.%s">',
                    $emoji,
                    $version,
                    $format === 'svg' ? 'svg' : '72x72',
                    $matches[1],
                    $format
                );
            }

            $item->expiresAfter(30 * 24 * 60 * 60);

            return $emojis;
        });
    }

    public function replace(string $string): string
    {
        $isTag = false;
        $buffer = '';
        $output = '';

        foreach (mb_str_split($string) as $char) {
            if (!$isTag && $char === '<') {
                $output .= strtr($buffer, $this->emojis);
                $buffer = '<';
                $isTag = true;
                continue;
            }

            if ($isTag && $char === '>') {
                $output .= $buffer . '>';
                $buffer = '';
                $isTag = false;
                continue;
            }

            $buffer .= $char;
        }

        $output .= $isTag ? $buffer : strtr($buffer, $this->emojis);

        return $output;
    }
}
