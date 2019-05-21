<?php
use onbuy\engine\{Request, Db};
use onbuy\model\repositories\{
    ProductRepository, 
    UsersRepository, 
    CategoryRepository, 
    SubcategoryRepository, 
    BasketRepository, 
    OrdersRepository, 
    CompanyRepository, 
    ClientsRepository, 
    LegalClientsRepository,
    FeedbackRepository,
    SettingRepository,
    DeliveryRepository
};

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../views/",
    'controllers_namespaces' => 'onbuy\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3307',
            'login' => 'user_shop',
            'password' => 'kj94lFp2Ca',
            'database' => 'onbuy_shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'usersRepository' => [
            'class' => UsersRepository::class
        ],
        'categoryRepository' => [
            'class' => CategoryRepository::class
        ],
        'subcategoryRepository' => [
            'class' => SubcategoryRepository::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ],
        'companyRepository' => [
            'class' => CompanyRepository::class
        ],
        'clientsRepository' => [
            'class' => ClientsRepository::class
        ],
        'legalClientsRepository' => [
            'class' => LegalClientsRepository::class
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class
        ],
        'settingRepository' => [
            'class' => SettingRepository::class
        ],
        'deliveryRepository' => [
            'class' => DeliveryRepository::class
        ],
    ]
];
