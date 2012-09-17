<?php

namespace BehatViewer\BehatViewerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration,
    JMS\SecurityExtraBundle\Annotation as Security,
    BehatViewer\BehatViewerCoreBundle\Entity;

class HistoryController extends BehatViewerProjectController
{
    /**
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\User    $user
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\Project $project
     * @param int                                               $page
     *
     * @return array
     *
     * @Configuration\Template()
     */
    public function indexAction(Entity\User $user, Entity\Project $project, $page = 1)
    {
        $builds = array();
        $pages = $page <= 0 ? 1 : $page;
        if ($project !== null) {
            $total = $this->getDoctrine()->getRepository('BehatViewerCoreBundle:Build')->findBy(
                array(
                    'project' => $project->getId()
                )
            );
            $pages = ceil(sizeof($total) / 10);

            $page = $page < 1 ? 1 : $page;
            $page = $page > $pages ? $pages : $page;

            $builds = $this->getDoctrine()->getRepository('BehatViewerCoreBundle:Build')->findBy(
                array(
                    'project' => $project->getId()
                ),
                array(
                    'id' => 'DESC'
                ),
                10,
                10 * (($page - 1) < 0 ? 0 : ($page - 1))
            );
        }

        return $this->getResponse(array(
            'items' => $builds,
            'current' => $page,
            'pages' => $pages
        ));
    }

    /**
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\User       $user
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\Project    $project
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\Build|null $build
     * @param string|null                                          $type
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Configuration\Template()
     */
    public function entryAction(Entity\User $user, Entity\Project $project, Entity\Build $build = null, $type = null)
    {
        $repository = $this->getDoctrine()->getRepository('BehatViewerCoreBundle:Build');
        $build = $repository->findOneByProjectAndId($project, $build);

        if (null === $type) {
            $type = $this->getViewType('thumb');
        }
        $this->setViewType($type);

        $view = 'entry' . ($type !== null ? '-' . $type : '');

        return $this->render(
            'BehatViewerBundle:History:' . $view . '.html.twig',
            $this->getResponse(
                array(
                    'build' => $build,
                    'items' => null !== $build ? $build->getFeatures() : array()
                )
            )
        );
    }

    /**
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\User       $user
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\Project    $project
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\Build|null $build
     *
     * @return \Symfony\Component\HttpFoundation\Response|array
     *
     * @Configuration\Template("BehatViewerBundle:History:index.html.twig")
     * @Security\Secure(roles="ROLE_USER")
     * @Security\SecureParam(name="project", permissions="EDIT")
     */
    public function deleteAction(Entity\User $user, Entity\Project $project, Entity\Build $build)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($build);
        $manager->flush();

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    /**
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\User    $user
     * @param \BehatViewer\BehatViewerCoreBundle\Entity\Project $project
     *
     * @return array
     *
     * @Configuration\Method({"POST"})
     * @Configuration\Template("BehatViewerBundle:History:index.html.twig")
     * @Security\Secure(roles="ROLE_USER")
     * @Security\SecureParam(name="project", permissions="EDIT")
     */
    public function deleteSelectedAction(Entity\User $user, Entity\Project $project)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('BehatViewerCoreBundle:Build');

        foreach ($this->getRequest()->get('delete', array()) as $id) {
            $build = $repository->findOneById($id);
            $manager->remove($build);
            $manager->flush();
        }

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}
