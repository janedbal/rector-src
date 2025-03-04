<?php

declare(strict_types=1);

namespace Rector\Tests\PSR4\Rector\Namespace_\MultipleClassFileToPsr4ClassesRector;

use Iterator;
use Nette\Utils\FileSystem;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class MultipleClassFileToPsr4ClassesRectorTest extends AbstractRectorTestCase
{
    /**
     * @param AddedFileWithContent[] $expectedFilePathsWithContents
     */
    #[DataProvider('provideData')]
    public function test(
        string $originalFilePath,
        array $expectedFilePathsWithContents,
        int $expectedRemovedFileCount
    ): void {
        $this->doTestFile($originalFilePath);

        $addedFileCount = $this->removedAndAddedFilesCollector->getAddedFileCount();

        $this->assertCount($addedFileCount, $expectedFilePathsWithContents);
        $this->assertFilesWereAdded($expectedFilePathsWithContents);

        $this->assertSame($expectedRemovedFileCount, $this->removedAndAddedFilesCollector->getRemovedFilesCount());
    }

    /**
     * @return Iterator<mixed>
     */
    public static function provideData(): Iterator
    {
        // source: https://github.com/nette/utils/blob/798f8c1626a8e0e23116d90e588532725cce7d0e/src/Utils/exceptions.php
        $filePathsWithContents = [
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/RegexpException.php',
                FileSystem::read(__DIR__ . '/Expected/RegexpException.php')
            ),
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/UnknownImageFileException.php',
                FileSystem::read(__DIR__ . '/Expected/UnknownImageFileException.php')
            ),
        ];
        yield [__DIR__ . '/Fixture/nette_exceptions.php.inc', $filePathsWithContents, 1];

        $filePathsWithContents = [
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/MyTrait.php',
                FileSystem::read(__DIR__ . '/Expected/MyTrait.php')
            ),
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/ClassTraitAndInterface.php',
                FileSystem::read(__DIR__ . '/Expected/ClassTraitAndInterface.php')
            ),
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/MyInterface.php',
                FileSystem::read(__DIR__ . '/Expected/MyInterface.php')
            ),
        ];

        yield [__DIR__ . '/Fixture/class_trait_and_interface.php.inc', $filePathsWithContents, 1];

        $filePathsWithContents = [
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/ClassMatchesFilenameException.php',
                FileSystem::read(__DIR__ . '/Expected/ClassMatchesFilenameException.php')
            ),
            new AddedFileWithContent(
                self::getFixtureTempDirectory() . '/ClassMatchesFilename.php',
                FileSystem::read(__DIR__ . '/Expected/ClassMatchesFilename.php')
            ),
        ];

        yield [__DIR__ . '/Fixture/ClassMatchesFilename.php.inc', $filePathsWithContents, 1];
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
