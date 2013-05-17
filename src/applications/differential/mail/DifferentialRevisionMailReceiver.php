<?php

final class DifferentialRevisionMailReceiver
  extends PhabricatorObjectMailReceiver {

  public function isEnabled() {
    $app_class = 'PhabricatorApplicationDifferential';
    return PhabricatorApplication::isClassInstalled($app_class);
  }

  protected function getObjectPattern() {
    return 'D[1-9]\d*';
  }

  protected function loadObject($pattern, PhabricatorUser $viewer) {
    $id = (int)trim($pattern, 'D');

    $results = id(new DifferentialRevisionQuery())
      ->setViewer($viewer)
      ->withIDs(array($id))
      ->execute();

    return head($results);
  }


}