<?php

namespace TRAW\PowermailJiraIssues\Events;

use In2code\Powermail\Domain\Model\Mail;

/**
 * Class PowermailSubmitEvent
 * @package LINGNER\LinExperience\Events
 */
class PowermailSubmitEvent
{
    /**
     * @var Mail
     */
    protected Mail $mail;
    /**
     * @var array
     */
    protected array $settings;

    /**
     * @param Mail  $mail
     * @param array $settings
     */
    public function __construct(Mail $mail, array $settings)
    {
        $this->mail = $mail;
        $this->settings = $settings;
    }

    /**
     * @return Mail
     */
    public function getMail(): Mail
    {
        return $this->mail;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }
}