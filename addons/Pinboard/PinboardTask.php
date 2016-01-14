<?php

namespace Statamic\Addons\Pinboard;

use Statamic\Extend\Task;
use Illuminate\Console\Scheduling\Schedule;
use Log;

class PinboardTask extends Task {

	// look here for common code: http://docs.talonsbeard.com/addons/best-practices/keeping-dry
    private $core;
    
    function init() {
    	$this->core = new Pinboard;
    }
    
	public function schedule(Schedule $schedule)    {
		$schedule->call(function () {
			$this->core = new Pinboard;
			Log::debug("task ran");
			$this->core->writeRecentLinks();
        })->everyTenMinutes();
    }
}