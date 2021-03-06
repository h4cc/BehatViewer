<?php
namespace BehatViewer\BehatViewerBundle\Controller;

/**
 *
 */
abstract class BehatViewerProjectController extends BehatViewerController
{
    /**
     * @param array $variables
     *
     * @return array
     */
    public function getResponse(array $variables = array())
    {
        return array_merge(
            array(
                'project' => $this->getRequest()->get('project')
            ),
            parent::getResponse($variables)
        );
    }
}
