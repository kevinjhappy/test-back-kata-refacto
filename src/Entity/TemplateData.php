<?php

final class TemplateData implements TemplateDataAttributeInterface
{
    private $templateText;

    public function __construct($templateText)
    {
        $this->templateText = $templateText;
    }

    public function check($attributeName)
    {
        return strpos($this->templateText, $attributeName) !== false;
    }

    private function setAttribute($attributeName, $attributeValue)
    {
        $this->templateText = str_replace($attributeName , $attributeValue, $this->templateText);
    }

    public function replaceAttributeNameToValue($attributeName, $attributeValue)
    {
        if ($this->check($attributeName)) {
            $this->setAttribute($attributeName, $attributeValue);
        }
    }

    public function getTemplateData()
    {
        return $this->templateText;
    }
}
