<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Post;

class ScraperService
{
    const LIMIT = 10;

    /**
     * @param string $url
     */
    public function scrapTechCrunch(string $url): void
    {
        $crawler = \Goutte::request('GET', $url);
        $crawler->filter('.post-block')->each(function ($node, $key) {
            if ($key >= static::LIMIT) {
                return false;
            }

            $title = trim($node->filter('header h2 a')->text());
            $authorName = trim($node->filter('header div div span a')->text());
            $articleDate = trim($node->filter('div div div time')->attr('datetime'));
            $excerpt = trim($node->filter('.post-block__content')->text());
            $imageUrl = trim($node->filter('footer .post-block__media img')->attr('src'));

            Post::create([
                'title' => $title,
                'author_name' => $authorName,
                'image_url' => $imageUrl,
                'excerpt'      => $excerpt,
                'article_date' => \Carbon\Carbon::parse($articleDate)->addHours(12)
            ]);
        });
    }
}
