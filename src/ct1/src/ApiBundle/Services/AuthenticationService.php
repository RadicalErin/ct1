<?php
namespace ApiBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

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
        $user = $this->em->getRepository("AppBundle:User")->loadUserByUsername($submittedName);
        if(!$user)
        {
            throw new UsernameNotFoundException("invalid user name provided");
        } else {
            $token = new UsernamePasswordToken($user, $submittedPassword, "publicfw", $user->getRoles());
            $this->container->get('security.token_storage')->setToken($token);
            return $token;
        }
    }

    /**
     * @param string $userName
     * @return boolean
     */
    public function logOut($userName)
    {
        $this->container->get('security.token_storage')->setToken(null);
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
            //
        }
        try {
            $newUser = new User();
            $newUser
                ->setUsername($submittedName)
                ->setPassword($submittedPassword);
            $this->em->persist($newUser);
            $this->em->flush();
        } catch (\Exception $e) {
            echo($e); die();
        }
        return true;
    }
}
