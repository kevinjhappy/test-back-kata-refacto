<?php

class TemplateData
{
    const QUOTE_SUMMARY_HTML = '[quote:summary_html]';
    const QUOTE_SUMMARY = '[quote:summary]';
    const QUOTE_DESTINATION_NAME = '[quote:destination_name]';
    const QUOTE_DESTINATION_LINK = '[quote:destination_link]';
    const USER_FIRST_NAME = '[user:first_name]';

    private $templateText;

    public function __construct($templateText)
    {
        $this->templateText = $templateText;
    }

    private function check($attributeName)
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
