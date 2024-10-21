<?php

namespace Tembo\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetVolumesCommand extends AbstractCommand {

  protected function configure() {
    $this->setName('setvolumes')
      ->setDescription('Create shared volumes for the docker images (at the moment only dump)');
  }

  function doExecute(InputInterface $input, OutputInterface $output) {
    $content = file_get_contents($this->temboDir.'/templates/docker-compose.dump.yaml');
    $content = str_replace('<<dump>>',$this->getenv('TEMBO_DUMP_DIR'),$content);
    file_put_contents('.ddev/docker-compose.dump.yaml',$content);
    return 1;
  }

}
