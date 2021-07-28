<?php
declare(strict_types=1);

namespace degordian\wpHelpers;

class FlexibleLayoutRenderer
{
    private string $basePath = '';

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return void|string
     */
    public function render($data)
    {
        $index = 0;
        foreach ($data as $layout) {
            get_partial(
                $this->getPartialPath($layout['acf_fc_layout']),
                array_merge(
                    $layout,
                    [
                        'index' => $index,
                        'section' => $layout
                    ]
                )
            );
        }
    }

    private function getPartialPath(string $partialName): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $partialName;
    }
}
