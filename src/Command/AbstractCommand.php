<?php

namespace Tembo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Process\Process;

abstract class AbstractCommand extends Command {

  protected $temboDir;

  /**
   * @param $temboDir
   */
  public function __construct($temboDir) {
    parent::__construct();
    $this->temboDir = $temboDir;
  }

  protected function getenv($variable){
    return $_ENV[$variable];
  }

  abstract function doExecute(InputInterface $input, OutputInterface $output);

  public function execute(InputInterface $input, OutputInterface $output)
  {
    if (!is_dir('.ddev')){
      $output->writeln('Tembo must run in a DDEV project (recognized by a .ddev subdirectory)');
      return 2;
    }
    return $this->doExecute($input, $output);
  }


}
