<?php
/**
 *  Blink Array
 */

namespace BlinkPhp;

class Data
{
    protected $data = [];

    protected $delimiter = '.';

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function setDelimiter($delimiter)
    {
        if (!is_string($delimiter)) {
            throw new \InvalidArgumentException("Invalid item delimiter.");
        }

        $this->delimiter = $delimiter;
    }

    public function get($key)
    {

    }

    protected function getData($key, array $data, $default = null)
    {
        list($index, $key) = $this->getDelimitedKey($key);

        if (array_key_exists($index, $data)) {
            if (is_array($data[$index])) {
                return $this->getData($key, $data[$index], $default);
            } else {
                return $data[$index];
            }
        } else {
            return $default;
        }
    }

    /**
     * Get delimited key
     *
     * Returns an array that contains the fis
     *
     * @param $key
     * @return array
     */
    protected function getDelimitedKey($key)
    {
        // Base case
        if (strpos($key, $this->delimiter) === false) {
            return [
                $key,
                ''
            ];
        }

        // The first delimited index
        $nextIndex = substr(
            $key,
            0,
            strpos($key, $this->delimiter)
        );

        // Remainder of key after first index
        $remainder = substr(
            $key,
            strpos($key, $this->delimiter)
        );

        return [
            $nextIndex,
            $remainder
        ];
    }
}
