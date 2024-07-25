<?php
defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(\TRAW\PowermailJiraIssues\Domain\Model\Form::TABLE_NAME, [
    'jira_target' => [
        'label' => 'Jira Configuration',
        'description' => '',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => '', 'value' => ''],
            ],
            'default' => '',
            'itemsProcFunc' => \TRAW\PowermailJiraIssues\Configuration\JiraConfiguration::class . '->loadJiraConfigurationForTCA',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
    ],
]);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    \TRAW\PowermailJiraIssues\Domain\Model\Form::TABLE_NAME,
    'jira_target',
    '',
    'after:pages'
);