<?php

/**
 * Use to autoload needed classes without Composer.
 *
 * @param string $class the fully-qualified class name
 */
\spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $prefix = 'Limepie\TwitterOAuth\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = \strlen($prefix);

    if (0 !== \strncmp($prefix, $class, $len)) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = \substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . \str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (\file_exists($file)) {
        require $file;
    }
});
