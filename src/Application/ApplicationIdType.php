<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\Application;

use DevboardLib\GitHub\Application\ApplicationId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class ApplicationIdType extends IntegerType
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return new ApplicationId((int) $value);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return $value->getValue();
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubApplicationId';
    }
}
