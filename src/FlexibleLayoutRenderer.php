<?php
/**
 * Created by PhpStorm.
 * Date: 16/05/2017
 * Time: 12:29
 */

namespace app\helpers;


class FlexibleLayoutRenderer
{
    private $basePath = '';

    /**
     * FlexibleLayoutRenderer constructor.
     * @param string $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function render($data)
    {
        $index = 0;
        foreach ($data as $layout) {
            get_partial(
                $this->getPartialPath($layout['acf_fc_layout']),
                array_merge(
                    $layout,
                    [
                        'index' => $index
                    ]
                )
            );
        }
    }

    private function getPartialPath($partialName)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $partialName;
    }


}