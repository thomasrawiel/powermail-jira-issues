<?php

namespace TRAW\PowermailJiraIssues\Domain\Model;

/**
 * Class Form
 * @package TRAW\PowermailJiraIssues\Domain\Model
 */
class Form extends \In2code\Powermail\Domain\Model\Form
{
    /**
     * @var string
     */
    protected string $jiraTarget;

    /**
     * @return string
     */
    public function getJiraTarget(): string
    {
        return $this->jiraTarget;
    }

    /**
     * @param string $jiraTarget
     *
     * @return void
     */
    public function setJiraTarget(string $jiraTarget): void
    {
        $this->jiraTarget = $jiraTarget;
    }
}