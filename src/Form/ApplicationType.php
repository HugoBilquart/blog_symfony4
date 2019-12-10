<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType
{
        /**
     * Fonction qui definie le tableau de base . ce qui permet d'éviter la rodondance au niveau du buildform
     * 
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     * 
     */
    protected function getTableau($label , $placeholder, $options = [])
    {
        return array_merge_recursive([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder,
                //'class' => 'customTabl'// creation de la class pour modif le css
            ]
        ],$options);
    }
    
}
