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

	public function camelCaseExamples()
	{
		return [
			['Two Words', 'twoWords'],
			['under_scores', 'underScores'],
			['hyphenated-words', 'hyphenatedWords'],
			['with, punctuation!!?', 'withPunctuation']
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
}
