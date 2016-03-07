<?php

namespace src;

require_once('./src/External_storage.php');
require_once('./src/Job_candidate.php');

class Employer {
    private $_text_file_destination;

    function __construct($text_file_destination) {
        $this->set_text_file_destination ($text_file_destination);
    }

    public function employ(External_storage $external_storage, Job_candidate $job_candidate) {
        /**
         * if job_candidate is experienced, insert his name into External_storage
         * else, write his name into a text file
         */
        if ($job_candidate->is_experienced()) {
            $external_storage->insert($job_candidate->getName());
        }
        else {
            /**
             * check if name is not already written into a text file
             */
            if(!exec('grep ' . escapeshellarg($job_candidate->getName()) . ' ' . $this->_text_file_destination)) {
                file_put_contents(
                    $this->_text_file_destination,
                    $job_candidate->getName() . PHP_EOL,
                    FILE_APPEND | LOCK_EX
                );
            }
        }
    }

    public function set_text_file_destination($_text_file_destination) {
        /**
         * check if file exists
         */
        if (file_exists($_text_file_destination)) {
            $this->_text_file_destination = $_text_file_destination;
        }
    }

    public function get_text_file_destination() {
        return $this->_text_file_destination;
    }
}