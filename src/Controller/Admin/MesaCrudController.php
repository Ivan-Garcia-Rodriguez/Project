<?php

namespace App\Controller\Admin;

use App\Entity\Mesa;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class MesaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mesa::class;
    }

    public function configureFields(string $pageName): iterable
    {
        
        yield Field::new('id')
            ->onlyOnIndex();
            
        yield Field::new('ancho');
        yield Field::new('alto');
        yield Field::new('x');
        yield Field::new('y');
        yield Field::new('imagen');
        
    }

    
  
}
