<?php

class QuoteRendererString implements QuoteRenderInterface
{
    public static function render(Quote $quote)
    {
        return (string) $quote->getId();
    }
}
