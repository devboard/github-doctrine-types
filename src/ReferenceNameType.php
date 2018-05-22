<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Tag\TagName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use RuntimeException;

class ReferenceNameType extends Type
{
    const SEPARATOR = ':';

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL(['length' => '255']);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $pattern = sprintf('/^(?<type>[0-9a-zA-Z]+)%s(?<id>.+)$/', self::SEPARATOR);

        if (preg_match($pattern, $value, $matches)) {
            if (BranchName::TYPE === $matches['type']) {
                return new BranchName($matches['id']);
            } elseif (TagName::TYPE === $matches['type']) {
                return new TagName($matches['id']);
            } else {
                throw new RuntimeException('Unknown ReferenceName '.$value.'!');
            }
        }

        throw new RuntimeException('ReferenceName '.$value.' not parsable');
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return sprintf('%s%s%s', $value::TYPE, self::SEPARATOR, $value->__toString());
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'GitHubReferenceName';
    }
}
