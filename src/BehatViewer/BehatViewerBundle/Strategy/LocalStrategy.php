<?php
namespace BehatViewer\BehatViewerBundle\Strategy;

use
	BehatViewer\BehatViewerBundle\Strategy\Form\Type\LocalStrategyType,
	Symfony\Component\Console\Output\ConsoleOutput
;

class LocalStrategy extends Strategy
{
	public function getId() {
		return 'local';
	}

	public function getLabel() {
		return 'Local directory';
	}

	public function getForm() {
		return new LocalStrategyType();
	}
	
	public function build() {
		$project = $this->getProject();

		$cmd = $project->getTestCommand();
		$cmd = str_replace("\r\n", PHP_EOL, $cmd);
		$path = $project->getConfiguration()->path;

		if (file_exists($path . DIRECTORY_SEPARATOR . 'build.sh')) {
			unlink($path . DIRECTORY_SEPARATOR . 'build.sh');
		}
		$fp = fopen($path . DIRECTORY_SEPARATOR . 'build.sh', 'w+');
		$script = '#!/bin/sh' . PHP_EOL . $cmd;
		fwrite($fp, $script, strlen($script));
		fclose($fp);

		$output = new ConsoleOutput();
		$process = new \BehatViewer\BehatViewerBundle\Process\UnbefferedProcess(
			'sh -e build.sh',
			$path
		);
		$process->setTimeout(600);
		$status = $process->run(function ($type, $buffer) use (&$output) {
			if ('err' === $type) {
				$output->writeln('<error>' . $buffer . '</error>');
			} else {
				$output->write($buffer);
			}
		});

		if (file_exists('build.sh')) {
			unlink('build.sh');
		}

		return $status;
	}
}
