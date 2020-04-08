<?php declare(strict_types=1);

namespace PHPImageOptim;

use Exception;
use PHPImageOptim\Tools\ToolsInterface;

class PHPImageOptim
{
    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * @var ToolsInterface[]
     */
    protected $chainedCommands = [];

    /**
     * @param string $imagePath
     * @throws Exception
     * @return PHPImageOptim
     */
    public function setImage(string $imagePath = ''): PHPImageOptim
    {
        if (false === file_exists($imagePath)) {
            throw new Exception('Image doesn\'t exist.');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @param ToolsInterface $object
     * @param bool $stopIfFail
     * @return PHPImageOptim
     */
    public function chainCommand(ToolsInterface $object, bool $stopIfFail = true): PHPImageOptim
    {
        $object->setStopOnFailure($stopIfFail);
        $this->chainedCommands[$object->getCompatibleImageFormat()][get_class($object)] = $object;
        return $this;
    }

    /**
     * @throws Exception
     * @return int
     */
    public function getFileSizeInBytes(): int
    {
        $fileSize = filesize($this->imagePath);

        if (false === $fileSize) {
            throw new Exception('Unable to file-size of: ' . $this->imagePath);
        }
    }

    /**
     * @return bool
     */
    public function optimise(): bool
    {
        $fileType = strtolower(pathinfo($this->imagePath, PATHINFO_EXTENSION));

        foreach ($this->chainedCommands[$fileType] as $chainedCommand) {
            $chainedCommand->setImagePath($this->imagePath);
            $chainedCommand->optimise();
        }

        return true;
    }

    /**
     * @return array<string, string>
     */
    public function getVersions(): array
    {
        $versions = [];
        foreach ($this->chainedCommands as $formats) {
            foreach ($formats as $chainedCommand) {
                $versions[get_class($chainedCommand)] = $chainedCommand->getVersion();
            }
        }

        return $versions;
    }
}
