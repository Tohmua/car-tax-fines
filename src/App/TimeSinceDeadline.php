<?php

namespace App;

use DateTime;
use Exception;

class TimeSinceDeadline
{
    public static function days($deadline)
    {
        return (int) self::timeSince($deadline)->format('%R%a');
    }

    public static function weeks($deadline)
    {
        $days = self::days($deadline);
        return (int) floor($days / 7);
    }

    public static function months($deadline)
    {
        return (int) self::timeSince($deadline)->format('%R%m');
    }

    protected static function timeSince($deadline)
    {
        $deadlineDate = new DateTime($deadline);
        $now = new DateTime();

        if ($deadlineDate > $now) {
            throw new DeadlineNotPassed();
        }

        return $deadlineDate->diff($now);
    }
}
