<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as FormValidator;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseEntity
{
    /**
     * @ORM\Column(type="string", length=128)
     * @FormValidator\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @FormValidator\NotBlank()
     */
    private $password;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    } 
}
