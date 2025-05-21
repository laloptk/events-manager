<?php
namespace EventOps\Settings;

/**
 * Class SettingsPage
 * @package EventOps\SettingsPage
 */
class SettingsPage extends AbstractSettings {
    protected function get_settings_page(): string {
        return 'em_settings_page';
    }

    protected function get_settings(): array {
        return [
            'event_manager_setting_1',
            'event_manager_setting_2',
            'event_manager_setting_3',
        ];
    }
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Event Manager Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields($this->get_settings_page());
                do_settings_sections($this->get_settings_page());
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}