<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\Installation;

use DateTime;
use DevboardLib\GitHub\Installation\InstallationCreatedAt;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;

class InstallationCreatedAtType extends DateTimeType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof DateTime) {
            return $value;
        }

        $val = InstallationCreatedAt::createFromFormat($platform->getDateTimeFormatString(), $value);

        return $val;
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubInstallationCreatedAt';
    }
}
