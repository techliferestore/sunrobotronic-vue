<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Webkul\Installer\Database\Seeders\DatabaseSeeder as BagistoDatabaseSeeder;

class CategoriesFullSeeder extends Seeder
{
    private $lftCounter = 1;
    private $locale = 'en'; // Change if you use another locale

    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('category_translations')->truncate();

        $now = Carbon::now();

        // Root Category
        $rootId = $this->insertCategory('Sun Robotronics', null, $now);

        // Define full hierarchy
        $data = [
            'School Projects' => [
                'Primary School (K-3)' => [
                    'Basic Science Models' => [],
                    'Simple Crafts' => [],
                    'Environmental Projects' => []
                ],
                'Elementary School (4-6)' => [
                    'Science Fair Projects' => [],
                    'STEM Learning Kits' => [],
                    'Basic Electronics' => []
                ],
                'Middle School (7-9)' => [
                    'Advanced Science Projects' => [],
                    'Robotics Basics' => [],
                    'Programming Introduction' => [],
                    'Engineering Challenges' => []
                ],
                'High School (10-12)' => [
                    'Competition Ready Projects' => [],
                    'Advanced Robotics' => [],
                    'AI & Machine Learning' => [],
                    'Research Projects' => []
                ]
            ],
            'Technology Projects' => [
                'Artificial Intelligence' => [
                    'Computer Vision' => [],
                    'Machine Learning' => [],
                    'Natural Language Processing' => [],
                    'AI Assistants' => []
                ],
                'Robotics & Automation' => [
                    'Mobile Robots' => [],
                    'Robotic Arms' => [],
                    'Humanoid Robots' => [],
                    'Industrial Automation' => []
                ],
                'IoT & Smart Systems' => [
                    'Home Automation' => [],
                    'Environmental Monitoring' => [],
                    'Smart Agriculture' => [],
                    'Health Monitoring' => []
                ],
                'Electronics & Circuits' => [
                    'Arduino Projects' => [],
                    'Raspberry Pi Projects' => [],
                    'Microcontroller Systems' => [],
                    'Sensor Integration' => []
                ],
                'Sustainability Tech' => [
                    'Solar Powered Systems' => [],
                    'Environmental Solutions' => [],
                    'Energy Harvesting' => [],
                    'Green Technology' => []
                ]
            ],
            'Components & Parts' => [
                'Microcontrollers' => [
                    'Arduino Boards' => [],
                    'Raspberry Pi' => [],
                    'ESP32/ESP8266' => [],
                    'Development Kits' => []
                ],
                'Sensors & Modules' => [
                    'Environmental Sensors' => [],
                    'Motion Sensors' => [],
                    'Vision Modules' => [],
                    'Communication Modules' => []
                ],
                'Actuators & Motors' => [
                    'Servo Motors' => [],
                    'Stepper Motors' => [],
                    'DC Motors' => [],
                    'Robotic Components' => []
                ],
                'Power & Batteries' => [
                    'Battery Packs' => [],
                    'Solar Panels' => [],
                    'Power Management' => [],
                    'Charging Circuits' => []
                ],
                'Basic Electronics' => [
                    'Resistors & Capacitors' => [],
                    'LEDs & Displays' => [],
                    'Connectors & Cables' => [],
                    'Tools & Accessories' => []
                ]
            ],
            'Learning Resources' => [
                'Video Courses' => [
                    'Beginner Tutorials' => [],
                    'Intermediate Projects' => [],
                    'Advanced Concepts' => [],
                    'Competition Prep' => []
                ],
                'Project Kits with Guides' => [
                    'Step-by-Step Manuals' => [],
                    'Code Examples' => [],
                    'Circuit Diagrams' => [],
                    'Video Instructions' => []
                ],
                'Educational Materials' => [
                    'Theory Books' => [],
                    'Reference Guides' => [],
                    'Safety Manuals' => [],
                    'Best Practices' => []
                ],
                'Interactive Learning' => [
                    'Simulation Software' => [],
                    'Online Labs' => [],
                    'Virtual Experiments' => [],
                    'Assessment Tools' => []
                ]
            ],
            'Competition Projects' => [
                'Science Fair Categories' => [
                    'STEM Olympiad' => [],
                    'Regional Science Fairs' => [],
                    'National Competitions' => [],
                    'International Events' => []
                ],
                'Robotics Competitions' => [
                    'FIRST Robotics' => [],
                    'VEX Robotics' => [],
                    'WRO (World Robot Olympiad)' => [],
                    'Local Robotics Leagues' => []
                ],
                'Innovation Challenges' => [
                    'Hackathons' => [],
                    'Maker Competitions' => [],
                    'Invention Contests' => [],
                    'Startup Challenges' => []
                ],
                'Academic Competitions' => [
                    'Engineering Challenges' => [],
                    'Programming Contests' => [],
                    'Design Competitions' => [],
                    'Research Presentations' => []
                ]
            ]
        ];

        // Insert all categories recursively
        $this->insertTree($data, $rootId, $now);
    }

    private function insertTree(array $tree, $parentId, $now)
    {
        foreach ($tree as $name => $children) {
            $id = $this->insertCategory($name, $parentId, $now);

            if (!empty($children)) {
                $this->insertTree($children, $id, $now);
            }
        }
    }

    private function insertCategory($name, $parentId, $now)
    {
        $lft = $this->lftCounter++;
        $rgt = $this->lftCounter++;

        $id = DB::table('categories')->insertGetId([
            'position'      => 0,
            'logo_path'     => null,
            'status'        => 1,
            'display_mode'  => 'products_and_description',
            '_lft'          => $lft,
            '_rgt'          => $rgt,
            'parent_id'     => $parentId,
            'additional'    => null,
            'banner_path'   => null,
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        // Insert translation
        DB::table('category_translations')->insert([
            'name'        => $name,
            'slug'        => strtolower(str_replace(' ', '-', $name)),
            'description' => null,
            'meta_title'  => $name,
            'meta_description' => $name,
            'meta_keywords'    => $name,
            'category_id' => $id,
            'locale'      => $this->locale,
        ]);

        return $id;
    }
}
