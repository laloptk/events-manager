<?php
/**
 * Plugin Name: EventOps
 * Description: OOP-based plugin with CPT, meta fields, and Gutenberg block.
 * Version: 1.0
 * Author: Eduardo Sanchez Hidalgo
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/Loader.php';

use EventOps\EventOpsPlugin;
function eventops_load_textdomain() {
    load_plugin_textdomain('event-ops', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('init', 'eventops_load_textdomain');

EventOpsPlugin::get_instance();

function filter_event_query_by_status( $args, $request ) {
    if ( ! isset( $request['event_status'] ) ) {
        return $args;
    }

    $status = $request['event_status'];
    $today = date( 'Y-m-d' );
    $now = strtotime( $today );

    switch ( $status ) {
        case 'upcoming':
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => $today,
                'compare' => '>',
                'type'    => 'DATE',
            ];
            break;

        case 'past':
            $args['meta_query'][] = [
                'key'     => '_event_ops_end_date',
                'value'   => $today,
                'compare' => '<',
                'type'    => 'DATE',
            ];
            break;

        case 'today':
            $args['meta_query'][] = [
                'relation' => 'AND',
                [
                    'key'     => '_event_ops_start_date',
                    'value'   => $today,
                    'compare' => '<=',
                    'type'    => 'DATE',
                ],
                [
                    'key'     => '_event_ops_end_date',
                    'value'   => $today,
                    'compare' => '>=',
                    'type'    => 'DATE',
                ],
            ];
            break;

        case 'this-week':
            $start = date( 'Y-m-d', strtotime( 'monday this week', $now ) );
            $end   = date( 'Y-m-d', strtotime( 'sunday this week', $now ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => [ $start, $end ],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
            break;

        case 'next-weekend':
            $start = date( 'Y-m-d', strtotime( 'saturday next week', $now ) );
            $end   = date( 'Y-m-d', strtotime( 'sunday next week', $now ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => [ $start, $end ],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
            break;

        case 'next-month':
            $start = date( 'Y-m-01', strtotime( 'first day of next month' ) );
            $end   = date( 'Y-m-t', strtotime( 'last day of next month' ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => [ $start, $end ],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
            break;

        case 'recent':
            $start = date( 'Y-m-d', strtotime( '-30 days', $now ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => [ $start, $today ],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
            break;

        case 'soon':
            $end = date( 'Y-m-d', strtotime( '+7 days', $now ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => [ $today, $end ],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
            break;

        case 'next-seven-days': // NEW STATUS
            $end = date( 'Y-m-d', strtotime( '+7 days', $now ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => [ $today, $end ],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
            break;

        case 'distant':
            $start = date( 'Y-m-d', strtotime( '+3 months', $now ) );
            $args['meta_query'][] = [
                'key'     => '_event_ops_start_date',
                'value'   => $start,
                'compare' => '>=',
                'type'    => 'DATE',
            ];
            break;

        case 'all':
        default:
            // No filter applied
            break;
    }

    return $args;
}
add_filter( 'rest_event_query', 'filter_event_query_by_status', 10, 2 );


