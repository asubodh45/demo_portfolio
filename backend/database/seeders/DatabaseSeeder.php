<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Experience;
use App\Models\Note;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Prajesh Shakya',
            'email' => 'admin@prajeshshakya.com',
            'password' => Hash::make('password'),
        ]);

        $categories = [
            ['name' => 'Brand Identity', 'slug' => 'brand-identity'],
            ['name' => 'Logo Design', 'slug' => 'logo-design'],
            ['name' => 'Packaging', 'slug' => 'packaging'],
            ['name' => 'Print Design', 'slug' => 'print-design'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $brandIdentity = Category::where('slug', 'brand-identity')->first();
        $logoDesign = Category::where('slug', 'logo-design')->first();
        $packaging = Category::where('slug', 'packaging')->first();

        $projects = [
            [
                'title' => 'Luminary Coffee',
                'slug' => 'luminary-coffee',
                'tagline' => 'A premium brand identity for a specialty coffee roaster',
                'description' => 'Complete brand identity system for Luminary Coffee, a specialty coffee roaster focused on single-origin beans. The design language draws inspiration from the golden hour light and the art of precision roasting.',
                'category_id' => $brandIdentity->id,
                'year' => '2024',
                'client' => 'Luminary Coffee Co.',
                'tags' => ['Brand Identity', 'Logo', 'Packaging'],
                'featured' => true,
                'published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Verdant Studio',
                'slug' => 'verdant-studio',
                'tagline' => 'Brand identity for a sustainable interior design studio',
                'description' => 'A clean, nature-inspired brand system for Verdant Studio, an interior design practice focused on biophilic design principles.',
                'category_id' => $brandIdentity->id,
                'year' => '2024',
                'client' => 'Verdant Studio',
                'tags' => ['Brand Identity', 'Typography'],
                'featured' => true,
                'published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Monolith Architecture',
                'slug' => 'monolith-architecture',
                'tagline' => 'Bold identity for a contemporary architecture firm',
                'description' => 'A strong geometric brand identity for Monolith Architecture, reflecting their philosophy of bold, functional design.',
                'category_id' => $logoDesign->id,
                'year' => '2023',
                'client' => 'Monolith Architecture',
                'tags' => ['Logo Design', 'Brand Identity'],
                'featured' => true,
                'published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Drift Wellness',
                'slug' => 'drift-wellness',
                'tagline' => 'Calming identity for a modern wellness brand',
                'description' => 'A serene, flowing brand identity for Drift Wellness, a mindfulness and meditation app.',
                'category_id' => $brandIdentity->id,
                'year' => '2023',
                'client' => 'Drift Wellness',
                'tags' => ['Brand Identity', 'Digital'],
                'featured' => false,
                'published' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Acre Provisions',
                'slug' => 'acre-provisions',
                'tagline' => 'Farm-to-table brand identity and packaging',
                'description' => 'Earthy, honest brand identity for Acre Provisions, an artisan food brand sourcing directly from local farms.',
                'category_id' => $packaging->id,
                'year' => '2023',
                'client' => 'Acre Provisions',
                'tags' => ['Packaging', 'Brand Identity'],
                'featured' => false,
                'published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Prism Creative Agency',
                'slug' => 'prism-creative-agency',
                'tagline' => 'Vibrant rebrand for a full-service creative agency',
                'description' => 'A bold rebrand for Prism Creative Agency, embracing spectrum-inspired visuals and a dynamic typographic system.',
                'category_id' => $brandIdentity->id,
                'year' => '2022',
                'client' => 'Prism Creative Agency',
                'tags' => ['Brand Identity', 'Rebrand'],
                'featured' => false,
                'published' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        $services = [
            ['title' => 'Brand Identity', 'description' => 'Complete brand systems — logo, typography, colour palette, and usage guidelines that tell your story consistently.', 'icon' => 'heroicon-o-identification', 'sort_order' => 1],
            ['title' => 'Logo Design', 'description' => 'Timeless marks crafted to represent your brand\'s values and vision at every scale.', 'icon' => 'heroicon-o-star', 'sort_order' => 2],
            ['title' => 'Brand Strategy', 'description' => 'Positioning, messaging, and competitive research to ensure your brand resonates with the right audience.', 'icon' => 'heroicon-o-light-bulb', 'sort_order' => 3],
            ['title' => 'Packaging Design', 'description' => 'Tactile, shelf-ready packaging that communicates quality and drives purchase decisions.', 'icon' => 'heroicon-o-cube', 'sort_order' => 4],
            ['title' => 'Brand Guidelines', 'description' => 'Comprehensive documentation that keeps your brand consistent across every touchpoint and team.', 'icon' => 'heroicon-o-document-text', 'sort_order' => 5],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $steps = [
            ['step_number' => 1, 'title' => 'Discovery', 'description' => 'We start with a deep dive into your business, audience, and competitive landscape to uncover what makes you distinct.', 'sort_order' => 1],
            ['step_number' => 2, 'title' => 'Strategy', 'description' => 'From insights, we define your brand positioning, personality, and the direction that will guide all creative decisions.', 'sort_order' => 2],
            ['step_number' => 3, 'title' => 'Design', 'description' => 'I craft multiple visual directions, refining the strongest concept into a complete and cohesive identity system.', 'sort_order' => 3],
            ['step_number' => 4, 'title' => 'Delivery', 'description' => 'You receive all final files, brand guidelines, and everything needed to launch and maintain your brand confidently.', 'sort_order' => 4],
        ];

        foreach ($steps as $step) {
            ProcessStep::create($step);
        }

        $skills = [
            ['name' => 'Adobe Illustrator', 'category' => 'Design Tool', 'sort_order' => 1],
            ['name' => 'Adobe Photoshop', 'category' => 'Design Tool', 'sort_order' => 2],
            ['name' => 'Adobe InDesign', 'category' => 'Design Tool', 'sort_order' => 3],
            ['name' => 'Figma', 'category' => 'Design Tool', 'sort_order' => 4],
            ['name' => 'Typography', 'category' => 'Skill', 'sort_order' => 5],
            ['name' => 'Brand Strategy', 'category' => 'Skill', 'sort_order' => 6],
            ['name' => 'Colour Theory', 'category' => 'Skill', 'sort_order' => 7],
            ['name' => 'Print Production', 'category' => 'Skill', 'sort_order' => 8],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        $experiences = [
            ['company' => 'Freelance', 'role' => 'Brand Identity Designer', 'description' => 'Working with clients globally to build meaningful brand identities from the ground up.', 'start_date' => 'Jan 2022', 'end_date' => null, 'is_current' => true, 'sort_order' => 1],
            ['company' => 'Studio North', 'role' => 'Junior Designer', 'description' => 'Contributed to brand identity projects for hospitality and lifestyle clients.', 'start_date' => 'Jun 2020', 'end_date' => 'Dec 2021', 'is_current' => false, 'sort_order' => 2],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        $settings = [
            'site_name' => 'Prajesh Shakya',
            'tagline' => 'Brand Identity Designer',
            'bio' => 'I craft brand identities that help businesses stand out and connect with the people who matter most.',
            'email' => 'hello@prajeshshakya.com',
            'instagram' => 'https://instagram.com/prajeshshakya',
            'behance' => 'https://behance.net/prajeshshakya',
            'linkedin' => 'https://linkedin.com/in/prajeshshakya',
            'available_for_work' => 'true',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::create(['key' => $key, 'value' => $value]);
        }

        Note::create([
            'title' => 'On Building a Brand That Lasts',
            'slug' => 'on-building-a-brand-that-lasts',
            'excerpt' => 'Brand identity is not just about how something looks — it\'s about how it makes people feel.',
            'content' => "Brand identity is not just about how something looks — it's about how it makes people feel.\n\nThe most enduring brands share one trait: clarity. They know exactly who they are, who they're for, and what they stand for. That clarity shapes every visual decision.",
            'published' => true,
            'published_at' => now(),
        ]);
    }
}
