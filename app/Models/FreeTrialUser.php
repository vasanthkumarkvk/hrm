<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeTrialUser extends Model
{
    use HasFactory;

    protected $table = 'free_trial_users';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'company_name', 'country', 'mobile', 'domain'];

  
}
