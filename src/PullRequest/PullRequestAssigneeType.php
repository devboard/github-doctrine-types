<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class PullRequestAssigneeType extends TextType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return PullRequestAssignee::deserialize(json_decode($value, true));
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return json_encode($value->serialize());
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubPullRequestAssignee';
    }
}
