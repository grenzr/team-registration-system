<?php


namespace App\Controller\Team;


use App\Entity\Team;
use App\Form\Team\TeamCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;

class TeamCreateController
{

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(
        \Twig_Environment $twig,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        FlashBagInterface $flashBag
    ) {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->flashBag = $flashBag;
    }

    public function __invoke(Request $request)
    {
        $team = new Team();
        $form = $this->formFactory->create(TeamCreateType::class, $team);

        $form->handleRequest($request);

        if ($form->isSubmitted()){

            if ($form->isValid()) {

                $this->entityManager->persist($team);
                $this->entityManager->flush();

                $this->flashBag->add('success', sprintf(
                    "Team &quot;%s&quot; successfully created for &quot;%s&quot;",
                    $team->getName(),
                    $team->getEvent()->getName())
                );

                return new RedirectResponse($this->router->generate('team_show', ['team_id' => $team->getId()]));
            }

            $this->flashBag->add('danger', "There were some problems with the information you provided");
        }

        return new Response($this->twig->render('team/create.html.twig', [
            'form' => $form->createView()
        ]));
    }
}
