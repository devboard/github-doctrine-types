<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\Milestone;

use DevboardLib\GitHub\Milestone\MilestoneDescription;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class MilestoneDescriptionType extends TextType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return new MilestoneDescription($value);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return (string) $value;
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubMilestoneDescription';
    }
}
