<?php

namespace Core;

/**
 * View
 *
 * PHP version 5.4
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem('../App/Views');

            $twig = new \Twig_Environment($loader, array('debug' => true));
            // Added Debug
            $twig->addExtension(new \Twig_Extension_Debug());

            // Add cast to object feature
            $twig->addFilter( new \Twig_SimpleFilter('cast_to_array', function ($stdClassObject) {
                $response = array();
                foreach ($stdClassObject as $key => $value) {
                    $response[] = array($key, $value);
                }
                return $response;
            }));
        }

        echo $twig->render($template, $args);
    }
}
