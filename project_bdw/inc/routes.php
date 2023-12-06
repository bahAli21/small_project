<?php

$routes = [

             "Home" => [

                        "controller" => "homeController",
                        "template" => "home"
             ],

             "Stats" => [

                        "controller" => "StatsController",
                        "template" => "Stats"
             ],

             "Services" => [
                              'one'=> [
                                "controller" => "service",
                                "template" => "services"
                              ],

                              'two'=> [
                                "controller" => "AddServiceController",
                                "template" => "services"
                              ],

             ],

             "Form" => [

                        "controller" => "formController",
                        "template" => "form"
             ],


             "AllServices" => [

                        "controller" => "AllServiceController",
                        "template" => "allService"
             ],

             "Remerciement" => [

                        "controller" => "remerciementController",
                        "template" => "remerciement"
             ],

             "Essaie" => [

                        "controller" => "homeEssaieController",
                        "template" => "homeEssaie"
             ],

             "formEssaie" => [

                        "controller" => "essaiController",
                        "template" => "essaiForm"
             ],

             "OursEssaie" => [

                        "controller" => "periodeEssaieController",
                        "template" => "periodeEssaie"
             ],

];
