<?php

namespace TRAW\PowermailJiraIssues\Finisher;

use TRAW\PowermailJiraIssues\Events\PowermailSubmitEvent;
use TYPO3\CMS\Core\EventDispatcher\EventDispatcher;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SubmitFormFinisher extends \In2code\Powermail\Finisher\AbstractFinisher
{
    public function myFinisher()
    {
        $mail = $this->getMail();
        $eventDispatcher = GeneralUtility::makeInstance(EventDispatcher::class);
        $eventDispatcher->dispatch(new PowermailSubmitEvent($mail, $this->getSettings()));
    }
}