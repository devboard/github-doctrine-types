<?php

declare(strict_types=1);

namespace DevboardLib\GitHubDoctrineType\PullRequest;

use Devboard\GitHubPullRequest\Core\GitHubPullRequestRootId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class PullRequestRootIdType extends Type
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL(['length' => '40']);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return new GitHubPullRequestRootId($value);
    }

    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
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
        return 'GitHubPullRequestRootId';
    }
}
