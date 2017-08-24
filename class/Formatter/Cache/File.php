<?php
namespace App\Formatter\Cache;

use App\Formatter;

/**
 * @inheritDoc
 */
final class File implements \App\Formatter\Cache
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * Retrieves cached output from a given path.
     *
     * @param string $path
     *
     * @return ?string
     */
    private function getFrom(string $path): ?string
    {
        if (!is_file($path)) {
            return null;
        }
        if (!$file = fopen($path, 'r')) {
            return null;
        }
        if (!flock($file, LOCK_SH)) {
            fclose($file);
            return null;
        }
        if (($output = file_get_contents($path)) === false) {
            flock($file, LOCK_UN);
            fclose($file);
            return null;
        }
        flock($file, LOCK_UN);
        fclose($file);
        return $output;
    }

    /**
     * Deletes a file or directory under a given path.
     *
     * @param string $path
     *
     * @return void
     */
    private function delete(string $path): void
    {
        if (is_file($path)) {
            unlink($path);
            return;
        }
        if (!is_dir($path)) {
            return;
        }
        foreach (scandir($path) as $file) {
            if ($file === '.') {
                continue;
            }
            if ($file === '..') {
                continue;
            }
            $this->delete("{$path}/{$file}");
        }
        rmdir($path);
    }

    /**
     * Constructor.
     *
     * @param string    $path
     * @param Formatter $formatter
     */
    public function __construct(string $path, Formatter $formatter)
    {
        $this->path      = $path;
        $this->formatter = $formatter;
    }

    /**
     * @inheritDoc
     */
    public function format(string $input): string
    {
        $base = $this->path
              . '/'
              . md5($input);
        $path = $base
              . '/'
              . md5(get_class($this->formatter));

        if (($output = $this->getFrom($path)) !== null) {
            return $output;
        }
        if (!is_dir($base)) {
            mkdir($base, 0777, true);
        }
        file_put_contents(
            $path,
            $output = $this->formatter->format($input),
            LOCK_EX
        );
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function expire(string $input): void
    {
        $this->delete($this->path . '/' . md5($input));
    }
}
