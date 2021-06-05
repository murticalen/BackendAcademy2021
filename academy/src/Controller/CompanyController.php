<?php


namespace App\Controller;


use App\Entity\Company\Company;
use App\Entity\Device\Device;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class TestController
 * @Route("/company")
 *
 * @package App\Controller
 */
class CompanyController extends AbstractController
{

    /**
     * @Route("/{id}/details")
     */
    public function noParamConverterDetailsAction(int $id, EntityManagerInterface $entityManager)
    {
//        $companyAssoc = $entityManager->getConnection()->fetchAllAssociative('SELECT * FROM company WHERE id = :id', ['id' => $id]);
//
//        return new Response(json_encode($companyAssoc));

        $company = $entityManager->getRepository(Company::class)->find($id);

        if (!$company) {
            throw new NotFoundHttpException();
        }

        return new Response($company->getName());
    }

    /**
     * @Route("/{id}")
     * @ParamConverter("company", class=Company::class, options={"id": "id"})
     * @Cache(smaxage="3789")
     */
    public function detailsAction(Company $company, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($company, 'json', ['groups' => ['common', 'company_full']]),
            Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}/device/{deviceId}")
     * @ParamConverter("company", class=Company::class, options={"id": "id"})
     * @ParamConverter("device", class=Device::class, options={"id": "deviceId"})
     * @Cache(smaxage="3789")
     */
    public function detailsWithDeviceAction(Company $company, Device $device, ?User $user = null, EntityManagerInterface $entityManager,
        SerializerInterface $serializer): JsonResponse
    {
        if (!$user || !in_array('ROLE_COMPANY_DETAILS', $user->getRoles(), true)) {
            //check if user is allowed to see all company details
            //role is granted ($user) -> ROLE_COMPANY_DETAILS
            throw new NotFoundHttpException(); //instead of telling user this route exists but they are not allowed, we say this route doesn't exist
        }

        return new JsonResponse($serializer->serialize([
            'device'  => $device,
            'company' => $company,
        ], 'json', ['groups' => ['common', 'company_full']]),
            Response::HTTP_OK, [], true);
    }
}
