<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\Issue;

use DateTime;
use DevboardLib\GitHub\Issue\IssueCreatedAt;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;

class IssueCreatedAtType extends DateTimeType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof DateTime) {
            return $value;
        }

        $val = IssueCreatedAt::createFromFormat($platform->getDateTimeFormatString(), $value);

        return $val;
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubIssueCreatedAt';
    }
}
