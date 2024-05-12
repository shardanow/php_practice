<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private string $templatePath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function render(string $template, array $data = []): string
    {
        $templatePath = $this->getFullTemplatePath($template);

        if (!file_exists($templatePath)) {
            throw new \Exception("Template file in {$templatePath} not found");
        }

        extract($data);

        ob_start();
        require $templatePath;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function getFullTemplatePath($template): string
    {
        return $this->templatePath . "/" . $template . ".php";
    }
}