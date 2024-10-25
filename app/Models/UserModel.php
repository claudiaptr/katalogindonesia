<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // The table name
    protected $primaryKey = 'id'; // The primary key
    protected $allowedFields = [
        'username', 
        'email', 
        'password', 
        'no_hp', 
        'foto_profil', 
        'nama_toko', 
        'alamat', 
        'level', 
        'saldo'
    ]; // Fields that can be inserted/updated
    protected $returnType = 'array'; // Type of the return value
    protected $useSoftDeletes = false; // Set to true if you are using soft deletes
    protected $useTimestamps = false; // Set to true if your table has created_at and updated_at fields
    protected $createdField = 'created_at'; // Name of created field
    protected $updatedField = 'updated_at'; // Name of updated field
    protected $deletedField = 'deleted_at'; // Name of deleted field if using soft deletes

    // Optional: Validation rules can be added here
    protected $validationRules = [
        'username' => 'required|is_unique[user.username]',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'no_hp' => 'required',
        'level' => 'in_list[1,2,3]',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'is_unique' => 'This username is already taken',
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please provide a valid email address',
            'is_unique' => 'This email is already in use',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters long',
        ],
    ];

}
