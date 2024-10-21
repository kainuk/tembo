<?php
/**
 * @author Klaas Eikelboom  <klaas.eikelboom@civicoop.org>
 * @date 18-Jun-2020
 * @license  AGPL-3.0
 */

namespace Tembo\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CopyConfigCommand extends AbstractCommand{

  protected function configure() {
    $this->setName('copyconfig')
      ->setDescription('Copy Configuration Files')
      ->addArgument('template',InputArgument::REQUIRED,'What template must by copied');
  }

  public function doExecute(InputInterface $input, OutputInterface $output)
  {
    $template = $input->getArgument('template');
    switch ($template) {
      case 'drupal' :
        copy($this->temboDir . '/templates/settings.php', './web/sites/default/settings.php');
        $output->writeln('Just copied the drupal settings file');
        break;
      case 'civicrm' :
      case 'civi' :
        copy($this->temboDir . '/templates/civicrm.settings.php', './web/sites/default/civicrm.settings.php');
        $output->writeln('Just copied the drupal settings file');
        break;
      default :
        $output->writeln('Very unknown template');
    }
    return 1; //success
  }




}
