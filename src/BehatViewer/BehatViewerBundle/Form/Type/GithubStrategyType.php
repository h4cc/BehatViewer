<?php
namespace BehatViewer\BehatViewerBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\CallbackValidator,
    Symfony\Component\Form\Form,
    Symfony\Component\Form\AbstractType;

/**
 *
 */
class GithubStrategyType extends AbstractType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'github';
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'      => 'BehatViewer\BehatViewerCoreBundle\Entity\GithubStrategy'
        );
    }

    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array                               $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                'text',
                array(
                    'label' => 'Username',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input-xlarge'
                    )
                )
            )
            ->add(
                'repository',
                'text',
                array(
                    'label' => 'Repository',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input-xlarge'
                    )
                )
            )
            ->add(
                'branch',
                'text',
                array(
                    'label' => 'Branch',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input-xxlarge'
                    )
                )
            )
        ;
    }
}
