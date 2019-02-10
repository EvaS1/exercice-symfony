<?php

namespace App\Form;

use App\Entity\Ami;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AmiType extends AbstractType {

	//Fonction pour créer le formulaire
	public function buildForm(FormBuilderInterface $builder, array $options) {

		$test = $options['action_name'];

		$builder
		->add('nomAmi') 
		->add('prenomAmi')
		->add('nomVille')
		->add('save', SubmitType::class, array('label' => $test))
		;
	}


	//Spécifications des options obligatoires/facultatives
	public function configureOptions(OptionsResolver $resolver) {

		$resolver->setDefaults([
			'data_class' => Ami::class,
			'action_name' => 'new',
		]);

	}

}


?>