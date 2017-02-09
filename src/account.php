<?php
class Account
{
    private $name;
    private $password;
    private $amount;

    function __construct($person_name, $person_password, $person_amount)
    {
        $this->name = $person_name;
        $this->password = $person_password;
        $this->amount = $person_amount;
    }

    function getName()
    {
        return $this->name;
    }

    function getPassword()
    {
        return $this->password;
    }
    function getAmount()
    {
        return $this->amount;
    }

    function save()
    {
        array_push($_SESSION['bank_accounts'], $this);
    }
    static function getAll()
    {
        return $_SESSION['bank_accounts'];
    }

}
?>
