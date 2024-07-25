<?php

namespace TRAW\PowermailJiraIssues\Service;

use DH\Adf\Node\Block\Document;
use In2code\Powermail\Domain\Model\Answer;
use JiraCloud\ADF\AtlassianDocumentFormat;
use JiraCloud\Issue\IssueField;
use TRAW\PowermailJiraIssues\Configuration\JiraConfiguration;
use TRAW\PowermailJiraIssues\Events\PowermailSubmitEvent;

/**
 * Class IssueService
 * @package TRAW\PowermailJiraIssues\Service
 */
class IssueService
{
    /**
     * @var JiraConfiguration|null
     */
    protected JiraConfiguration|null $jiraConfiguration = null;

    /**
     * @param JiraConfiguration $jiraConfiguration
     */
    public function __construct(JiraConfiguration $jiraConfiguration)
    {
        $this->jiraConfiguration = $jiraConfiguration;
    }

    /**
     * @param PowermailSubmitEvent $event
     *
     * @return IssueField
     * @throws \Exception
     */
    public function createIssue(PowermailSubmitEvent $event): IssueField
    {
        $mail = $event->getMail();
        $uri = $event->getUri();
        $url = $uri->getScheme() . '://' . $uri->getHost() . $uri->getPath();
        $answers = $mail->getAnswers();
        $configuration = $this->jiraConfiguration->getConfigurationByKey($mail->getForm()->getJiraTarget());

        if (empty($configuration)) {
            throw new \Exception('No configuration for this board');
        }

        $doc = new Document();

        foreach ($answers as $answer) {
            $doc->paragraph()
                ->strong($answer->getField()->getTitle())
                ->end();
            switch ($answer->getValueType()) {
                case Answer::VALUE_TYPE_UPLOAD:
                case Answer::VALUE_TYPE_ARRAY:
                    foreach ($answer->getValue() as $uploadedFile) {
                        $doc->paragraph()->text($uploadedFile)->end();
                    }
                    break;
                default:
                    $doc->paragraph()->text($answer->getValue())->end();
            }

        }
        $doc->paragraph()->em('- - - This issue has been automatically created - - -')->end();
        $doc->paragraph()->em('URL: ' . $url)->end();

        $issueField = (new IssueField())->setProjectKey($configuration['project_key'])
            ->setSummary($configuration['subject'] ?? $mail->getSubject())
            ->setAssigneeToDefault()
            ->setPriorityNameAsString($configuration['priority'] ?? 'Medium')
            ->setIssueTypeAsString($configuration['type'] ?? 'Task')
            ->setDescription(new AtlassianDocumentFormat($doc));

        return $issueField;
    }
}