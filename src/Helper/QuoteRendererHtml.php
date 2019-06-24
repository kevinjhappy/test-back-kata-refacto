<?php

class QuoteRendererHtml implements QuoteRenderInterface
{
    public static function render(Quote $quote)
    {
        return '<p>' . $quote->getId() . '</p>';
    }


}
