<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

return [
    'doctrine' => [
        'migrations_configuration' => [
            'orm_default' => [
                'namespace' => 'OrmDefaultMigrations',
                'directory' => __DIR__ . '/../../migrations/orm_default',
                'table' => 'doctrine_migration_versions',
            ],
        ],
        'connection' => [
            'orm_default' => [
                'params' => [
                    'host' => '',
                    'port' => '',
                    'user' => '',
                    'password' => '',
                    'dbname' => '',
                    'driver' => '',
                ]
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            'doctrine.entitymanager.orm_default' => new DoctrineORMModule\Service\EntityManagerFactory('orm_default'),
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ],
    ],

];
