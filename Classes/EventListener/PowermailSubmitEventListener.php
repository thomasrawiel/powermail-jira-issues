<?php

namespace TRAW\PowermailJiraIssues\EventListener;

use TRAW\PowermailJiraIssues\Events\PowermailSubmitEvent;

class PowermailSubmitEventListener
{
    public function __invoke(PowermailSubmitEvent $event)
    {
        //do stuff
    }
}