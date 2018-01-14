<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class PullRequestNumberType extends IntegerType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return new PullRequestNumber((int) $value);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return $value->getId();
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubPullRequestNumber';
    }
}
