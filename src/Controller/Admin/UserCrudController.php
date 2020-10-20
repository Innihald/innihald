<?php


namespace App\Controller\Admin;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordEncoderInterface $encoder;

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("username"),
            Field::new("plainPassword")->hideOnIndex()->setRequired(false),
            ArrayField::new("roles")->setSortable(false)
        ];
    }


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    private function setUserPlainPassword(User $user): void
    {
        if ($user->getPlainPassword()) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPlainPassword()));
        }
    }

    public function persistEntity(EntityManagerInterface $entityManager,$entityInstance) : void{
        if($entityInstance instanceof User) {
            $this->setUserPlainPassword($entityInstance);
        }
        parent::persistEntity($entityManager,$entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if($entityInstance instanceof User) {
            $this->setUserPlainPassword($entityInstance);
        }
        parent::updateEntity($entityManager, $entityInstance);
    }

    /**
     * @required
     * @param UserPasswordEncoderInterface $encoder
     */
    public function setEncoder(UserPasswordEncoderInterface $encoder): void
    {
        $this->encoder = $encoder;
    }
}