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
 *  block_moodle_test render.
 *
 * @package   block_moodle_test
 * @copyright 2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *  block_moodle_test render.
 *
 * @package   block_moodle_test
 * @copyright 2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_moodle_test_renderer extends plugin_renderer_base {
    /**
     * Block moodle test main render
     *
     * @param block_moodle_test\output\main $main
     * @return string
     */
    protected function render_main(block_moodle_test\output\main $main): string {
        $context = $main->export_for_template($this);
        return $this->render_from_template('block_moodle_test/main', $context);
    }
}
