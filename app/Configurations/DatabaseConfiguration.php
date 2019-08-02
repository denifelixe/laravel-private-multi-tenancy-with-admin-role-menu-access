<?php 

namespace App\Configurations;

use App\Repositories\Master\Tenants\TenantInterface;
use Illuminate\Support\Facades\DB;
use PDO;

class DatabaseConfiguration
{
	public static function connectToDatabase(array $connection) :void
	{
        
        DB::purge($connection['connection']);

        config(['database.default' => $connection['connection']]);

        switch ($connection['connection']) {
            case 'mysql':

                config([

                    'database.connections.mysql' => [
                        'driver' => 'mysql',
                        'url' => $connection['url'],
                        'host' => $connection['host'],
                        'port' => $connection['port'],
                        'database' => $connection['database'],
                        'username' => $connection['username'],
                        'password' => decrypt($connection['password']),
                        'unix_socket' => $connection['socket'],
                        'charset' => 'utf8mb4',
                        'collation' => 'utf8mb4_unicode_ci',
                        'prefix' => '',
                        'prefix_indexes' => true,
                        'strict' => true,
                        'engine' => null,
                        'options' => extension_loaded('pdo_mysql') ? array_filter([
                            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                        ]) : [],
                    ]

                ]);
                
                break;
            
            default:
                break;
        }

        DB::reconnect($connection['connection']);
	}

    public static function resetConnectionToMasterDatabase() :void
    {
        $connection = [
            'connection' => env('DB_CONNECTION'),
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => encrypt(env('DB_PASSWORD')),
            'socket' => env('DB_SOCKET'),
            'foreign_keys' => env('DB_FOREIGN_KEYS')
        ];

        static::connectToDatabase($connection);

    }

    public static function resetConnectionToTenantDatabase(string $subdomain) :void
    {
        $tenants_repo = resolve(TenantInterface::class);

        $connection = $tenants_repo->getDatabaseConnectionBySubdomain($subdomain);

        static::connectToDatabase($connection);

    }
}