<?php

declare(strict_types=1);

namespace Devboard\GitHub\DoctrineTypes\Repo;

use Devboard\GitHub\Repo\GitHubRepoUpdatedAt;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;

class GitHubRepoUpdatedAtType extends DateTimeType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof \DateTime) {
            return $value;
        }

        $val = GitHubRepoUpdatedAt::createFromFormat($platform->getDateTimeFormatString(), $value);

        if (!$val) {
            $val = date_create($value);
        }

        if (!$val) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getDateTimeFormatString());
        }

        return $val;
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubRepoUpdatedAt';
    }
}
