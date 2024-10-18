<?php

namespace Tembo;

use Symfony\Component\Console\Application as SymfonyApplication;

class Application extends SymfonyApplication{

  /**
   * @param $temboDir
   */
  public function __construct($temboDir) {
    parent::__construct('Tembo - Common tools for development environments', 'v1.0');
    $this->temboDir = $temboDir;
    $this->add(new \Tembo\Command\CopyConfigCommand($temboDir));
    $this->add(new \Tembo\Command\ImportDatabaseCommand());
  }

}
