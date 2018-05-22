<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class PullRequestAssigneeCollectionType extends TextType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return PullRequestAssigneeCollection::deserialize(json_decode($value, true));
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
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
        return 'GitHubPullRequestAssigneeCollection';
    }
}
