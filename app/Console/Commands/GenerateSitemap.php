<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use App\Models\Product;
use App\Models\Category;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->getSitemap();

        // Ajoutez la page d'accueil
        $sitemap->add(Url::create('/'));

        // Ajoutez les pages statiques
        $sitemap->add(Url::create('/about-shop'));
        $sitemap->add(Url::create('/confidentialitychop'));
        $sitemap->add(Url::create('/conditionshop'));
        $sitemap->add(Url::create('/contact'));

        // Ajoutez les produits
        Product::all()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(Url::create("/showproduct/{$product->id}")
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        });

        // Ajoutez les catégories
        // Category::all()->each(function (Category $category) use ($sitemap) {
        //     $sitemap->add(Url::create("/category/{$category->slug}")
        //         ->setLastModificationDate($category->updated_at)
        //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        //         ->setPriority(0.7));
        // });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}