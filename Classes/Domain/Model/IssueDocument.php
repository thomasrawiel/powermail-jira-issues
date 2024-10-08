<?php

namespace TRAW\PowermailJiraIssues\Domain\Model;

use DH\Adf\Node\Block\Document;
use In2code\Powermail\Domain\Model\Answer;
use JiraCloud\ADF\AtlassianDocumentFormat;
use TRAW\PowermailJira\Domain\Model\IssueDocumentInterface;
use TRAW\PowermailJira\Events\PowermailSubmitEvent;

/**
 * Class IssueDocument
 */
class IssueDocument implements IssueDocumentInterface
{
    /**
     * @param PowermailSubmitEvent $event
     *
     * @return AtlassianDocumentFormat
     */
    public function getDescriptionForIssue(PowermailSubmitEvent $event)
    {
        $uri = $event->getUri();
        $url = $uri->getScheme() . '://' . $uri->getHost() . $uri->getPath();
        $answers = $event->getMail()->getAnswers();

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

        return new AtlassianDocumentFormat($doc);
    }
}
