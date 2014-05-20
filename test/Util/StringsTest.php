<?php
namespace Kendru\Util;

class StringsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider camelCaseExamples
     */
    public function testCamelCase($in, $out)
    {
        $this->assertEquals($out, Strings::camelCase($in));
    }

    /**
     * @dataProvider titleCaseExamples
     */
    public function testTitleCase($in, $out)
    {
        $this->assertEquals($out, Strings::titleCase($in));
    }

    /**
     * @dataProvider underscoreExamples
     */
    public function testUnderscore($in, $out)
    {
        $this->assertEquals($out, Strings::underscore($in));
    }

    /**
     * @dataProvider incrementExamples
     */
    public function testIncrement($in, $out)
    {
        $this->assertEquals($out, Strings::increment($in));
    }

    /**
     * @dataProvider truncateExamples
     */
    public function testTruncate($in, $out, $length, $ellipsis, $breakOnWord)
    {
        $this->assertEquals($out, Strings::truncate($in, $length, $ellipsis, $breakOnWord));
    }

    public function camelCaseExamples()
    {
        return [
            ['Two Words', 'twoWords'],
            ['under_scores', 'underScores'],
            ['hyphenated-words', 'hyphenatedWords'],
            ['with, punctuation!!?', 'withPunctuation']
        ];
    }

    public function titleCaseExamples()
    {
        return [
            ['This is the happy path', 'This Is the Happy Path'],
            ['a title starting with an article', 'A Title Starting with an Article'],
            ['title ending with or', 'Title Ending with Or'],
            ['first in and around or the last', 'First in and around or the Last']
        ];
    }

    public function underscoreExamples()
    {
        return [
            ['Two Words', 'two_words'],
            ['camelCase', 'camel_case'],
            ['hyphenated-words', 'hyphenated_words'],
            ['with, punctuation!!?', 'with_punctuation']
        ];
    }

    public function incrementExamples()
    {
        return [
            ['Apple', 'Applf'],
            ['Two Words', 'Two Wordt'],
            ['Ends in space ', 'Ends in spacf'],
            ['Ends in z', 'Ends io'],
            ['zzz   z', 'zzz   za'],
            ['', 'a']
        ];
    }

    public function truncateExamples()
    {
        return [
            ['there are more', 'there are m', 11, null, false],
            ['there are more', 'there are m...', 11, '...', false],
            ['there are more', 'there are...', 11, '...', true],
            ['verylongword', '...', 1, '...', true],
            ['there are more', 'there are more', 500, null, null],
        ];
    }
}
