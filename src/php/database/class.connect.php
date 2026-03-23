<?php
/**
 * Create a MySQLi connection to a database
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

class DbConnect {
    protected $dbinfo = [
        'host' => '100.102.89.75',
        'user' => 'Hoek',
        'password' => '',
        'dbname' => 'website'
    ];
    private static $dbConn;
    private static $instance;

    private final function  __construct() {
        if (empty(self::$dbConn)) {
            $this->getConnection();
        }
    }

    /**
     * Create a new instance or get the existing one
     * 
     * @author Hoek
     * @since Mar 22 2026
     * @revisions 0
     */
    public static function Init() {
        if (empty(self::$instance)) {
            self::$instance = new DbConnect();
        }
        return self::$instance;
    }

    /**
     * Get the database connection or create new as needed
     * 
     * @author Hoek
     * @since Mar 22 2026
     * @revisions 0
     */
    public function getConnection() {
        if (empty(self::$dbConn)) {
            self::$dbConn = new mysqli(
                $this->dbinfo['host'],
                $this->dbinfo['user'],
                $this->dbinfo['password'],
                $this->dbinfo['dbname']
            );
            if (self::$dbConn->connect_error) {
                throw new mysqli_sql_exception("Fatal error: #" . self::$dbConn->connect_errno . " : " . self::$dbConn->connect_error);
            }
        }
        return self::$dbConn;
    }
}