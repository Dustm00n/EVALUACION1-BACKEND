<?php
function getServices() {
    $services = [
        [
            'id' => 1,
            'titulo' => [
                'esp' => 'Consultoría digital',
                'eng' => 'Digital consulting'
            ],
            'descripcion' => [
                'esp' => 'Identificamos las fallas y conectamos los puntos entre tu negocio y tu estrategia digital. Nuestro equipo experto cuenta con años de experiencia en la definición de estrategias y hojas de ruta en función de tus objetivos específicos.',
                'eng' => 'We identify failures and connect the dots between your business and your digital strategy. Our expert team has years of experience defining strategies and roadmaps based on your specific objectives.'
            ],
            'activo' => true
        ],
        [
            'id' => 2,
            'titulo' => [
                'esp' => 'Soluciones multiexperiencia',
                'eng' => 'Multi-experience solutions'
            ],
            'descripcion' => [
                'esp' => 'Deleitamos a las personas usuarias con experiencias interconectadas a través de aplicaciones web, móviles, interfaces conversacionales, digital twin, IoT y AR. Su arquitectura puede adaptarse y evolucionar para adaptarse a los cambios de tu organización.',
                'eng' => 'We delight users with interconnected experiences through web applications, mobile applications, conversational interfaces, digital twin, IoT and AR. Its architecture can adapt and evolve to adapt to changes in your organization.'
            ],
            'activo' => true
        ],
        [
            'id' => 3,
            'titulo' => [
                'esp' => 'Evolución de ecosistemas',
                'eng' => 'Ecosystem evolution'
            ],
            'descripcion' => [
                'esp' => 'Ayudamos a las empresas a evolucionar y ejecutar sus aplicaciones de forma eficiente, desplegando equipos especializados en la modernización y el mantenimiento de ecosistemas técnicos. Creando soluciones robustas en tecnologías de vanguardia.',
                'eng' => 'We help companies evolve and run their applications efficiently, deploying teams specialized in the modernization and maintenance of technical ecosystems. Creating robust solutions in cutting-edge technologies.'
            ],
            'activo' => true
        ],
        [
            'id' => 4,
            'titulo' => [
                'esp' => 'Soluciones Low-Code',
                'eng' => 'Low-Code Solutions'
            ],
            'descripcion' => [
                'esp' => 'Traemos el poder de las soluciones low-code y no-code para ayudar a nuestros clientes a acelerar su salida al mercado y añadir valor. Aumentamos la productividad y la calidad, reduciendo los requisitos de cualificación de los desarrolladores.',
                'eng' => 'We bring the power of low-code and no-code solutions to help our clients accelerate time to market and add value. We increase productivity and quality, reducing developer qualification requirements.'
            ],
            'activo' => true
        ]
    ];
    return $services;
}
?>