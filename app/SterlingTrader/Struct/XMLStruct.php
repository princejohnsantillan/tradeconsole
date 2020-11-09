<?php

namespace App\SterlingTrader\Struct;

use SimpleXMLElement;

abstract class XMLStruct
{
    public function __construct($data)
    {
        $this->register($data);
    }

    public static function build($data)
    {
        return new static($data);
    }

    /**
     * @param  string|array $data
     * @return void
     */
    private function register($data)
    {
        $data = is_array($data) ? $data : json_decode($data, true);

        foreach ($data as $key => $value) {
            if (isset($this->{$key})) {
                $this->{$key} = $value;
            }
        }

        $this->computeProperties();
    }

    public function asXML()
    {
        $root = $this->root();

        $xml = new SimpleXMLElement("<$root />");

        foreach (get_object_vars($this) as $key => $val) {
            if ($val === null) {
                continue;
            }

            $xml->addChild($key, $val);
        }

        return $xml->asXML();
    }

    protected function computeProperties()
    {
        //NOTE: Trigger computed properties here.
    }

    abstract public function root(): string;
}
