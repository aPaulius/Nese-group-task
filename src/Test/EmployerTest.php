<?php

namespace src\Test;

require_once("./src/Employer.php");
use src\Employer;

class EmployerTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function test_file_destination_exists() {
        $employer = new Employer("./src/Employers/employers.txt");
        $this->assertEquals('./src/Employers/employers.txt', $employer->get_text_file_destination());
    }
}