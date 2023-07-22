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
 * Moodle test block Unit test
 *
 * @package    block_moodle_test
 * @copyright  2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_moodle_test\api;

defined('MOODLE_INTERNAL') || die();
global $CFG;

/**
 * Moodle test block Unit test class
 *
 * @package    block_moodle_test
 * @copyright  2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_m_test extends advanced_testcase {
    /**
     * Test activities list
     *
     * @return void
     */
    public function test_activities_list() {
        $this->resetAfterTest();
        $course = $this->getDataGenerator()->create_course(['enablecompletion' => 1]);
        $user = $this->getDataGenerator()->create_and_enrol($course);
        $page1 = $this->getDataGenerator()->create_module('page', ['course' => $course->id],
        ['completion' => 2, 'completionview' => 1]);
        $page2 = $this->getDataGenerator()->create_module('page', ['course' => $course->id],
        ['completion' => 2, 'completionview' => 1]);
        // Complete page 1 activity.
        $cm = get_coursemodule_from_instance('page', $page1->id);
        $context = \context_module::instance($page1->cmid);
        $this->setUser($user);
        page_view($page1, $course, $cm, $context);
        // Not complete page 2 activity.
        $status = api::is_activity_completed($user->id, $cm->id);
        $this->assertEquals(true, $status);
        $cm = get_coursemodule_from_instance('page', $page2->id);
        $status = api::is_activity_completed($user->id, $cm->id);
        $this->assertEquals(false, $status);
    }
}
