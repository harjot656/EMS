<?php

namespace App;

require_once './vendor/autoload.php';
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;



class FirebaseDb extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];
*/
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    
    
    public function get_database()
    {   

        try{ 

            $serviceAccount = ServiceAccount::fromJsonFile('./vendor/ems-php-7be99-008e26379391.json');
            $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
            $database = $firebase->getDatabase();    
            return $database;
            //print_r($database);
        }
        catch(Exception $e)
        {
          echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
    
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
