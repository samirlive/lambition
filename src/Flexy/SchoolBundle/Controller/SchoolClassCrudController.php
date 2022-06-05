<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\SchoolClass;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class SchoolClassCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SchoolClass::class;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $schoolClass = $entityInstance;
        foreach($schoolClass->getStudents() as $student){
            $student->setSchoolClass($schoolClass);
            $entityManager->persist($student);
        }

        foreach($schoolClass->getSchoolSubjects() as $schoolSubject){
            $schoolSubject->addSchoolClass($schoolClass);
            $entityManager->persist($schoolSubject);
        }
        
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $schoolClass = $entityInstance;

        foreach($schoolClass->getStudents() as $student){
            $student->setSchoolClass($schoolClass);
            $entityManager->persist($student);
        }
        foreach($schoolClass->getSchoolSubjects() as $schoolSubject){
            $schoolSubject->addSchoolClass($schoolClass);
            $entityManager->persist($schoolSubject);
        }
        $entityManager->flush();
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('schoolYear'),
            AssociationField::new('students'),
            AssociationField::new('schoolSubjects'),
        ];
    }
    
}
