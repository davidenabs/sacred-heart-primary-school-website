<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('home') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('about') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('contact') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('contact.send') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('management') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('gallery') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('apply') }}</loc>
    </sitemap>
    @if($post != null)
        <sitemap>
            <loc>{{ route('sitemap.posts.index') }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        </sitemap>
    @endif
</sitemapindex>