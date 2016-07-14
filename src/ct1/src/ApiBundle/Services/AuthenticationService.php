<?php
namespace ApiBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class AuthenticationService
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param string $submittedName
     * @param string $submittedPassword
     * @return string
     */
    public function logIn($submittedName, $submittedPassword)
    {
        if($result =  $this->em->getRepository("AppBundle:User")->findOneBy(array('username' => $submittedName))){
            try {
                if($result->getPassword = $submittedPassword){
                    return true;
                }
            } catch (\Exception $e) {
                return trigger_error("An error occurred while logging in", E_USER_ERROR);
            }
        }
        return trigger_error("Unable to verify user/password combination", E_USER_ERROR);
    }

    /**
     * @param string $userName
     * @return boolean
     */
    public function logOut($userName)
    {
        //at the moment, we aren't really doing this properly, so there's nothing to 'do'
        return true;
    }

    /**
     * @param string $submittedName
     * @param string $submittedPassword
     * @return boolean
     */
    public function newUser($submittedName, $submittedPassword)
    {
        if($results =  $this->em->getRepository("AppBundle:User")->findBy(array('username' => $submittedName))){
            return trigger_error("The username provided already exists", E_USER_ERROR);
        }
        try {
            $newUser = new User();
            $newUser
                ->setUsername($submittedName)
                ->setPassword($submittedPassword);
            $this->em->persist($newUser);
            $this->em->flush();
        } catch (\Exception $e) {
            return trigger_error("Could not create new user", E_USER_ERROR);
        }
        return true;
    }
}
