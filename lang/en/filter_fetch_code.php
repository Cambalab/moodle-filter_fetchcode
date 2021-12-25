<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     filter_fetch_code
 * @category    string
 * @copyright   2022 Cambá <info@camba.coop>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Fetch Code';
$string['cdn'] = 'Use CDN';
$string['cdn_desc'] = 'Use CDN library for stylesheets. This may be faster than loading the files locally,
                        but you may prefer loading the files locally for GDPR reasons.';
$string['allowexternalsource'] = 'Use anything source';
$string['allowexternalsource_desc'] = 'Allow use external source ,if not only work from Gitlab and Github official repo';
