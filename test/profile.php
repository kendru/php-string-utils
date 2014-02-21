<?php
namespace Kendru\Util;

require_once 'vendor/autoload.php';

class Profiler
{
	private $methods;
	private $args;
	private $trials;
	private $records = [];

	public function __construct(array $methods = [], array $args = [], $trials = 100000)
	{
		$this->methods = $methods;
		$this->args = $args;
		$this->trials = $trials;
	}

	public function run()
	{
		foreach ($this->methods as $method) {
			$this->performTrials($method);
		}
		$this->reportWinner();
	}

	public function performTrials($method)
	{
		$start = microtime(true);
		for ($i = 0; $i < $this->trials; $i++) {
			call_user_func_array(['\Kendru\Util\Strings', $method], $this->args);
		}
		$end = microtime(true);

		echo "Completed $method in " . ($end - $start) . " seconds\n";
		$this->records[$method] = $end - $start;
	}

	public function reportWinner()
	{
		$lowestTime = null;
		$lowestTimeMethod = null;

		foreach($this->records as $method => $time) {
			if (is_null($lowestTime) || $time < $lowestTime) {
				$lowestTime = $time;
				$lowestTimeMethod = $method;
			}
		}

		echo "Fastest method:\t$lowestTimeMethod ($lowestTime)\n";
	}
}

list($_, $methods, $args, $trials) = $argv;
$methods = explode(',', $methods);
$args = explode(',', $args);
$profiler = new Profiler($methods, $args, $trials);
$profiler->run();

