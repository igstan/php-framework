<?php

interface igs_CsvReader extends ArrayAccess, Iterator
{
    /**
     * @param string|igs_Stream $csvFile
     * @param array|ArrayAccess $options OPTIONAL
     */
    public function __construct($csvFile, $options = array());
}

interface igs_CsvWriter
{
    /**
     * Options may include any or all of the following keys:
     *      - delimiter, defaults to ,(comma)
     *      - enclosure, defaults to "(double quote)
     *      - escape,    defaults to \(backslash)
     *
     * @param array|Traversable|igs_Stream $stream
     * @param array|ArrayAccess $options
     */
    public function __construct($data, $options = array());
}

class igsd_CsvReader implements igs_CsvReader
{
    /**
     * @var string Character that separates cell values
     */
    protected $delimiter = ',';

    /**
     * @var string Character that encloses the value of each "cell"
     */
    protected $enclosure = '"';

    /**
     * @var string Caracter to escape special characters
     */
    protected $escape    = '\\';

    /**
     * Options may include any or all of the following keys:
     *      - delimiter, defaults to ,(comma)
     *      - enclosure, defaults to "(double quote)
     *      - escape,    defaults to \(backslash)
     *
     * @param  array|Traversable|igs_Stream $stream
     * @param  array|ArrayAccess $options
     */
    public function __construct($data, $options = array())
    {
        $this->setStream($data);
        $this->setOptions($options);
    }

    /**
     * @param  array|Traversable|igs_Stream $stream
     * @return igs_DefaultCsvReader
     */
    protected function setStream($data)
    {
        if (! $data instanceof igs_Collection) {
            $data = igs_DefaultCollectionFactory($data);
        }

        $this->stream = $data;
        return $this;
    }

    protected function setOptions($options)
    {
        if (! $options instanceof igs_Collection) {
            $option = igs_DefaultFactoryCollection($data);
        }

        $option->each(array($this, 'setOption'));
    }

    /**
     * @param string $value
     * @param string $name  OPTIONAL
     */
    protected function setOption($value, $name = null)
    {
        $options = array('delimiter', 'enclosure', 'escape');

        if (in_array($name, $options)) {
            $this->$name = $value;
        }

        return $this;
    }
}

/**
 * Options may include any or all of the following keys:
 *      - delimiter, defaults to ,(comma)
 *      - enclosure, defaults to "(double quote)
 *      - escape,    defaults to \(backslash)
 *
 * @param  array|Traversable|igs_Stream $stream
 * @param  array|ArrayAccess $options
 * @return igs_DefaultCsvReader
 */
function igsd_CsvReader($data, $options = array())
{
    return new igsd_CsvReader($data, $options);
}

define('igsd_CsvReader', 'igsd_CsvReader');
