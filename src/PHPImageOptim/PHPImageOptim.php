<?php

namespace PHPImageOptim;

use Exception;

class PHPImageOptim
{
    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * @var array
     */
    protected $chainedCommands = [];

    /**
     * @param string $imagePath
     * @return PHPImageOptim
     * @throws Exception
     */
    public function setImage(string $imagePath = ''): PHPImageOptim
    {
        if (!file_exists($imagePath)) {
            throw new Exception('Image doesn\'t exist.');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @param $object
     * @return PHPImageOptim
     */
    public function chainCommand($object): PHPImageOptim
    {
        $this->chainedCommands[] = $object;
        return $this;
    }

    /**
     * @return bool
     */
    public function optimise(): bool
    {
        foreach ($this->chainedCommands as $chainedCommand) {
            $chainedCommand->determinePreOptimisedFileSize();
            $chainedCommand->setImagePath($this->imagePath);
            $chainedCommand->optimise();
            $chainedCommand->determinePostOptimisedFileSize();
        }

        return true;
    }
}
