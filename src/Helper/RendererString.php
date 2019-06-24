<?php

class RendererString implements RenderInterface
{
    public static function render($id)
    {
        return (string) $id;
    }
}
