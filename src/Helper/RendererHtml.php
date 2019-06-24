<?php

class RendererHtml implements RenderInterface
{
    public static function render($id)
    {
        return '<p>' . $id . '</p>';
    }
}
