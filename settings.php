<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings for fetch and highlight code.
 *
 * @package   filter_fetch_code
 * @author    Camba Coop <info@camba.coop>
 * @copyright 2020 Camba Coop {@link https://www.camba.coop}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    $setting = new admin_setting_configcheckbox('filter_fetch_code/cdn',
                                        new lang_string('cdn', 'filter_fetch_code'),
                                        new lang_string('cdn_desc', 'filter_fetch_code'),
                                        0);
    $settings->add($setting);

    $setting = new admin_setting_configcheckbox('filter_fetch_code/allowexternalsource',
                                       new lang_string('allowexternalsource', 'filter_fetch_code'),
                                       new lang_string('allowexternalsource_desc', 'filter_fetch_code'),
                                       0);

    $settings->add($setting);
}
