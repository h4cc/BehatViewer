<?php
namespace BehatViewer\BehatViewerBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\CallbackValidator,
    Symfony\Component\Form\Form,
    Symfony\Component\Form\AbstractType;

/**
 *
 */
class LocalStrategyType extends AbstractType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'local';
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'      => 'BehatViewer\BehatViewerCoreBundle\Entity\LocalStrategy'
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
                'path',
                'text',
                array(
                    'label' => 'Path',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input-xlarge'
                    )
                )
            )
            ->add(
                'base_url',
                'url',
                array(
                    'label' => 'Base URL',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input-xlarge'
                    )
                )
            )
        ;
    }
}
