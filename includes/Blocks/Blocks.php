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
        
        return $blocks_list;
    }
}
