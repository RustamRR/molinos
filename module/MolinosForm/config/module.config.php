<?php

namespace MolinosForm;

use MolinosForm\Controller\AdminController;
use MolinosForm\Controller\AdminControllerFactory;
use MolinosForm\Controller\IndexController;
use MolinosForm\Controller\IndexControllerFactory;
use MolinosForm\Service\FeedbackService;
use MolinosForm\Service\FeedbackServiceFactory;
use MolinosForm\View\Helper\Feed;
use MolinosForm\View\Helper\Grid;

return array(
    'controllers' => array(
        'factories' => array(
            IndexController::class => IndexControllerFactory::class,
            AdminController::class => AdminControllerFactory::class
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            FeedbackService::class => FeedbackServiceFactory::class,
        )
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
            ),
        ),
        'driver' => array(
            __NAMESPACE__ => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity'
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'MolinosForm\Entity' => __NAMESPACE__,
                ),
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'molinos-form' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/feedback',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        'controller'    => IndexController::class,
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(

                            ),
                        ),
                    ),
                ),
            ),
            'molinos-admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' =>array(
                        'controller' => AdminController::class,
                        'action'    => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action[/:id]]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9]*',
                                'id' => '[0-9]*',
                            ),
                            'defaults' => array(

                            ),
                        )
                    )
                )
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => include __DIR__ . '/../template_map.php',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'grid' => Grid::class,
            'feed' => Feed::class
        ),
    ),
);
