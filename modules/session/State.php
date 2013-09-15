<?php

/**
 * Session state enum
 *
 * Enum class automatically created by /bin/enum.php
 */

namespace Rdy4Racing\Modules\Session;

class State {
    const SCHEDULED = 1; // Session is scheduled
    const CLOSED = 2; // Session closed, no more drivers may join
    const OPEN = 3; // Session is open, drivers may join at any time
    const RACING = 4; // Session is closed, drivers have started the race
    const FINISHED = 5; // Session has ended, results pending
    const COMPLETED = 6; // Session has ended, results done
}

