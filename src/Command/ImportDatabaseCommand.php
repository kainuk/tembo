<?php

namespace Tembo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class ImportDatabaseCommand extends AbstractCommand {

  protected function configure() {
    $this->setName('importdatabase')
      ->setDescription('Import Database (and remove the old database)')
      ->addArgument('type',InputArgument::REQUIRED,'Type of the database (drupal|civicrm)')
      ->addArgument('file',InputArgument::REQUIRED,'File that contains the database (sql.tar) format');
  }

  public function doExecute(InputInterface $input, OutputInterface $output)
  {
    $createDropSql = <<< SQL
    drop database if exists db;
    create database if not exists db;
SQL;
    $process = Process::fromShellCommandline("ddev mysql -proot -uroot");
    $process->setInput($createDropSql);
    $this->getHelper('process')->run($output, $process);
    $fileName = $input->getArgument('file');
    $process = Process::fromShellCommandline("ddev ssh");
    $process->setInput("gunzip --stdout /dump/$fileName| sed 's/utf8mb4_0900_ai_ci/utf8mb4_unicode_ci/g' |mysql db -proot -uroot");
    $this->getHelper('process')->run($output, $process);

    return 1;
  }

}
