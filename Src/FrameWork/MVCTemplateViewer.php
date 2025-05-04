<?php

declare(strict_types=1);

namespace Framework;

class MVCTemplateViewer implements TemplateViewerInterface
{
    public function render(string $template, array $data = []): string
    {
        $viewsDir = dirname(__DIR__, 2).'/views/';
        $code = file_get_contents($viewsDir . "$template.mvc.php");
        if (preg_match('#^{% extends "(?<template>.*)" %}#', $code, $matches) === 1) {
            $base = file_get_contents($viewsDir . $matches['template']);
            $blocks = $this->getBlocks($code);
            $code = $this->replaceYield($base, $blocks);
        }
        $code = $this->loadIncludes($viewsDir , $code);
        $code = $this->replaceVariables($code);
        $code = $this->replacePhp($code);
        // exit($code);
        extract($data, EXTR_SKIP);
        ob_start();
        eval("?>$code");
        return ob_get_clean();
    }
    private function replaceVariables(string $code)
    {
        return preg_replace("#{{\s*(\S+)\s*}}#", "<?=htmlspecialchars(\$1 ?? '')?>", $code);
    }
    private function replacePhp(string $code)
    {
        return preg_replace("#{%\s*(.+)\s*%}#", "<?php $1 ?>", $code);
    }
    private function getBlocks(string $code)
    {
        preg_match_all("#{% block (?<name>\w+) %}(?<content>.*?){% endblock %}#s", $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $blocks[$match['name']] = $match['content'];
        }
        // var_dump($matches);
        return $blocks;
    }
    private function replaceYield(string $code, array $blocks)
    {
        preg_match_all("#{% yield (?<name>\w+) %}#s", $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $name = $match['name'];
            $block = $blocks[$name];
            $code = preg_replace("#{% yield $name %}#s", $block, $code);
        }
        return $code;
    }
    private function loadIncludes(string $dir, string $code)
    {
        preg_match_all('#{% include "(?<template>.*?)" %}#', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $template = $match['template'];
            $contents = file_get_contents($dir . $template);
            $code = preg_replace("#{% include \"$template\" %}#", $contents, $code);
        }
        return $code;
    }
}
