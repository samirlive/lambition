<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Repository\Product\CategoryProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class ImportExcelController extends AbstractController
{



    #[Route('/vendor/import/excel-documentation', name: 'flexy_shop_bundle_import_excel_documentation')]
    public function documentation(CategoryProductRepository $categoryProductRepository): Response
    {
        $categories = $categoryProductRepository->findAll();
        return $this->render('@Flexy/ShopBundle/templates/vendor/importExcel/documentation.html.twig',["categories"=>$categories]);
    }


    #[Route('/vendor/import/excel-error', name: 'flexy_shop_bundle_import_excel_error')]
    public function errorImportation(): Response
    {
        return $this->render('@Flexy/ShopBundle/templates/vendor/importExcel/errorImportation.html.twig');
    }
}
