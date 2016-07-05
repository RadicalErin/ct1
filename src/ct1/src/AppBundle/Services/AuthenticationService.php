<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AuthenticationService
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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

    public function logOut($userName)
    {
        $this->container->get('security.token_storage')->setToken(null);
        return true;
    }

    public function newUser($submittedName, $submittedPassword)
    {
        //fail if exists
        if($this->em->getRepository("AppBundle:User")->findOneBy(['name' => $submittedName]))
        {
            return false;
        }
        //create new user object
        $newUser = new User();
        $newUser
            ->setName($submittedName)
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($newUser, $submittedPassword));
        if($this->container->get('security.password_encoder')->isPasswordValid($newUser, $submittedPassword))
        {
            //save if no issues
            $this->em->persist($newUser);
            $this->em->flush();
            return true;
        }
        return false;
    }
}
