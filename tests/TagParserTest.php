<?php

namespace Tests;

use App\TagParser;
use \PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    protected TagParser $tagParser;

    protected function setUp(): void
    {
        $this->parser = new TagParser();
    }

    /**
     * @dataProvider tagsProvider
     */
    public function test_it_parses_tags($input, $expected)
    {
        $result = $this->parser->parse($input);

        $this->assertSame($expected, $result);
    }

    /**
     * You can refactor your unit test using data provider like below.
     */
    public function tagsProvider()
    {
        return [
            ["personal", ["personal"]],
            ['personal, money, family', ['personal', 'money', 'family']],
            ['personal | money | family', ['personal', 'money', 'family']],
            ['personal|money|family', ['personal', 'money', 'family']],
            ['personal ! money ! family', ['personal', 'money', 'family']]
        ];
    }

    public function test_it_parses_a_single_tag()
    {
        $result = $this->parser->parse('personal');
        $expected = ['personal'];

        $this->assertSame($expected, $result);
    }

    public function test_it_parses_a_comma_separated_list_of_tags()
    {
        $result = $this->parser->parse('personal, money, family');
        $expected = ['personal', 'money', 'family'];
        $this->assertSame($expected, $result);
    }

    public function test_it_parses_a_pipe_separated_list_of_tags()
    {
        $result = $this->parser->parse('personal | money | family');
        $expected = ['personal', 'money', 'family'];
        $this->assertSame($expected, $result);
    }

    public function test_spaces_are_optional()
    {
        $result = $this->parser->parse('personal,money,family');
        $expected = ['personal', 'money', 'family'];
        $this->assertSame($expected, $result);

        $result = $this->parser->parse('personal|money|family');
        $expected = ['personal', 'money', 'family'];
        $this->assertSame($expected, $result);
    }
}