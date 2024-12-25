<?php
declare(strict_types=1);
namespace models;
defined('ROOTPATH') or exit . 'Access Denied!';

use core\Database;
use PDO;

class Home
{
    private $cache_dir;
    private $cache_expiration;
    protected $table = 'test';
    protected $order_by = 'id';
    protected $order_type = 'desc';
    protected $limit = 5;
    protected $selectAllowdedColumns = [
        'id',
        'name',
        'create_at'
    ];

    use Database;

    public function cache_dir()
    {
        $currentDirectory = __DIR__;
        $rootDirectory = dirname($currentDirectory, 2);

        $this->cache_dir = "$rootDirectory/app/cache/";
        # $this->cache_expiration = 60 * 60; // 1 hours - every hours it wil be executed..
        $this->cache_expiration = 60 * 1; // 1 minute - every minute it wil be executed.
    }

    public function clean_expired_cache()
    {
        $this->cache_dir();

        if (is_dir($this->cache_dir)) {
            foreach (glob("$this->cache_dir*.cache") as $cache_file) {
                if ((time() - filemtime($cache_file)) >= $this->cache_expiration) {
                    unlink($cache_file);
                    // echo "Cache File Deleted: $cache_file<br>";
                }
            }
        }
    }

    public function queryAllData()
    {
        $pdo = $this->get_connection();

        $this->clean_expired_cache();

        if (!empty($this->selectAllowdedColumns)) {
            $allowdedColumns = implode(", ", $this->selectAllowdedColumns);
        }

        $query = "SELECT $allowdedColumns FROM $this->table ORDER BY $this->order_by $this->order_type LIMIT $this->limit";

        $cache_key = md5($query);
        $cache_file = "$this->cache_dir$cache_key.cache";

        # Verify is file cache exist.
        if (file_exists($cache_file)) {

            # Query data from cache.
            $results = json_decode(file_get_contents($cache_file));

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $results_db = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (!empty($results_db)) {
                // echo "Available data: <br>";

                foreach ($results_db as $result_db) {

                    foreach ($results as $result_cache) {

                        if ($result_db->id == $result_cache->id) {

                            if ($result_db != $result_cache) {
                                // echo "Mismatch between database and cache: <br>";

                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_OBJ);

                                $currentDirectory = __DIR__;
                                $rootDirectory = dirname($currentDirectory, 2);

                                # Save result in cache.
                                if (!is_dir($this->cache_dir)) {
                                    echo $this->cache_dir;
                                    if (!mkdir($this->cache_dir, 0777, true)) {
                                        file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't create cache directory: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                                        die();
                                    }
                                }

                                # Create a tempolary file.
                                $temp_cache_file = "$cache_file.tmp";
                                if (file_put_contents($temp_cache_file, json_encode($results)) === false) {
                                    file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't write in the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                                    die();
                                }

                                # Rename the temporal cache file.
                                if (!rename($temp_cache_file, $cache_file)) {
                                    file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't rename the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                                    die();
                                }

                                return $results;

                            } else {
                                // echo "Data obtained from the cache is identical:<br>";

                            }
                        }
                    }
                }
            } else {
                // echo "No data: <br>";

            }

            return $results;

        } else {

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);

            $currentDirectory = __DIR__;
            $rootDirectory = dirname($currentDirectory, 2);

            # Save result in cache.
            if (!is_dir($this->cache_dir)) {
                echo $this->cache_dir;
                if (!mkdir($this->cache_dir, 0777, true)) {
                    file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't create cache directory: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                    die();
                }
            }

            # Create a tempolary file.
            $temp_cache_file = "$cache_file.tmp";
            if (file_put_contents($temp_cache_file, json_encode($results)) === false) {
                file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't write in the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                die();
            }

            # Rename the temporal cache file.
            if (!rename($temp_cache_file, $cache_file)) {
                file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't rename the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                die();
            }

            // echo "Data don't exist: obtained from the database:<br>";
        }

        return $results;
    }

    public function queryWhereData($id)
    {
        $pdo = $this->get_connection();

        $this->clean_expired_cache();

        /** Select only wanted columns **/
        if (!empty($this->selectAllowdedColumns)) {
            $allowdedColumns = implode(", ", $this->selectAllowdedColumns);
        }

        $query = "SELECT $allowdedColumns FROM $this->table WHERE id = :id";

        $cache_key = md5($query);
        $cache_file = "$this->cache_dir$cache_key.cache";

        # Verify is file cache exist.
        if (file_exists($cache_file)) {
            $result = json_decode(file_get_contents($cache_file));

            if (isset($result->id) && $result->id == $id) {

                // echo "Select data ID: $id, from caché:<br>";
                // print_r($result);

                return $result;

            } else {

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);

                $currentDirectory = __DIR__;
                $rootDirectory = dirname($currentDirectory, 2);

                # Save result in cache.
                if (!is_dir($this->cache_dir)) {
                    echo $this->cache_dir;
                    if (!mkdir($this->cache_dir, 0777, true)) {
                        file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't create cache directory: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                        die();
                    }
                }

                # Create a tempolary file.
                $temp_cache_file = "$cache_file.tmp";
                if (file_put_contents($temp_cache_file, json_encode($result)) === false) {
                    file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't write in the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                    die();
                }

                # Rename the temporal cache file.
                if (!rename($temp_cache_file, $cache_file)) {
                    file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't rename the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                    die();
                }

                // echo "ID not equal: Selecting data ID: $id, from data base<br>";

            }
        } else {

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            $currentDirectory = __DIR__;
            $rootDirectory = dirname($currentDirectory, 2);

            # Save result in cache.
            if (!is_dir($this->cache_dir)) {
                echo $this->cache_dir;
                if (!mkdir($this->cache_dir, 0777, true)) {
                    file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't create cache directory: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                    die();
                }
            }

            # Create a tempolary file.
            $temp_cache_file = "$cache_file.tmp";
            if (file_put_contents($temp_cache_file, json_encode($result)) === false) {
                file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't write in the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                die();
            }

            # Rename the temporal cache file.
            if (!rename($temp_cache_file, $cache_file)) {
                file_put_contents("$rootDirectory/app/log/cache.log", "Error:: Can't rename the temporal cache file: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                die();
            }

            // echo "Data ID don't exist: Selecting data ID: $id, from data base<br>";

        }

        return $result;

    }
}