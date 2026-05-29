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
            'email' => 'admin@admin.com',
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
                'category_id' => $brandIdentity->id,
                'year' => '2024',
                'client' => 'Luminary Coffee Co.',
                'tags' => ['Brand Identity', 'Logo', 'Packaging'],
                'featured' => true,
                'published' => true,
                'sort_order' => 1,
                'overview' => 'Complete brand identity system for Luminary Coffee, a specialty coffee roaster focused on single-origin beans. The design language draws inspiration from the golden hour light and the art of precision roasting.',
                'problem' => 'Luminary needed to stand apart in a saturated premium coffee market where most brands default to dark, rustic aesthetics. They wanted to appeal to a younger, design-conscious audience without sacrificing credibility.',
                'approach' => 'We began with an extensive discovery phase — studying competitors, interviewing their core customers, and auditing existing touchpoints. The strategic direction centred on light, warmth, and precision as brand pillars.',
                'solution' => 'A warm golden identity system anchored by a custom logotype and a sun-flare mark. The typography pairs a refined serif with a geometric sans, reflecting both craft and modernity. A restrained palette of amber, cream, and charcoal extends across packaging and collateral.',
                'outcome' => 'The rebrand launched to immediate positive reception. Online engagement increased 40% in the first month and wholesale enquiries doubled within a quarter.',
            ],
            [
                'title' => 'Verdant Studio',
                'slug' => 'verdant-studio',
                'tagline' => 'Brand identity for a sustainable interior design studio',
                'category_id' => $brandIdentity->id,
                'year' => '2024',
                'client' => 'Verdant Studio',
                'tags' => ['Brand Identity', 'Typography'],
                'featured' => true,
                'published' => true,
                'sort_order' => 2,
                'overview' => 'A clean, nature-inspired brand system for Verdant Studio, an interior design practice focused on biophilic design principles.',
                'problem' => 'Verdant had grown through referrals but lacked a visual identity that communicated their unique sustainable philosophy. Their existing materials looked generic and failed to attract the premium clients they were ready for.',
                'approach' => 'Strategy sessions revealed that Verdant\'s true differentiator was their belief that nature improves wellbeing — not just aesthetics. We built the brand around this idea, positioning them as "design rooted in nature."',
                'solution' => 'An earthy, organic identity using a hand-drawn botanical mark alongside a refined typographic system. The palette of sage, warm white, and terracotta mirrors natural materials, while generous white space communicates the calm Verdant creates.',
                'outcome' => 'Within six months of launching, Verdant secured their first international project and rebranded their studio space to align with the new identity.',
            ],
            [
                'title' => 'Monolith Architecture',
                'slug' => 'monolith-architecture',
                'tagline' => 'Bold identity for a contemporary architecture firm',
                'category_id' => $logoDesign->id,
                'year' => '2023',
                'client' => 'Monolith Architecture',
                'tags' => ['Logo Design', 'Brand Identity'],
                'featured' => true,
                'published' => true,
                'sort_order' => 3,
                'overview' => 'A strong geometric brand identity for Monolith Architecture, reflecting their philosophy of bold, functional design.',
                'problem' => 'Monolith\'s portfolio showcased striking, large-scale projects but their brand felt timid and inconsistent — undermining their pitch to major commercial clients.',
                'approach' => 'We audited their portfolio and competitive landscape, identifying a gap for an architectural brand that felt as monumental as the buildings they create. The strategy: confident, structural, enduring.',
                'solution' => 'A bold geometric wordmark constructed on a strict grid, paired with a stark black-and-white system. The identity uses negative space and structural composition principles drawn directly from architectural drawing.',
                'outcome' => 'The new identity was instrumental in winning a landmark cultural centre commission valued at over $20M — their largest project to date.',
            ],
            [
                'title' => 'Drift Wellness',
                'slug' => 'drift-wellness',
                'tagline' => 'Calming identity for a modern wellness brand',
                'category_id' => $brandIdentity->id,
                'year' => '2023',
                'client' => 'Drift Wellness',
                'tags' => ['Brand Identity', 'Digital'],
                'featured' => false,
                'published' => true,
                'sort_order' => 4,
                'overview' => 'A serene, flowing brand identity for Drift Wellness, a mindfulness and meditation app targeting busy professionals.',
                'problem' => 'The wellness app market is crowded with brands using predictable soft pastels and generic "zen" imagery. Drift needed to feel modern and trustworthy, not clichéd.',
                'approach' => 'Research showed their core users — overworked professionals — were skeptical of overly spiritual branding. We positioned Drift as a science-informed practice rather than a lifestyle brand.',
                'solution' => 'A fluid, motion-inspired identity using a liquid gradient mark that shifts between deep navy and soft lavender. The system feels premium and grounded, with a type pairing that balances approachability with authority.',
                'outcome' => 'App downloads increased 65% in the three months following the rebrand. The new identity also supported a successful seed funding round.',
            ],
            [
                'title' => 'Acre Provisions',
                'slug' => 'acre-provisions',
                'tagline' => 'Farm-to-table brand identity and packaging',
                'category_id' => $packaging->id,
                'year' => '2023',
                'client' => 'Acre Provisions',
                'tags' => ['Packaging', 'Brand Identity'],
                'featured' => false,
                'published' => true,
                'sort_order' => 5,
                'overview' => 'Earthy, honest brand identity and packaging for Acre Provisions, an artisan food brand sourcing directly from local farms.',
                'problem' => 'Acre was selling at farmers\' markets but struggling to break into retail. Their packaging looked homemade and failed to justify premium price points on shelves.',
                'approach' => 'Retail packaging requires instant legibility at distance and shelf differentiation. We studied their category, mapped competitor colours, and identified an opportunity in the premium-artisan space where most brands over-design.',
                'solution' => 'A stripped-back packaging system using recycled kraft stock, a stamped-aesthetic wordmark, and a clear hierarchy of product name, farm source, and description. Each product line has a distinct earthy accent colour.',
                'outcome' => 'Acre secured listings with three regional grocery chains within four months of packaging launch. Average retail price increased 30% with no drop in velocity.',
            ],
            [
                'title' => 'Prism Creative Agency',
                'slug' => 'prism-creative-agency',
                'tagline' => 'Vibrant rebrand for a full-service creative agency',
                'category_id' => $brandIdentity->id,
                'year' => '2022',
                'client' => 'Prism Creative Agency',
                'tags' => ['Brand Identity', 'Rebrand'],
                'featured' => false,
                'published' => true,
                'sort_order' => 6,
                'overview' => 'A bold rebrand for Prism Creative Agency, embracing spectrum-inspired visuals and a dynamic typographic system to attract bigger clients.',
                'problem' => 'Despite producing excellent work, Prism\'s brand looked dated and failed to attract the enterprise clients they were capable of serving. Their identity didn\'t communicate the quality of their output.',
                'approach' => 'Agency branding is inherently self-referential — it must demonstrate the quality of thinking you apply to clients. We treated Prism as our most demanding client and applied the full strategic process.',
                'solution' => 'A dynamic identity system built around the concept of light through a prism: a spectrum gradient that shifts across touchpoints, paired with a bold geometric wordmark. The system is flexible enough to feel fresh across different brand applications.',
                'outcome' => 'Prism won their first Fortune 500 client brief within six months of launching the new brand, and grew their team from 8 to 14 people in the following year.',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        $services = [
            [
                'title' => 'Brand Identity',
                'description' => 'Complete visual identity systems including logo design, typography, color palettes, and comprehensive brand guidelines.',
                'deliverables' => ['Logo System', 'Color Palette', 'Typography', 'Guidelines'],
                'icon' => 'heroicon-o-identification',
                'sort_order' => 1,
            ],
            [
                'title' => 'Brand Strategy',
                'description' => 'Deep strategic work including market positioning, audience research, brand messaging, and competitive analysis.',
                'deliverables' => ['Positioning', 'Voice & Tone', 'Messaging', 'Research'],
                'icon' => 'heroicon-o-light-bulb',
                'sort_order' => 2,
            ],
            [
                'title' => 'Visual Systems',
                'description' => 'Scalable design systems for growing brands, including templates, social media assets, and environmental graphics.',
                'deliverables' => ['Templates', 'Social Assets', 'Collateral', 'Graphics'],
                'icon' => 'heroicon-o-squares-2x2',
                'sort_order' => 3,
            ],
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
