<?php 
namespace Model;

class User extends ActiveRecord 
{
    // Table for this model
    protected static $table = 'users';

    // Columns for the table
    protected static $column_db = [
        'id',
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'admin',
        'confirmed',
        'token'
    ];
    
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $confirmed;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmed = $args['confirmed'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    public function validNewAccount()
    {
        if(!$this->name) {
            self::$alerts['error'][] = 'Debes agregar tu nombre.';    
        }
        if(!$this->lastname) {
            self::$alerts['error'][] = 'Debes agregar tu apellido.';    
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'El E-Mail es obligatorio.';    
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña es obligatoria.';    
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'La contraseña debe contener al menos 6 caracteres.';    
        }

        return self::$alerts;
    }
    
    public function validLogin()
    {
        if(!$this->email) {
            self::$alerts['error'][] = 'El E-Mail es obligatorio';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'El password es obligatorio';
        }

        return self::$alerts;
    }
    
    public function validEmail()
    {
        if(!$this->email) {
            self::$alerts['error'][] = 'El E-Mail es obligatorio';
        }

        return self::$alerts;
    }

    public function validPassword()
    {
        if(!$this->password) {
            self::$alerts['error'][] = 'El password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'La contraseña debe contener al menos 6 caracteres.';    
        }
        return self::$alerts;
    }

    // See if user exists
    public function userExists() 
    {   
        $query = " SELECT * FROM " . self::$table . " WHERE email = '$this->email' LIMIT 1";

        $result = self::$db->query($query);

        if($result->num_rows) {
            self::$alerts['error'][] = 'User already exists';
        }
        return $result;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function createToken() 
    {
        $this->token = uniqid();
    }

    public function checkPasswordAndVerified($password)
    {
        $result = password_verify($password, $this->password);

        if(!$result || !$this->confirmed) {
            self::$alerts['error'][] = 'Password incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
}
