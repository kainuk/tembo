<?php

namespace Tembo;

use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Dotenv\Dotenv;

class Application extends SymfonyApplication{

  /**
   * @param $temboDir
   */
  public function __construct($temboDir) {
    parent::__construct('Tembo - Common tools for development environments', 'v1.0');
    (new Dotenv())->load($temboDir.'/.env');
    $this->temboDir = $temboDir;
    $this->add(new \Tembo\Command\CopyConfigCommand($temboDir));
    $this->add(new \Tembo\Command\ImportDatabaseCommand($temboDir));
  }

}
