<?php
namespace EventOps\Blocks;

class Blocks {
    public function register() {
        $paths = $this->get_blocks_paths();
        foreach ($paths as $path) {
            register_block_type_from_metadata( $path );
        }
    }

    protected function get_blocks_paths(): array {
        // Assuming the blocks are located in the 'build/blocks/' directory of the plugin
        $blocks_path = WP_PLUGIN_DIR . '/eventops/build/blocks/';
        $blocks_list = apply_filters(
            'eventos_modify_block_paths', 
            array(
                $blocks_path . 'event-block/',
            )
        );

        // Validate: make sure each path is a directory and has a block.json
        $valid_paths = array_filter( $blocks_list, function( $path ) {
            return is_dir( $path ) && file_exists( $path . 'block.json' );
        });
        
        return $valid_paths;
    }
}
