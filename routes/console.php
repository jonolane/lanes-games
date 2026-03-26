<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('guests:cleanup')->daily();