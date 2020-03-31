<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TemplateTest extends TestCase
{
    /**
     * /products [GET]
     */
    public function testShouldReturnAllTemplates(){

        $response =$this->json('GET', 'checklists/templates') ;
        // $response->seeStatusCode(200);
        $response->seeJsonStructure([
            'meta' => [
                    'count',
                    'total',   
            ],
            'links' => [
                    'first',
                    'last',
                    'next',
                    'prev',
            ],
            'data' => [
                    '*' => [
                        'attributes' =>[
                            'name',
                            'checklist' => [
                                        'description',
                                        'due_interval',
                                        'due_unit',
                                ],
                            'items' => [ 
                                '*' =>[
                                    'description',
                                    'urgency',
                                    'due_interval',
                                    'due_unit'
                                ]
                                
                            ]
                        ]
                                     
                    ]
            ],
        ]);
        
    }

    /**
     * /products/id [GET]
     */
    public function testShouldReturnTemplate(){
        $this->get("checklists/template/5", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'id',
                    'type',
                    'attributes' => [
                        'name',
                        'checklist' => [

                            'description',
                            'due_interval',
                            'due_unit',
                        ],
                        'items' => [ '*' => [
                                'description',
                                'urgency',
                                'due_interval',
                                'due_unit',
                            ]
                        ],
                        
                    ],
                    'links' => ['self']

                ],

            ]    
        );
        
    }

    /**
     * /products [POST]
     */
    public function testShouldCreateProduct(){

        $parameters = [
                "data" => [
                    "attributes" => [
                        "name" => "foo template",
                        "checklist" => [
                            "description" => "my checklist",
                            "due_interval" => 3,
                            "due_unit" => "hour"
                        ],
                        "items" => [ '*' =>
                            [
                                "description" => "my foo item",
                                "urgency" => 2,
                                "due_interval" => 40,
                                "due_unit" => "minute"
                            ],
                            [
                                "description" => "my bar item",
                                "urgency" => 3,
                                "due_interval" => 30,
                                "due_unit" => "minute"
                            ]
                        ]
                    ]
                ]
            
        ];

        $this->post("checklists/templates", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'id',
                    'attributes' => [
                        'name',
                        'checklist' => [
                            'description',
                            'due_interval',
                            'due_unit'
                        ],
                        'items' => [ '*' => [
                                        'description',
                                        'urgency',
                                        'due_interval',
                                        'due_unit'
                                    ]
    
                        ]

                    ]
                ]
            ]    
        );
        
    }
    
    /**
     * /products/id [PUT]
     */
    public function testShouldUpdateProduct(){

        $parameters = [
            "data" => [
                "attributes" => [
                    "name" => "foo template",
                    "checklist" => [
                        "description" => "my checklist",
                        "due_interval" => 3,
                        "due_unit" => "hour"
                    ],
                    "items" => [ '*' =>
                        [
                            "description" => "my foo item",
                            "urgency" => 2,
                            "due_interval" => 40,
                            "due_unit" => "minute"
                        ],
                        [
                            "description" => "my bar item",
                            "urgency" => 3,
                            "due_interval" => 30,
                            "due_unit" => "minute"
                        ]
                    ]
                ]
            ]
        ];

        $this->patch("checklists/template/6", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
           ['data' =>
                [
                    'id',
                    'type',
                    'attributes' => [
                        'name',
                        'checklist' => [

                            'description',
                            'due_interval',
                            'due_unit',
                        ],
                        'items' => [ '*' => [
                                'description',
                                'urgency',
                                'due_interval',
                                'due_unit',
                            ]
                        ],
                        
                    ],
                    'links' => ['self']

                ],

            ]    
        );
    }

    /**
     * /products/id [DELETE]
     */
    public function testShouldDeleteProduct(){
        
        $this->delete("checklists/template/6", [], []);
        $this->seeStatusCode(204);
    }

}