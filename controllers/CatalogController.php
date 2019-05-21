<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class CatalogController extends Controller {
    public function actionIndex($id) {
        $current = App::call()->subcategoryRepository->getOne($id);
        echo $this->render('catalog', [
            'category_name' => $current->name,
            'category' => $current->category_id,
            'category_item' => $id,
            'sort' => $this->currentSort(),
            'perpage' => App::call()->settingRepository->getSiteSetting()->per_page,
            'total' => App::call()->productRepository->getCountWhere('subcategory', $id),
        ]);
    }
    
    public function actionApiCatalog($id) {
        $sort = App::call()->productRepository->getSortString($this->currentSort());
        $page = App::call()->request->getParams()['page'];
        $per_page = App::call()->settingRepository->getSiteSetting()->per_page;
        $start = $per_page * $page;
        $catalog = App::call()->productRepository->getAllWhere('subcategory', $id, $sort, $start, $per_page);
        header('Content-Type: application/json');
        echo json_encode(['catalog' => $catalog], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    }
    
    private function currentSort() {
        $sort = App::call()->request->getParams()['sort'];
        return (is_null($sort)) ? 'price' : $sort;
    }
    
    public function actionSearch() {
        $term = App::call()->request->getParams()['searh'];
        if (isset($term)) {
           $params['term'] = $term;
           $params['count'] = App::call()->productRepository->getCountSearch($term);
           $params['perpage'] = App::call()->settingRepository->getSiteSetting()->per_page;
        }
        $params['pagetitle'] = 'Результаты поиска';
        echo $this->render('search', $params);
    }
    
    public function actionSearchCatalog() {
        $term = App::call()->request->getParams()['searh'];
        $page = App::call()->request->getParams()['page'];
        $per_page = App::call()->settingRepository->getSiteSetting()->per_page;
        $start = $per_page * $page;
        $catalog = App::call()->productRepository->searchProducts($term, $start, $per_page);
        header('Content-Type: application/json');
        echo json_encode(['catalog' => $catalog], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    }
}
