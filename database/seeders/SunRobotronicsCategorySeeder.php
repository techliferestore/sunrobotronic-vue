<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SunRobotronicsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $position = 1;

        // Helper function to insert category
        $insertCategory = function ($name, $parentId = 1) use (&$position, $now) {
            $id = DB::table('categories')->insertGetId([
                'position'       => $position++,
                'logo_path'      => null,
                'status'         => 1,
                'display_mode'   => 'products_and_description',
                '_lft'           => 0,
                '_rgt'           => 0,
                'parent_id'      => $parentId,
                'additional'     => null,
                'banner_path'    => null,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);

            DB::table('category_translations')->insert([
                'name'        => $name,
                'slug'        => \Str::slug($name),
                'locale'      => 'en',
                'description' => $name,
                'category_id' => $id
            ]);

            return $id;
        };

        // CATEGORY TREE
        $school = $insertCategory('School Projects');
        $primary = $insertCategory('Primary School (K-3)', $school);
        $insertCategory('Basic Science Models', $primary);
        $insertCategory('Simple Crafts', $primary);
        $insertCategory('Environmental Projects', $primary);

        $elementary = $insertCategory('Elementary School (4-6)', $school);
        $insertCategory('Science Fair Projects', $elementary);
        $insertCategory('STEM Learning Kits', $elementary);
        $insertCategory('Basic Electronics', $elementary);

        $middle = $insertCategory('Middle School (7-9)', $school);
        $insertCategory('Advanced Science Projects', $middle);
        $insertCategory('Robotics Basics', $middle);
        $insertCategory('Programming Introduction', $middle);
        $insertCategory('Engineering Challenges', $middle);

        $high = $insertCategory('High School (10-12)', $school);
        $insertCategory('Competition Ready Projects', $high);
        $insertCategory('Advanced Robotics', $high);
        $insertCategory('AI & Machine Learning', $high);
        $insertCategory('Research Projects', $high);

        $tech = $insertCategory('Technology Projects');
        $ai = $insertCategory('Artificial Intelligence', $tech);
        $insertCategory('Computer Vision', $ai);
        $insertCategory('Machine Learning', $ai);
        $insertCategory('Natural Language Processing', $ai);
        $insertCategory('AI Assistants', $ai);

        $robotics = $insertCategory('Robotics & Automation', $tech);
        $insertCategory('Mobile Robots', $robotics);
        $insertCategory('Robotic Arms', $robotics);
        $insertCategory('Humanoid Robots', $robotics);
        $insertCategory('Industrial Automation', $robotics);

        $iot = $insertCategory('IoT & Smart Systems', $tech);
        $insertCategory('Home Automation', $iot);
        $insertCategory('Environmental Monitoring', $iot);
        $insertCategory('Smart Agriculture', $iot);
        $insertCategory('Health Monitoring', $iot);

        $electronics = $insertCategory('Electronics & Circuits', $tech);
        $insertCategory('Arduino Projects', $electronics);
        $insertCategory('Raspberry Pi Projects', $electronics);
        $insertCategory('Microcontroller Systems', $electronics);
        $insertCategory('Sensor Integration', $electronics);

        $sustainability = $insertCategory('Sustainability Tech', $tech);
        $insertCategory('Solar Powered Systems', $sustainability);
        $insertCategory('Environmental Solutions', $sustainability);
        $insertCategory('Energy Harvesting', $sustainability);
        $insertCategory('Green Technology', $sustainability);

        $components = $insertCategory('Components & Parts');
        $micro = $insertCategory('Microcontrollers', $components);
        $insertCategory('Arduino Boards', $micro);
        $insertCategory('Raspberry Pi', $micro);
        $insertCategory('ESP32/ESP8266', $micro);
        $insertCategory('Development Kits', $micro);

        $sensors = $insertCategory('Sensors & Modules', $components);
        $insertCategory('Environmental Sensors', $sensors);
        $insertCategory('Motion Sensors', $sensors);
        $insertCategory('Vision Modules', $sensors);
        $insertCategory('Communication Modules', $sensors);

        $actuators = $insertCategory('Actuators & Motors', $components);
        $insertCategory('Servo Motors', $actuators);
        $insertCategory('Stepper Motors', $actuators);
        $insertCategory('DC Motors', $actuators);
        $insertCategory('Robotic Components', $actuators);

        $power = $insertCategory('Power & Batteries', $components);
        $insertCategory('Battery Packs', $power);
        $insertCategory('Solar Panels', $power);
        $insertCategory('Power Management', $power);
        $insertCategory('Charging Circuits', $power);

        $basicElec = $insertCategory('Basic Electronics', $components);
        $insertCategory('Resistors & Capacitors', $basicElec);
        $insertCategory('LEDs & Displays', $basicElec);
        $insertCategory('Connectors & Cables', $basicElec);
        $insertCategory('Tools & Accessories', $basicElec);

        $learning = $insertCategory('Learning Resources');
        $video = $insertCategory('Video Courses', $learning);
        $insertCategory('Beginner Tutorials', $video);
        $insertCategory('Intermediate Projects', $video);
        $insertCategory('Advanced Concepts', $video);
        $insertCategory('Competition Prep', $video);

        $kits = $insertCategory('Project Kits with Guides', $learning);
        $insertCategory('Step-by-Step Manuals', $kits);
        $insertCategory('Code Examples', $kits);
        $insertCategory('Circuit Diagrams', $kits);
        $insertCategory('Video Instructions', $kits);

        $edu = $insertCategory('Educational Materials', $learning);
        $insertCategory('Theory Books', $edu);
        $insertCategory('Reference Guides', $edu);
        $insertCategory('Safety Manuals', $edu);
        $insertCategory('Best Practices', $edu);

        $interactive = $insertCategory('Interactive Learning', $learning);
        $insertCategory('Simulation Software', $interactive);
        $insertCategory('Online Labs', $interactive);
        $insertCategory('Virtual Experiments', $interactive);
        $insertCategory('Assessment Tools', $interactive);

        $competition = $insertCategory('Competition Projects');
        $scienceFair = $insertCategory('Science Fair Categories', $competition);
        $insertCategory('STEM Olympiad', $scienceFair);
        $insertCategory('Regional Science Fairs', $scienceFair);
        $insertCategory('National Competitions', $scienceFair);
        $insertCategory('International Events', $scienceFair);

        $roboticsComp = $insertCategory('Robotics Competitions', $competition);
        $insertCategory('FIRST Robotics', $roboticsComp);
        $insertCategory('VEX Robotics', $roboticsComp);
        $insertCategory('WRO (World Robot Olympiad)', $roboticsComp);
        $insertCategory('Local Robotics Leagues', $roboticsComp);

        $innovation = $insertCategory('Innovation Challenges', $competition);
        $insertCategory('Hackathons', $innovation);
        $insertCategory('Maker Competitions', $innovation);
        $insertCategory('Invention Contests', $innovation);
        $insertCategory('Startup Challenges', $innovation);

        $academic = $insertCategory('Academic Competitions', $competition);
        $insertCategory('Engineering Challenges', $academic);
        $insertCategory('Programming Contests', $academic);
        $insertCategory('Design Competitions', $academic);
        $insertCategory('Research Presentations', $academic);
    }
}
