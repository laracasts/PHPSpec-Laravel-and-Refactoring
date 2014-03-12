<?php

namespace spec\Acme\Parsers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FieldSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Parsers\Field');
    }

    function it_parses_fields_into_an_array()
    {
        $this->parse('title:string')->shouldReturn([
            'title' => 'string'
        ]);

        $this->parse('title:string, body:text')->shouldReturn([
            'title' => 'string',
            'body'  => 'text'
        ]);

        $this->parse('title:string,body:text')->shouldReturn([
            'title' => 'string',
            'body'  => 'text'
        ]);
    }

    function it_squawks_if_the_provided_file_type_is_not_recognized()
    {
        $this->shouldThrow('Acme\Parsers\Exceptions\UnrecognizedType')
             ->duringParse('title:foobar');
    }

    // Homework:
    // What else should this class do? Describe it here,
    // and then make the tests green.

}
