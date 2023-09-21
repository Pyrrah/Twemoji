<?php

namespace Avris\Twemoji;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpClient\HttpClient;

class TwemojiSeviceTest extends TestCase
{
    /** @var TwemojiService */
    private $service;

    public function setUp()
    {
        $this->service = new TwemojiService(HttpClient::create(), new ArrayAdapter());
    }

    /**
     * @dataProvider domProvider
     */
    public function testReplace(string $input, string $expectedOutput)
    {
        $this->assertEquals($expectedOutput, $this->service->replace($input));
    }

    public function domProvider()
    {
        yield [
            'Hello! 👋 My name is Andrea.',
            'Hello! <img draggable="false" class="emoji" alt="👋" src="https://twemoji.maxcdn.com/v/12.1.4/svg/1f44b.svg"> My name is Andrea.'
        ];

        yield [
            '<a href="#experience">👩‍💻 software engineer</a>',
            '<a href="#experience"><img draggable="false" class="emoji" alt="👩‍💻" src="https://twemoji.maxcdn.com/v/12.1.4/svg/1f469-200d-1f4bb.svg"> software engineer</a>'
        ];

        yield [
            '<a title="👋">👋</a>',
            '<a title="👋"><img draggable="false" class="emoji" alt="👋" src="https://twemoji.maxcdn.com/v/12.1.4/svg/1f44b.svg"></a>'
        ];
    }
}
