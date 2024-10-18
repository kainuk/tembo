<?php

namespace Tembo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDatabaseCommand extends Command {

  protected function configure() {
    $this->setName('importdatabase')
      ->setDescription('Import Database (and remove the old database)')
      ->addArgument('type',InputArgument::REQUIRED,'Type of the database (drupal|civicrm)')
      ->addArgument('file',InputArgument::REQUIRED,'File that contains the database (sql.tar) format');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('This command is not really implemented (however we work on it');
    return 1;
  }

}
