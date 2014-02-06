<?php
namespace Kendru\Util;

class StringsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider incrementExamples
     */
    public function testIncrement($in, $out)
    {
	$this->assertEquals($out, Strings::increment($in));
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
