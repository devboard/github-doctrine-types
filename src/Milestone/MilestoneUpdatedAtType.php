<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\Milestone;

use DateTime;
use DevboardLib\GitHub\Milestone\MilestoneUpdatedAt;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;

class MilestoneUpdatedAtType extends DateTimeType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof DateTime) {
            return $value;
        }

        $val = MilestoneUpdatedAt::createFromFormat($platform->getDateTimeFormatString(), $value);

        if (!$val) {
            $val = date_create($value);
        }

        if (!$val) {
            throw ConversionException::conversionFailedFormat(
                $value, $this->getName(), $platform->getDateTimeFormatString()
            );
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
        return 'GitHubMilestoneUpdatedAt';
    }
}
