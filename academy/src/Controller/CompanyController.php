<?php


namespace App\Controller;


use App\Entity\Company\Company;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;

/**
 * Class TestController
 * @Route("/company")
 *
 * @package App\Controller
 */
class CompanyController extends AbstractController
{

    /**
     * @Route("/{id}")
     * @Cache(smaxage="3789")
     */
    public function detailsAction(Company $company, ?User $user = null): JsonResponse
    {
        if ($user) {
            //check if user is allowed to see all company details
            //role is granted ($user) -> ROLE_COMPANY_DETAILS
            throw new NotFoundHttpException(); //instead of telling user this route exists but they are not allowed, we say this route doesn't exist
        }

        return new JsonResponse($this->get('serializer')->serialize($company, 'json', ['groups' => ['common', 'company_full']]),
            Response::HTTP_OK, [], true);
    }
}
