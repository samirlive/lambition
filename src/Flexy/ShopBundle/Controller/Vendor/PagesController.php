<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Repository\Product\CategoryProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class PagesController extends AbstractController
{

    #[Route('/vendor/pages/contract', name: 'flexy_shop_bundle_pages_contract')]
    public function errorImportation(): Response
    {
        return $this->render('@Flexy/ShopBundle/templates/vendor/pages/contract.html.twig');
    }
}
