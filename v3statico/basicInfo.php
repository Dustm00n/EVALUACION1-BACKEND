<?php
function getBasicInfo() {
    $basicInfo = [
        [
            'tipo' => 'menu-principal',
            'items' => [
                'esp' => [
                    [
                        'link' => '#home',
                        'texto' => 'Inicio',
                        'activo' => true
                    ],
                    [
                        'link' => '#our-services',
                        'texto' => 'Nuestros Servicios',
                        'activo' => true
                    ],
                    [
                        'link' => '#contact-us',
                        'texto' => 'Contáctenos',
                        'activo' => true
                    ],
                    [
                        'link' => '#about-us',
                        'texto' => 'Nosotros',
                        'activo' => true
                    ]
                ],
                'eng' => [
                    [
                        'link' => '#home',
                        'texto' => 'Home',
                        'activo' => true
                    ],
                    [
                        'link' => '#our-services',
                        'texto' => 'Our Services',
                        'activo' => true
                    ],
                    [
                        'link' => '#contact-us',
                        'texto' => 'Contact Us',
                        'activo' => true
                    ],
                    [
                        'link' => '#about-us',
                        'texto' => 'About Us',
                        'activo' => true
                    ]
                ]
            ],
            'activo' => true
        ],
        [
            'tipo' => 'hero',
            'titulo' => [
                'esp' => 'Su socio para soluciones digitales',
                'eng' => 'Your partner for digital solutions'
            ],
            'parrafo' => [
                'esp' => 'Proporcionamos el diseño de TI más responsivo y funcional para empresas y negocios de todo el mundo.',
                'eng' => 'We provide the most responsive and functional IT design for companies and businesses worldwide.'
            ],
            'activo' => true
        ],
        [
            'tipo' => 'contacto',
            'items' => [
                [
                    'tipo' => 'direccion',
                    'valor' => 'Av. Providencia 1234, Oficina 601 Providencia, Santiago Chile',
                    'activo' => true
                ],
                [
                    'tipo' => 'telefono',
                    'valor' => '+56 2 1234 5678',
                    'activo' => true
                ],
                [
                    'tipo' => 'email',
                    'valor' => 'info@coningenio.cl',
                    'activo' => true
                ]
            ],
            'activo' => true
        ],
        [
            'tipo' => 'rrss',
            'items' => [
                [
                    'rrss' => 'facebook',
                    'icono' => 'fa fa-facebook',
                    'link' => '#',
                    'activo' => true
                ],
                [
                    'rrss' => 'instagram',
                    'icono' => 'fa fa-instagram',
                    'link' => '#',
                    'activo' => true
                ]
            ],
            'activo' => true
        ]
    ];
    return $basicInfo;
}
?>