<?php namespace Acme\Parsers;

use Acme\Parsers\Exceptions\UnrecognizedType;

class Field {

    /**
     * Parse a string of fields into an array
     *
     * @param $fields
     * @return array|mixed
     */
    public function parse($fields)
    {
        // title:string, body:text
        $chunks = $this->splitFieldsIntoChunks($fields);
        $parsed = [];

        foreach($chunks as $chunk)
        {
            $parsed = $this->parseChunk($chunk, $parsed);
        }

        return $parsed;
    }

    /**
     * Split fields, by comma
     *
     * @param $fields
     * @return array
     */
    private function splitFieldsIntoChunks($fields)
    {
        return preg_split('/, ?/', $fields);
    }

    /**
     * Parse chunk
     *
     * @param $declaration
     * @param $parsed
     * @return mixed
     * @throws Exceptions\UnrecognizedType
     */
    private function parseChunk($declaration, $parsed)
    {
        list($property, $type) = explode(':', $declaration);

        if ( ! $this->typeIsRecognized($type))
        {
            throw new UnrecognizedType;
        }

        $parsed[ $property ] = $type;

        return $parsed;
    }

    /**
     * Is the field type recognized
     *
     * @param $type
     * @return bool
     */
    private function typeIsRecognized($type)
    {
        // If more complex, extract this to a field, above.
        return $type == 'string' or $type == 'text';
    }

}
