<?php

interface TemplateManagerInterface
{
    public function getTemplateComputed(Template $tpl, array $data);
}
