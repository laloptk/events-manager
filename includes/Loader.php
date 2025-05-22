<?php
spl_autoload_register(function ($class) {

    if (strpos($class, 'EventOps\\') === 0) {
        $plugin_base = plugin_dir_path(__FILE__);
        $base_dir = $plugin_base . 'PostTypes/';
        $meta_dir = $plugin_base . 'Meta/';
        $block_dir = $plugin_base . 'Blocks/';
        $settings_dir = $plugin_base . 'Settings/';
        $custom_metabox_dir = $plugin_base . 'MetaBox/Event/';

        $relative_class = substr($class, strlen('EventOps\\'));
        $path = str_replace('\\', '/', $relative_class) . '.php';
        
        $possible_paths = [
            $plugin_base . $path,
            $base_dir . $path,
            $meta_dir . $path,
            $block_dir . $path,
            $settings_dir . $path,
            $custom_metabox_dir . $path,
        ];

        foreach ($possible_paths as $file) {
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});
