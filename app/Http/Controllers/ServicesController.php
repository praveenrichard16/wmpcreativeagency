<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private $services = [
        'static-website' => [
            'title' => 'Static Website Design',
            'category' => 'Website Designing',
            'icon' => 'bi-window',
            'tagline' => 'Fast, secure, and beautiful informational websites.',
            'description' => 'We design stunning static websites crafted for businesses that need a strong online identity without complex databases. Our static sites are highly optimized for speed, fully responsive, and SEO-friendly.',
            'features' => [
                'Lightning-Fast Loading Speed',
                'Fully Responsive layouts (Mobile, Tablet, Desktop)',
                'SEO-Optimized Code Structure',
                'Secure SSL Integration',
                'Custom Agency Styling matching branding colors',
            ],
            'timeline' => '3 - 5 Days Delivery',
            'price' => 'Starts at ₹299',
        ],
        'dynamic-website' => [
            'title' => 'Dynamic Website Development',
            'category' => 'Website Designing',
            'icon' => 'bi-window-sidebar',
            'tagline' => 'Scalable web applications with dynamic content management.',
            'description' => 'Take control of your content with dynamic database-driven applications. Perfect for blogs, portals, and interactive dashboards, our dynamic sites feature custom-built admin desks tailored for your business operations.',
            'features' => [
                'Interactive User Dashboards',
                'Custom Admin Control Panels (CMS)',
                'Database Integration (MySQL, PostgreSQL, SQLite)',
                'Automated User Authentication & Security',
                'API Connections and Integrations',
            ],
            'timeline' => '7 - 14 Days Delivery',
            'price' => 'Starts at ₹799',
        ],
        'ecommerce-website' => [
            'title' => 'eCommerce Web Solutions',
            'category' => 'Website Designing',
            'icon' => 'bi-cart-check-fill',
            'tagline' => 'Sell online effortlessly with robust payment integrations.',
            'description' => 'Launch your online store with high-fidelity, secure shopping portals. From inventory management systems to credit card gateways (Stripe, PayPal), we build responsive online shopping vaults designed to convert visitors.',
            'features' => [
                'Product Inventory Management System',
                'Secure Gateway Checkout Integrations (Stripe & PayPal)',
                'Discount Code & Coupon Engines',
                'Automated Customer Invoicing & Receipting',
                'Order History & Vault Trackers',
            ],
            'timeline' => '10 - 20 Days Delivery',
            'price' => 'Starts at ₹1,299',
        ],
        'seo' => [
            'title' => 'Search Engine Optimization (SEO)',
            'category' => 'Digital Marketing',
            'icon' => 'bi-search-heart-fill',
            'tagline' => 'Rank higher on Google search results and grow organically.',
            'description' => 'Gain premium exposure by optimizing your platform copy and index hierarchy. We perform extensive keyword audits, link-building outreach, and technical site restructuring to ensure Google indexes your brand at the very top.',
            'features' => [
                'On-Page & Technical Site Auditing',
                'High-Traffic Keyword Research',
                'Content Strategy & Meta Tags restructurings',
                'Competitor Density Analytics',
                'Monthly Google Search Console reporting',
            ],
            'timeline' => 'Continuous Strategy',
            'price' => 'Starts at ₹399 / month',
        ],
        'facebook-instagram-ads' => [
            'title' => 'Facebook & Instagram Paid Campaigns',
            'category' => 'Digital Marketing',
            'icon' => 'bi-instagram',
            'tagline' => 'Target high-intent customers on social media platforms.',
            'description' => 'Target specific consumer segments using high-conversion Instagram Reels and Facebook carousel copy. We set up audience pixels, A/B test ad configurations, and optimize budgets to drive direct conversions to your store.',
            'features' => [
                'Custom Audience & Pixel Setup',
                'Ad Creative Asset Generation',
                'A/B Creative and Copy Testing',
                'Retargeting Campaign Desks',
                'ROAS (Return on Ad Spend) Optimization Analytics',
            ],
            'timeline' => 'Setup in 3 Days',
            'price' => 'Starts at ₹499 / month',
        ],
        'google-ads' => [
            'title' => 'Google Search & Display Campaigns',
            'category' => 'Digital Marketing',
            'icon' => 'bi-google',
            'tagline' => 'Intercept buyers actively searching for your services.',
            'description' => 'Run optimized Google Ads campaigns that place your storefront in front of users the moment they search for your products. We construct tight keyword groups and negative keyword lists to maximize conversion rates.',
            'features' => [
                'Google Search, Display & Shopping setups',
                'Strict negative keyword optimizations to avoid waste',
                'High-converting landing page optimization tips',
                'Quality Score audits',
                'Direct Conversion Tracking pixel setups',
            ],
            'timeline' => 'Setup in 3 Days',
            'price' => 'Starts at ₹499 / month',
        ],
        'logo-design' => [
            'title' => 'Luxury Logo & Brandmarks',
            'category' => 'Branding',
            'icon' => 'bi-vector-pen',
            'tagline' => 'Establish visual authority with custom scalable logos.',
            'description' => 'Your logo is the cornerstone of your business identity. We design custom vector marks, secondary brand variations, and color guides optimized for storefront headers, app store icons, and corporate materials.',
            'features' => [
                '3 Distinct Design Concept Layouts',
                'High-Resolution Scalable Vectors (SVG, PDF, EPS)',
                'Transparent Branding PNG Variations',
                'Branding Typography & Palette Guides',
                'Social Media Profile Mockups',
            ],
            'timeline' => '3 - 5 Days Delivery',
            'price' => 'Starts at ₹199',
        ],
        'poster-design' => [
            'title' => 'Poster & Promotion Graphics',
            'category' => 'Branding',
            'icon' => 'bi-postcard-fill',
            'tagline' => 'Stunning layouts for physical and digital campaigns.',
            'description' => 'Promote template releases, corporate webinars, or storefront sales with high-end print-ready poster designs. Designed in agency colors with strict attention to hierarchy, margins, and typography contrast.',
            'features' => [
                'Digital Display Ads & Print-Ready layouts',
                'High-resolution PDF export with print bleed settings',
                'Custom illustration elements',
                'Unlimited revisions to ensure brand alignment',
                'Photorealistic poster mockups for portfolios',
            ],
            'timeline' => '2 - 4 Days Delivery',
            'price' => 'Starts at ₹99',
        ],
        'brochure-design' => [
            'title' => 'Corporate Brochure & Booklet Design',
            'category' => 'Branding',
            'icon' => 'bi-book-half',
            'tagline' => 'Tell your company story with premium layouts.',
            'description' => 'Deliver comprehensive brand credentials or product catalogs with styled multi-page brochures. We organize text blocks, vector graphics, and photography into smooth grids that showcase your agency capability.',
            'features' => [
                'Bi-Fold, Tri-Fold, or Multi-Page booklet structures',
                'Carefully arranged grid structures for readability',
                'High-fidelity custom photography placeholders',
                'Print-ready vector exports with source files',
                'Digital interactive PDF versions (clickable links)',
            ],
            'timeline' => '4 - 7 Days Delivery',
            'price' => 'Starts at ₹249',
        ],
        'sales-funnel' => [
            'title' => 'Sales Funnel Architecture',
            'category' => 'Performance Marketing',
            'icon' => 'bi-filter-square-fill',
            'tagline' => 'Convert cold traffic into loyal repeating buyers.',
            'description' => 'Maximize average customer checkout value by mapping user journeys through opt-ins, high-converting checkout flows, upsell steps, and automated transaction receipts. Built to integrate directly with your product vault.',
            'features' => [
                'Landing Page & Opt-in Squeeze setups',
                'High-Converting Checkout checkout structures',
                'One-Click Upsell & Downsell configuration',
                'Automated email transactional logic setups',
                'Direct analytics integrations (Google Analytics, Mixpanel)',
            ],
            'timeline' => '5 - 10 Days Delivery',
            'price' => 'Starts at ₹599',
        ],
        'lead-generation' => [
            'title' => 'High-Quality Lead Generation',
            'category' => 'Performance Marketing',
            'icon' => 'bi-person-vcard-fill',
            'tagline' => 'Populate your CRM database with qualified hot leads.',
            'description' => 'Acquire consumer inquiries, corporate quote requests, or webinar registrations using highly optimized lead forms. We set up tracking pipelines, design lead magnets, and run campaigns to fill your sales pipeline.',
            'features' => [
                'Lead Magnet concepting & vector generation',
                'Highly optimized Multi-Step Lead forms',
                'CRM Integration (HubSpot, Salesforce, Zapier)',
                'Spam filtering and verification configurations',
                'Detailed cost-per-lead analytic reports',
            ],
            'timeline' => '4 - 8 Days Delivery',
            'price' => 'Starts at ₹499',
        ],
    ];

    public function show($slug)
    {
        if (!isset($this->services[$slug])) {
            abort(404, 'Service not found.');
        }

        $service = $this->services[$slug];
        return view('services.show', compact('service'));
    }
}
