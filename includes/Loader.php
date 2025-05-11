<?php
spl_autoload_register(function ($class) {
    if (strpos($class, 'EventManager\\') === 0) {
        $plugin_base = plugin_dir_path(__FILE__);
        $base_dir = $plugin_base . 'PostTypes/';
        $meta_dir = $plugin_base . 'Meta/';
        $block_dir = $plugin_base . 'Blocks/';
        $settings_dir = $plugin_base . 'Settings/';

        $relative_class = substr($class, strlen('EventManager\\'));
        $path = str_replace('\\', '/', $relative_class) . '.php';
        
        $possible_paths = [
            $plugin_base . $path,
            $base_dir,
            $meta_dir,
            $block_dir,
            $settings_dir,
        ];

        foreach ($possible_paths as $file) {
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});
