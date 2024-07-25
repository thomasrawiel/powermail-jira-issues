<?php

namespace TRAW\PowermailJiraIssues\Validation;

/**
 * Class Validation
 * @package TRAW\PowermailJiraIssues\Validation
 */
class Validation
{
    /**
     * @param string $key
     * @param array  $configuration
     *
     * @return bool
     * @throws \Exception
     */
    public static function validateConfiguration(string $key, array $configuration): bool
    {
        extract($configuration);

        if (empty($label)) {
            throw new \Exception('Label is required');
        }
        if (empty($project_key)) {
            throw new \Exception('Project key is required');
        }
        if (empty($key)) {
            throw new \Exception('Configuration Key is required');
        }
        if (strlen($key) > 20) {
            throw new \Exception('Configuration key is too long (max 20 chars)');
        }

        return true;
    }
}