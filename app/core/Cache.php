<?php
declare(strict_types=1);
/**
 * This PHP code is designed to automatically delete cache files that have expired.
 * Its execution is intended to be automated by means of a "cron job",
 * a scheduled job that runs in the background on a server on a regular basis.
 * The script's main purpose is to free up storage space by clearing cache files that are no longer needed,
 * preventing the system from filling up with old files.
 */

/**
 * Cron jobs are configured to run every 24 hours by default, but you can modify this schedule as needed.
 *
 * To edit your cron jobs, use the following command:
 * Command: crontab -e
 *
 * Example: To execute this script daily at midnight, add the following line to your crontab:
 * Command: 0 0 * * * /opt/lampp/bin/php /path/to/your/script/framework-v1/app/core/Cache.php
 *
 * Explanation of "0 0 * * *":
 * - The first "0" represents the minute (0 = the start of the hour).
 * - The second "0" represents the hour (0 = midnight).
 * - The first "*" represents the day of the month (every day of the month).
 * - The second "*" represents the month (every month).
 * - The third "*" represents the day of the week (every day of the week).
 * You can modify these values to customize the schedule. For example:
 * - "30 2 * * *": Executes at 2:30 AM every day.
 * - "0 12 1 * *": Executes at noon on the first day of each month.
 * - "0 9 * * 1": Executes at 9:00 AM every Monday.
 *
 * To check if your cron job is running successfully, use the following command:
 * Command: tail -f /var/log/syslog
 */

$currentDirectory = __DIR__;
$rootDirectory = dirname($currentDirectory, 2);

$cache_dir = "$rootDirectory/app/cache/";
# $cache_expiration = 24 * 60 * 60; // 24 hours every 00:00am
$cache_expiration = 60 * 1; // 1 minute every minute

function clean_expired_cache($cache_dir, $cache_expiration, $rootDirectory)
{
    if (is_dir($cache_dir)) {
        foreach (glob("$cache_dir*.cache") as $cache_file) {
            if ((time() - filemtime($cache_file)) >= $cache_expiration) {
                unlink($cache_file);
                file_put_contents("$rootDirectory/app/log/cache.log", "Success:: cache file deleted: $cache_file\n", FILE_APPEND);
            } else {
                file_put_contents("$rootDirectory/app/log/cache.log", "Error:: cache file not deleted: $cache_file\n", FILE_APPEND);
            }
        }
    } else {
        file_put_contents("$rootDirectory/app/log/cache.log", "Error:: cache directory not find\n", FILE_APPEND);
    }
}

clean_expired_cache($cache_dir, $cache_expiration, $rootDirectory);
file_put_contents("$rootDirectory/app/log/cache.log", "Success:: cron job executed at: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
