<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\Branch;

use DevboardLib\Git\Branch\BranchName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class BranchNameType extends Type
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL(['length' => '255']);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return new BranchName($value);
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
        return 'GitHubBranchName';
    }
}
