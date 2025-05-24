<?php
namespace EventOps\Blocks;

class Blocks {
    protected const BLOCKS_DIR = WP_PLUGINS_DIR . '/eventops/build/blocks/';

    public function register() {
        $paths = $this->get_blocks_paths();
        foreach ($paths as $path) {
            register_block_type_from_metadata( $path );
        }
    }

    protected function get_blocks_paths(): array {
        $blocks_list = apply_filters(
            'eventos_modify_block_paths', 
            array(
                self::BLOCKS_DIR . 'event-block/',
            )
        );

        // Validate: make sure each path is a directory and has a block.json
        $valid_paths = array_filter( $blocks_list, function( $path ) {
            return is_dir( $path ) && file_exists( $path . 'block.json' );
        });
        
        return $valid_paths;
    }
}
